@extends('templates.compro.pages')
@section('title')
@section('header')
<h1>Profile Perusahaan</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item active"><a href="#">Profile Perusahaan</a></div>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-12 col-md-12">
    @if(Session::get('success'))
      <div class="alert alert-primary">{{ Session::get('success') }}</div>
    @endif
    <div class="card profile-widget">
      <div class="profile-widget-header">
        <img alt="image" src="{{ asset('logo-saranawisesa.png') }}" class="profile-widget-picture">
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Posts</div>
            <div class="profile-widget-item-value">187</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Followers</div>
            <div class="profile-widget-item-value">68K</div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label">Following</div>
            <div class="profile-widget-item-value">2K</div>
          </div>
        </div>
      </div>
      @foreach ($profile_perusahaan as $profile_perusahaans)
      <div class="profile-widget-description card-body">
        <div class="profile-widget-name">PT SARANAWISESA PROPERINDO<div class="text-muted d-inline font-weight-normal"><div class="slash"></div>SWP</div></div>
        <p>{{ $profile_perusahaans->sejarah_perusahaan }}</p>
        <div class="profile-widget-name">Visi</div>
        <ul>
          @foreach(explode('#', $profile_perusahaans->visi) as $visi)
            <li>{{ $visi }}</li>
          @endforeach
        </ul>
        <div class="profile-widget-name">Misi</div>
        <ul>
          @foreach(explode('#', $profile_perusahaans->misi) as $misi)
            <li>{{ $misi }}</li>
          @endforeach
        </ul>
      </div>
      <div class="card-footer text-right">
        @if(auth()->user()->level == 1)
          <a href="{{ route('compro.superadmin.profile-perusahaan.edit', $profile_perusahaans->id) }}" class="btn btn-primary"><i class="fas fa-cog"></i></a>
        @endif
        @if(auth()->user()->level == 2)
          <a href="{{ route('compro.admin.profile-perusahaan.edit', $profile_perusahaans->id) }}" class="btn btn-primary"><i class="fas fa-cog"></i></a>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection