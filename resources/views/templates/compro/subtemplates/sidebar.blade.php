<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="{{ asset('logo-saranawisesa.png') }}" width="50px" alt="">
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <img src="{{ asset('logo-saranawisesa.png') }}" width="30px" alt="">
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      @if(auth()->user()->level == 1)
        <li class=active><a class="nav-link" href="{{ route('compro.superadmin.dashboard') }}"><i class="far fa-square"></i><span>Dashboard</span></a></li>
        <li class="menu-header">Menu</li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.akun.index') }}"><i class="far fa-square"></i><span>Akun</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.profile-perusahaan') }}"><i class="far fa-square"></i><span>Profile Perusahaan</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.portofolio.index') }}"><i class="far fa-square"></i><span>Portofolio</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.artikel.index') }}"><i class="far fa-square"></i><span>Artikel</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.jajaran-direksi.index') }}"><i class="far fa-square"></i><span>Jajaran Direksi</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.jajaran-komisaris.index') }}"><i class="far fa-square"></i><span>Jajaran Komisaris</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.superadmin.survey') }}"><i class="far fa-square"></i><span>Survey</span></a></li>
      @endif
      @if(auth()->user()->level == 2)
        <li class=active><a class="nav-link" href="{{ route('compro.admin.dashboard') }}"><i class="far fa-square"></i><span>Dashboard</span></a></li>
        <li class="menu-header">Menu</li>
        <li><a class="nav-link" href="{{ route('compro.admin.profile-perusahaan') }}"><i class="far fa-square"></i><span>Profile Perusahaan</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.admin.portofolio.index') }}"><i class="far fa-square"></i><span>Portofolio</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.admin.artikel.index') }}"><i class="far fa-square"></i><span>Artikel</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.admin.jajaran-direksi.index') }}"><i class="far fa-square"></i><span>Jajaran Direksi</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.admin.jajaran-komisaris.index') }}"><i class="far fa-square"></i><span>Jajaran Komisaris</span></a></li>
        <li><a class="nav-link" href="{{ route('compro.admin.survey') }}"><i class="far fa-square"></i><span>Survey</span></a></li>
      @endif
      @if(auth()->user()->level == 3)
        <li class=active><a class="nav-link" href="{{ route('compro.creator.dashboard') }}"><i class="far fa-square"></i><span>Dashboard</span></a></li>
        <li class="menu-header">Menu</li>
        <li><a class="nav-link" href="{{ route('compro.creator.artikel.index') }}"><i class="far fa-square"></i><span>Artikel</span></a></li>
      @endif
      @if(auth()->user()->level == 4)
        <li class=active><a class="nav-link" href="{{ route('compro.helpdesk.dashboard') }}"><i class="far fa-square"></i><span>Dashboard</span></a></li>
        <li class="menu-header">Menu</li>
        <li><a class="nav-link" href="{{ route('compro.helpdesk.survey') }}"><i class="far fa-square"></i><span>Survey</span></a></li>
      @endif
    </ul>
  </aside>
</div>