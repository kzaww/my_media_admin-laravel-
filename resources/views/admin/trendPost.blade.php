@extends('admin.layouts.overall')

@section('title','Trend Post list')

@section('content')
    <div class="d-flex" style="position: relative">
        <h2 style="letter-spacing: 2px">Trend Product List</h2>

            <form action="{{ route('admin#postList') }}" method="get" class="d-flex col-2 mt-3" style="position: absolute;right:50%" >
                <input type="text" class="form-control" name="key" placeholder="search..." style="height:35px">
                <button class="" style="height: 35px;transform:translateX(-34px);width:40px;border-radius:5px;border:none;background-color: rgb(21, 122, 100)"><i class='bx bx-search-alt-2' ></i></button>
            </form>

        {{-- <h3 class="float-end me-5" style="user-select:none;position: absolute;right:10px;top:50px">Total-(<b class="text-info">{{ count($data) }}</b>)</h3> --}}
    </div>

    <div class="container">
        <div class="col-6 offset-3 mt-5">

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>views</th>
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
                            <td class="col align-middle">{{ $item->category_id }}</td>
                            <td class="col align-middle">{{ $item->view }}</td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>

        @if (request('key'))
            <span>search key:<b>{{ request('key') }}</b></span>
        @endif
    </div>
@endsection

@section('script')
    <script>


        $(document).ready(function(){
            $('.dc').click(function(e){
                e.preventDefault();

            });
        })
    </script>
@endsection
