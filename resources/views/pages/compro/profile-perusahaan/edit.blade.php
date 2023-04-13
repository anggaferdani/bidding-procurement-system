@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Edit Profile Perusahaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Edit Profile Perusahaan</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12 col-md-12">
    <div class="card">
      @if(auth()->user()->level == 1)
      <form method="POST" action="{{ route('compro.superadmin.profile-perusahaan.update', $profile_perusahaan->id) }}" class="needs-validation">
      @endif
      @if(auth()->user()->level == 2)
      <form method="POST" action="{{ route('compro.admin.profile-perusahaan.update', $profile_perusahaan->id) }}" class="needs-validation">
      @endif
        @csrf
        @method('PUT')
        <div class="card-header">
          <h4>Edit Profile Perusahaan</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
              <label for="">Sejarah Perusahaan</label>
              <textarea class="form-control" name="sejarah_perusahaan" id="">{{ $profile_perusahaan->sejarah_perusahaan }}</textarea>
              @error('sejarah_perusahaan')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <code>Untuk penulisan setiap visi diakhiri dengan (#). Contoh : visi pertama# visi kedua# visi ketiga# visi keempat.</code>
            <div class="form-group">
              <label for="">Visi</label>
              <textarea class="form-control" name="visi" id="">{{ $profile_perusahaan->visi }}</textarea>
              @error('visi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <code>Untuk penulisan setiap misi diakhiri dengan (#). Contoh : misi pertama# misi kedua# misi ketiga# misi keempat.</code>
            <div class="form-group">
              <label for="">Misi</label>
              <textarea class="form-control" name="misi" id="">{{ $profile_perusahaan->misi }}</textarea>
              @error('misi')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="card-footer">
          @if(auth()->user()->level == 1)
            <a href="{{ route('compro.superadmin.profile-perusahaan') }}" class="btn btn-secondary">Back</a>
          @endif
          @if(auth()->user()->level == 2)
            <a href="{{ route('compro.admin.profile-perusahaan') }}" class="btn btn-secondary">Back</a>
          @endif
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection