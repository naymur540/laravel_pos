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
           <div class="col-md-12">
           <div class="card">
                <div class="card-header"><h4 style="float:left;">Barcode</h4></div>
                <div class="card-body">
                    <div id="prinf">
                        <div class="row">
                            
                            @foreach ($products as $barcode)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                    <img src="{{asset('product/barcode/'.$barcode->barcode)}}" alt="">
                                        <h4 style="text-align: center;">{{$barcode->product_code}}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
           </div>
           
        </div>
    </div>
</div>









@endsection