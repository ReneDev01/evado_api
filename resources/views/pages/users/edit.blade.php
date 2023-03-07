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
                <h1 class="m-0">Utilisateurs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Utilisateur</li>
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
                        <h3 class="card-title">Mettre à jour un utilisateur</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('user.update', $user->id)}}" method="POST" >
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nom</label>
                                <input type="text" class="form-control" value=" {{$user->name}} " name="name" id="exampleInputEmail1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Prenom</label>
                                <input type="text" class="form-control" value=" {{$user->surname}} " name="surname" id="exampleInputPassword1" placeholder="Enter last name">
                                </div>
    
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Telephone</label>
                                    <input type="phone" value=" {{$user->phone}} " class="form-control" name="phone" id="exampleInputPassword1" placeholder="Enter Phone">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select2" name="roles[]" multiple="multiple" data-placeholder="Choisir les roles" style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"> 
                                                {{ $role->name}}
                                            </option>
                                        @endforeach 
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Sexe</label>
                                    <select class="form-control select2" name="sexe" style="width: 100%;">
                                      <option selected="selected">Option</option>
                                      <option {{ $user->sexe == "Masculin" ? 'selected' : '' }}> Masculin </option>
                                      <option {{ $user->sexe == "Feminin" ? 'selected' : '' }}> Feminin </option>
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