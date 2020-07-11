@extends('plantillas.adminApp')
@section('main')
<div class="container shadow p-3 mb-5 bg-white rounded mt-5 ">
    <div class="row justify-content-md-center mb-5 mt-2">
        <div class="col-9">
            @if(session('schoolAlert'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>{{session('schoolAlert')}}</strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h6><strong>¡Error! </strong>{{session('error')}}</h6>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center mb-5 mt-5">
        <div class="col-7">
            <div class="card shadow-lg p-3 mb-4 bg-white rounded border border-primary">
                <center>
                    <h4 class="card-header">Escuelas</h4>
                    <div class="card-body">
                        <h5 class="card-title">Subir y/o actualizar escuelas</h5>
                        <p class="card-text">Se actualizaran o agregaran nuevas escuelas sin afectar a las ya existentes
                            la primera fila del excel tienen que ser los titulos de las columnas que serian: cve_esc, nom_esc e cve_loc
                        </p>
                        <div class="col ">
                            <form action="{{route('importSchool')}}" method="post" enctype="multipart/form-data">
                                @csrf @error('school')
                                <div class="alert alert-danger">
                                    Porfavor seleccione un archivo excel de escuelas
                                </div>
                                @enderror
                                <div class="form-control-file">
                                    <input type="file" name="school" id="school" class="btn btn-primary">
                                </div>
                                <br>
                                <div class="form-control-button">
                                    <button type="submit" class="btn btn-success">Subir archivo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection