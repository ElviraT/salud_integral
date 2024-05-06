@extends('layouts.admin.base')

@section('content')
    <div class="page-header">
        <div class="content-page-header">
            <h5>Ticket {{ $ticket->subject }}</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary popup-toggle rounded-circle d-inline-flex p-2" href="javascript:void(0);"><i
                                class="fe fe-filter" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="filter_inputs" class="card filter-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3">
                        <label>Email</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-details-group">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="ticket-widget-img rounded-circle d-inline-flex">
                            <img src="{{ asset('assets/img/icons/ticket.svg') }}" alt="ticket">
                        </span>
                        <div class="ticket-details-cont">
                            <p>TK-{{ $ticket->id }}</p>
                            <h6>{{ $ticket->subject }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="ticket-details text-lg-end text-md-end">
                    <span class="badge"
                        style="border: solid 1px {{ $ticket->priority->color }} !important; color:
                        {{ $ticket->priority->color }} !important;">{{ $ticket->priority->name }}</span>
                    <span class="badge ms-3"
                        style="border: solid 1px {{ $ticket->statusTicket->color }} !important;
                color: {{ $ticket->statusTicket->color }} !important;">{{ $ticket->statusTicket->name }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="ticket-description-group">
        <h6>@lang('Description')</h6>
        <p>{{ $ticket->description }}</p>

    </div>
    <div class="ticket-information">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-icon rounded-circle d-inline-flex">
                            <i class="fe fe-user"></i>
                        </span>
                        <div class="customer-details-cont">
                            <h6>@lang('Requester')</h6>
                            <p>{{ $ticket->assigned_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="customer-details">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-icon rounded-circle d-inline-flex">
                            <i class="fe fe-calendar"></i>
                        </span>
                        <div class="customer-details-cont">
                            <h6>@lang('Requested Date')</h6>
                            <p>{{ $ticket->created_at->format('j F, Y, g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="customer-details border-0">
                    <div class="d-flex align-items-center">
                        <span class="customer-widget-icon rounded-circle d-inline-flex">
                            <i class="fe fe-file-text"></i>
                        </span>
                        <div class="customer-details-cont">
                            <h6>@lang('Subject')</h6>
                            <p>{{ $ticket->subject }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('tickets.comment') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_ticket" value="{{ $ticket->id }}">
        <div wire:snapshot="{&quot;data&quot;:[],&quot;memo&quot;:{&quot;id&quot;:&quot;tHLNmmD2KTfeIol4MM8w&quot;,&quot;name&quot;:&quot;ticket-details-history&quot;,&quot;path&quot;:&quot;ticket-details&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;},&quot;checksum&quot;:&quot;03b9bea70beec253f90ce92364ed48547d1dba442d89f5a6fe9bff4a6662f1c4&quot;}"
            wire:effects="[]" wire:id="tHLNmmD2KTfeIol4MM8w" class="ticket-history ticket-information pb-0">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card-inform">
                        <div class="ticket-info d-flex align-items-center justify-content-between">
                            <h6>@lang('Attachments')</h6>
                            <label class="ticket-upload upload-doc mb-0">
                                <span class="report-info"><i class="fe fe-paperclip me-2"></i></span>@lang('Add File')
                                <input type="file" name="image" id="image_personal">
                            </label>
                        </div>
                    </div>
                    @foreach ($images as $item)
                        <div class="support-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="support-widget-icon rounded-circle d-inline-flex">
                                    <i class="fe fe-file-text"></i>
                                </span>
                                <div class="support-details-cont">
                                    <h6>{{ $item->user->name }}</h6>
                                    <p>{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-record-id="{{ $item->id }}" data-bs-target="#img_details">
                                    <i class="far fa-eye me-2"></i>@lang('Show')</a>

                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirm-delete"
                                    data-bs-record-id="{{ $item->id }}" data-bs-record-title="{{ 'la imagen' }}"
                                    data-bs-action="{{ route('ticket.destroy_img', $item) }}"
                                    title="{{ __('Delete Image') }}"><i
                                        class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card-inform">
                        <div class="ticket-info d-flex align-items-center justify-content-between">
                            <h6>@lang('History')</h6>
                        </div>
                    </div>
                    <div class="card-inform d-block mt-lg-5 mt-0">
                        <ul class="activity-feed">
                            <li class="feed-item">
                                <span class="feed-text"><strong class="text-gray-dark me-2">John Smith</strong>
                                    Created a new response Created a new response</span>
                                <p>30 Dec 2023 01:24AM</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div wire:snapshot="{&quot;data&quot;:[],&quot;memo&quot;:{&quot;id&quot;:&quot;HtTaHN3glshwJ2dxOHWu&quot;,&quot;name&quot;:&quot;ticket-details-comments&quot;,&quot;path&quot;:&quot;ticket-details&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;children&quot;:[],&quot;scripts&quot;:[],&quot;assets&quot;:[],&quot;errors&quot;:[],&quot;locale&quot;:&quot;en&quot;},&quot;checksum&quot;:&quot;309a6006390170c26c03ddc4efdeb25695ed91fd09d3c50a9e75fc8ec4d52157&quot;}"
            wire:effects="[]" wire:id="HtTaHN3glshwJ2dxOHWu" class="comments">
            <div class="comments-head">
                <h5>@lang('Comments')</h5>
            </div>
            @foreach ($comments as $comment)
                <div class="card sombra">
                    <div class="card-body">
                        <div class="comments-details d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="comments-widget-img rounded-circle d-inline-flex">
                                    {{-- <img class="avatar-img rounded-circle" src="assets/img/profiles/avatar-01.jpg"
                                        alt="User Image"> --}}
                                </span>
                                <div class="comments-details-cont">
                                    <h6>{{ $comment->user->name }}</h6>
                                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-describe">
                            <p>{{ $comment->conment }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="comments">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-block mb-3">
                        <label>@lang('Leave a comments')</label>
                        <input type="text" name="conment" class="form-control" placeholder="Enter Comments">
                    </div>
                </div>
                <div class="col-lg-12 text-end">
                    <div class="row">
                        <div class="col-3 ">
                            <button type="submit" class="btn btn-primary">@lang('Post Comments')</button>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('tickets', $ticket->statusTicket->id) }}"
                                class="btn btn-back cancel-btn me-2">@lang('Back')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    @include('tickets.js')
@endsection
@section('modal')
    @include('modales.images')
    @include('modales.eliminar')
@endsection
