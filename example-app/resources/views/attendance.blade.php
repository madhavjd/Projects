@extends('layouts.app')

@section('content')
<h2>Attendance<h2>
<form class="form" action="attendance" method="post">
  @csrf
  <div class="row mt-3">
    <div class="col-6">
    <input type="submit" class="btn btn-primary" value="present" name="status" id="present">
    </div>
    </div>
    @if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
</form>
@endsection
