<div class="col-xl-3 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>@lang('Settings')</h5>
                </div>
            </div>

            <div class="widget settings-menu mb-0">
                <ul>
                    @can('profile.edit')
                        <li class="nav-item">
                            <a href="{{ route('settings') }}"
                                class="nav-link {{ @request()->routeIs('settings') ? 'active' : ' ' }}">
                                <i class="fe fe-user"></i> <span>@lang('Account Settings')</span>
                            </a>
                        </li>
                        <br>
                    @endcan
                    @can('settings.company')
                        <li class="nav-item">
                            <a href="{{ route('settings.company') }}"
                                class="nav-link {{ @request()->routeIs('settings.company') ? 'active' : ' ' }}">
                                <i class="fe fe-settings"></i> <span>@lang('Company Settings')</span>
                            </a>
                        </li>
                        <br>
                    @endcan
                    {{-- <li class="nav-item">
                        <a href="payment-settings.html" class="nav-link ">
                            <i class="fe fe-credit-card"></i> <span>@lang('Payment Methods')</span>
                        </a>
                    </li> --}}
                    @can('settings.banks')
                        <li class="nav-item">
                            <a href="{{ route('settings.banks') }}"
                                class="nav-link {{ @request()->routeIs('settings.banks') ? 'active' : ' ' }}">
                                <i class="fe fe-aperture"></i> <span>@lang('Bank Settings')</span>
                            </a>
                        </li>
                        <br>
                    @endcan
                    {{-- <li class="nav-item">
                        <a href="tax-rates.html" class="nav-link ">
                            <i class="fe fe-file-text"></i> <span>@lang('Tax Rates')</span>
                        </a>
                    </li>
                    <br> --}}
                    <li class="nav-item">
                        <a href="email-settings.html" class="nav-link ">
                            <i class="fe fe-mail"></i> <span>@lang('Email Settings')</span>
                        </a>
                    </li>
                    <br>
                    {{-- <li class="nav-item">
                        <a href="preferences.html" class="nav-link ">
                            <i class="fe fe-settings"></i> <span>Preference Settings</span>
                        </a>
                    </li> --}}
                </ul>
            </div>

        </div>
    </div>
</div>
