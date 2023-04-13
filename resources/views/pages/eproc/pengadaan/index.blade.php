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
                <th>Nama Pengadaan</th>
                <th>HPS</th>
                <th>Tanggal Akhir Pengadaan</th>
                <th>Action</th>
              </tr>
              @foreach ($pengadaan as $id => $pengadaans)
                @if($pengadaans->status_aktif == 1)
                <tr>
                  <td>{{ $id+1 }}</td>
                  <td>{{ $pengadaans->barangs->nama_barang }}</td>
                  <td>{{ 'Rp. '.strrev(implode('.',str_split(strrev(strval($pengadaans->barangs->hps)),3))) }}</td>
                  <td>{{ $pengadaans->barangs->tanggal_akhir_pengadaan }}</td>
                  <td>
                    @if(auth()->user()->level == 1)
                    <a href="{{ route('eproc.superadmin.detail-pengadaan', ['id' => $pengadaans->id]) }}">Lihat</a>
                    @endif
                    @if(auth()->user()->level == 2)
                    <a href="{{ route('eproc.admin.detail-pengadaan', ['id' => $pengadaans->id]) }}">Lihat</a>
                    @endif
                    @if(auth()->user()->level == 'perusahaan')
                    <a href="{{ route('eproc.perusahaan.detail-pengadaan', ['id' => $pengadaans->id]) }}">Lihat</a>
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