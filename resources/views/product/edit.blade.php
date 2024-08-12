<div class="modal right fade" id="editProduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Edit Product</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                       
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="from-group">
                                        <label for="">Name</label>
                                        <input type="text" name="product_name" id="" value="{{$product->product_name}}"class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label for="">product Code</label>
                                        <input type="text" name="product_code" id="" value="{{$product->product_code}}"class="form-control">
                                    </div>
                                    
                                    <div class="from-group">
                                            <label for="">Catagories</label>
                                            <select  name="product_catagorie" class="form-control">
                                                @foreach($catagories as $catagorie)
                                                <option value="{{$product->product_catagorie}}">{{$catagorie->catagorie_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="from-group">
                                        <label for="">Bay_price</label>
                                        <input type="number" name="bay_price" id="" value="{{$product->bay_price}}"class="form-control">
                                    </div>
                                    
                                    <div class="from-group">
                                        <label for="">Sell Price</label>
                                        <input type="number" name="sell_price" id="" value="{{$product->sell_price}}" class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label for="">stock</label>
                                        <input type="number" name="quantity" id=""value="{{$product->quantity}}" class="form-control">
                                    </div>
                                    <div class="from-group">
                                        <label for="">Alert-stock</label>
                                        <input type="number" name="alert_stock" id="" value="{{$product->alert_stock}}"class="form-control">
                                    </div>
                                    <div class="from-group">
                                    <img width="60px" height="80px" src="{{asset('product/img/'.$product->product_image)}}" alt=""><br>
                                        <label for="">Product-Image</label>
                                        <input type="file" name="product_image" id="" class="form-control">
                                    </div>
                                   
                                    <div class="modal-footer">
                                    <button class="btn btn-primary btn-block">update User</button>
                                    </div>

                                    </form>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>