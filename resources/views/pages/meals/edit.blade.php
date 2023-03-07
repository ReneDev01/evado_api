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
                <h1 class="m-0">Produits Edit</h1>
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
                <!-- left column -->
                <div class="col-md-12">
                <!-- general form elements -->
                    <div class="card card-primary">
                    <form method="POST" action=" {{route("meal.update", $meal->id)}} " enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Name">Produit name</label>
                                <input type="text" class="form-control" value="{{$meal->name}}" name="name" placeholder="Entrer le nom ">
                            </div>
                            <div class="form-group">
                                <label for="Name">Produit slug</label>
                                <input type="text" class="form-control" value="{{$meal->slug}}" name="slug" placeholder="Entrer le slug ">
                            </div>
                            <div class="form-group">
                                <label for="Name">Produit temps de cuisson</label>
                                <input type="number" class="form-control" value="{{$meal->cooking_time}}" name="cooking_time" placeholder="Entrer le temps de cuisson ">
                            </div>
                            <div class="form-group">
                                <label for="Name">Produit prix</label>
                                <input type="number" class="form-control" value="{{$meal->price}}" name="price" placeholder="Entrer le prix ">
                            </div>

                            <div class="form-group">
                                <label for="Name">Produit description</label>
                                <input type="text" id="div_editor1" value="{{$meal->description}}" class="form-control"  name="description" placeholder="Entrer la description ">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Groupe</label>
                                <select class="custom-select rounded-0" value=" {{$meal->group_id}} " name="group_id" id="exampleSelectRounded0">
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}"
                                        {{
                                        $meal
                                        ->group_id === 
                                        $group->id ? 'selected' : ''}}
                                             >{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ajouter une image</label>
                                <input type="file" class="form-control" value="{{$meal->image}}" name="image" >
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button meals="submit" class="btn btn-primary">Mettre à jour</button>
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