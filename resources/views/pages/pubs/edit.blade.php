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
                <h1 class="m-0">Pubs Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pubs</li>
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
                    <form method="POST" action=" {{route("pub.update", $pub->id)}} " enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <label for="Name">Pubs description</label>
                            <input type="text" class="form-control" value="{{$pub->description}}" name="description" placeholder="Entrer la description ">
                            </div>
                            <div class="form-group">
                            <label for="Phone">Pubs pourcentage</label>
                            <input type="number" class="form-control" value="{{$pub->percent}}" name="percent" placeholder="Entrer le pourcentage">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Pubs</label>
                                <select class="custom-select rounded-0" value=" {{$pub->partener_id}} " name="partener_id" id="exampleSelectRounded0">
                                    @foreach ($parteners as $partener)
                                        <option value="{{$partener->id}}"
                                        {{
                                        $pub
                                        ->partener_id === 
                                        $partener->id ? 'selected' : ''}}
                                             >{{$partener->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ajouter une image</label>
                                <input type="file" class="form-control" value=" {{$pub->image}}" name="image" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button Pubs="submit" class="btn btn-primary">Mettre à jour</button>
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