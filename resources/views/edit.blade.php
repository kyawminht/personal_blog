@extends('layouts.master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="header">
                    <h5 class="modal-title" >Edit post</h5>
                </div>
                <div class="d-flex justify-between">
                    <img src="" alt="" class="rounded-circle" height="50" width="50">
                    <h5>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                </div>

                <form action="{{route('facebook-clone.update',$post->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" name="body" id="" class="form-control" value="{{$post->body}}" >
                        </div>
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control" ">
                        </div>
                        <img src="{{"/storage/$post->image"}}" alt="" width="50%" height="50%">
                    </div>
                    <div class="modal-footer">
                        <a href="{{route('index')}}" class="btn btn-success">Cancle</a>
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
