@can('isPimpinan')
<ul class="sidebar-menu" data-widget="tree">
  <li class="header bg-red" style="color:white;text-align:center;letter-spacing:2px;font-size:14px;">MENU UTAMA</li>
  <li class="{{ set_active('pimpinan.dashboard') }}">
    <a href="{{ route('pimpinan.dashboard') }}">
      <i class="fa fa-television"></i> <span>Dashboard</span>
    </a>
  </li>
  <li class="{{ set_active('pimpinan.surat_masuk.index') }}">
    <a href="{{ route('pimpinan.surat_masuk.index') }}">
      <i class="fa fa-envelope-o"></i> <span>Data Surat Masuk</span>
    </a>
  </li>
</ul>
@endcan