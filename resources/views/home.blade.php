
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!--HERENCIA DE LAYOUT-->
    @extends('layouts.app')

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
 



  </head>
  <body>


    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
    
                <div id="video-list">
                    @foreach ($videos as $video)
                        <div class="video-item col-md-10 pull-left panel panel-default">
                            <div class="panel-body">
                                <!--mostrar imagen-->
                                @if(Storage::disk('images')->has($video->imagen))
                                    <div class="video-image-thumb col-md-3 pull-left">
                                        <div class="video-imagen-mask">
                                            <img src="{{url('/miniatura/'.$video->imagen)}}" class="video-imagen"/>
                                        </div>
                                    </div>
                                    
                                @endif

                                <div class="data">
                                <h4><a href="{{route('detailVideo',['video_id'=>$video->id])}}">{{$video->title}}</a></h4>
                                <p>{{$video->user->name.' '.$video->user->surname}}</p>
                                </div>
                                <!--botones de accion-->
                                <a href="" class="btn btn-success">Ver</a>
                                @if(Auth::check() && Auth::user()->id==$video->user->id)
                                    <a href="" class="btn btn-warning">Editar</a>
                                    <a href="" class="btn btn-danger">Eliminar</a>
                                @endif

                            </div>
    
                        </div>
                    @endforeach
                </div>
            </div>
            <!--METODO 'links()' para la paginacion-->
            {{$videos->links()}}
        </div>
    </div>
    @endsection
    

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>



</body>
</html>



