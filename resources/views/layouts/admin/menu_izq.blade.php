<div class="sidebar second" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">

                <li class="menu-title"><span>Inicio</span></li>
                <li>
                    <a class="{{ @request()->routeIs('dashboard') ? 'active' : ' ' }}" href="{{ route('dashboard') }}"
                        onclick=" loading_show();"><i class="fe fe-home"></i> <span>
                            @lang('Dashboard')</span></a>
                </li>
                @canany(['chatify', 'tickets'])
                    <li class="submenu">
                        <a href="#"><i class="fe fe-grid"></i> <span> @lang('Applications')</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            @can('chatify')
                                <li><a href="{{ route('chatify') }}"
                                        class="nav-link {{ @request()->routeIs('chatify') ? 'active' : ' ' }}"
                                        onclick=" loading_show();">@lang('Chat')</a>
                                </li>
                            @endcan
                            @can('tickets')
                                <li><a href="{{ route('tickets', '5') }}"
                                        class="nav-link {{ @request()->routeIs('tickets') || @request()->routeIs('tickets.edit') ? 'active' : ' ' }}"
                                        onclick=" loading_show();">@lang('Ticket')</a>
                                </li>
                            @endcan
                            {{-- <li><a href="calendar.html" class>Calendar</a></li>
                        <li><a href="inbox.html" class>Email</a></li> --}}
                        </ul>
                    </li>
                @endcanany
                @canany(['users', 'medicals', 'patients', 'permissions'])
                    <li class="menu-title"><span>@lang('User Management')</span></li>
                    @canany(['users', 'medicals', 'patients'])
                        <li class="submenu">
                            <a href="#"><i class="fe fe-users"></i> <span> @lang('users')</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                @can('users')
                                    <li>
                                        <a class="{{ @request()->routeIs('users') ? 'active' : ' ' }}" href="{{ route('users') }}"
                                            onclick=" loading_show();">
                                            @lang('Users')
                                        </a>
                                    </li>
                                @endcan
                                @can('medicals')
                                    <li>
                                        <a href="{{ route('medicals') }}"
                                            class="nav-link {{ @request()->routeIs('medicals') || @request()->routeIs('schedules') ? 'active' : ' ' }}"
                                            onclick=" loading_show();">
                                            @lang('Medical')
                                        </a>
                                    </li>
                                @endcan
                                @can('patients')
                                    <li>
                                        <a href="{{ route('patients') }}"
                                            class="nav-link {{ @request()->routeIs('patients') || @request()->routeIs('patients.family') ? 'active' : ' ' }}"
                                            onclick=" loading_show();">
                                            @lang('Patients')
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                    @can('permissions')
                        <li>
                            <a class="{{ @request()->routeIs('permissions') ? 'active' : ' ' }}"
                                href="{{ route('permissions') }}" onclick=" loading_show();"><i class="fe fe-lock"></i> <span>
                                    @lang('Roles & Permission')</span>
                            </a>
                        </li>
                    @endcan
                @endcanany
                @canany(['consultings', 'services'])
                    <li class="menu-title"><span>@lang('Medical Management')</span></li>
                    @can('consultings')
                        <li>
                            <a class="{{ @request()->routeIs('consultings') ? 'active' : ' ' }}"
                                href="{{ route('consultings') }}" onclick=" loading_show();"><i class="fe fe-clipboard"></i>
                                <span>
                                    @lang('Consulting Room')</span>
                            </a>
                        </li>
                    @endcan
                    @can('services')
                        <li>
                            <a class="{{ @request()->routeIs('services') ? 'active' : ' ' }}" href="{{ route('services') }}"
                                onclick=" loading_show();"><i class="fe fe-heart"></i> <span>
                                    @lang('Services')</span>
                            </a>
                        </li>
                    @endcan
                @endcanany
                @canany(['citas'])
                    <li class="menu-title"><span>@lang('Consultas')</span></li>
                    @can('citas')
                        <li>
                            <a class="{{ @request()->routeIs('citas') ? 'active' : ' ' }}" href="{{ route('citas') }}"
                                onclick=" loading_show();"><i class="fe fe-book"></i> <span>
                                    @lang('Cita')</span>
                            </a>
                        </li>
                    @endcan
                @endcanany
                @can('settings')
                    <li class="menu-title"><span>@lang('Settings')</span></li>
                    <li>
                        <a class="{{ @request()->routeIs('settings') ? 'active' : ' ' }}" href="{{ route('settings') }}"
                            onclick=" loading_show();"><i class="fe fe-settings"></i>
                            <span>@lang('Setting')</span></a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
