@extends('admin.layouts.overall')

@section('title','Post Details')

@section('content')
<div class="col-6 offset-3">
    <div class="container mt-5">
        <button class="btn" style="font-size: 1.4rem" onclick="window.history.back()"><i class='bx bx-arrow-back'></i></button>
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="text-center">Detail Post</h3><br>
                <img src="{{ asset('storage/'.$data->image) }}" class="img-thumbnail" style="width: 80%; margin-left:60px"><br>

                <div class="row mt-3" style="user-select: none">
                    <div class="col-6 text-center">
                        <span>Title</span><br>
                        <span>Category</span><br>
                        <span>Description</span>
                    </div>
                    <div class="col-6" style="user-select: none">
                        <span>: <b>{{ $data->post_title }}</b></span><br>
                        <span>: <b class="text-info">{{ $data->category_title }}</b></span><br>
                        <span>: <b>{{ $data->post_description }}</b></span><br>
                    </div>
                </div>
                <div class="float-end">
                    <span class="d-flex"><i class='bx bxs-show' style="margin-top: 8px"></i>0</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
