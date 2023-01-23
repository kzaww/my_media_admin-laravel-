@extends('admin.layouts.overall')

@section('title','Edit Category')

@section('content')
    <div class="col-6 offset-3">
        <div class="container mt-5">
            <button class="btn" style="font-size: 1.4rem" onclick="window.history.back()"><i class='bx bx-arrow-back'></i></button>
            <div class="card">
                <div class="card-header bg-info">
                    <h2>Edit Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin#categoryUpdate') }}" method="post">
                        @csrf
                        <input type="text" name="id" value="{{ $data->category_id }}" hidden>
                        <div class="">
                            <label for="">Title:</label>
                            <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @elseif($errors->has('description')) is-valid  @endif" placeholder="name..." value="{{ old('title',$data->category_title) }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>

                        <div class="">
                            <label for="">Description:</label>
                            <textarea name="description" class="form-control @if($errors->has('description')) is-invalid @elseif($errors->has('title')) is-valid  @endif" rows="4" placeholder="description...">{{ old('description',$data->category_description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><br>

                        <button class="btn btn-secondary float-end">Update</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
