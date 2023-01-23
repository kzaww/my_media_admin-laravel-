@extends('admin.layouts.overall')

@section('title','category list')

@section('content')
    <div class="d-flex" style="position: relative">
        <h2 style="letter-spacing: 2px">Category List</h2>

            <form action="{{ route('admin#categoryList') }}" method="get" class="d-flex col-2 mt-3" style="position: absolute;right:50%" >
                <input type="text" class="form-control" name="key" placeholder="search..." style="height:35px">
                <button class="" style="height: 35px;transform:translateX(-34px);width:40px;border-radius:5px;border:none;background-color: rgb(21, 122, 100)"><i class='bx bx-search-alt-2' ></i></button>
            </form>

        <h3 class="float-end me-5" style="user-select:none;position: absolute;right:10px;top:50px">Total-(<b class="text-info">{{ count($data) }}</b>)</h3>
        <button class="btn btn-success mt-3" style="position: absolute;right:50px" data-bs-toggle="modal" data-bs-target="#createCategory">+ Add Category</button>
    </div>

    <div class="container">
        <div class="col-6 offset-3 mt-5">
            @if (session('createFail'))
                <div role="alert" class="alert alert-danger alert-dismissible fade show">
                    {{ session('createFail') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>

                <script>
                    $(document).ready(function(){
                        $('#createCategory').modal('show');
                    })
                </script>
            @endif
            @if (session('createSuccess'))
                <div role="alert" class="alert alert-success alert-dismissible fade show">
                    {{ session('createSuccess') }}
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
            @if (session('updateSuccess'))
                <div role="alert" class="alert alert-success alert-dismissible fade show">
                    {{ session('updateSuccess') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                </div>
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="ps-5">Action</th>
                </tr>
            </thead>
            <tbody style="">
                @if (count($data) == 0 )
                    <tr>
                        <td colspan="5" class="text-center text-danger"><h1 class="danger">No Data</h1></td>
                    </tr>
                @else
                    <?php  $i = 1 ?>
                    @foreach ($data as $item)
                        <tr style="user-select: none;">
                            <td class="col-1 align-middle"><?php echo $i; ?></td>
                            <td class="col-2 align-middle">{{ $item->category_title }}</td>
                            <td class="col-7 align-middle" style="hyphens: auto;"><textarea rows="2" style="cursor:context-menu" class="form-control tb_text">{{ $item->category_description }}</textarea></td>
                            <td class="col-3 align-middle ps-5">
                                <a href="{{ route('admin#categoryEdit',$item->category_id) }}" class="text-decoration-none">
                                    <button class="btn btn-sm btn-warning pt-2" title="edit"><i class='bx bxs-edit' style="font-size: 15px"></i></button>
                                </a>
                                <button class="btn btn-sm btn-danger pt-2 dc" title="delete" value="{{ $item->category_id }}"><i class='bx bxs-trash' style="font-size: 15px"></i></button>
                            </td>
                        </tr>

                        <?php $i++; ?>
                    @endforeach
                @endif

            </tbody>
        </table>

        @if (request('key'))
            <span>search key:<b>{{ request('key') }}</b></span>
        @endif
    </div>

    {{-- modal --}}
    <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createController" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('admin#categoryCreate') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="">
                        <label for="">Title:</label>
                        <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @elseif($errors->has('description')) is-valid  @endif" placeholder="name..." value="{{ old('title') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div><br>

                    <div class="">
                        <label for="">Description:</label>
                        <textarea name="description" class="form-control @if($errors->has('description')) is-invalid @elseif($errors->has('title')) is-valid  @endif" rows="4" placeholder="description...">{{ old('description') }}</textarea>
                        @error('description')
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
<div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="deleteCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#categoryDelete') }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="text" name="id" id="cId" hidden>
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
        //user select disable in textarea
        $('.tb_text').on('mousedown', function(e) {
            e.preventDefault();
        });

        $(document).ready(function(){
            $('.dc').click(function(e){
                e.preventDefault();

                let categoryId = $(this).val();
                $('#cId').val(categoryId);
                $('#deleteCategory').modal('show');
            });
        })
    </script>
@endsection
