@extends('plantillas.adminApp')
@section('main')
<div class="row justify-content-md-center">
    <div class="col-7 shadow p-3 mb-5 bg-white rounded mt-4">
        <div class="col border border-secondary">
            <div class="row justify-content-center my-2">
                <h2 class="">Editar Beca JEF</h2>
            </div>
            <form action="{{url('/higerEducation/'.$JEF->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row form-group">
                    <div class="col">
                        <label for="consignment">{{'Remesa'}}</label>
                        <input type="text" class="form-control" name="consignment" id="consignment" value="{{$JEF->consignment}}">
                    </div>
                    @error('consignment')
                    <div class="alert alert-danger">
                        Error en la remesa, comprobar nuevamente(remesa valida, formato de letras y numeros, no vacio).
                    </div>
                    @enderror

                    <div class="col">
                        <label for="fol_form">{{'Folio de formato'}}</label>
                        <input type="number" class="form-control" name="fol_form" id="fol_form" value="{{$JEF->fol_form}}">
                    </div>
                    @error('fol_form')
                    <div class="alert alert-danger">
                        Error en la clave de la localidad, revisar nuevamente(numerico, no vacio).
                    </div>
                    @enderror
                </div>

                <div class="row form-group">
                    <div class="col">
                        <label for="scholar_id">{{'clave del becario'}}</label>
                        <input type="number" class="form-control" name="scholar_id" id="scholar_id" value="{{$JEF->scholar_id}}">
                    </div>
                    @error('scholar_id')
                    <div class="alert alert-danger">
                        Error en el nombre de la localidad, revisar nuevamente, (nombre valido, no vacio, no numerico)
                    </div>
                    @enderror

                    <div class="col">
                        <label for="status"></label>
                        <select id="status" name="status" class="form-control">
                            @if($JEF->status == 0)
                            <option name="0" value="0" selected>Pendiente</option>
                            <option name="1" value="1">Entregado</option>
                            <option name="2" value="2">No entregado/no localizado</option>
                            <option name="3" value="3">No entregado/por baja</option>
                            @elseif($JEF->status == 1)
                            <option name="0" value="0">Pendiente</option>
                            <option name="1" value="1" selected>Entregado</option>
                            <option name="2" value="2">No entregado/no localizado</option>
                            <option name="3" value="3">No entregado/por baja</option>
                            @elseif($JEF->status == 2)
                            <option name="0" value="0">Pendiente</option>
                            <option name="1" value="1">Entregado</option>
                            <option name="2" value="2" selected>No entregado/no localizado</option>
                            <option name="3" value="3">No entregado/por baja</option>
                            @elseif($JEF->status == 3)
                            <option name="0" value="0">Pendiente</option>
                            <option name="1" value="1">Entregado</option>
                            <option name="2" value="2">No entregado/no localizado</option>
                            <option name="3" value="3" selected>No entregado/por baja</option>
                            @endif
                        </select>
                        @error('status')
                        <div class="alert alert-danger" role="alert">
                            {{'Seleccione una modalidad'}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col">
                        <label for="bimester"></label>
                        <select id="bimester" name="bimester" class="form-control">
                            @if($JEF->bimester == 1)
                            <option name="1" value="1" selected>Enero-Febrero</option>
                            <option name="2" value="2">Marzo-Abril</option>
                            <option name="3" value="3">Mayo-Junio</option>
                            <option name="4" value="4">Septiembre-Octubre</option>
                            <option name="5" value="5">Noviembre-Diciembre</option>
                            @elseif($JEF->bimester == 2)
                            <option name="1" value="1">Enero-Febrero</option>
                            <option name="2" value="2" selected>Marzo-Abril</option>
                            <option name="3" value="3">Mayo-Junio</option>
                            <option name="4" value="4">Septiembre-Octubre</option>
                            <option name="5" value="5">Noviembre-Diciembre</option>
                            @elseif($JEF->bimester == 3)
                            <option name="1" value="1">Enero-Febrero</option>
                            <option name="2" value="2">Marzo-Abril</option>
                            <option name="3" value="3" selected>Mayo-Junio</option>
                            <option name="4" value="4">Septiembre-Octubre</option>
                            <option name="5" value="5">Noviembre-Diciembre</option>
                            @elseif($JEF->bimester == 4)
                            <option name="1" value="1">Enero-Febrero</option>
                            <option name="2" value="2">Marzo-Abril</option>
                            <option name="3" value="3">Mayo-Junio</option>
                            <option name="4" value="4" selected>Septiembre-Octubre</option>
                            <option name="5" value="5">Noviembre-Diciembre</option>
                            @elseif($JEF->bimester == 5)
                            <option name="1" value="1">Enero-Febrero</option>
                            <option name="2" value="2">Marzo-Abril</option>
                            <option name="3" value="3">Mayo-Junio</option>
                            <option name="4" value="4">Septiembre-Octubre</option>
                            <option name="5" value="5" selected>Noviembre-Diciembre</option>
                            @endif
                        </select>
                        @error('bimester')
                        <div class="alert alert-danger" role="alert">
                            {{'Seleccione un bimestre'}}
                        </div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="year"></label>
                        <select id="year" name="year" class="form-control">
                            <option value="2019">2019</option>
                            <option selected value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                        @error('year')
                        <div class="alert alert-danger" role="alert">
                            {{'Seleccione año'}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="school_id"></label>
                    <select id="school_id" name="school_id" class="form-control">
                        @foreach($schools as $school)
                        @if($school->id === $JEF->school_id)
                        <option name="{{$school->id}}" value="{{$school->id}}" style="width:600px" selected>{{$school->nameSchool}}</option>
                        @else
                        <option name="{{$school->id}}" value="{{$school->id}}" style="width:600px">{{$school->nameSchool}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                @error('school_id')
                <div class="alert alert-danger">
                    Seleccione una localidad
                </div>
                @enderror

                <div class="row justify-content-center">
                    <input type="submit" class="btn btn-success mr-1" value="Editar">
                    <a href="{{url('/higerEducation')}}" class="btn btn-primary">Regresar</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection