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
                <div class="card-header"><h4 style="float:left;">product section</h4><a href="" style="float:right" class="btn btn-dark" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus"></i>Add Product</a></div>
                <div class="card-body">
                    <table class="table table-bordered table-left"> 
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Catagorie</th>
                                <th>Bay-price</th>
                                <th>Sell-price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $key=> $product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_catagorie}}</td>
                               
                                <td>{{$product->bay_price}}</td>
                                <td>{{$product->sell_price}}</td>
                                <td>@if($product->quantity <= $product->alert_stock)<span class="badge badge-danger">low stock>{{$product->quantity}} </span>
                                @else
                                        {{$product->quantity}}

                                    @endif
                                </td>
                                
                                
                                <td>
                                    <div class="btn-group">
                                        <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editProduct{{$product->id}}"><i class="fa fa-edit" ></i></a>
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProduct{{$product->id}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            
                                {{--modal for edit--}}
                               @include('product.edit')

                                {{--modal for delete--}}
                                <div class="modal fade" id="deleteProduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                       
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('products.destroy',$product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <p>Are you sure you want to delete this{{$product->product_name}} </p>
                                      
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




{{--add product model--}}
<div class="modal right fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="from-group">
        <label for="">Name</label>
        <input type="text" name="product_name" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Product_code</label>
        <input type="text" name="product_code" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Catagories</label>
        <select  name="product_catagorie" class="form-control">
                    @foreach($catagories as $catagorie)
                      <option value="{{$catagorie->id}}">{{$catagorie->catagorie_name}}</option>
                    @endforeach
                    </select>
       </div>
      
       <div class="from-group">
        <label for="">Bay_price</label>
        <input type="number" name="price" id="" class="form-control">
       </div>
    
       <div class="from-group">
        <label for="">Sell Price</label>
        <input type="number" name="sell_price" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">stock</label>
        <input type="number" name="quantity" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Alert-stock</label>
        <input type="number" name="alert_stock" id="" class="form-control">
       </div>
       <div class="from-group">
        <label for="">Product-Image</label>
        <input type="file" name="product_image" id="" class="form-control">
       </div>
       <div class="modal-footer">
       <button class="btn btn-primary btn-block">Add product</button>
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