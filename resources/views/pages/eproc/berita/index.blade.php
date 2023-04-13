@extends('templates.eproc.pages')
@section('title')
@section('header')
<style>
  .modal-backdrop{
    display: none;
  }
</style>
<h1>Berita</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Berita</a></div>
</div>
@endsection
@section('content')
<h2 class="section-title">Keterangan</h2>
<p class="section-lead">
  Semisal sehabis menambahkan data menggunakan import excel jika gambar thumbnailnya tidak muncul dapat ditambahkan secara manual dengan cara edit data
</p>
<div class="row">
  <div class="col-12">
    
    @if(Session::get('success'))
      <div class="alert alert-primary">{{ Session::get('success') }}</div>
    @endif

    @if(Session::get('fail'))
      <div class="alert alert-danger">{{ Session::get('fail') }}</div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Berita</h4>
      </div>
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 1)
          <a href="{{ route('eproc.superadmin.berita.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          <a href="{{ route('eproc.superadmin.export-berita') }}" class="btn btn-success"><i class="fas fa-file-upload"></i></a>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-download"></i></button>
          <a href="{{ route('eproc.superadmin.cetak-pdf') }}" class="btn btn-danger"><i class="fas fa-file-alt"></i></a>
          @endif
          @if(auth()->user()->level == 2)
          <a href="{{ route('eproc.admin.berita.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          <a href="{{ route('eproc.admin.export-berita') }}" class="btn btn-success"><i class="fas fa-file-upload"></i></a>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-file-download"></i></button>
          <a href="{{ route('eproc.admin.cetak-pdf') }}" class="btn btn-danger"><i class="fas fa-file-alt"></i></a>
          @endif
        </div>
        <div class="float-right">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <div class="input-group-append">                                            
                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
  
        <div class="clearfix mb-3"></div>
  
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>No</th>
                <th>Judul Berita</th>
                <th>Tanggal Published</th>
                <th>Thumbnail</th>
                <th>Actoin</th>
              </tr>
              <?php $id = 0; ?>
              @foreach ($berita as $beritas)
                @if($beritas->status_aktif == 1)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $beritas->judul_berita }}</td>
                  <td>{{ $beritas->tanggal_published }}</td>
                  <td><img src="/eproc/thumbnail/{{ $beritas->thumbnail }}" alt="" width="100px"></td>
                  <td>
                    @if(auth()->user()->level == 1)
                      <form action="{{ route('eproc.superadmin.berita.destroy', $beritas->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.superadmin.berita.show', $beritas->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.superadmin.berita.edit', $beritas->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <button type="submit" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    @endif
                    @if(auth()->user()->level == 2)
                      <form action="{{ route('eproc.admin.berita.destroy', $beritas->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.admin.berita.show', $beritas->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.admin.berita.edit', $beritas->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <button type="submit" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    @endif
                  </td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(auth()->user()->level == 1)
        <form method="POST" action="{{ route('eproc.superadmin.import-berita') }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
        @if(auth()->user()->level == 2)
        <form method="POST" action="{{ route('eproc.admin.import-berita') }}" class="needs-validation" enctype="multipart/form-data" novalidate="">
        @endif
        @csrf
          <div class="form-group">
            <label for="">Berita</label>
            <input id="" type="file" class="form-control" name="excel" required tabindex="1">
          </div>
          <p>Untuk mengimport menggunakan excel untuk gambarnya bisa diupload dulu kedalam folder *thumbnail. Untuk penulisan data diexcelnya [1]judul_berita, [2]tanggal_published, [3]thumbnail(nama file nya), [4]isi_berita.</p>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection