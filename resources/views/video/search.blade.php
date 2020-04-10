<!doctype html>
<html lang="en">
  <head>
@extends('layouts.app')

    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>



  @section('content')
  <div class="container">
      <div class="row">
            <div class="container">
                <div class="col-md-12">
                <h2>Busqueda de concidencias con "{{$search}}"</h2>
                <br>
                </div>

                <div class="col-md-8">
                    <form action="{{url('/buscar/'.$search)}}" class="col-md-6 pull-right" method="get">
                        <label for="filter">Ordenar</label>
                        <select name="filter" class="form-control">
                            <option value="new">Mas nuevos</option>
                            <option value="old">Mas antiguos</option>
                            <option value="all">De la A a la Z</option>
                        </select>
                        <br>
                        <input type="submit" value="Ordenar" class="btn-filter btn btn-sm btn-primary">
                        <br>
                    </form>
                </div>

                <div class="clearfix"></div>
                @include('video.videosList')
             
            </div>

      </div>
  </div>
  @endsection
  



  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>