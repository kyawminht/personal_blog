@extends('layouts.master')

@yield('comment')
@section('content')
    {{--    comment Modal--}}

    <div class="container">
        <div class="row">
            <div class="flex-col">
                <div class="card">
                    <h5 class="card-title" >Comment</h5>
                </div>
                <a href="{{route('comments.index')}}" class="btn btn-secondary">show all comments</a>
                <div class="d-flex justify-between">
                    <img src="" alt="" class="rounded-circle" height="50" width="50">
                    <h5>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                </div>

                <form action="{{route('comment.store', ['postId' => $post->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">

                            <input type="text" name="body" id="" class="form-control">
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
