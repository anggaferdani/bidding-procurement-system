@extends('templates.eproc.pages')
@section('title')
@section('header')
<h1>Detail Pengadaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Detail Pengadaan</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Detail Pengadaan</h4>
      </div>
      <div class="card-body">
        <div class="profile-widget-name">Nama Barang :</div>
        <p>{{ $pengadaan->barang_id }}</p>
        @if(auth()->user()->level == 'perusahaan')
        <form method="POST" action="{{ route('eproc.perusahaan.bid', ['id' => $pengadaan->id]) }}" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group">
            <input hidden id="" type="text" class="form-control" name="barang_id" value="{{ $pengadaan->barang_id }}" tabindex="1">
          </div>
          <div class="form-group">
            <label for="">Mau Ngebid Berapa?</label>
            <input id="" type="text" class="form-control" name="price_quotation" tabindex="1">
            @error('price_quotation')<div class="text-danger">{{ $message }}</div>@enderror
          </div>
          @if(auth()->user()->level == 1)
            <a href="{{ route('eproc.superadmin.pengadaan') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('eproc.admin.pengadaan') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 'perusahaan')
            <a href="{{ route('eproc.perusahaan.dashboard') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>History Pengadaan</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <tbody>
              <tr>
                <th>No</th>
                <th>Nama Panjang</th>
                <th>Price Quotation</th>
                <th>Waktu</th>
              </tr>
              @foreach ($history_pengadaan as $id => $history_pengadaans)
                @if($history_pengadaans->status_aktif == 1)
                <tr>
                  <td>{{ $id+1 }}</td>
                  <td>{{ $history_pengadaans->user_id }}</td>
                  <td>{{ 'Rp. '.strrev(implode('.',str_split(strrev(strval($history_pengadaans->price_quotation)),3))) }}</td>
                  <td>{{ $history_pengadaans->created_at }}</td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection