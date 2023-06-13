@extends('layouts.master')

@section('home')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <div class="d-flex justify-content-between">
                                <h5>
                                    <img src="{{\Illuminate\Support\Facades\Auth::user()->image}}" alt="" rounded="circle" height="50" width="50">
                                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                                </h5>
                            </div>
                        </h5>
                        <div class="card-text">
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">What on your mind?,{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($posts as $post)
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <div class="d-flex justify-content-between">
                                    <h5>
                                        <img src="{{\Illuminate\Support\Facades\Auth::user()->image}}" alt="" rounded="circle" width="40" height="40">
                                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                                    </h5>
                                    <div class="flex-end">
                                        <a href="{{route('facebook-clone.edit',$post->id)}}"><i class="fa-solid fa-pen"></i></a>
                                        <a href="{{route('facebook-clone.destroy',$post->id)}}"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>
                            </h5>
                            <div class="card-text">
                                <p>
                                    {{$post->body}}
                                </p>
                               @if($post->image)
                                    <div class="card-image">
                                        <img src="{{"/storage/$post->image"}}" alt="" width="20%" height="20%">
                                    </div>
                                @endif
                            </div>
                          <div class="d-flex justify-space-between">
                              <p class="p-2">{{$post->like_count}} like</p>
                          </div>
                            <div class="card-footer text-muted d-flex justify-between">

                                <form action="{{ route('posts.like', ['postId' => $post->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i></button>
                                </form>

                                <a href="{{route('comment.create',['postId' => $post->id])}}" class="btn btn-success"> <i class="fa-regular fa-message"></i></a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

{{--    Create post Modal--}}

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="d-flex justify-between">
                    <img src="" alt="" class="rounded-circle" height="50" width="50">
                    <h5>{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                </div>

                <form action="{{route('facebook-clone.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    <div class="mb-3">

                        <input type="text" name="body" id="" class="form-control" placeholder="What on your mind?,{{\Illuminate\Support\Facades\Auth::user()->name}}">
                    </div>
                    <div class="mb-3 image-field">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>



@endsection


