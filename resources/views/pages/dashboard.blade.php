@extends('layouts.app')

@section('content')
@include('components.navbar')
@include('components.nav_aside')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">welcome</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <h5 class="mb-2">Informations générales</h5>
      <div class="row">
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$customer_count}}</h3>
              <p>Nombre de clients</p>
            </div>
            <div class="icon">
              {{-- <i class="ion ion-bag"></i> --}}
              <i class="ion ion-person-add"></i>
            </div>
            <a href=" {{route("customer.index")}} " class="small-box-footer"> 
              Liste des clients <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$total_order}}</h3>

              <p>Totale Commandes</p>
            </div>
            <div class="icon">
              {{-- <i class="ion ion-stats-bars"></i> --}}
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route("order.all")}}" class="small-box-footer">Liste des commandes<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3> {{$total_deliver}} </h3>

              <p>Total Livreurs</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route("delever.index")}}" class="small-box-footer">
              Liste des livreurs <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3> {{$total_partener}} </h3>

              <p>Total Partenaires</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route("partener.index")}}" class="small-box-footer">Liste des partenaires <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <h5 class="mb-2">Informations journalières</h5>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Totale Commendés</span>
              <span class="info-box-number"> {{$daily_order}} </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Commandes En Cours</span>
              <span class="info-box-number"> {{$daily_order_inProgress}} </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Commandes Livrées</span>
              <span class="info-box-number"> {{$daily_order_delived}} </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Partenaires Ouverts</span>
              <span class="info-box-number"> {{$daily_active_partener}} </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-6">
          <canvas id="myChart" height="400" width="400" ></canvas>
        </div>
        <div class="col-md-6">
          <canvas id="myChart2" height="400" width="400"></canvas>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@include('components.aside')
@include('components.footer')

<script>
  var day = @json($array_days);
  var cf = @json($array_cf);
</script>


@endsection