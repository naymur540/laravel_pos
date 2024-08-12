<a href=""  data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill"><i class="fa fa-list"></i></a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-home"></i>Home</a>
<a href="{{route('users.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-user"></i>User</a>
<a href="{{route('products.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-box"></i>Product</a>
<a href="{{route('orders.create')}}" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i>Cashier</a>
<a href="{{route('orders.index')}}" class="btn btn-outline rounded-pill"><i class="fa fa-file"></i>Report</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-money-bill"></i>Transaction</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-chart"></i>Suppliers</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-users"></i>Customer</a>
<a href="" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i>Income</a>
<a href="{{route('products.barcode')}}" class="btn btn-outline rounded-pill"><i class="fa fa-laptop"></i>barcode</a>
<style>
    .btn-outline{
        border-color:#008b8b;
        color:#008b8b;
    }
    .btn-outline:hover{
        background-color:#008b8b;
        color:#000;
    }
</style>