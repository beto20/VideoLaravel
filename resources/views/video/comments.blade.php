

<hr>
<h4>Comentarios</h4>
@if(session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif


<form class="col-md-4" action="{{url('/comment')}}" method="post">
    {!!csrf_field()!!}
    <input type="hidden" class="" name="video_id" value="{{$video->id}}" required>
    <p>
        <textarea name="body" class="form-control" required></textarea>
    </p>
    <input type="submit" class="btn btn-success" value="Comentar">
</form>