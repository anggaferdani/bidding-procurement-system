@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Edit Berita</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Edit Berita</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Berita</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 1)
        <form method="POST" action="{{ route('eproc.superadmin.berita.update', $berita->id) }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
        @if(auth()->user()->level == 2)
        <form method="POST" action="{{ route('eproc.admin.berita.update', $berita->id) }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="">Judul Berita</label>
            <input id="" type="text" class="form-control" name="judul_berita" value="{{ $berita->judul_berita }}" tabindex="1">
            @error('judul_berita')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Tanggal Published</label>
            <input id="" type="date" class="form-control" name="tanggal_published" value="{{ $berita->tanggal_published }}" tabindex="1">
            @error('tanggal_published')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Thumbnail</label>
            <input type="file" class="form-control" name="thumbnail" onchange="file(event)" tabindex="1">
            @error('thumbnail')<div class="text-danger">{{ $message }}</div>@enderror
            <p><img src="/eproc/thumbnail/{{ $berita->thumbnail }}" class="mt-2" id="output" alt="" width="200px"></p>
          </div>
          <div class="form-group">
            <label for="">Isi Berita</label>
            <textarea class="form-control" name="isi_berita" id="">{{ $berita->isi_berita }}</textarea>
            @error('isi_berita')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('eproc.superadmin.berita.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('eproc.admin.berita.index') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var file = function(event){
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  }
</script>
@endsection