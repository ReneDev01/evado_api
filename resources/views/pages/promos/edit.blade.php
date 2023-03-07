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
                <h1 class="m-0">Parteners Edit</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{route('dashboard')}} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">partener</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
  <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                <!-- general form elements -->
                    <div class="card card-primary">
                    <form method="POST" action=" {{route("promo.update", $promo->id)}} " enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <label for="Name">Promos description</label>
                            <input type="text" class="form-control" value="{{$promo->description}}"  name="description" placeholder="Entrer la description ">
                            </div>
                            <div class="form-group">
                            <label for="Phone">Promos pourcentage</label>
                            <input type="number" class="form-control" value="{{$promo->percent}}" name="percent" placeholder="Entrer le pourcentage">
                            </div>
                            <div class="form-group">
                                <label for="Longitude">Promos date debut</label>
                                <input type="date" class="form-control" value="{{$promo->date_debut}}" name="date_debut" placeholder="Date debut">
                            </div>
                            <div class="form-group">
                                <label for="Longitude">Promo date fin</label>
                                <input type="date" class="form-control" value="{{$promo->date_fin}}" name="date_fin" placeholder="Date fin">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Promo meal</label>
                                <select class="custom-select rounded-0" value=" {{$promo->meal_id}} " name="meal_id" id="exampleSelectRounded0">
                                    @foreach ($meals as $meal)
                                        <option value="{{$meal->id}}"
                                        {{
                                        $promo
                                        ->meal_id === 
                                        $meal->id ? 'selected' : ''}}
                                             >{{$meal->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ajouter une image</label>
                                <input type="file" class="form-control" value="{{$promo->image}}" name="image" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button partener="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
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