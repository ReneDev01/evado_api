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
                <h1 class="m-0">Livreurs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Livreurs</li>
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
                        <h3 class="card-title">Ajouter un Livreurs</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{route("delever.store")}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                <label for="Name">Livreurs name</label>
                                <input type="text" class="form-control" name="name" placeholder="Entrer le nom " required>
                                </div>
                                <div class="form-group">
                                    <label for="Name">Livreurs prenom</label>
                                    <input type="text" class="form-control" name="surname" placeholder="Entrer le prenom " required>
                                </div>
                                <div class="form-group">
                                <label for="Phone">Partener phone</label>
                                <input type="text" class="form-control" name="phone" placeholder="Entrer le phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="Longitude">Partener date de naissance</label>
                                    <input type="date" class="form-control" name="birthday" placeholder="Date de naissance" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectRounded0">Type de partener</label>
                                    <select class="custom-select rounded-0" name="sex" id="exampleSelectRounded0">
                                        <option>defaut</option>
                                        <option value="Masculin">Masculin</option>
                                        <option value="Feminin">Feminin</option>
                                    </select>
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