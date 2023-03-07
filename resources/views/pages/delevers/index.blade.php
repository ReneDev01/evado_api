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
                    <h1 class="m-0">Livreurs Liste</h1>
                    <br>
                    <a href=" {{route("delever.create")}} "><button group="submit" class="btn btn-success">Ajouter un Livreur</button></a>  
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Delevers</li>
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
                            <h3 class="card-title">Liste des différents Livreurs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Prenom</th>
                                        <th>Phone</th>
                                        <th>Date de naissance</th>
                                        <th>Solde</th>
                                        <th>Status</th>
                                        <th>operations</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($delevers as $delever)
                                        <tr>
                                            <td> {{$delever->name}} </td>
                                            <td> {{$delever->surname}} </td> 
                                            <td> {{$delever->phone}} </td>
                                            <td> {{$delever->birthday}} </td> 
                                            <td> {{$delever->solde}} </td> 
                                            <td>
                                                @if($delever->status == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a href="{{route('delever.block',$delever->id )}}" class="btn btn-success">Activer</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a href="{{route('delever.block',$delever->id )}}" class="btn btn-danger">Bloquer</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-success" href=" {{route('delever.operate', $delever->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> 
                                            <td> 
                                                <form class="d-inline" method="POST" action=" {{route('delever.destory',$delever)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce livreur ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> 
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Prenom</th>
                                        <th>Phone</th>
                                        <th>Date de naissance</th>
                                        <th>Solde</th>
                                        <th>Status</th>
                                        <th>operations</th>
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
