@extends('layouts.admin_app')

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
                    <h2>Admin Dashboard</h2>
                    <p>User Loged-in is: {{Auth::user()->name}}</p>
                    <div class="row">
                        <a href="addnewprod">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
