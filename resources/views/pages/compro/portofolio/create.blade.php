@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Tambah Portofolio</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Tambah Portofolio</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Tambah Portofolio</h4>
      </div>
      <div class="card-body">
        @if(auth()->user()->level == 1)
        <form method="POST" action="{{ route('compro.superadmin.portofolio.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
        @if(auth()->user()->level == 2)
        <form method="POST" action="{{ route('compro.admin.portofolio.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
          @csrf
          <div class="form-group">
            <label for="">Judul Portofolio</label>
            <input id="" type="text" class="form-control" name="judul_portofolio" tabindex="1">
            @error('judul_portofolio')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label for="">Portofolio</label>
            <input type="file" class="form-control" name="portofolio" onchange="file(event)" tabindex="1">
            @error('portofolio')<div class="text-danger">{{ $message }}</div>@enderror
            <p><img src="" class="mt-2" id="output" alt="" width="200px"></p>
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('compro.superadmin.portofolio.index') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('compro.admin.portofolio.index') }}" class="btn btn-secondary">Back</a>
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