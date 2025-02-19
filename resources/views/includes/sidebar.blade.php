<ul class="list-unstyled accordion-menu">
    <li class="sidebar-title">
      Main
    </li>
    <li class="{{ request()->is('dashboard') ? 'active-page' : '' }}">
      <a href="{{route('dashboard.index')}}"><i data-feather="home"></i>Dashboard</a>
    </li>
    <li class="sidebar-title">
      Apps
    </li>
    <li class="{{ request()->is('location') ? 'active-page' : '' }}">
        <a href="{{route('location.index')}}"><i data-feather="map-pin"></i>Location</a>
    </li>
    <li class="{{ request()->is('inventory') ? 'active-page' : '' }}">
        <a href="{{route('inventory.index')}}"><i data-feather="archive"></i>Inventory</a>
    </li>
    <li class="{{ request()->is('coach') ? 'active-page' : '' }}">
        <a href="{{route('coach.index')}}"><i data-feather="user"></i>Coach</a>
    </li>
    <li class="{{ request()->is('mastercoach') ? 'active-page' : '' }}">
        <a href="{{route('mastercoach.index')}}"><i data-feather="user-plus"></i>Master Coach</a>
    </li>
    <li class="{{ request()->is('student') ? 'active-page' : '' }}">
        <a href="{{route('student.index')}}"><i data-feather="users"></i>Student</a>
    </li>
    <li class="{{ request()->is('schedule') ? 'active-page' : '' }}">
        <a href="{{route('schedule.index')}}"><i data-feather="calendar"></i>Schedule</a>
    </li>
    <li class="{{ request()->is('assesment-aspect') ? 'active-page' : '' }}">
        <a href="{{route('assesment-aspect.index')}}"><i data-feather="file"></i>Assesment Aspects</a>
    </li>
    <li class="{{ request()->is('assesment-category') ? 'active-page' : '' }}">
        <a href="{{route('assesment-category.index')}}"><i data-feather="file-text"></i>Assesment Category</a>
    </li>
    <li class="{{ request()->is('assesment-report') ? 'active-page' : '' }}">
        <a href="{{route('assesment-report.index')}}"><i data-feather="clipboard"></i>Assesment Reports</a>
    </li>
    <li class="{{ request()->is('admin') ? 'active-page' : '' }}">
        <a href="{{route('admin.index')}}"><i data-feather="user-minus"></i>Admin</a>
    </li>
  </ul>
