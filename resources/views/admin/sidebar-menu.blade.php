@can('isAdmin')
  <li class="nav-item {{ set_active('admin.dashboard') }}">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('admin.kode_surat.index') }}">
    <a class="nav-link" href="{{ route('admin.kode_surat.index') }}">
      <i class="menu-icon mdi mdi-code-tags"></i>
      <span class="menu-title">Manajemen Kode Surat</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('admin.surat_masuk.index') }}">
    <a class="nav-link" href="{{ route('admin.surat_masuk.index') }}">
      <i class="menu-icon mdi mdi-email"></i>
      <span class="menu-title">Manajemen Surat Masuk</span>
    </a>
  </li>
  <li class="nav-item treeview {{ set_active(['admin.surat_keluar.internal','admin.surat_keluar.eksternal']) }}">
    <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
      <i class="menu-icon mdi mdi-email-open"></i>
      <span class="menu-title">Manajemen Surat Keluar</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="page-layouts">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item {{ set_active('admin.surat_keluar.internal') }}">
          <a class="nav-link" href="{{ route('admin.surat_keluar.internal') }}"><i class="menu-icon mdi mdi-message-processing"></i>&nbsp;Surat Ke Internal</a>
        </li>
        <li class="nav-item {{ set_active('admin.surat_keluar.eksternal') }}">
          <a class="nav-link" href="{{ route('admin.surat_keluar.eksternal') }}"><i class="menu-icon mdi mdi-message-reply"></i>&nbsp;Surat Ke Eksternal</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item {{ set_active('admin.satuan_kerja.index') }}">
    <a class="nav-link" href="{{ route('admin.satuan_kerja.index') }}">
      <i class="menu-icon mdi mdi-account-multiple"></i>
      <span class="menu-title">Manajemen Satuan Kerja</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('admin.pejabat_disposisi.index') }}">
    <a class="nav-link" href="{{ route('admin.pejabat_disposisi.index') }}">
      <i class="menu-icon mdi mdi-account-box-outline"></i>
      <span class="menu-title">Manajemen Pejabat Disposisi</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('admin.manajemen_user.index') }}">
    <a class="nav-link" href="{{ route('admin.manajemen_user.index') }}">
      <i class="menu-icon fa fa-users"></i>
      <span class="menu-title">Manajemen User</span>
    </a>
  </li>
  <li class="nav-item {{ set_active('admin.manajemen_user.index') }}">
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
        <i class="menu-icon fa fa-power-off text-danger"></i>
        <span class="menu-title">{{ __('Logout') }}</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </li>
@endcan