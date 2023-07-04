@extends('layouts.admin_app')

@section('content')
<form id="checkvalidation" action="checkvalidation" method="post">
    @csrf
    <div class="row">
          <div class="col-6 mt-2">
               <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
          </div>
          <div class="col-6 mt-2">
               <input type="text" placeholder="Email Body" class="form-control" name="data" id="data">
          </div>
          <div class="col-6 mt-2">
               <input type="email" class="form-control" placeholder="Email Send To" name="email" id="email">
          </div>
          <div class="col-6 mt-2">
               <input type="tel" class="form-control" placeholder="Mobile" name="mobile" id="mobile">
          </div>
          <div class="col-6 mt-2">
               <input type="submit" class="btn btn-primary" name="branch_save" id="branch_save">
          </div>
     </div>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
