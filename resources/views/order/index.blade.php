@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float:left;">Report</h4>
                        <a href="{{ route('orders.create') }}" style="float:right" class="btn btn-dark">
                            <i class="fa fa-plus"></i> Create Order
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ number_format($order->orderDetails->sum('amount'), 2) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" onclick="printReceiptContent('{{ $order->id }}')" class="btn btn-danger">
                                                    <i class="fa fa-print"></i> Print
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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


@foreach($orders as $order)
    <!-- Print Content Modal -->
    <div class="modal fade" id="printModal{{ $order->id }}" tabindex="-1" aria-labelledby="printModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel{{ $order->id }}">Invoice #{{ $order->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="print-content-{{ $order->id }}">
                        <!-- Invoice Content -->
                        <div id="invoice_pos">
                            <div id="printed_content">
                                <center id="top">
                                    <div class="logo">logo</div>
                                    <div class="info"></div>
                                    <h2>POS in Laravel</h2>
                                </center>
                            </div>
                            <div id="mid">
                                <center class="info">
                                    <h2>Contact Us</h2>
                                    <p>
                                        Address: Dhaka, Bangladesh.<br>
                                        Phone: 01800000000.<br>
                                        Email: laravel@gmail.com
                                    </p>
                                </center>
                            </div>
                            <div class="bot">
                                <div id="table">
                                    <table>
                                        <tr class="tabletitle">
                                            <td class="item"><h2>Item</h2></td>
                                            <td class="hours"><h2>Qty</h2></td>
                                            <td class="rate"><h2>Price</h2></td>
                                            <td class="rate"><h2>Dis%</h2></td>
                                            <td class="rate"><h2>Total</h2></td>
                                        </tr>
                                        @foreach($order->orderDetails as $receipt)
                                            <tr class="service">
                                                <td class="tableitem"><p class="itemtext">{{ $receipt->product->product_name }}</p></td>
                                                <td class="tableitem"><p class="itemtext">{{ $receipt->quantity }}</p></td>
                                                <td class="tableitem"><p class="itemtext">{{ number_format($receipt->unitprice, 2) }}</p></td>
                                                <td class="tableitem"><p class="itemtext">{{ $receipt->discount }}</p></td>
                                                <td class="tableitem"><p class="itemtext">{{ number_format($receipt->amount, 2) }}</p></td>
                                            </tr>
                                        @endforeach
                                        <tr class="tabletitle">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="rate"><p class="itemtext">Tax</p></td>
                                            <td class="payment"><p class="itemtext">5%</p></td>
                                        </tr>
                                        <tr class="totalpayment">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="rate">Total</td>
                                            <td class="payment">{{ number_format($order->orderDetails->sum('amount') * 1.05, 2) }} taka</td>
                                        </tr>
                                    </table>
                                    <div class="legalcopy">
                                        <p class="legal"><strong>*** Thanks For Shopping With Us ***</strong><br>We are always here for you</p>
                                    </div>
                                    <div class="serial-number">
                                        Invoice: <span class="">{{$order->id}}</span><br>
                                        <span>{{ $order->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReceiptContent('{{ $order->id }}')">Print Invoice</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    @media print {
        #invoice_pos {
            background: #fff;
            width: 70mm;
            margin: 0 auto;
            padding: 2mm;
            box-shadow: 0 0 1in -.25in rgb(0, 0, 0.5);
        }
        /* Additional print styles here */
    }
</style>

@endsection

@section('script')
<script>
    function printReceiptContent(orderId) {
    var content = document.getElementById('print-content-' + orderId).innerHTML;
    var printWindow = window.open('', '', 'height=600,width=800');
    
    printWindow.document.write('<html><head><title>Print Receipt</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('#invoice_pos { background: #fff; width: 55mm; margin: 0 auto; padding: 2mm; box-shadow: 0 0 1in -.25in rgb(0, 0, 0.5); }');
    printWindow.document.write('#invoice_pos::selection { background: #34495E; color: #fff; }');
    printWindow.document.write('#invoice_pos::-moz-selection { background: #34495E; color: #fff; }');
    printWindow.document.write('#invoice_pos h1 { font-size: 1.5em; color: black; }');
    printWindow.document.write('#invoice_pos h2 { font-size: 0.6em; }');
    printWindow.document.write('#invoice_pos h3 { font-size: 1.2em; line-height: 2em; font-weight: 300; }');
    printWindow.document.write('#invoice_pos p { font-size: 0.7em; line-height: 1.2em; color: #666; }');
    printWindow.document.write('#invoice_pos #top, #invoice_pos #mid, #invoice_pos #bot { border-bottom: 1px solid #eee; }');
    printWindow.document.write('#invoice_pos #top { min-height: 100px; }');
    printWindow.document.write('#invoice_pos #mid { min-height: 80px; }');
    printWindow.document.write('#invoice_pos #bot { min-height: 50px; }');
    printWindow.document.write('#invoice_pos #top .logo { height: 60px; width: 60px; background-image: url() no-repeat; background-size: 60px 60px; border-radius: 50px; }');
    printWindow.document.write('#invoice_pos.info { display: block; text-align: center; margin-left: 0; }');
    printWindow.document.write('#invoice_pos.title { float: right; }');
    printWindow.document.write('#invoice_pos.title p { text-align: right; }');
    printWindow.document.write('#invoice_pos table { width: 100%; border-collapse: collapse; }');
    printWindow.document.write('#invoice_pos .tabletitle { font-size: 0.5em; background: #eee; }');
    printWindow.document.write('#invoice_pos .totalpayment { font-size: 0.4em; background: #eee; margin-top: 10px; }');
    printWindow.document.write('#invoice_pos .service { border-bottom: 1px solid #eee; }');
    printWindow.document.write('#invoice_pos .item { width: 24mm; }');
    printWindow.document.write('#invoice_pos .itemtext { font-size: 0.5em; }');
    printWindow.document.write('#invoice_pos .legalcopy { margin-top: 5mm; text-align: center; }');
    printWindow.document.write('#invoice_pos.serial-number { margin-top: 5em; margin-bottom: 2em; text-align: center; font-size: 8px; font-weight: 100; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body >');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.focus();

    printWindow.onload = function() {
        printWindow.print();
        printWindow.onafterprint = function () {
            printWindow.close();
        };
    };
}

</script>
@endsection