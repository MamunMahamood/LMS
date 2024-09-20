<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LMS</span>
    </a>

    @php
    if($user_common) {
        if($user_common->tphoto) {
            $photo = $user_common->tphoto;
        }
        elseif($user_common->sphoto) {
            $photo = $user_common->sphoto;
        }
        elseif($user_common->aphoto) {
            $photo = $user_common->aphoto;
        }
        else {
            // Set default photo using the asset function
            $photo = asset('assets/img/dphoto.png');
        }
    } else {
        // If $user_common is null, set the default photo
        $photo = asset('assets/img/dphoto.png');
    }

    $user = Auth::user();

    @endphp

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{$photo}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>




        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                @if ($user->role === App\UserRole::Teacher->value)
   
                <li class="nav-item {{ request()->routeIs('profile.edit') || request()->routeIs('teacher-profile') || request()->routeIs('teacher.dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('profile.edit') || request()->routeIs('teacher-profile') || request()->routeIs('teacher.dashboard')? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        @if($teacher != null)
                        <li class="nav-item">
                            <a href="{{ route('teacher-profile', ['id' => $teacher->id]) }}" class="nav-link {{ request()->routeIs('teacher-profile') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teacher Profile</p>
                            </a>
                        </li>

                        @else
                        <li class="nav-item">
                            <a href="{{ route('teacher-create')}}" class="nav-link {{ request()->routeIs('teacher-profile') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teacher Profile</p>
                            </a>
                        </li>

                        @endif

                    </ul>
                </li>

                <!-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->

                @elseif ($user->role === App\UserRole::Student->value && $student != null)
                <li class="nav-item {{ request()->routeIs('profile.edit') || request()->routeIs('student-profile') || request()->routeIs('student.dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('profile.edit') || request()->routeIs('student-profile') || request()->routeIs('student.dashboard')? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student-profile', ['id' => $student->id]) }}" class="nav-link {{ request()->routeIs('student-profile') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teaching Profile</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <!-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->


                @elseif($user->role === App\UserRole::Admin->value && $admin != null)
                <li class="nav-item {{ request()->routeIs('profile.edit') || request()->routeIs('admin-profile') || request()->routeIs('admin.dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('profile.edit') || request()->routeIs('admin-profile') || request()->routeIs('admin.dashboard')? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-profile', ['id' => $admin->id]) }}" class="nav-link {{ request()->routeIs('admin-profile') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teaching Profile</p>
                            </a>
                        </li>

                    </ul>
                </li>


                @else


               



                <!-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->

                @endif

                <li class="nav-item {{ request()->routeIs('course-index') || request()->routeIs('course-create') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('course-index') || request()->routeIs('course-create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Courses Section
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('course-index') }}" class="nav-link {{ request()->routeIs('course-index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Provided Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('course-create') }}" class="nav-link {{ request()->routeIs('course-create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Course</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>