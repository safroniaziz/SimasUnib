@can('isStafTu')
  <li class="nav-item menu">
    <a class="nav-link" href="{{ route('staf_tu.dashboard') }}">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item ">
    <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
      <i class="menu-icon mdi mdi-email-open"></i>
      <span class="menu-title">Manajemen Surat Masuk</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="page-layouts">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('staf_tu.surat_masuk_internal.index') }}"><i class="menu-icon mdi mdi-message-processing"></i>&nbsp;Surat Masuk Internal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('staf_tu.surat_masuk_eksternal.index') }}"><i class="menu-icon mdi mdi-message-reply"></i>&nbsp;Surat Masuk Eksternal</a>
        </li>
      </ul>
    </div>
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