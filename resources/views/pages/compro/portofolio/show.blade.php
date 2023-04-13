@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Keterangan Portofolio</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Keterangan Portofolio</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Keterangan Portofolio</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Judul Portofolio</label>
            <input disabled id="" type="text" class="form-control" name="judul_portofolio" value="{{ $portofolio->judul_portofolio }}" tabindex="1">
            @error('judul_portofolio')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Portofolio</label>
            <p><img src="/compro/portofolio/{{ $portofolio->portofolio }}" alt="" width="200px"></p>
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('compro.superadmin.portofolio.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('compro.admin.portofolio.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection