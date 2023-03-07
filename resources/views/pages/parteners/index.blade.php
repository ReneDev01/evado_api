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
                    <h1 class="m-0">Parteneiare Liste</h1>
                    <br>
                    <a href=" {{route("partener.create")}} "><button partener="submit" class="btn btn-success">Ajouter un partener</button></a>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Partenaires</li>
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
                            <h3 class="card-title">Liste des différentes partenaires</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Solde</th>
                                        <th>Quartier</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Details</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($parteners as $partener)
                                        <tr>
                                            <td> {{$partener->name}} </td>
                                            <td> {{$partener->phone}} </td> 
                                            <td> {{$partener->solde}} </td>
                                            <td> {{$partener->neighboord}} </td> 
                                            <td> {{$partener->type->slug}} </td> 
                                            <td>
                                                @if($partener->status == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a class="btn btn-success">Ouvert</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a class="btn btn-danger">Fermer</a>
                                                @endif
                                            </td>
                                            <td> 
                                                <img src="{{$partener->logo}}" height="50" alt="" srcset="">    
                                            </td> 
                                            <td>
                                                <a class="btn btn-outline-success" href=" {{route('partener.show', $partener->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> 
                                            <td>
                                                <a class="btn btn-outline-info" href=" {{route('partener.edit', $partener->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td> 
                                                <form class="d-inline" method="POST" action=" {{route('partener.destroy',$partener->id)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce partenaire ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> 
                                            <td>
                                                @if($partener->active == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a href="{{route('partener.action',$partener->id )}}" class="btn btn-success">Activer</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a href="{{route('partener.action',$partener->id )}}" class="btn btn-danger">Désactiver</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Solde</th>
                                        <th>Quartier</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Details</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                        <th>Action</th> 
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
