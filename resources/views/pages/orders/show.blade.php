@extends('layouts.app')

@section('content')
@include('components.navbar')
@include('components.nav_aside')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Details Commande</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Commande</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                        <h4>
                            <i class="fas fa-globe"></i> Commande-{{$order->code}}
                            <small class="float-right">Date: {{$order->order_date}}</small>
                        </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        Partener
                        <address>
                            <strong>{{$order->partener->name}}</strong><br>
                            {{$order->partener->phone}}<br>
                            {{$order->partener->neighboord}}<br>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        Client
                        <address>
                            <strong>{{$order->customer->name}}{{$order->customer->surname}}</strong><br>
                            {{$order->customer->phone}}<br>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        <b>Commande #{{$order->code}}</b><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>Image</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($order->meals as $meal)
                            <tr>
                                <td> 
                                    <img src="{{asset($meal->image)}}" height="35" alt="" srcset="">    
                                </td>
                                <td>{{$meal->name}}</td>
                                <td>{{$meal->pivot->quantity}}</td>
                                <td>{{$meal->price}}</td>
                            </tr>
                            @endforeach 
                            </tbody>
                        </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Total Commande</p>

                            <div class="table-responsive">
                                <table class="table">
                                <tr>
                                    <th>Livraison:</th>
                                    <td>{{$order->delever_price}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>{{$order->delevery_price}}</td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@include('components.aside')
@include('components.footer')
@endsection