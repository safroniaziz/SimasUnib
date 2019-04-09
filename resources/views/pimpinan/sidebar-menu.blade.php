@can('isPimpinan')
  <li class="nav-item {{ set_active('pimpinan.dashboard') }}">
    <a class="nav-link" href="{{ route('pimpinan.dashboard') }}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('pimpinan.surat_masuk.index') }}">
    <a class="nav-link" href="{{ route('pimpinan.surat_masuk.index') }}">
      <i class="menu-icon mdi mdi-email icon-md"></i>
      <span class="menu-title">Manajemen Surat Masuk</span>
    </a>
  </li>
@endcan