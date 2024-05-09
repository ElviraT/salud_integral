<div class="sidebar second" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">

                <li class="menu-title"><span>Inicio</span></li>
                <li>
                    <a class="{{ @request()->routeIs('dashboard') ? 'active' : ' ' }}" href="{{ route('dashboard') }}"><i
                            class="fe fe-home"></i> <span>
                            @lang('Dashboard')</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-grid"></i> <span> @lang('Applications')</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('chatify') }}"
                                class="nav-link {{ @request()->routeIs('chatify') ? 'active' : ' ' }}">@lang('Chat')</a>
                        </li>
                        <li><a href="{{ route('tickets', '5') }}"
                                class="nav-link {{ @request()->routeIs('tickets') ? 'active' : ' ' }}">@lang('Ticket')</a>
                        </li>
                        {{-- <li><a href="calendar.html" class>Calendar</a></li>
                        <li><a href="inbox.html" class>Email</a></li> --}}
                    </ul>
                </li>

                <li class="menu-title"><span>@lang('User Management')</span></li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-users"></i> <span> @lang('users')</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li>
                            <a class="{{ @request()->routeIs('users') ? 'active' : ' ' }}" href="{{ route('users') }}">
                                @lang('Users')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('medicals') }}"
                                class="nav-link {{ @request()->routeIs('medicals') ? 'active' : ' ' }}">
                                @lang('Medical')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('patients') }}"
                                class="nav-link {{ @request()->routeIs('patients') || @request()->routeIs('patients.family') ? 'active' : ' ' }}">
                                @lang('Patients')
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="{{ @request()->routeIs('permissions') ? 'active' : ' ' }}"
                        href="{{ route('permissions') }}"><i class="fe fe-lock"></i> <span>
                            @lang('Roles & Permission')</span>
                    </a>
                </li>
                <li class="menu-title"><span>@lang('Medical Management')</span></li>
                <li>
                    <a class="{{ @request()->routeIs('consultings') ? 'active' : ' ' }}"
                        href="{{ route('consultings') }}"><i class="fe fe-clipboard"></i> <span>
                            @lang('Consulting Room')</span>
                    </a>
                </li>
                <li class="menu-title"><span>@lang('Settings')</span></li>
                <li>
                    <a class="{{ @request()->routeIs('settings') ? 'active' : ' ' }}"
                        href="{{ route('settings') }}"><i class="fe fe-settings"></i>
                        <span>@lang('Setting')</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
