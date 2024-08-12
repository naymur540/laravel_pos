<style>
    a{
        text-decoration: none;
    }
    #sidebar ul.lead{
        border-bottom:1px solid #47748b;
        width:fit-content;
    }
    #sidebar ul li a{
        padding:10px;
        font-size: 1.1em;
    display:block;
    width:30vh;
    color:#008B8B;
    }
    #sidebar ul li a:hover{
        
    color:#fff;
    background:#008B8B;
    text-decoration: none;
    }
    #sidebar ul li a i{
        margin-right: 15px;
        
    }
    #sidebar ul li.active>a,a[aria-expanded="true"]
{
    color: #fff;
    background: #008B8B;
}
</style>
<nav class="active" id="sidebar">
    <ul class="list-unstyled lead">
        <li class="active">
            <a href=" "><i class="fa fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('orders')}}"><i class="fa fa-box"></i>Order</a>
        </li>
        <li>
            <a href="{{url('transactions')}}"><i class="fa fa-money-bill"></i>transaction</a>
        </li>
        <li>
            <a href="{{url('products')}}"><i class="fa fa-truck"></i>Product</a>
        </li>
    </ul>

</nav>