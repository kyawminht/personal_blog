@extends('layouts.master')

@yield('comment')
@section('content')
    @foreach($comments as $comment)
        <div class="container">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <h5>
                        <img src="{{\Illuminate\Support\Facades\Auth::user()->image}}" alt="" rounded="circle" width="40" height="40">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </h5>
                </div>
                <div class="card-body">
                    <p>{{$comment->body}}</p>
                </div>
            </div>
            <div class="footer">
                <a href="{{route('index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
    @endforeach
@endsection
