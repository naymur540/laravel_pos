@extends('layouts.app')
@section('content')
@if (session()->has('message'))
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('message') !!}
        </strong>
    </div>
@endif
<div class="container">
    <div class="col-lg-12">
        <div class="row">
           <div class="col-md-9">
           <div class="card">
                <div class="card-header"><h4 style="float:left;">User section</h4><a href="" style="float:right" class="btn btn-dark" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus"></i>Add User</a></div>
                <div class="card-body">
                    <table class="table table-bordered table-left"> 
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $key=> $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>@if($user->is_admin==1)Admin
                                    @else Cashier
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editUser{{$user->id}}"><i class="fa fa-edit" ></i></a>
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUser{{$user->id}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            
                                {{--modal for edit--}}
                                <div class="modal right fade" id="editUser{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                       
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('users.update',$user->id)}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="from-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" id="" value="{{$user->name}}"class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="" value="{{$user->email}}" class="form-control">
                                    </div>
                                    <!-- <div class="from-group">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" id="" class="form-control">
                                    </div> -->
                                    <div class="from-group">
                                        <label for="">Role</label>
                                        <select name="is_admin" id=""  class="form-control">
                                            
                                            <option value="1" @if($user->is_admin==1) selected @endif>Admin</option>
                                            <option value="2"@if($user->is_admin==2) selected @endif>Cashier</option>
                                        </select>
                                    </div>
                                    <div class="from-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" value="{{$user->password}}" class="form-control">
                                    </div>
                                    <!-- <div class="from-group">
                                        <label for="">confirm Password</label>
                                        <input type="password" name="confirm_password" id="" class="form-control">
                                    </div> -->
                                    <div class="modal-footer">
                                    <button class="btn btn-primary btn-block">update User</button>
                                    </div>

                                    </form>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>

                                {{--modal for delete--}}
                                <div class="modal fade" id="deleteUser{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                       
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('users.destroy',$user->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <p>Are you sure you want to delete this{{$user->name}} </p>
                                      
                                    <div class="modal-footer">
                                    <button class="btn btn-warning " data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-danger " type="submit">Delete</button>
                                    </div>

                                    </form>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           </div>
           <div class="col-md-3">
           <div class="card">
                <div class="card-header"><h4>Search</h4></div>
                <div class="card-body">
                   .....
                </div>
            </div>
           </div>
        </div>
    </div>
</div>




{{--add user model--}}
<div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{route('users.store')}}" method="post">
        @csrf
        <div class="from-group">
        <label for="">Name</label>
        <input type="text" name="name" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Email</label>
        <input type="email" name="email" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Phone</label>
        <input type="text" name="phone" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Role</label>
        <select name="is_admin" id="" class="form-control">
            <option value="">Select Role</option>
            <option value="1">Admin</option>
            <option value="2">Cashier</option>
        </select>
       </div>
       <div class="from-group">
        <label for="">Password</label>
        <input type="password" name="password" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">confirm Password</label>
        <input type="password" name="confirm_password" id="" class="form-control">
       </div>
       <div class="modal-footer">
       <button class="btn btn-primary btn-block">Save User</button>
       </div>

       </form>
      </div>
     
    </div>
  </div>
</div>





<style>
    .modal.right .modal-dialog{
        
        top:0;
        right:0;
        margin-right:19vh;
    }
    .modal.fade:not(.in).right .modal-dialog{
        -webkit-transition: translate3d(25%,0,0);
        transform: translate3d(25%,0,0);
    }
</style>
@endsection