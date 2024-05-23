 <div class="header header-one">
     <a href="{{ route('home') }}"
         class="d-inline-flex d-sm-inline-flex align-items-center d-md-inline-flex d-lg-none align-items-center device-logo">
         <img src="{{ asset(Storage::url('logos/' . Session::get('logo'))) }}" class="img-fluid logo2" alt="Logo"
             width="55%">
     </a>
     <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none">
         <div class="logo-white">
             <a href="{{ route('home') }}">
                 <img src="{{ asset(Storage::url('logos/' . Session::get('company_icon'))) }}"
                     class="img-fluid logo-blue" alt="Logo">
             </a>
             <a href="{{ route('home') }}">
                 <img src="{{ asset(Storage::url('logos/' . Session::get('company_icon'))) }}"
                     class="img-fluid logo-small" alt="Logo">
             </a>
         </div>
         <div class="logo-color">
             <a href="{{ route('home') }}">
                 <img src="{{ asset(Storage::url('logos/' . Session::get('logo'))) }}" class="img-fluid logo-blue"
                     alt="Logo" width="90%">
             </a>
             <a href="{{ route('home') }}">
                 <img src="{{ asset(Storage::url('logos/' . Session::get('favicon'))) }}" class="img-fluid logo-small"
                     alt="Logo" width="90%">
             </a>
         </div>
     </div>

     <a href="javascript:void(0);" id="toggle_btn">
         <span class="toggle-bars">
             <span class="bar-icons"></span>
             <span class="bar-icons"></span>
             <span class="bar-icons"></span>
             <span class="bar-icons"></span>
         </span>
     </a>

     <a class="mobile_btn" id="mobile_btn">
         <i class="fas fa-bars"></i>
     </a>
     @if (@request()->routeIs('dashboard'))
         <button id="iniciarIntroBtn" class="btn btn-primary mt-2">@lang('Mostrar Recorrido')</button>
     @endif
     <ul class="nav nav-tabs user-menu">
         <li class="nav-item dropdown has-arrow flag-nav">
             @php
                 $condicion = env('APP_LOCALE') == 'us' ? 'us.png' : 'es.png';
                 //  dd(env('APP_LOCALE'));
             @endphp
             <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                 <img src="{{ asset('assets/img/flags/' . $condicion) }}" width='20%' alt="flag">
                 <span>
                     {{ env('APP_LOCALE') == 'us' ? 'English' : 'Español' }}
                 </span>
             </a>
             <div class="dropdown-menu dropdown-menu-end">
                 <a href="{{ route('set_language', ['en']) }}" class="dropdown-item" onclick=" loading_show();">
                     <img src="{{ asset('assets/img/flags/us.png') }}" width='20%'
                         alt="flag"><span>English</span>
                 </a>
                 <a href="{{ route('set_language', ['es']) }}" class="dropdown-item" onclick=" loading_show();">
                     <img src="{{ asset('assets/img/flags/es.png') }}" width='20%'
                         alt="flag"><span>Spanish</span>
                 </a>
             </div>
         </li>
         <li class="nav-item  has-arrow dropdown-heads ">
             <a href="javascript:void(0);" class="win-maximize">
                 <i class="fe fe-maximize"></i>
             </a>
         </li>
         <li class="nav-item dropdown">
             @php
                 $avatar = isset(auth()->user()->avatar)
                     ? asset(Storage::url('avatar/' . auth()->user()->avatar))
                     : asset('assets/img/avatar.png');
             @endphp
             <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                 <span class="user-img">
                     <img src="{{ $avatar }}" alt="img" class="profilesidebar">
                     <span class="animate-circle"></span>
                 </span>
                 <span class="user-content">
                     <span class="user-details">{{ auth()->user()->name }}</span>
                     <span class="user-name">{{ auth()->user()->rol->role->name }}</span>
                 </span>
             </a>
             <div class="dropdown-menu menu-drop-user">
                 <div class="profilemenu">
                     <div class="subscription-menu">
                         <ul>
                             @can('profile.edit')
                                 <li>
                                     <a class="dropdown-item" href="{{ route('profile.edit') }}"
                                         onclick=" loading_show();">@lang('Profile')</a>
                                 </li>
                             @endcan
                             @can('settings')
                                 <li>
                                     <a class="dropdown-item" href="{{ route('settings') }}"
                                         onclick=" loading_show();">@lang('Settings')</a>
                                 </li>
                             @endcan
                         </ul>
                     </div>
                     <div class="subscription-logout">
                         <ul>
                             <li class="pb-0">
                                 <a class="dropdown-item"
                                     href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                     <i class="ti-layout-sidebar-left"></i>
                                     @lang('Logout')
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                     style="display: none;">
                                     @csrf
                                 </form>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </li>
     </ul>
 </div>
