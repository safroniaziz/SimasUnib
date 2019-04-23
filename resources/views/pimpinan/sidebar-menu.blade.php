@can('isPimpinan')
  <li class="nav-item {{ set_active('pimpinan.dashboard') }}">
    <a class="nav-link" href="{{ route('pimpinan.dashboard') }}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item ">
      <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
        <i class="menu-icon mdi mdi-email-open"></i>
        <span class="menu-title">Data Surat Masuk</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="page-layouts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pimpinan.surat_masuk_internal.index') }}"><i class="menu-icon mdi mdi-message-processing"></i>&nbsp;Surat Masuk Internal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pimpinan.surat_masuk_eksternal.index') }}"><i class="menu-icon mdi mdi-message-reply"></i>&nbsp;Surat Masuk Eksternal</a>
          </li>
        </ul>
      </div>
    </li>
@endcan