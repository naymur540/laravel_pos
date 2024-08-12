<div id="invoice_pos">
<div id="printed_content">
<center id="top">
    <div class="logo">logo</div>
    <div class="info"></div>
    <h2>pos in laravel</h2>
</center>
</div>
<div id="mid">
    <center class="info">
        <h2>Contact Us</h2>
        <p>
            Address:Dhaka,Bangladesh.
            Phone:01800000000.
            Email:laravel@gmail.com
        </p>
    </center>
</div>

<div class="bot">
    <div id="table">
        <table>
            <tr class="tabletitle">
                <td class="item"><h2>Item</h2></td>
                <td class="hours"><h2>Qty</h2></td>
                <td class="rate"><h2>price</h2></td>
                <td class="rate"><h2>dis%</h2></td>
                <td class="rate"><h2>Total</h2></td>
            </tr>
            @foreach($order_receipt as $receipt)
            <tr class="service">
                <td class="tableitem"><p class="itemtext">{{$receipt->product->product_name}}</p></td>
                <td class="tableitem"><p class="itemtext">{{$receipt->quantity}}</p></td>
                <td class="tableitem"> <p class="itemtext">{{number_format ($receipt->unitprice,2)}}</p></td>
                <td class="tableitem"><p class="itemtext">{{$receipt->discount}}</p></td>
                <td class="tableitem"><p class="itemtext">{{number_format ($receipt->amount,2)}}</p></td>
            </tr>
            @endforeach
            <tr class="tabletitle" style="margin-top: 6px;">
              <td></td>
              <td></td>
              <td></td>
                <td class="rate"><p class="itemtext">tax</p></td>
                
                <td class="payment"><p class="itemtext">5 %</p></td>
            </tr>
            <tr class="totalpayment">
                <td></td>
                <td></td>
                <td></td>
                  <td class="rate">Total</td>
                  
                  <td class="payment">{{ number_format($order_receipt->sum('amount') * 1.05, 2) }}

                  taka</td>
              </tr>
        </table>
        <div class="legalcopy">
            <p class="legal"><strong>*** Thanks For Shopping Our Shop ***</strong><br>We all ways with you</p>
        </div>
        <div class="serial-number">Invoice:<span class="">12345</span><br>
        <span>2024-08-10</span></div>
    </div>
</div>
</div>
<style>
#invoice_pos{
    background: #fff;
    width: 55mm;
    margin: 0 auto;
    padding: 2mm;
    box-shadow: 0 0 1in -.25in rgb(0, 0, 0.5);
}
#invoice_pos::selection{
    background: #34495E;
    color: #fff;
}
#invoice_pos::-moz-selection{
    background: #34495E;
    color: #fff;
}
#invoice_pos h1{
    font-size: 1.5em;
    color: black;
}
#invoice_pos h2{
    font-size: 0.6em;
   
}
#invoice_pos h3{
    font-size: 1.2em;
   line-height: 2em;
   font-weight: 300;
}
#invoice_pos p{
    font-size: 0.7em;
   line-height: 1.2em;
  color: #666;
}
#invoice_pos #top,#invoice_pos #mid,#invoice_pos #bot{
    border-bottom: 1px solid #eee;
}
#invoice_pos #top{
    min-height: 100px;
}
#invoice_pos #mid{
    min-height: 80px;
    
}
#invoice_pos #bot{
    min-height: 50px;
}
#invoice_pos #top .logo{
    height: 60px;
    width: 60px;
    background-image: url()no-repeat;
    background-size: 60px 60px;
    border-radius: 50px;
}
#invoice_pos.info{
    display: block;
    text-align: center;
    margin-left: 0;
}
#invoice_pos.title{
    float: right;
}
#invoice_pos.title p{
    text-align: right;
}
#invoice_pos table{
    width: 100%;
    border-collapse: collapse;
}
#invoice_pos .tabletitle{
    font-size: 0.5em;
    background: #eee;

}
#invoice_pos .totalpayment{
    font-size: 0.4em;
    background: #eee;
    margin-top: 10px;

}
#invoice_pos .service{
    border-bottom: 1px solid #eee;
}
#invoice_pos .item{
    width: 24mm;
}
#invoice_pos .itemtext{
    font-size: 0.5em;
}
#invoice_pos .legalcopy{
    margin-top: 5mm;
    text-align: center;
}
#invoice_pos.serial-number{
    margin-top: 5em;
    margin-bottom: 2em;
    text-align: center;
    font-size: 8px;
    font-weight: 100;
}


</style>