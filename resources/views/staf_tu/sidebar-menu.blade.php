@can('isStafTu')
<ul class="sidebar-menu" data-widget="tree">
  <li class="header bg-red" style="color:white;text-align:center;letter-spacing:2px;font-size:14px;">MENU UTAMA</li>
  <li class="{{ set_active('staf_tu.dashboard') }}">
    <a href="{{ route('staf_tu.dashboard') }}">
      <i class="fa fa-television"></i> <span>Dashboard</span>
    </a>
  </li>
  <li class="{{ set_active('staf_tu.surat_masuk.index') }}">
    <a href="{{ route('staf_tu.surat_masuk.index') }}">
      <i class="fa fa-envelope-o"></i> <span>Manajemen Surat Masuk</span>
    </a>
  </li>
  <li class="{{ set_active('staf_tu.panduan.index') }}">
    <a href="{{ route('staf_tu.panduan.index') }}">
      <i class="fa fa-file"></i> <span>Panduan</span>
    </a>
  </li>
</ul>
@endcan