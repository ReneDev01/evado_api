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
                    <h1 class="m-0">Produits Liste</h1>
                    <br>
                    <a href=" {{route("meal.create", $partener->id)}} "><button partener="submit" class="btn btn-success">Ajouter un produit</button></a>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Produits</li>
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
                            <h3 class="card-title">Liste des différentes produits</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Cuisson</th>
                                        {{-- <th>Partenaire</th>
                                        <th>Groupe</th> --}}
                                        <th>Image</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($meals as $meal)
                                        <tr>
                                            <td> {{$meal->name}} </td> 
                                            <td> {{$meal->slug}} </td> 
                                            <td> {{$meal->price}} </td> 
                                            <td> {{$meal->cooking_time}} </td> 
                                            {{-- <td> {{$meal->partener->name}} </td>
                                            <td> {{$meal->group->name}} </td> --}}
                                            <td> 
                                                <img src="{{$meal->image}}" height="50" alt="" srcset="">    
                                            </td> 
                                            <td>
                                                <a class="btn btn-outline-info" href=" {{route('meal.edit', $meal->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            <td> 
                                                <form class="d-inline" method="POST" action=" {{route('meal.destroy',$meal->id)}} ">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette meal ?')">
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
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Cuisson</th>
                                        {{-- <th>Partenaire</th>
                                        <th>Groupe</th> --}}
                                        <th>Image</th>
                                        <th>Modifier</th>
                                        <th>Suprimer</th> 
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