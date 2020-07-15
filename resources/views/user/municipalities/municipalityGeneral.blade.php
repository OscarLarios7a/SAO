@extends('plantillas.adminApp')
@section('main')
<div class="container shadow px-5 mb-5 bg-white rounded mt-4 border border-success">

    <div class="row justify-content-md-center">
        <img src="https://qroo.gob.mx/sites/default/files/inline-images/BECAS_COORDINACION_logo.png" class="img-fluid" alt="Responsive image" width="40%" height="40%">
    </div>

    <div class="row justify-content-md-center">
        <h4><b>SUBDIRECCION DE ATENCION OPERATIVA</b></h4>
    </div>

    <div class="row justify-content-md-center">
        <h5><b>REPORTE GENERAL DE MUNICIPIO</b> | {{@date('Y-m-d')}} | Administrador: {{Auth::user()->name}} {{Auth::user()->firstSurname}} {{Auth::user()->secondSurname}}</h5>
    </div>

    <div class="row justify-content-md-center mb-0">
        <h6>
            @foreach($municipalityInfo as $municipality)
            <b>REGION:</b> {{$municipality->region->nameRegion}} - <b>NUMERO:</b> {{$municipality->region->region}}
            @endforeach
            <td>
                @if($bossRegion->count() == 0)
                | {{'Sin Jefe asignado'}}
                @elseif($bossRegion->count() >= 2)
                @foreach($bossRegion as $boss)
                | <b>{{'Responsables de la region:'}}</b> {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}},
                @endforeach
                @else
                @foreach($bossRegion as $boss)
                | <b>{{'Responsable de la region:'}}</b> {{$boss->name}} {{$boss->firstSurname}} {{$boss->secondSurname}}
                @endforeach
                @endif
        </h6>
    </div>

    <hr style="color: #0056b2;" width="100%" />
    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center">
        <div class="col-10">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        @foreach($municipalityInfo as $municipality)
                        <td scope="col">
                            <h5><b>MUNICIPIO:</b></h5> {{$municipality->nameMunicipality}}
                        </td>
                        <td scope="col">
                            <h5><b>NUMERO:</b></h5> {{$municipality->id}}
                        </td>
                        @endforeach

                        <td>
                            <a class="btn btn-primary" href="{{url('reportMunicipality/'.$municipality->id.'/reportMunicipality/1')}}" target="_blank">PDF</a>
                            <a class="btn btn-success" href="{{url('/municipality')}}">Regresar</a>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-center mt-3">
        <h5>EDUCACION BASICA - CERM</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{$basicsCermBim1->where('status', 0)->count()}}</td>
                        <td>{{$basicsCermBim2->where('status', 0)->count()}}</td>
                        <td>{{$basicsCermBim3->where('status', 0)->count()}}</td>
                        <td>{{$basicsCermBim4->where('status', 0)->count()}}</td>
                        <td>{{$basicsCermBim5->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{$basicsCermBim1->where('status', 1)->count()}}</td>
                        <td>{{$basicsCermBim2->where('status', 1)->count()}}</td>
                        <td>{{$basicsCermBim3->where('status', 1)->count()}}</td>
                        <td>{{$basicsCermBim4->where('status', 1)->count()}}</td>
                        <td>{{$basicsCermBim5->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{$basicsCermBim1->where('status', 2)->count()}}</td>
                        <td>{{$basicsCermBim2->where('status', 2)->count()}}</td>
                        <td>{{$basicsCermBim3->where('status', 2)->count()}}</td>
                        <td>{{$basicsCermBim4->where('status', 2)->count()}}</td>
                        <td>{{$basicsCermBim5->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{$basicsCermBim1->where('status', 3)->count()}}</td>
                        <td>{{$basicsCermBim2->where('status', 3)->count()}}</td>
                        <td>{{$basicsCermBim3->where('status', 3)->count()}}</td>
                        <td>{{$basicsCermBim4->where('status', 3)->count()}}</td>
                        <td>{{$basicsCermBim5->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row justify-content-md-center mt-4">
        <h5>EDUCACION BASICA - AVISOS DE COBRO</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{$basicsDeliveryBim1->where('status', 0)->count()}}</td>
                        <td>{{$basicsDeliveryBim2->where('status', 0)->count()}}</td>
                        <td>{{$basicsDeliveryBim3->where('status', 0)->count()}}</td>
                        <td>{{$basicsDeliveryBim4->where('status', 0)->count()}}</td>
                        <td>{{$basicsDeliveryBim5->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{$basicsDeliveryBim1->where('status', 1)->count()}}</td>
                        <td>{{$basicsDeliveryBim2->where('status', 1)->count()}}</td>
                        <td>{{$basicsDeliveryBim3->where('status', 1)->count()}}</td>
                        <td>{{$basicsDeliveryBim4->where('status', 1)->count()}}</td>
                        <td>{{$basicsDeliveryBim5->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{$basicsDeliveryBim1->where('status', 2)->count()}}</td>
                        <td>{{$basicsDeliveryBim2->where('status', 2)->count()}}</td>
                        <td>{{$basicsDeliveryBim3->where('status', 2)->count()}}</td>
                        <td>{{$basicsDeliveryBim4->where('status', 2)->count()}}</td>
                        <td>{{$basicsDeliveryBim5->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{$basicsDeliveryBim1->where('status', 3)->count()}}</td>
                        <td>{{$basicsDeliveryBim2->where('status', 3)->count()}}</td>
                        <td>{{$basicsDeliveryBim3->where('status', 3)->count()}}</td>
                        <td>{{$basicsDeliveryBim4->where('status', 3)->count()}}</td>
                        <td>{{$basicsDeliveryBim5->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center mt-5">
        <h5>EDUCACION MEDIA SUPERIOR</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{$mediumsBim1->where('status', 0)->count()}}</td>
                        <td>{{$mediumsBim2->where('status', 0)->count()}}</td>
                        <td>{{$mediumsBim3->where('status', 0)->count()}}</td>
                        <td>{{$mediumsBim4->where('status', 0)->count()}}</td>
                        <td>{{$mediumsBim5->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{$mediumsBim1->where('status', 1)->count()}}</td>
                        <td>{{$mediumsBim2->where('status', 1)->count()}}</td>
                        <td>{{$mediumsBim3->where('status', 1)->count()}}</td>
                        <td>{{$mediumsBim4->where('status', 1)->count()}}</td>
                        <td>{{$mediumsBim5->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{$mediumsBim1->where('status', 2)->count()}}</td>
                        <td>{{$mediumsBim2->where('status', 2)->count()}}</td>
                        <td>{{$mediumsBim3->where('status', 2)->count()}}</td>
                        <td>{{$mediumsBim4->where('status', 2)->count()}}</td>
                        <td>{{$mediumsBim5->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{$mediumsBim1->where('status', 3)->count()}}</td>
                        <td>{{$mediumsBim2->where('status', 3)->count()}}</td>
                        <td>{{$mediumsBim3->where('status', 3)->count()}}</td>
                        <td>{{$mediumsBim4->where('status', 3)->count()}}</td>
                        <td>{{$mediumsBim5->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-center mt-5">
        <h5>REEXPEDICIONES MEDIA SUPERIOR</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{$reissueBim1->where('status', 0)->count()}}</td>
                        <td>{{$reissueBim2->where('status', 0)->count()}}</td>
                        <td>{{$reissueBim3->where('status', 0)->count()}}</td>
                        <td>{{$reissueBim4->where('status', 0)->count()}}</td>
                        <td>{{$reissueBim5->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{$reissueBim1->where('status', 1)->count()}}</td>
                        <td>{{$reissueBim2->where('status', 1)->count()}}</td>
                        <td>{{$reissueBim3->where('status', 1)->count()}}</td>
                        <td>{{$reissueBim4->where('status', 1)->count()}}</td>
                        <td>{{$reissueBim5->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{$reissueBim1->where('status', 2)->count()}}</td>
                        <td>{{$reissueBim2->where('status', 2)->count()}}</td>
                        <td>{{$reissueBim3->where('status', 2)->count()}}</td>
                        <td>{{$reissueBim4->where('status', 2)->count()}}</td>
                        <td>{{$reissueBim5->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{$reissueBim1->where('status', 3)->count()}}</td>
                        <td>{{$reissueBim2->where('status', 3)->count()}}</td>
                        <td>{{$reissueBim3->where('status', 3)->count()}}</td>
                        <td>{{$reissueBim4->where('status', 3)->count()}}</td>
                        <td>{{$reissueBim5->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <hr style="color: #0056b2;" width="100%" />

    <div class="row justify-content-md-center mt-5">
        <h5>JOVENES ESCRIBIENDO EL FUTURO</h5>
    </div>

    <div class="row justify-content-md-center mb-4">
        <div class="col">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ESTATUS</th>
                        <th scope="col">ENERO-FEBRERO</th>
                        <th scope="col">MARZO-ABRIL</th>
                        <th scope="col">MAYO-JUNIO</th>
                        <th scope="col">SEPTIEMBRE-OCTUBRE</th>
                        <th scope="col">NOVIEMBRE-DICIEMBRE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Pendientes</th>
                        <td>{{$higersBim1->where('status', 0)->count()}}</td>
                        <td>{{$higersBim2->where('status', 0)->count()}}</td>
                        <td>{{$higersBim3->where('status', 0)->count()}}</td>
                        <td>{{$higersBim4->where('status', 0)->count()}}</td>
                        <td>{{$higersBim5->where('status', 0)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Entregados</th>
                        <td>{{$higersBim1->where('status', 1)->count()}}</td>
                        <td>{{$higersBim2->where('status', 1)->count()}}</td>
                        <td>{{$higersBim3->where('status', 1)->count()}}</td>
                        <td>{{$higersBim4->where('status', 1)->count()}}</td>
                        <td>{{$higersBim5->where('status', 1)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - No localizados</th>
                        <td>{{$higersBim1->where('status', 2)->count()}}</td>
                        <td>{{$higersBim2->where('status', 2)->count()}}</td>
                        <td>{{$higersBim3->where('status', 2)->count()}}</td>
                        <td>{{$higersBim4->where('status', 2)->count()}}</td>
                        <td>{{$higersBim5->where('status', 2)->count()}}</td>
                    </tr>
                    <tr>
                        <th scope="row">No entregados - Por baja</th>
                        <td>{{$higersBim1->where('status', 3)->count()}}</td>
                        <td>{{$higersBim2->where('status', 3)->count()}}</td>
                        <td>{{$higersBim3->where('status', 3)->count()}}</td>
                        <td>{{$higersBim4->where('status', 3)->count()}}</td>
                        <td>{{$higersBim5->where('status', 3)->count()}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-md-center mb-4">
        <p>&copy; {{@date('Y')}} {{'Subdireccion de atencion operativa - Oaxaca, Todos los derechos reservados'}}</p>
    </div>
</div>
@endsection