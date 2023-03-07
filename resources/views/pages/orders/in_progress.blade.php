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
                    <h1 class="m-0">Listes des Commandes En cours</h1>
                </div><!-- /.col -->
                
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                        <li class="breadcrumb-item active">Commandes En cours</li>
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
                            <h3 class="card-title">Liste des différentes commandes en cours</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Date</th>
                                        <th>Confirmer</th>
                                        <th>Prise</th> 
                                        <th>Livrer</th> 
                                        <th>Détails</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td> {{$order->code}} </td>
                                            <td> {{$order->order_date}} </td>
                                            <td>
                                                @if($order->is_confirmed == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a class="btn btn-success">Oui</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a class="btn btn-danger">Non</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->is_taked == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a class="btn btn-success">Oui</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a class="btn btn-danger">Non</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->is_delived == 1)
                                                    <!-- <a><i class="align-middle" data-feather="check-circle" style="color:green">></i></a> -->
                                                    <a class="btn btn-success">Oui</a>
                                                @else
                                                    <!-- <a><i class="align-middle"  data-feather="x-circle" style="color:red"></i></a> -->
                                                    <a class="btn btn-danger">Non</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-success" href=" {{route('order.show', $order->id)}} ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach 
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Date</th>
                                        <th>Confirmer</th>
                                        <th>Prise</th> 
                                        <th>Livrer</th> 
                                        <th>Détails</th>
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
