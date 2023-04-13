@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Profile</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Profile</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">

    @if(Session::get('success'))
      <div class="alert alert-primary">{{ Session::get('success') }}</div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Profile</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 1)
        <form method="POST" action="{{ route('eproc.superadmin.postprofile') }}" class="needs-validation" novalidate="">
        @endif
        @if(auth()->user()->level == 2)
        <form method="POST" action="{{ route('eproc.admin.postprofile') }}" class="needs-validation" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input id="" type="text" class="form-control" name="nama_panjang" value="{{ $user->nama_panjang }}" tabindex="1">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input id="" type="email" class="form-control" name="email" value="{{ $user->email }}" tabindex="1">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem voluptatibus ipsum dicta sint nesciunt excepturi magni magnam placeat veniam repudiandae explicabo quis enim debitis id, architecto mollitia officiis natus est.</p>
          <div class="form-group">
            <label for="">New Password</label>
            <input id="" type="text" class="form-control" name="password" tabindex="1">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('eproc.superadmin.dashboard') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('eproc.admin.dashboard') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection