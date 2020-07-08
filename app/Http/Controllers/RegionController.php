<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use App\Region;
use App\Basic;
use App\Medium;
use App\Higer;
use App\User;
use Illuminate\Support\Facades\App;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol == 0) {
            $region_id = Auth::user()->region_id;
            $regions = Region::where('id', $region_id)->paginate(1);

            return view('user.regions.index', compact('regions'));
        } else {
            $regions = Region::paginate(5);
            $regions->sortBy('nameRegion');
            return view('user.regions.index', compact('regions'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->except('_token');

        $request->validate([
            'id' => 'required|integer',
            'region' => 'required|integer|max:100',
            'name' => 'required|string',
        ]);

        $region = new Region();
        $region->id = $request->id;
        $region->region = $request->region;
        $region->nameRegion = $request->name;
        $region->save();

        return redirect()->action('RegionController@index')->with('saveRegion', 'Nueva region agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idRegion = $request->get('id');
        $numberRegion = $request->get('numberRegion');
        $nameRegion = $request->get('nameRegion');

        $regions = Region::orderBy('id', 'ASC')
            ->idRegion($idRegion)
            ->numberRegion($numberRegion)
            ->nameRegion($nameRegion)
            ->paginate(5);

        if (count($regions) == 0) {
            return back()->with('notFound', 'No se encontraron resultados');
        } else {
            return view('user.regions.index', compact('regions'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::findOrfail($id);
        return view('user.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
        $request->validate([
            'id' => 'required|numeric',
            'region' => 'required|integer',
            'name' => 'required|string',
        ]);


        Region::where('id', $id)->update($data);
        return redirect()->action('RegionController@index')->with('updateRegion', 'Region actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Region::destroy($id);
        return redirect()->action('RegionController@index')->with('deleteRegion', 'Region eliminada');
    }

    // funciones para los reportes de regiones

    public function reportRegion($id, $type)
    {
        $bossRegion = User::where('region_id', $id)->get();
        $regionInfo = Region::where('id', $id)->get();

        $basics = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', 'localities.id', '=', 'basics.locality_id')
            ->where('region_id', $id)->get();

        $mediums = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('media', 'schools.id', '=', 'media.school_id')
            ->where('region_id', $id)
            ->get();

        $higers = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('schools', 'localities.id', '=', 'schools.locality_id')
            ->join('higers', 'schools.id', '=', 'higers.school_id')
            ->where('region_id', $id)
            ->get();

        if ($type == 0) {
            return view('user.regions.regionGeneral', compact('regionInfo', 'bossRegion', 'basics', 'mediums', 'higers'));
        } elseif ($type == 1) {
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('user.regions.regionPdf', compact('regionInfo', 'bossRegion', 'basics', 'mediums', 'higers'));
            return $pdf->stream();
        } else {
            return back();
        }
    }

    public function reportRegions($id, $type)
    {
        $basics = Region::join('municipalities', 'regions.id', '=', 'municipalities.region_id')
            ->join('localities', 'municipalities.id', '=', 'localities.municipality_id')
            ->join('basics', 'localities.id', '=', 'basics.locality_id')->select('regions.*', 'basics.status', 'basics.bimester')->get();

        $regions = Region::all();

        foreach ($regions as $region) {
            $c =  count($basics->where('id', $region->id)->where('status', 0)->where('bimester', 1));
            if ($c > 0) {
                echo $region->nameRegion;
                echo '<br>';
                echo $c;
                echo '<br>';
            }
            echo '<br>';
        }
        //return view('user.regions.regionsGeneral');
    }
}
