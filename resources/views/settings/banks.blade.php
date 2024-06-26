@extends('layouts.admin.base')

@section('content')
    <div class="row">
        @include('settings.menu')
        <div class="col-xl-9 col-md-8">
            <div class="card">
                <div class="card-body w-100">
                    <div class="content-page-header p-0">
                        <h5>@lang('Bank Accounts')</h5>
                        @can('banks.store')
                            <div class="list-btn">
                                <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                    data-bs-action="{{ route('banks.store') }}" data-bs-target="#bank_details"><i
                                        class="fa fa-plus-circle me-2" aria-hidden="true"></i>@lang('Add Bank')</a>

                            </div>
                        @endcan
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-center table-hover datatable" width="100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('Name')</th>
                                                    <th>@lang('Bank Name')</th>
                                                    <th>@lang('Account Number') </th>
                                                    <th>@lang('Amount')</th>
                                                    <th class="no-sort">@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($banks as $item)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                {{ $item->titular }}
                                                            </h2>
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->account }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td class="d-flex align-items-center">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class=" btn-action-icon "
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fas fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul>
                                                                        @can('banks.edit')
                                                                            <li>
                                                                                <a href="#" type="button"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#bank_details"
                                                                                    class="btn btn-greys me-2"
                                                                                    data-bs-record-id="{{ $item->id }}"
                                                                                    data-bs-action="{{ route('banks.update', $item) }}">
                                                                                    <i class="fa fa-edit me-1"></i>
                                                                                    {{ __('Edit Bank') }}
                                                                                </a>
                                                                            </li>
                                                                        @endcan
                                                                        @can('banks.destroy')
                                                                            <li>
                                                                                <a class="btn btn-greys me-2"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#confirm-delete"
                                                                                    data-bs-record-id="{{ $item->id }}"
                                                                                    data-bs-record-title="{{ 'El Banco ' }}{{ $item->name }}"
                                                                                    data-bs-action="{{ route('banks.destroy', $item) }}"
                                                                                    title="{{ __('Delete Banks') }}"><i
                                                                                        class="far fa-trash-alt me-2"></i>@lang('Delete')</a>
                                                                            </li>
                                                                        @endcan
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('modales.banks')
    @include('modales.eliminar')
@endsection
@section('js')
    @include('settings.js')
@endsection
