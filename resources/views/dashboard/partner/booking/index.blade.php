@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Bookings</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  @if (session('success'))
    <div class="col-md-12">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Whooilah!</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  <div class="col-md-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Customer Name</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th style="width: 100px">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>1</th>
          <td>Micah</td>
          <td>10 am</td>
          <td>11 am</td>
          <td>
            <button class="btn btn-success">Confirm</button>
            <button class="btn btn-danger">Cancel</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection