<!doctype html>
<html lang="en">
  <head>
    <!-- HERENCIA DE LAYOUT-->
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
        <h2>Crear nuevo video</h2>
        <hr>
      <form action="{{route('saveVideo')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
        <!-- USAR EL TOKEN OBLIGATORIO-->
        {!!csrf_field()!!}  
        
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
          </div>
        @endif
        
        <div class="form-group">
            <label for="title">Titulo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label for="description">Descripcion</label>
          <textarea class="form-control" id="descripcion" name="description">{{old('description')}}</textarea>
          </div>
          <div class="form-group">
            <label for="image">Miniatura</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
          </div>
          <div class="form-group">
            <label for="video">Archivo de video</label>
            <input type="file" class="form-control" id="video" name="video">
          </div>
          <button type="submit" class="btn btn-success">Crear video</button>


        </form>
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