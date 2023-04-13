@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Keterangan Survey</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Keterangan Survey</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Keterangan Survey</h4>
      </div>
      <div class="card-body">
        <div class="profile-widget-name">Nama Panjang :</div>
        <p>{{ $survey->nama_panjang }}</p>
        <div class="profile-widget-name">Email :</div>
        <p>{{ $survey->email }}</p>
        <div class="profile-widget-name">Perusahaan :</div>
        <p>{{ $survey->nama_perusahaan }}</p>
        <div class="profile-widget-name">Pesan :</div>
        <p>{{ $survey->pesan }}</p>
        @if(auth()->user()->level == 1)
          <a href="{{ route('compro.superadmin.survey') }}" class="btn btn-secondary">Back</a>
        @endif
        @if(auth()->user()->level == 2)
          <a href="{{ route('compro.admin.survey') }}" class="btn btn-secondary">Back</a>
        @endif
        @if(auth()->user()->level == 4)
          <a href="{{ route('compro.helpdesk.survey') }}" class="btn btn-secondary">Back</a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection