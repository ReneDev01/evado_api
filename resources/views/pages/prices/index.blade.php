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
                    <h1 class="m-0">Price</h1>
                    <br>
                    <a href=" {{route("price.create")}} "><button type="submit" class="btn btn-success">Ajouter une price</button></a>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Price</li>
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
                            <h3 class="card-title">Liste des différentes price</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Price</th>
                                        <th>Modifier</th>
                                        {{-- <th>Suprimer</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prices as $price)
                                        <tr>
                                            <td> {{$price->price}} </td>
                                            <td>
                                                <a class="btn btn-outline-info" href=" {{route('price.edit', $price->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                            {{-- <td> 
                                                <form class="d-inline" method="POST" action="">
                                                    <!-- @method('DELETE')
                                                    @csrf -->
                                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer cette price ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td> --}}
                                            
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Price</th>
                                    <th>Modifier</th>
                                    {{-- <th>Suprimer</th> --}}
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('components.aside')
@include('components.footer')
@endsection