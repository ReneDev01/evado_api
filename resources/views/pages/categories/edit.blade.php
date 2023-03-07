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
                <h1 class="m-0">Categories Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Categorie</li>
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
                    <form method="POST" action=" {{route("category.update", $category->id)}} ">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Name">Categorie name</label>
                                <input type="text" class="form-control" value=" {{$category->name}} " name="name" placeholder="Entrer le nom de la categorie">
                            </div>
                            <div class="form-group">
                                <label for="Slug">Categorie slug</label>
                                <input type="text" class="form-control" value=" {{$category->slug}} " name="slug" placeholder="Entrer le slug">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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