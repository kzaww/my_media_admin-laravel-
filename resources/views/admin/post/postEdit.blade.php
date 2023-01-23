@extends('admin.layouts.overall')

@section('title','Edit Post')

@section('content')
    <div class="col-8 offset-2">
        <div class="container mt-5">
            <button class="btn" style="font-size: 1.4rem" onclick="window.history.back()"><i class='bx bx-arrow-back'></i></button>
            <div class="card">
                <div class="card-header bg-info">
                    <h2>Edit Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin#postUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="{{ $data->post_id }}" hidden>
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset('storage/'.$data['image']) }}" alt="" style="width: 100%">
                                <div class="">
                                    <label for="">Image:</label>
                                    <input type="file" name="image" class="form-control @if($errors->has('image')) is-invalid @elseif(($errors->has('title')||$errors->has('category')||$errors->has('description'))) is-valid  @endif">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><br>
                            </div>

                            <div class="col-6">
                                <div class="">
                                    <label for="">Title:</label>
                                    <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @elseif(($errors->has('category')||$errors->has('image')||$errors->has('description'))) is-valid  @endif" placeholder="title..." value="{{ old('title',$data['post_title']) }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><br>

                                <div class="">
                                    <label for="">Description:</label>
                                    <textarea name="description" class="form-control @if($errors->has('description')) is-invalid @elseif(($errors->has('title')||$errors->has('image')||$errors->has('category'))) is-valid  @endif" rows="4" placeholder="description...">{{ old('description',$data['post_description']) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><br>

                                <div class="">
                                    <label for="">Category:</label>
                                    <select name="category" class="form-control @if($errors->has('category')) is-invalid @elseif($errors->has('title')||$errors->has('image')||$errors->has('description')) is-valid  @endif">
                                        <option value="" disabled>Choose Categroy</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->category_id }}" @if ($data['category_id'] == $cat->category_id) selected @endif>{{ $cat->category_title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><br>
                            </div>
                        </div>
                        <button class="btn btn-secondary float-end">Update</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
