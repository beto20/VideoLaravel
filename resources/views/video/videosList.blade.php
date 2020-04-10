<div id="video-list">
    @if(count($videos)>=1)


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
                    <a href="{{route('detailVideo',['video_id'=>$video->id])}}" class="btn btn-success">Ver</a>
                    @if(Auth::check() && Auth::user()->id==$video->user->id)
                        <a href="{{route('videoEdit',['video_id'=>$video->id])}}" class="btn btn-warning">Editar</a>
                        <div>
                            <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                            <a href="#modal{{$video->id}}" role="button" class="btn btn-danger" data-toggle="modal">Eliminar</a>
                            
                            <!-- Modal / Ventana / Overlay en HTML -->
                            <div id="modal{{$video->id}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Estás seguro?</h4>
                                            {{--'&times;' ES UNA 'X' PARA CERRAR EN BOOTSTRAP--}}
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>

                                        <div>
                                        <p class="modal-body">
                                            <p>¿Seguro que quieres borrar este video?</p>
                                        <p class="text-warning"><small>" {{$video->title}} "</small></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <a href="{{url('/delete-video/'.$video->id)}}" type="button" class="btn btn-danger">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        @endforeach
    @else
        <div class="alert alert-warning">No hay videos</div>
    @endif
    
    <div class="clearfix"></div>
     <!--METODO 'links()' para la paginacion-->
    {{$video->links()}}
</div>