@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
           <div class="col-md-8">
           <div class="card">
                <div class="card-header"><h4 style="float:left;">product section</h4><a href="" style="float:right" class="btn btn-dark" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus"></i>Add Product</a></div>
                <form action="{{route('orders.store')}}" method="post">
                    @csrf
                <div class="card-body">
                    <table class="table table-bordered table-left"> 
                        <thead>

                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>price</th>
                                <th>Discount %</th>
                                <th>Total</th>
                                <th><a href="#" class="btn btn-sm btn-success rounded-circle add_more"><i class="fa fa-plus"></i></a></th>
                                
                            </tr>
                            
                        </thead>
                        
                        <tbody class="addMoreProduct" >
                        <tr class="">
                            <td>1</td>
                        <td>
                            <select name="product_id[]" id="product_id" class="form-control product_id">
                                <option value="">Select product</option>
                                @foreach($products as $product)
                                <option  data-price="{{$product->sell_price}}"value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantity[]" id="quantity" class="form-control quantity">
                        </td>
                        <td>
                            <input type="number" name="price[]" id="price" class="form-control price">
                        </td>
                        <td>
                            <input type="number" name="discount[]" id="discount" class="form-control discount">
                        </td>
                        <td>
                            <input type="number" name="total_amount[]" id="total_amount" class="form-control total_amount">
                        </td>
                        <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a></td>
                       </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
           </div>
           <div class="col-md-4">
           <div class="card">
                <div class="card-header"><h4>Total <b  class="total" name="total" id="total"></b></h4></div>
                <div class="card-body">
                    <div class="btn-group">
                        <button type="button" onclick="printReceiptContent('print')" class="btn btn-danger" ><i class="fa fa-print"></i>print</button>
                       
                    </div>
                   <div class="panel">
                    <div class="row">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                <label for="">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control">
                                </td>
                                <td>
                                <label for="">Customer Phone</label>
                                <input type="number" name="customer_phone" class="form-control">
                                </td>
                            </tr>
                        </table>
                       <div>
                        Payment Method <br>
                        <span class="radio-item ">
                            <input type="radio" value="cash" name="payment_method" is="payment_method" class="true" checked>
                            <label for="payment_method"><i class="fa fa-money-bill text-success"></i>Cash</label>
                        </span>
                        <span class="radio-item ">
                            <input type="radio" value="bank" name="payment_method" is="payment_method" class="true " >
                            <label for="payment_method"><i class="fa fa-university text-danger"></i>Bank</label>
                        </span>
                        <span class="radio-item ">
                            <input type="radio" value="bikash" name="payment_method" is="payment_method" class="true " >
                            <label for="payment_method"><i class="fa fa-money-bill text-success"></i>Bikash</label>
                        </span>
                        
                       </div>
                       <td>
                        Paid Amount
                        <input type="number" name="paid_amount" id="paid_amount" class="form-control paid_amount">

                       </td>
                       <td>
                        Change Amount
                        <input type="number" name="balance" id="balance" class="form-control ">

                       </td>
                       <td>
                        <button class="btn btn-primary btn-lg btn-block mt-3">Save</button>
                       </td>
                       <td>
                        <a class="btn btn-danger btn-lg btn-block mt-2" data-toggle="modal" data-target="#addProduct">Calculator</a>
                       </td>
                       <div class="text-center mt-2">
                        
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt"></i>Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                       </div>
                    </div>
                   </div>
                </div>
            </div>
           </div>
           </form>
        </div>
    </div>
</div>

{{---print recept---}}
<div class="modal">
<div id="print">
@include('report.recept')
</div>
</div>




<div class="modal right fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       @include('order.calculator')
      </div>
     
    </div>
  </div>
</div>



<style>
    .modal.right .modal-dialog{
         min-height:200px;
        top:0;
        right:0;
        margin-right:19vh;
    }
    .modal.fade:not(.in).right .modal-dialog{
        -webkit-transition: translate3d(25%,0,0);
        transform: translate3d(25%,0,0);
    }
        .radio-item input[type="radio"] {
        visibility: hidden;
        width: 20px;
        height: 20px;
        margin: 0 5px 0 5px;
        padding: 0;
        cursor: pointer;
        }
    /* before style */
        .radio-item input[type="radio"]:before {
        position: relative;
        margin: 4px -25px -4px 0;
        display: inline-block;
        visibility: visible;
        width: 20px;
        height: 20px;
        border-radius: 10px;
        border: 2px inset rgb(150, 150, 150, 0.75);
        background: radial-gradient(ellipse at top left, rgb(255, 255, 255)0%
        rgb(250, 250, 250) 5%, rgb(230, 230, 230) 95%, rgb(225, 225, 225) 100%);
        content:'';
        cursor: pointer;}
    /*checked after style */
        .radio-item input[type="radio"]:checked:after {
        position: relative;
        top: 0;
        left: 9px;
        display: inline-block;
        border-radius: 6px;
        visibility: visible;
        width: 12px;
        height: 12px;
        background: radial-gradient(ellipse at top left,rgb(240, 255, 220) 0%,  rgb(225, 250, 100) 5%, rgb(75, 75, 0) 95%, rgb(25, 100, 0) 100%);
        content: '';
        cursor: pointer;
        }

        /* after checked */
        .radio-item input[type="radio"].true:checked:after {
        background: radial-gradient(ellipse at top left,
        rgb(240, 255, 220) 0%,
        rgb(225, 250, 100) 5%,
        rgb(75, 75, 0) 95%,
        rgb(25, 100, 0) 100%);}

        .radio-item input[type="radio"].false:checked:after {
        background: radial-gradient(ellipse at top left,
        rgb(255, 255, 255) 0%,
        rgb(250, 250, 250) 5%,
        rgb(230, 230, 230) 95%,
        rgb(225, 225, 225) 100%);
        }
        .radio-item label{
        display: inline-block;
        margin: 0;
        padding: 0;
        line-height: 25px;
        height: 25px;
        cursor:pointer;
        }
   
</style>
@endsection

@section('script')



<script>
    $(document).ready(function() {
        $('.add_more').on('click', function(){
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length -0) + 1;
        var tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control product_id" name="product_id[]" >' + product + '</select></td>' +
        '<td> <input type="number" name="quantity[]" class="form-control quantity "></td>'+
        '<td> <input type="number" name="price[]" class="form-control price"></td>'+
        '<td> <input type="number" name="discount[]" class="form-control discount"></td>'+
        '<td> <input type="number" name="total_amount[]" class="form-control total_amount"></td>'+
        '<td><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times-circle"></i></a> </td>'
        $('.addMoreProduct').append(tr);
        
        })
        // Delete a row
            $('.addMoreProduct').delegate('.delete', 'click', function(){
            $(this).parent().parent().remove();
            })

            function TotalAmount() {
            var total = 0;

            // Iterate over each element with the class `total_amount`
            $('.total_amount').each(function() {
                var amount = parseFloat($(this).val()) || 0; // Parse the value as a float, default to 0 if it's not a number
                total += amount; // Add to the total
            });

            // Round the total to the nearest whole number
            var roundedTotal = Math.round(total);

            // Display the rounded total in the element with the class `total`
            $('.total').html(roundedTotal);
        }



        $('.addMoreProduct').delegate('.product_id', 'change', function() {
        var tr = $(this).closest('tr'); // Find the closest table row
        var price = tr.find('.product_id option:selected').attr('data-price'); // Get the selected product price
        tr.find('.price').val(price); // Set the price input value
        var qty = tr.find('.quantity').val() - 0; // Get the quantity
        var disc = tr.find('.discount').val() - 0; // Get the discount
        var price = tr.find('.price').val() - 0; // Get the price
        var total_amount = (qty * price) - ((qty * price * disc) / 100); // Calculate total amount with discount
        tr.find('.total_amount').val(Math.round(total_amount)); // Set rounded total amount
        TotalAmount(); // Recalculate the overall total
    });

    $('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function() {
        var tr = $(this).closest('tr'); // Find the closest table row
        var qty = tr.find('.quantity').val() - 0; // Get the quantity
        var disc = tr.find('.discount').val() - 0; // Get the discount
        var price = tr.find('.price').val() - 0; // Get the price
        var total_amount = (qty * price) - ((qty * price * disc) / 100); // Calculate total amount with discount
        tr.find('.total_amount').val(Math.round(total_amount)); // Set rounded total amount
        TotalAmount(); // Recalculate the overall total
    });

    $('#paid_amount').keyup(function() {
        var total = Math.round(parseFloat($('.total').html()) || 0); // Get the total amount and ensure it's rounded
        var paid_amount = Math.round(parseFloat($(this).val()) || 0); // Get the paid amount and ensure it's rounded
        var balance = paid_amount - total; // Calculate balance
        $('#balance').val(balance.toFixed(2)); // Set balance value and fix to 2 decimal places
    });

    })
    //print function//
    function printReceiptContent(el){
        var data='<input type="button" id="printPageButton" class="printPageButton" style="display:block; width:100%; border: none; background-color: #008B8B; color: #fff ; padding: 14px 28px; font-size:16px; cursor: pointer; text-align: center" value="Print Receipt"" onClick="window.print()">';
        data+=document.getElementById(el).innerHTML;
        myReceipt=window.open("","myWin","left=150,top=30,width=400,height=400");
        myReceipt.screnX=0;
        myReceipt.screnY=0;
        myReceipt.document.write(data);
        myReceipt.document.title="print receipt";
        myReceipt.focus();
        setTimeout(()=>{
            myReceipt.close();
        },8000);
    }
</script>
@endsection