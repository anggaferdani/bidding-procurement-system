@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Akun</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Akun</a></div>
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
        <h4>Akun</h4>
      </div>
      <div class="card-body">
        <div class="float-left">
          <a href="{{ route('eproc.superadmin.akun.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
              <?php $id = 0; ?>
              @foreach ($akun as $akuns)
                @if($akuns->status_aktif == 1)
                  @if($akuns->level == 2)
                  <?php $id++; ?>
                  <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $akuns->nama_panjang }}</td>
                    <td>{{ $akuns->email }}</td>
                    <td>
                      @if($akuns->level == 2)
                        <div class="badge badge-danger">Admin</div>
                      @endif
                    </td>
                    <td>
                      <form action="{{ route('eproc.superadmin.akun.destroy', $akuns->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('eproc.superadmin.akun.show', $akuns->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                        <a href="{{ route('eproc.superadmin.akun.edit', $akuns->id) }}" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <button type="submit" class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endif
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