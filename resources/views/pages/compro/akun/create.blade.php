@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Tambah Akun</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Tambah Akun</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Tambah Akun</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('compro.superadmin.akun.store') }}" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input id="" type="text" class="form-control" name="nama_panjang" tabindex="1">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem voluptatibus ipsum dicta sint nesciunt excepturi magni magnam placeat veniam repudiandae explicabo quis enim debitis id, architecto mollitia officiis natus est.</p>
          <div class="form-group">
            <label class="form-label">Level</label>
            <div class="selectgroup selectgroup-pills">
              <label class="selectgroup-item">
                <input type="radio" name="level" value="2" class="selectgroup-input" checked>
                <span class="selectgroup-button">Admin</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="level" value="3" class="selectgroup-input">
                <span class="selectgroup-button">Creator</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="level" value="4" class="selectgroup-input">
                <span class="selectgroup-button">Helpdesk</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input id="" type="email" class="form-control" name="email" tabindex="1">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input id="" type="text" class="form-control" name="password" tabindex="1">
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <a href="{{ route('compro.superadmin.akun.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection