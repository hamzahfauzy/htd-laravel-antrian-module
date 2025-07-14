@extends('antrian::layouts')

@section('content')
<div class="py-5 bg-body-secondary">
    <div class="container">
        <img src="{{$post->thumbnail ? asset('storage/'.$post->thumbnail->filename) : 'https://placehold.co/600x400'}}" width="100%" alt="{{$post->title}}" class="rounded mb-2">
        <h6 class="">{{date('D, F Y H:i:s', strtotime($post->created_at))}}</h6>
        <h2 class="fs-4 fw-bold ">{{$post->title}}</h2>
        <div>{!! $post->content !!}</div>
    </div>
</div>
@endsection