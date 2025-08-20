@extends('antrian::layouts')

@section('content')
<div class="py-5 bg-body-secondary">
    <div class="container py-4">
        <h2
            class="fs-2 fw-bold py-3 px-5 bg-white m-0 rounded-top-4 border"
            style="width: fit-content;">Berita</h2>

        <div class="row">
            <div class="col-12">
                <div
                    class="card rounded-top-0 rounded-bottom-4 rounded-end-4" >

                    <div id="posts">
                        @foreach($posts as $post)
                        <div
                        class="d-flex flex-column flex-md-row gap-3 align-items-start align-items-md-center p-3 border-bottom">
                        <img src="{{$post->thumbnail ? asset('storage/'.$post->thumbnail->filename) : 'https://placehold.co/600x400'}}"
                            width="200"
                            class="rounded-5 img-fluid"
                            alt="placeholder">
                        <div>
                            <a href="berita/{{$post->slug}}" class="text-reset link-underline link-underline-opacity-0">
                                <h5>{{$post->title}}</h5>
                            </a>
                            <p
                                class="card-text text-body-secondary">{{$post->created_at}}</p>
                        </div>
                    </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection