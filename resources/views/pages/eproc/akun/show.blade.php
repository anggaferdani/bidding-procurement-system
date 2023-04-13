@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Keterangan Akun</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Keterangan Akun</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Keterangan Akun</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="" class="needs-validation" novalidate="">
          @csrf
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem voluptatibus ipsum dicta sint nesciunt excepturi magni magnam placeat veniam repudiandae explicabo quis enim debitis id, architecto mollitia officiis natus est.</p>
          <div class="form-group">
            <label for="">Nama Panjang</label>
            <input disabled id="" type="text" class="form-control" name="nama_panjang" value="{{ $akun->nama_panjang }}" tabindex="1">
            @error('nama_panjang')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input disabled id="" type="email" class="form-control" name="email" value="{{ $akun->email }}" tabindex="1">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <a href="{{ route('eproc.superadmin.akun.index') }}" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection