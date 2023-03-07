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
                <h1 class="m-0">Partener</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Partener</li>
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
                        <div class="card-header">
                        <h3 class="card-title">Ajouter un Partener</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route("partener.store")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                <label for="Name">Partener name</label>
                                <input type="text" class="form-control" name="name" placeholder="Entrer le nom ">
                                </div>
                                <div class="form-group">
                                <label for="Phone">Partener phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Entrer le phone">
                                </div>
                                <div class="form-group">
                                    <label for="Longitude">Partener quartier</label>
                                    <input type="text" class="form-control" name="neighboord" placeholder="Quartier">
                                </div>
                                <div class="form-group">
                                <label for="Latitude">Partener latitude</label>
                                <input type="text" class="form-control" name="latitude" placeholder="Entrer la latitude ">
                                </div>
                                <div class="form-group">
                                <label for="Longitude">Partener longitude</label>
                                <input type="text" class="form-control" name="longitude" placeholder="Entrer la longitude">
                                </div>
                                <div class="form-group">
                                    <label for="Longitude">Partener heure d'ouverture</label>
                                    <input type="time" class="form-control" name="start_hours" placeholder="heure d'ouverture">
                                </div>
                                <div class="form-group">
                                    <label for="Longitude">Partener heure de fermeture</label>
                                    <input type="time" class="form-control" name="end_hours" placeholder="heure de fermeture">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Type de partener</label>
                                    <select class="custom-select rounded-0" name="type_id" id="exampleSelectRounded0">
                                        @foreach ($types as $type)
                                            <option value=" {{$type->id}} ">{{$type->slug}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Ajouter une image</label>
                                    <input type="file" class="form-control" name="logo" >
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enrégistrer</button>
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