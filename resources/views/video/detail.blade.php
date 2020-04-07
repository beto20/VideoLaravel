<!DOCTYPE html>
<html lang="en">
<head>
    @extends('layouts.app');
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @section('content')
    <div class="col-md-10 col-md-offset-2">
        <h2>{{$video->title}}</h2>
        <hr/>

        <div class="col-md-8">
            {{--VIDEO--}}
            <video controls id="video-player">
                <source src="{{route('fileVideo',['filename'=>$video->video_path])}}">
                Tu navegador no es compatible
            </video>
            {{--DESCRIPCION--}}
            <div class="panel panel-default video-data">
                <div class="panel-heading">
                    <div class="panel-title">
                        subido por <strong>{{$video->user->name.' '.$video->user->surmame}}</strong>{{\FormatTime::LongTimeFilter($video->created_at)}}
                    </div>
                </div>
                <div class="panel-body">
                    {{$video->description}}
                </div>
            </div>


            {{--COMENTARIOS--}}
            @include('video/comments')
        
        </div>

    </div>

@endsection    



</body>
</html>

