@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Keterangan Artikel</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Keterangan Artikel</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Keterangan Artikel</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Judul Artikel</label>
            <input disabled id="" type="text" class="form-control" name="judul_artikel" value="{{ $artikel->judul_artikel }}" tabindex="1">
            @error('judul_artikel')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Published</label>
            <input disabled id="" type="date" class="form-control" name="tanggal_published" value="{{ $artikel->tanggal_published }}" tabindex="1">
            @error('tanggal_published')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Thumbnail</label>
            <p><img src="/compro/thumbnail/{{ $artikel->thumbnail }}" class="mt-2" id="output" alt="" width="200px"></p>
          </div>
          <div class="form-group">
            <label for="">Isi Artikel</label>
            <textarea disabled class="form-control" name="isi_artikel" id="">{{ $artikel->isi_artikel }}</textarea>
            @error('isi_artikel')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('compro.superadmin.artikel.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('compro.admin.artikel.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 3)
            <a href="{{ route('compro.creator.artikel.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection