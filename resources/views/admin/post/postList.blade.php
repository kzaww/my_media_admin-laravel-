@extends('admin.layouts.overall')

@section('title','Post list')

@section('content')
    <div class="d-flex" style="position: relative">
        <h2 style="letter-spacing: 2px">Product List</h2>

            <form action="{{ route('admin#postList') }}" method="get" class="d-flex col-2 mt-3" style="position: absolute;right:50%" >
                <input type="text" class="form-control" name="key" placeholder="search..." style="height:35px">
                <button class="" style="height: 35px;transform:translateX(-34px);width:40px;border-radius:5px;border:none;background-color: rgb(21, 122, 100)"><i class='bx bx-search-alt-2' ></i></button>
            </form>

        <h3 class="float-end me-5" style="user-select:none;position: absolute;right:10px;top:50px">Total-(<b class="text-info">{{ count($data) }}</b>)</h3>
        <button class="btn btn-success mt-3" style="position: absolute;right:50px" data-bs-toggle="modal" data-bs-target="#createProduct">+ Add Product</button>
    </div>

    <div class="container">
        <div class="col-6 offset-3 mt-5">
            @if (session('failCreate'))
                <div role="alert" class="alert alert-danger alert-dismissible fade show">
                    {{ session('failCreate') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>

                <script>
                    $(document).ready(function(){
                        $('#createProduct').modal('show');
                    })
                </script>
            @endif
            @if (session('successCreate'))
                <div role="alert" class="alert alert-success alert-dismissible fade show">
                    {{ session('successCreate') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
            @if (session('deleteSuccess'))
                <div role="alert" class="alert alert-success alert-dismissible fade show">
                    {{ session('deleteSuccess') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
            @if (session('deleteFail'))
                <div role="alert" class="alert alert-danger alert-dismissible fade show">
                    {{ session('deleteFail') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
            @if (session('successUpdate'))
                <div role="alert" class="alert alert-success alert-dismissible fade show">
                    {{ session('successUpdate') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    {{-- <th>views</th> --}}
                    <th class="ps-5">Action</th>
                </tr>
            </thead>
            <tbody style="">
                @if (count($data) == 0 )
                    <tr>
                        <td colspan="5" class="text-center text-danger"><h1 class="danger">No Data</h1></td>
                    </tr>
                @else
                    @foreach ($data as $item)
                        <tr style="user-select: none;">
                            <td class="col align-middle" >
                                <img class="img-thumbnail" src="{{ asset('storage/'.$item->image) }}" alt="" style="width: 100px;height:70px ">
                            </td>
                            <td class="col align-middle">{{ $item->post_title }}</td>
                            <td class="col align-middle">{{ $item->category_title }}</td>
                            {{-- <td class="col align-middle">0</td> --}}
                            <td class="col align-middle ps-5">
                                <a href="{{ route('admin#postDetail',$item->post_id) }}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-info pt-2" title="detail"><i class='bx bxs-detail' style="font-size: 15px"></i></button>
                                </a>
                                <a href="{{ route('admin#postEdit',$item->post_id) }}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-warning pt-2" title="edit"><i class='bx bxs-edit' style="font-size: 15px"></i></button>
                                </a>
                                <button class="btn btn-sm btn-danger pt-2 dc" title="delete" value="{{ $item->post_id }}"><i class='bx bxs-trash' style="font-size: 15px"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

        @if (request('key'))
            <span>search key:<b>{{ request('key') }}</b></span>
        @endif
    </div>

    {{-- modal --}}
    <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createController" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('admin#postCreate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="">
                        <label for="">Image:</label>
                        <input type="file" name="image" class="form-control @if($errors->has('image')) is-invalid @elseif(($errors->has('title')||$errors->has('category')||$errors->has('description'))) is-valid  @endif" value="{{ old('image') }}">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div><br>

                    <div class="">
                        <label for="">Title:</label>
                        <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @elseif(($errors->has('category')||$errors->has('image')||$errors->has('description'))) is-valid  @endif" placeholder="title..." value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div><br>

                    <div class="">
                        <label for="">Description:</label>
                        <textarea name="description" class="form-control @if($errors->has('description')) is-invalid @elseif(($errors->has('title')||$errors->has('image')||$errors->has('category'))) is-valid  @endif" rows="4" placeholder="description...">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div><br>

                    <div class="">
                        <label for="">Category:</label>
                        <select name="category" class="form-control @if($errors->has('category')) is-invalid @elseif($errors->has('title')||$errors->has('image')||$errors->has('description')) is-valid  @endif">
                            <option value="">Choose Categroy</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->category_id }}" @if (old('category') == $cat->category_id) selected @endif>{{ $cat->category_title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div><br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div>
            </form>
          </div>
        </div>
      </div>

{{-- modal --}}
<div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deleteCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#postDelete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="text" name="id" id="pId" hidden>
                Are you Sure?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary ">Yes</button>
              </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>


        $(document).ready(function(){
            $('.dc').click(function(e){
                e.preventDefault();

                let productId = $(this).val();
                $('#pId').val(productId);
                $('#deletePost').modal('show');
            });
        })
    </script>
@endsection
