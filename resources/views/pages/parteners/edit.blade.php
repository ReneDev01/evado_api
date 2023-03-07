@extends('layouts.app')

@section('content')
@include('components.navbar')
@include('components.nav_aside')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Parteners Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">partener</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                    <div class="card card-primary">
                    <form method="POST" action=" {{route("partener.update", $partener->id)}} " enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <label for="Name">Partener name</label>
                            <input type="text" class="form-control" value="{{$partener->name}}" name="name" >
                            </div>
                            <div class="form-group">
                            <label for="Phone">Partener phone</label>
                            <input type="text" class="form-control" value="{{$partener->phone}}"  name="phone" >
                            </div>
                            <div class="form-group">
                                <label for="Longitude">Partener quartier</label>
                                <input type="text" class="form-control" value="{{$partener->neighboord}}" name="neighboord" placeholder="Quartier">
                            </div>
                            <div class="form-group">
                            <label for="Latitude">Partener latitude</label>
                            <input type="text" class="form-control" value="{{$partener->latitude}}" name="latitude">
                            </div>
                            <div class="form-group">
                            <label for="Longitude">Partener longitude</label>
                            <input type="text" class="form-control" value="{{$partener->longitude}}" name="longitude">
                            </div>
                            <div class="form-group">
                                <label for="Longitude">Partener heure d'ouverture</label>
                                <input type="time" class="form-control" value="{{$partener->start_hours}}" name="start_hours" placeholder="heure d'ouverture">
                            </div>
                            <div class="form-group">
                                <label for="Longitude">Partener heure de fermeture</label>
                                <input type="time" class="form-control"value="{{$partener->end_hours}}" name="end_hours" placeholder="heure de fermeture">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Type de partener</label>
                                <select class="custom-select rounded-0" value=" {{$partener->type_id}} " name="type_id" id="exampleSelectRounded0">
                                    @foreach ($types as $type)
                                        <option value="{{$type->id}}"
                                        {{
                                        $partener
                                        ->type_id === 
                                        $type->id ? 'selected' : ''}}
                                             >{{$type->slug}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ajouter une image</label>
                                <input type="file" class="form-control" value=" {{$partener->logo}} " name="logo" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button partener="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
          <!-- /.card -->
  <!-- /.content-header -->
<!-- Main content -->
</div>
@include('components.aside')
@include('components.footer')
@endsection