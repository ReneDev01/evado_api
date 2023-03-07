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
                    <h1>Details Partenaire</h1>
                    <br>
                    <a href=" {{route("meal.index", $partener->id)}} "><button type="submit" class="btn btn-success">Liste des produits</button></a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Partenaire</li>
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
                            <i class="fas fa-globe"></i> {{$partener->name}}
                        </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                     <!-- info row -->
                     <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        Partener
                        <address>
                            {{$partener->phone}}<br>
                            {{$partener->neighboord}}<br>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        Times
                        <address>
                            Début : {{$partener->start_hours}}<br>
                            Fin : {{$partener->end_hours}}<br>
                        </address>
                        </div>
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