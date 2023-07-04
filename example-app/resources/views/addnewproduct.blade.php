@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{ __('Dashboard') }}
                <a href="productpage">All Products</a>
                 </div>
                <div class="card-body">
                @if(isset($productDataByID))
                <form class="form" action="/productedit/{{$productDataByID->id}}" method="post">
                @else
                <form class="form" action="saveproddata" method="post">
                @endif
                    @csrf
                    <div class="row mt-3">
                       <div class="col-6">
                        <input type="text" class="form-control" name="product_title" 
                        placeholder="Enter Product Title" id="product_title" value="{{$productDataByID->product_title ?? ''}}">
                       </div>
                       <div class="row mt-3">
                       <div class="col-6">
                        <input type="text" class="form-control" name="product_description" 
                        placeholder="Enter Product Description" id="product_description" value="{{$productDataByID->product_description ?? ''}}">
                       </div>
                    <div class="row mt-3">
                       <div class="col-6">
                        <input type="text" class="form-control" name="product_price" 
                        placeholder="Enter Product price" id="product_price" value="{{$productDataByID->product_price ?? ''}}">
                       </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-6">
                        <input type="number" class="form-control" name="product_quantity" 
                        placeholder="Enter Product Quantity" id="product_quantity" value="{{$productDataByID->product_quantity ?? ''}}">
                       </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-6">
                        <input type="submit" class="btn btn-primary" name="submit" id="submit">
                       </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
