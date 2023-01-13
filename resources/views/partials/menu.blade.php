<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <style>
        .verzija{
            font-size: 10px;
            color: #fff;
            position: absolute;
            top: 0;
            right: 0;
            padding: 5px;
        }
    </style>
    <a href="#" class="brand-link">
        <span class="verzija">v{{ config('app.version') }}</span>
        <img src="{{asset('images/logonobg.png')}}" class="w-25" alt="">
        <span class="brand-text font-weight-bold">{{ trans('panel.site_title') }}</span>
    </a>
    <style>
        .bg-menu-open{
            background: #4a9084 !important;
            color: white;
        }
        .bg-menu-open p{
            color: white;
        }
.bg-menu-open i{
            color: white;
        }
        .bg-menu-open .active p{
            color: #7f7f7f !important;
        }
        .bg-menu-open .active i{
            color: #7f7f7f!important;
        }
    </style>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav bg-menu-open nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('drug_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.drugs.index") }}" class="nav-link {{ request()->is("admin/drugs") || request()->is("admin/drugs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-pills">

                            </i>
                            <p>
                                {{ trans('cruds.drug.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('patient_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/doctor-patients*") ? "menu-open" : "" }} {{ request()->is("admin/reports*") ? "menu-open" : "" }} {{ request()->is("admin/medications*") ? "menu-open" : "" }} {{ request()->is("admin/tests*") ? "menu-open" : "" }} {{ request()->is("admin/appointments*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/doctor-patients*") ? "active" : "" }} {{ request()->is("admin/reports*") ? "active" : "" }} {{ request()->is("admin/medications*") ? "active" : "" }} {{ request()->is("admin/tests*") ? "active" : "" }} {{ request()->is("admin/appointments*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-h-square">

                            </i>
                            <p>
                                {{ trans('cruds.patientManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav bg-menu-open nav-treeview">
                            @can('doctor_patient_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.doctor-patients.index") }}" class="nav-link {{ request()->is("admin/doctor-patients") || request()->is("admin/doctor-patients/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-md">

                                        </i>
                                        <p>
                                            {{ trans('cruds.doctorPatient.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.reports.index") }}" class="nav-link {{ request()->is("admin/reports") || request()->is("admin/reports/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.report.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('medication_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.medications.index") }}" class="nav-link {{ request()->is("admin/medications") || request()->is("admin/medications/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-capsules">

                                        </i>
                                        <p>
                                            {{ trans('cruds.medication.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tests.index") }}" class="nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-search">

                                        </i>
                                        <p>
                                            {{ trans('cruds.test.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('appointment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-phone">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('doctor_field_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.doctor-fields.index") }}" class="nav-link {{ request()->is("admin/doctor-fields") || request()->is("admin/doctor-fields/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-clone">

                            </i>
                            <p>
                                {{ trans('cruds.doctorField.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
