@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Pengadaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
</div>
@endsection
@section('content')
<h2 class="section-title">Keterangan</h2>
<p class="section-lead">
  Label merah menandakan Admin, Label biru berarti menandakan Creator sedangkan untuk label berwarna kuning menandakan Helpdesk
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
        <h4>Pengadaan</h4>
      </div>
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 1)
          <a href="{{ route('eproc.superadmin.barang.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          @endif
          @if(auth()->user()->level == 2)
          <a href="{{ route('eproc.admin.barang.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                <th>Nama Panjang</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
              @foreach ($barang as $id => $barangs)
                @if($barangs->status_aktif == 1)
                <tr>
                  <td>{{ $id+1 }}</td>
                  <td>{{ $barangs->nama_barang }}</td>
                  <td>{{ $barangs->jenis_barang }}</td>
                  <td>{{ $barangs->hps }}</td>
                  <td>
                    @if(auth()->user()->level == 1)
                      <form action="{{ route('eproc.superadmin.barang.destroy', $barangs->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.superadmin.barang.show', $barangs->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.superadmin.barang.edit', $barangs->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <button type="submit" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    @endif
                    @if(auth()->user()->level == 2)
                      <form action="{{ route('eproc.admin.barang.destroy', $barangs->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.admin.barang.show', $barangs->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.admin.barang.edit', $barangs->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
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
@endsection