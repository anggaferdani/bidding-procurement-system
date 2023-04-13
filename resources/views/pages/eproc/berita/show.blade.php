@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Keterangan Berita</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Keterangan Berita</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Keterangan Berita</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="" class="needs-validation" enctype="multipart/form-data" novalidate="">
          @csrf
          <div class="form-group">
            <label for="">Judul Berita</label>
            <input disabled id="" type="text" class="form-control" name="judul_berita" value="{{ $berita->judul_berita }}" tabindex="1">
            @error('judul_berita')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Published</label>
            <input disabled id="" type="date" class="form-control" name="tanggal_published" value="{{ $berita->tanggal_published }}" tabindex="1">
            @error('tanggal_published')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Thumbnail</label>
            <p><img src="/eproc/thumbnail/{{ $berita->thumbnail }}" class="mt-2" id="output" alt="" width="200px"></p>
          </div>
          <div class="form-group">
            <label for="">Isi Berita</label>
            <textarea disabled class="form-control" name="isi_berita" id="">{{ $berita->isi_berita }}</textarea>
            @error('isi_berita')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('eproc.superadmin.berita.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('eproc.admin.berita.index') }}" class="btn btn-secondary">Back</a>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection