@extends('layouts.admin.base')

@section('content')
    <div class="page-header">
        <div class="content-page-header">
            <h5>Tickets</h5>
            <div class="list-btn">
                <ul class="filter-list">

                    <li>
                        <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Filter"><span class="me-2"><img src="{{ asset('assets/img/icons/filter-icon.svg') }}"
                                    alt="filter"></span>Filter
                        </a>
                    </li>
                    @can('tickets.store')
                        <li>
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#add_ticket"><i
                                    class="fa fa-plus-circle me-2" aria-hidden="true"></i>@lang('New Tickets')</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-2 col-lg-4 col-sm-6 col-12">
            <div class="card inovices-card sombra">
                <div class="card-body">
                    <div class="dash-widget-header mb-0">
                        <span class="inovices-widget-icon rounded-circle bg-info-light">
                            <img src="{{ asset('assets/img/icons/receipt-item.svg') }}" alt="invoices">
                        </span>
                        <div class="dash-count">
                            <div class="dash-title">@lang('Total Tickets')</div>
                            <div class="dash-counts">
                                <p class="mb-0">{{ $total }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($ticketCounts as $count)
            <div class="col-xl-2 col-lg-4 col-sm-6 col-12">
                <div class="card inovices-card sombra">
                    <div class="card-body">
                        <div class="dash-widget-header mb-0">
                            <span class="inovices-widget-icon rounded-circle" style="background:{{ $count->color }};">
                                <img src="{{ asset('assets/img/icons/transaction-minus.svg') }}" alt="invoices">
                            </span>
                            <div class="dash-count">
                                <div class="dash-title">{{ $count->status_name }}</div>
                                <div class="dash-counts">
                                    <p class="mb-0">{{ $count->ticket_count }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="card invoices-tabs-card">
        <div class="invoices-main-tabs">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="invoices-tabs">
                        @php($id = substr(str_replace('/', '', $_SERVER['REQUEST_URI']), -1))
                        <ul class="nav nav-tabs nav-justified">
                            @foreach ($status as $item)
                                <li>
                                    <a href="{{ route('tickets', $item->id) }}"
                                        class="{{ $id == $item->id ? 'active' : '' }}"
                                        onclick=" loading_show();">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="comments">
        @foreach ($tickets as $ticket)
            @can('tickets.edit')
                <a href="{{ route('tickets.edit', $ticket) }}" onclick=" loading_show();">
                @endcan
                <div class="card sombra">
                    <div class="card-body card-support">
                        <div class="comments-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center describe-btn mt-0">
                                <h6 class="fw-bolder text-gray-dark">{{ $ticket->subject }}</h6><span class="badge ms-3"
                                    style="border: solid 1px {{ $ticket->statusTicket->color }} !important;
                                color: {{ $ticket->statusTicket->color }} !important;">{{ $ticket->statusTicket->name }}</span>
                            </div>
                            <a href="#" class="reply-comment d-flex text-gray-light"><span><i
                                        class="fe fe-clock text-gray-light fw-normal me-2"></i></span><span
                                    class="text-gray-light fw-normal">{{ $ticket->created_at->diffForHumans() }}</span></a>
                        </div>
                        <div class="card-describe">
                            <p>{{ $ticket->description }}</p>
                        </div>
                        <div class="describe-btn">
                            <span class="badge me-2"
                                style="border: solid 1px {{ $ticket->priority->color }} !important;
                        color: {{ $ticket->priority->color }} !important;">{{ $ticket->priority->name }}</span>
                            <span class="badge badge-gray-outline me-2">{{ '#' . $ticket->id }}</span>
                            <span><i
                                    class="fe fe-message-square text-gray-light fw-normal me-2"></i>{{ count($ticket->comment) }}</span>
                        </div>
                    </div>
                </div>
                @can('tickets.edit')
                </a>
            @endcan
        @endforeach

        <div class="col-12">
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
@section('filtros')
    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">

                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Customer
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="checkBoxes1">
                                            <div class="form-custom">
                                                <input type="text" class="form-control" id="member_search1"
                                                    placeholder="Search here">
                                                <span><img src="{{ asset('assets/img/icons/search.svg') }}"
                                                        alt="img"></span>
                                            </div>
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Brian Johnson
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Russell Copeland
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Greg Lynch
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> John Blair
                                                </label>

                                                <div class="view-content">
                                                    <div class="viewall-One">
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="username">
                                                            <span class="checkmark"></span> Barbara Moore
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="username">
                                                            <span class="checkmark"></span> Hendry Evan
                                                        </label>
                                                        <label class="custom_check w-100">
                                                            <input type="checkbox" name="username">
                                                            <span class="checkmark"></span> Richard Miles
                                                        </label>
                                                    </div>
                                                    <div class="view-all">
                                                        <a href="javascript:void(0);" class="viewall-button-One"><span
                                                                class="me-2">View
                                                                All</span><span><i
                                                                    class="fa fa-circle-chevron-down"></i></span></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion" id="accordionMain2">
                        <div class="card-header-new" id="headingTwo">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Select Date
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample2">
                            <div class="card-body-chat">
                                <div class="input-block mb-3">
                                    <label class="form-control-label">From</label>
                                    <div class="cal-icon">
                                        <input type="email" class="form-control datetimepicker"
                                            placeholder="DD-MM-YYYY">
                                    </div>
                                </div>
                                <div class="input-block mb-3">
                                    <label class="form-control-label">To</label>
                                    <div class="cal-icon">
                                        <input type="email" class="form-control datetimepicker"
                                            placeholder="DD-MM-YYYY">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion" id="accordionMain3">
                        <div class="card-header-new" id="headingThree">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    By Status
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample3">
                            <div class="card-body-chat">
                                <div id="checkBoxes2">
                                    <div class="form-custom">
                                        <input type="text" class="form-control" id="member_search2"
                                            placeholder="Search here">
                                        <span><img src="{{ asset('assets/img/icons/search.svg') }}"
                                                alt="img"></span>
                                    </div>
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> All
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Open
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Resolved
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Pending
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="bystatus">
                                            <span class="checkmark"></span> Closed
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion accordion-last" id="accordionMain4">
                        <div class="card-header-new" id="headingFour">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    Category
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample4">
                            <div class="card-body-chat">
                                <div id="checkBoxes3">
                                    <div class="selectBox-cont">
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Advertising
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Food
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Repairs
                                        </label>
                                        <label class="custom_check w-100">
                                            <input type="checkbox" name="category">
                                            <span class="checkmark"></span> Software
                                        </label>

                                        <div class="view-content">
                                            <div class="viewall-Two">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Stationary
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Medical
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username">
                                                    <span class="checkmark"></span> Designing
                                                </label>
                                            </div>
                                            <div class="view-all">
                                                <a href="javascript:void(0);" class="viewall-button-Two"><span
                                                        class="me-2">View All</span><span><i
                                                            class="fa fa-circle-chevron-down"></i></span></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="filter-buttons">
                        <button type="submit"
                            class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary">
                            Apply
                        </button>
                        <button type="submit"
                            class="d-inline-flex align-items-center justify-content-center btn w-100 btn-secondary">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.ticket')
    @include('modales.eliminar')
@endsection
@section('js')
    @include('tickets.js')
@endsection
