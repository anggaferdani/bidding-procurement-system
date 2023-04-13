@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Survey</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Survey</a></div>
</div>
@endsection
@section('content')
<h2 class="section-title">Keterangan</h2>
<p class="section-lead">
  debitis aspernatur ad. Accusamus velit odio minima in aliquid voluptates. Saepe autem perferendis nulla vero distinctio ad omnis laboriosam beatae molestias maiores, in cum molestiae repellendus nostrum cumque quia magni eos.
</p>
<div class="row">
  <div class="col-12">
    
    <div class="card">
      <div class="card-header">
        <h4>Survey</h4>
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
                <th>Nama Panjang</th>
                <th>Email</th>
                <th>Perusahaan</th>
                <th>Actoin</th>
              </tr>
              <?php $id = 0; ?>
              @foreach ($survey as $surveys)
              <?php $id++; ?>
              <tr>
                <td>{{ $id }}</td>
                <td>{{ $surveys->nama_panjang }}</td>
                <td>{{ $surveys->email }}</td>
                <td>{{ $surveys->nama_perusahaan }}</td>
                <td>
                  @if(auth()->user()->level == 1)
                    <a href="{{ route('compro.superadmin.survey.show', $surveys->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                  @endif
                  @if(auth()->user()->level == 2)
                    <a href="{{ route('compro.admin.survey.show', $surveys->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                  @endif
                  @if(auth()->user()->level == 4)
                    <a href="{{ route('compro.helpdesk.survey.show', $surveys->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-info-circle"></i></a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection