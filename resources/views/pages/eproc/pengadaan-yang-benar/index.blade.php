@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Management Pengadaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Management Pengadaan</a></div>
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
        <h4>Management Pengadaan</h4>
      </div>
      <div class="card-body">
        <div class="float-left">
          @if(auth()->user()->level == 1)
          <a href="{{ route('eproc.superadmin.pengadaan-yang-benar.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
          @endif
          @if(auth()->user()->level == 2)
          <a href="{{ route('eproc.admin.pengadaan-yang-benar.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                <th>Nama Pengadaan</th>
                <th>Jenis Pengadaan</th>
                <th>HPS</th>
                <th>Actoin</th>
              </tr>
              <?php $id = 0; ?>
              @foreach ($pengadaan as $pengadaans)
                @if($pengadaans->status_aktif == 1)
                <?php $id++; ?>
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $pengadaans->nama_pengadaan }}</td>
                  <td>{{ $pengadaans->jenis_pengadaan }}</td>
                  <td>{{ 'Rp. '.strrev(implode('.',str_split(strrev(strval($pengadaans->hps)),3))) }}</td>
                  <td>
                    @if(auth()->user()->level == 1)
                      <form action="{{ route('eproc.superadmin.pengadaan-yang-benar.destroy', $pengadaans->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.superadmin.pengadaan-yang-benar.show', $pengadaans->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.superadmin.pengadaan-yang-benar.edit', $pengadaans->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <button type="submit" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    @endif
                    @if(auth()->user()->level == 2)
                      <form action="{{ route('eproc.admin.pengadaan-yang-benar.destroy', $pengadaans->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.admin.pengadaan-yang-benar.show', $pengadaans->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.admin.pengadaan-yang-benar.edit', $pengadaans->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
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