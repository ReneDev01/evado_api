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
                    <h1 class="m-0">Publicité Liste</h1>
                    <br>
                    <a href=" {{route("pub.create")}} "><button type="submit" class="btn btn-success">Ajouter une pub</button></a>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Publicité</li>
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
                            <h3 class="card-title">Liste des différentes publicité</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Partener</th>
                                        <th>Description</th>
                                        <th>Pourcentage</th>
                                        <th>Image</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                        <th>Etat</th> 
                                        <th>Promotion</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pubs as $pub)
                                        <tr>
                                            <td> {{$pub->partener->name}} </td>
                                            <td> {{$pub->description}} </td> 
                                            <td> {{$pub->percent}} </td>
                                            <td> 
                                                <img src="{{$pub->image}}" height="50" alt="" srcset="">    
                                            </td> 
                                            <td>
                                                <a class="btn btn-outline-info" href=" {{route('pub.edit', $pub->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td> 
                                                <form class="d-inline" method="POST" action=" {{route('pub.destroy',$pub)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette pub ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> 
                                            <td>
                                                @if($pub->is_active == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a href="{{route('pub.action',$pub->id )}}" class="btn btn-success">Activé</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a href="{{route('pub.action',$pub->id )}}" class="btn btn-danger">Désactivé</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($pub->promotion == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a href="{{route('pub.promote',$pub->id )}}" class="btn btn-success">Oui</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a href="{{route('pub.promote',$pub->id )}}" class="btn btn-danger">Non</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Partener</th>
                                        <th>Description</th>
                                        <th>Pourcentage</th>
                                        <th>Image</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th>
                                        <th>Etat</th>
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