@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                {{ __('Dashboard') }}
                <a href="productpage">All Products</a>
                 </div>
                <div class="card-body">
                <h2>All Products</h2>
                    {{--$data["msg"]--}}
                    {{--dd($allproducts)--}}
                    <div class="row">
                        <a href="addnewprod">Add New Product</a>
                    </div>
                    <table class="table table-bordered mt-3 table-responsive">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($allproducts as $data)
                            <tr>
                                <td>{{$data->product_title}}</td>
                                <td>{{$data->product_price}}</td>
                                <td>{{$data->product_quantity}}</td>
                                <td>
                                <button class="btn btn-success">
                                   <a href="productedit/{{$data->id}}">Edit</a>
                                </button>
                                <button class="btn btn-danger">
                                   <a href="productdelete/{{$data->id}}">Delete</a>
                                </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
