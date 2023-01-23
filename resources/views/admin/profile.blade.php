@extends('admin.layouts.overall')

@section('title','profile')

@section('content')
    <div class="col-6 offset-3 mt-5">
        <div class="container">
            <div class="">
                @if (Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('fail') }}
                        <button type="close" class="btn btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('#changeProfile').modal('show');
                        });
                    </script>
                @endif
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if (session('changeFail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('changeFail') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert"></button>
                </div>
                <script>
                    $(document).ready(function(){
                        $('#changePassword').modal('show');
                    });
                </script>
                @endif
                 @if (session('changesuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('changesuccess') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if (session('notMatch'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('notMatch') }}
                    <button type="close" class="btn btn-close" data-bs-dismiss="alert"></button>
                </div>
                <script>
                    $(document).ready(function(){
                        $('#changePassword').modal('show');
                    });
                </script>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <div >
                        <h2 class="text-center" style="letter-spacing: 2px">Profile</h2><hr>
                    </div>

                    <div class="row">
                        <div class="col-4 offset-2">
                            <b>Name</b><br>
                            <b>Email</b><br>
                            <b>Phone</b><br>
                            <b>Address</b><br>
                            <b>Gender</b><br>
                        </div>
                        <div class="col ">
                            <span>: {{ auth()->user()->name }}</span><br>
                            <span>: {{ auth()->user()->email }}</span><br>
                            <span>: {{ auth()->user()->phone }}</span><br>
                            <span>: {{ auth()->user()->address }}</span><br>
                            <span>: {{ auth()->user()->gender }}</span><br>
                        </div>
                    </div>

                    <div class="float-end mt-3 me-5">
                        <a href="javascript:{}" class="cpw">change password?</a>
                        <button class="btn btn-sm btn-warning cp">Change Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="changeProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#changeProfile') }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @elseif($errors->has('email')||$errors->has('phone')||$errors->has('address')||$errors->has('gender')) is-valid  @endif" placeholder="name..." value="{{ auth()->user()->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
                <div class="">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @elseif($errors->has('name')||$errors->has('phone')||$errors->has('address')||$errors->has('gender')) is-valid  @endif" placeholder="email..." value="{{ auth()->user()->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
                <div class="">
                    <label for="">Phone:</label>
                    <input type="number" name="phone" class="form-control @if($errors->has('phone')) is-invalid @elseif($errors->has('email')||$errors->has('name')||$errors->has('address')||$errors->has('gender')) is-valid  @endif" placeholder="phone..." value="{{ auth()->user()->phone }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
                <div class="">
                    <label for="">Address:</label>
                    <input type="text" name="address" class="form-control @if($errors->has('address')) is-invalid @elseif($errors->has('email')||$errors->has('name')||$errors->has('phone')||$errors->has('gender')) is-valid  @endif" placeholder="address..." value="{{ auth()->user()->address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
                <div class="">
                    <label for="">Gender:</label>
                    <select name="gender" class="form-control  @if($errors->has('gender')) is-invalid @elseif($errors->has('email')||$errors->has('name')||$errors->has('address')||$errors->has('phone')) is-valid  @endif">
                        <option value="" >choose gender</option>
                        <option value="male" @if (auth()->user()->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if (auth()->user()->gender == 'female') selected @endif>Female</option>
                        <option value="other" @if (auth()->user()->gender == 'other') selected @endif>Other</option>
                    </select>
                    @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('admin#changePassword') }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="">
                    <label for="">Old Password:</label>
                    <div class="input-group">
                        <input type="password" id="inputType1" name="oldpassword" class="form-control" placeholder="old password...">
                        <span class="input-group-text" id="op" style="cursor: pointer" onclick="myfunction('inputType1','op')">show</span>
                    </div>
                </div>
                @error('oldpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <div class="">
                    <label for="">New Password:</label>
                    <div class="input-group">
                        <input type="password" id="inputType2" name="newpassword" class="form-control" placeholder="new password...">
                        <span class="input-group-text" id="np" style="cursor: pointer" onclick="myfunction('inputType2','np')">show</span>
                    </div>
                </div>
                @error('newpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <div class="">
                    <label for="">Confirm Password:</label>
                    <div class="input-group">
                        <input type="password" id="inputType3" name="confirmpassword" class="form-control" placeholder="confirm password...">
                        <span class="input-group-text" id="cp" style="cursor: pointer" onclick="myfunction('inputType3','cp')">show</span>
                    </div>
                </div>
                @error('confirmpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.cp').click(function(e){
                e.preventDefault();

                $('#changeProfile').modal('show');
            });
            $('.cpw').click(function(e){
                e.preventDefault();

                $('#changePassword').modal('show');
            });
        });

        password=true;
        function myfunction(id1,id2){
            let x = document.getElementById(id1);
            if(password){
                x.type = 'text';
                document.getElementById(id2).innerHTML="hide";
            }else{
                x.type = 'password';
                document.getElementById(id2).innerHTML = "show";
            }
            password=!password;
        }
    </script>
@endsection
