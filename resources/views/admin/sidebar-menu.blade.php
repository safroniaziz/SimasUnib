@can('isAdmin')
  <li class="nav-item menu">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item menu">
    <a class="nav-link" data-toggle="collapse" href="#komponen-user" aria-expanded="false" aria-controls="komponen-user">
      <i class="menu-icon mdi mdi-email-open"></i>
      <span class="menu-title">Komponen Surat</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="komponen-user">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.kode_surat.index') }}"><i class="menu-icon mdi mdi-code-array"></i>&nbsp;Kode Surat</a>
        </li>
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.jenis_surat.index') }}"><i class="menu-icon mdi mdi-information-outline"></i>&nbsp;Jenis Surat</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item menu">
    <a class="nav-link" data-toggle="collapse" href="#surat-masuk" aria-expanded="false" aria-controls="surat-masuk">
      <i class="menu-icon fa fa-sign-in"></i>
      <span class="menu-title">Manajemen Surat Masuk</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="surat-masuk">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.surat_masuk_internal.index') }}"><i class="menu-icon mdi mdi-message-processing"></i>&nbsp;Surat Internal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.surat_masuk_eksternal.index') }}"><i class="menu-icon mdi mdi-message-reply"></i>&nbsp;Surat Eksternal</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item menu">
    <a class="nav-link" data-toggle="collapse" href="#surat-keluar" aria-expanded="false" aria-controls="surat-keluar">
      <i class="menu-icon fa fa-sign-out"></i>
      <span class="menu-title">Manajemen Surat Keluar</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="surat-keluar">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.surat_keluar_internal.index') }}"><i class="menu-icon mdi mdi-message-processing"></i>&nbsp;Surat Internal</a>
        </li>
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.surat_keluar_eksternal.index') }}"><i class="menu-icon mdi mdi-message-reply"></i>&nbsp;Surat Eksternal</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item menu">
    <a class="nav-link" data-toggle="collapse" href="#komponen-surat" aria-expanded="false" aria-controls="komponen-surat">
      <i class="menu-icon fa fa-users"></i>
      <span class="menu-title">Komponen User</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="komponen-surat">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.satuan_kerja.index') }}"><i class="menu-icon mdi mdi-account-multiple"></i>&nbsp;Satuan Kerja</a>
          <a class="nav-link" href="{{ route('admin.manajemen_jabatan.index') }}"><i class="menu-icon fa fa-tasks"></i>&nbsp;Jabatan User</a>
        </li>
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.manajemen_user.index') }}"><i class="menu-icon fa fa-users"></i>&nbsp;Data User</a>
        </li>
        <li class="nav-item menu">
          <a class="nav-link" href="{{ route('admin.pejabat_disposisi.index') }}"><i class="menu-icon mdi mdi-account-box-multiple"></i>&nbsp;Pejabat Disposisi</a>
        </li>
      </ul>
    </div>
  </li>
  
  <li class="nav-item menu">
    <a class="nav-link" href="{{ route('admin.manajemen_admin.index') }}">
      <i class="menu-icon fa fa-user"></i>
      <span class="menu-title">Manajemen Admin</span>
    </a>
  </li>

  <li class="nav-item menu">
    <a class="nav-link" href="{{ route('admin.manajemen_laporan') }}">
      <i class="menu-icon fa fa-bar-chart"></i>
      <span class="menu-title">Laporan Rekapitulasi Surat</span>
    </a>
  </li>

  <li class="nav-item menu">
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
        <i class="menu-icon fa fa-power-off text-danger"></i>
        <span class="menu-title">{{ __('Logout') }}</span>
    </a>

    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
  </li>
@endcan