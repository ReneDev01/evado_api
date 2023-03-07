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
                    <h1 class="m-0">Promotions Liste</h1>
                    <br>
                    <a href=" {{route("promo.create")}} "><button partener="submit" class="btn btn-success">Ajouter une promotion</button></a>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Promotions</li>
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
                            <h3 class="card-title">Liste des différentes Promotione</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code Promo</th>
                                        <th>Slug</th>
                                        <th>Pourcentage</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promotions as $promo)
                                        <tr>
                                            <td> {{$promo->code}} </td> 
                                            <td> {{$promo->slug}} </td>
                                            <td> {{$promo->percent}} </td>
                                            <td>
                                                <a class="btn btn-outline-info" href=" {{route('promo.edit', $promo->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td> 
                                                <form class="d-inline" method="POST" action=" {{route('promo.destroy',$promo->id)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette promo ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> 
                                            <td>
                                                @if($promo->isActive == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a href="{{route('promo.action',$promo->id )}}" class="btn btn-success">Activer</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a href="{{route('promo.action',$promo->id )}}" class="btn btn-danger">Désactiver</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code Promo</th>
                                        <th>Slug</th>
                                        <th>Pourcentage</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                        <th>Status</th>  
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