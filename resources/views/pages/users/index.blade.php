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
                    <h1 class="m-0">Utilisateur</h1>
                    <br>
                    <a href=" {{route("user.create")}} "><button type="submit" class="btn btn-success">Ajouter un utilisateur</button></a>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liste des différents utilisateurs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom Complet</th>
                                        <th>Details</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td> {{$user->name}} {{$user->surname}} </td>
                                            <td>
                                                <a class="btn btn-outline-success" href=" {{route('user.show', $user->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> 
                                            <td>
                                                <a class="btn btn-outline-primary" href=" {{route('user.edit', $user->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> 
                                            <td>
                                                <form class="d-inline" method="POST" action=" {{route('user.delete',$user)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cet Utilisateur ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> 
                                        </tr> 
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Voir</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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