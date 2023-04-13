@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Tambah Pengadaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Tambah Pengadaan</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Tambah Pengadaan</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 1)
        <form method="POST" action="{{ route('eproc.superadmin.pengadaan-yang-benar.store') }}" class="needs-validation" novalidate="">
        @endif
        @if(auth()->user()->level == 2)
        <form method="POST" action="{{ route('eproc.admin.pengadaan-yang-benar.store') }}" class="needs-validation" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama Pengadaan</label>
            <input id="" type="text" class="form-control" name="nama_pengadaan" tabindex="1">
            @error('nama_pengadaan')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Jenis Pengadaan</label>
            <select class="form-control" name="jenis_pengadaan">
              <option disabled selected>Pilih</option>
              <option value="Gedung">Gedung</option>
              <option value="Sarana Prasarana">Sarana Prasarana</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">HPS</label>
            <input id="" type="text" class="form-control" name="hps" tabindex="1">
            @error('hps')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Mulai Pengadaan</label>
            <input id="" type="date" class="form-control" name="tanggal_mulai_pengadaan" tabindex="1">
            @error('tanggal_mulai_pengadaan')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Akhir Pengadaan</label>
            <input id="" type="date" class="form-control" name="tanggal_akhir_pengadaan" tabindex="1">
            @error('tanggal_akhir_pengadaan')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('eproc.superadmin.pengadaan-yang-benar.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('eproc.admin.pengadaan-yang-benar.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection