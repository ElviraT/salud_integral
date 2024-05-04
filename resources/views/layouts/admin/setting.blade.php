<div class="settings-icon">
    <span data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
        aria-controls="theme-settings-offcanvas"><img src="{{ asset('assets/img/icons/siderbar-icon2.svg') }}"
            class="feather-five" alt="layout"></span>
</div>
<div class="offcanvas offcanvas-end border-0 " tabindex="-1" id="theme-settings-offcanvas">
    <div class="sidebar-headerset">
        <div class="sidebar-headersets">
            <h2>@lang('Customizer')</h2>
            <h3>@lang('Customize your overview Page layout')</h3>
        </div>
        <div class="sidebar-headerclose">
            <a data-bs-dismiss="offcanvas" aria-label="Close"><img src="{{ asset('assets/img/close.png') }}"
                    alt="img"></a>
        </div>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="settings-mains">
                <div class="layout-head">
                    <h5>@lang('Layout')</h5>
                    <h6>@lang('Choose your layout')</h6>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio p-0">
                            <input id="customizer-layout01" name="data-layout" type="radio" value="vertical"
                                class="form-check-input">
                            <label class="form-check-label avatar-md w-100" for="customizer-layout01">
                                <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">@lang('Vertical')</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio p-0">
                            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal"
                                class="form-check-input">
                            <label class="form-check-label  avatar-md w-100" for="customizer-layout02">
                                <img src="{{ asset('assets/img/horizontal.png') }}" alt="img">
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">@lang('Horizontal')</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio p-0">
                            <input id="customizer-layout03" name="data-layout" type="radio" value="twocolumn"
                                class="form-check-input">
                            <label class="form-check-label  avatar-md w-100" for="customizer-layout03">
                                <img src="{{ asset('assets/img/two-col.png') }}" alt="img">
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">@lang('Two Column')</h5>
                    </div>
                </div>
                <div class="layout-head pt-3">
                    <h5>@lang('Color Scheme')</h5>
                    <h6>@lang('Choose Light or Dark Scheme').</h6>
                </div>
                <div class="colorscheme-cardradio">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio blue  p-0 ">
                                <input class="form-check-input" type="radio" name="data-layout-mode"
                                    id="layout-mode-blue" value="blue">
                                <label class="form-check-label  avatar-md w-100" for="layout-mode-blue">
                                    <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2 mb-2">@lang('Blue')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio p-0">
                                <input class="form-check-input" type="radio" name="data-layout-mode"
                                    id="layout-mode-light" value="light">
                                <label class="form-check-label  avatar-md w-100" for="layout-mode-light">
                                    <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2 mb-2">@lang('Light')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio dark  p-0 ">
                                <input class="form-check-input" type="radio" name="data-layout-mode"
                                    id="layout-mode-dark" value="dark">
                                <label class="form-check-label avatar-md w-100 " for="layout-mode-dark">
                                    <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2 mb-2">@lang('Dark')</h5>
                        </div>
                    </div>
                </div>
                <div id="layout-width">
                    <div class="layout-head pt-3">
                        <h5>@lang('Layout Width')</h5>
                        <h6>@lang('Choose Fluid or Boxed layout.')</h6>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio p-0">
                                <input class="form-check-input" type="radio" name="data-layout-width"
                                    id="layout-width-fluid" value="fluid">
                                <label class="form-check-label avatar-md w-100" for="layout-width-fluid">
                                    <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Fluid')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio p-0 ">
                                <input class="form-check-input" type="radio" name="data-layout-width"
                                    id="layout-width-boxed" value="boxed">
                                <label class="form-check-label avatar-md w-100 px-2" for="layout-width-boxed">
                                    <img src="{{ asset('assets/img/boxed.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Boxed')</h5>
                        </div>
                    </div>
                </div>
                <div id="layout-position" class="">
                    <div class="layout-head pt-3">
                        <h5>@lang('Layout Position')</h5>
                        <h6>@lang('Choose Fixed or Scrollable Layout Position.')</h6>
                    </div>
                    <div class="btn-group bor-rad-50 overflow-hidden radio" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-fixed" value="fixed">
                        <label class="btn btn-light w-sm" for="layout-position-fixed">@lang('Fixed')</label>
                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-light w-sm ms-0"
                            for="layout-position-scrollable">@lang('Scrollable')</label>
                    </div>
                </div>
                <div class="layout-head pt-3">
                    <h5>@lang('Topbar Color')</h5>
                    <h6>@lang('Choose Light or Dark Topbar Color.')</h6>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio  p-0">
                            <input class="form-check-input" type="radio" name="data-topbar"
                                id="topbar-color-light" value="light">
                            <label class="form-check-label avatar-md w-100" for="topbar-color-light">
                                <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">@lang('Light')</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio p-0">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark"
                                value="dark">
                            <label class="form-check-label  avatar-md w-100" for="topbar-color-dark">
                                <img src="{{ asset('assets/img/dark.png') }}" alt="img">
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">@lang('Dark')</h5>
                    </div>
                </div>
                <div id="sidebar-size">
                    <div class="layout-head pt-3">
                        <h5>@lang('Sidebar Size')</h5>
                        <h6>@lang('Choose a size of Sidebar.')</h6>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio  p-0 ">
                                <input class="form-check-input" type="radio" name="data-sidebar-size"
                                    id="sidebar-size-default" value="lg">
                                <label class="form-check-label avatar-md w-100" for="sidebar-size-default">
                                    <img src="{{ asset('assets/img/vertical.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Default')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio p-0 ">
                                <input class="form-check-input" type="radio" name="data-sidebar-size"
                                    id="sidebar-size-small-hover" value="md">
                                <label class="form-check-label avatar-md w-100" for="sidebar-size-small-hover">
                                    <img src="{{ asset('assets/img/small-hover.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Small Sidebar')</h5>
                        </div>
                    </div>
                </div>
                <div id="sidebar-view">
                    <div class="layout-head pt-3">
                        <h5>@lang('Sidebar View')</h5>
                        <h6>@lang('Choose Default or Detached Sidebar view.')</h6>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio  p-0">
                                <input class="form-check-input" type="radio" name="data-layout-style"
                                    id="sidebar-view-default" value="default">
                                <label class="form-check-label avatar-md w-100" for="sidebar-view-default">
                                    <img src="{{ asset('assets/img/compact.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Default')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio p-0">
                                <input class="form-check-input" type="radio" name="data-layout-style"
                                    id="sidebar-view-detached" value="detached">
                                <label class="form-check-label  avatar-md w-100" for="sidebar-view-detached">
                                    <img src="{{ asset('assets/img/detached.png') }}" alt="img">
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Detached')</h5>
                        </div>
                    </div>
                </div>
                <div id="sidebar-color">
                    <div class="layout-head pt-3">
                        <h5>@lang('Sidebar Color')</h5>
                        <h6>@lang('Choose a color of Sidebar.')</h6>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse"
                                data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar"
                                    id="sidebar-color-light" value="light">
                                <label class="form-check-label  avatar-md w-100" for="sidebar-color-light">
                                    <span class="bg-light bg-sidebarcolor"></span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Light')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio p-0" data-bs-toggle="collapse"
                                data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar"
                                    id="sidebar-color-dark" value="dark">
                                <label class="form-check-label  avatar-md w-100" for="sidebar-color-dark">
                                    <span class="bg-darks bg-sidebarcolor"></span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Dark')</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio p-0">
                                <input class="form-check-input" type="radio" name="data-sidebar"
                                    id="sidebar-color-gradient" value="gradient">
                                <label class="form-check-label avatar-md w-100" for="sidebar-color-gradient">
                                    <span class="bg-gradients bg-sidebarcolor"></span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">@lang('Gradient')</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary w-100 bor-rad-50"
                    id="reset-layout">@lang('Reset')</button>
            </div>
        </div>
    </div>
</div>
