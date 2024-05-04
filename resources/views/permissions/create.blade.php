@extends('layouts.admin.base')

@section('content')
    <div class="page-header">
        <div class="content-page-header">
            <h5>Permission</h5>
        </div>
        <div class="role-testing d-flex align-items-center justify-content-between">
            <h6>@lang('Role Name'):<span class="ms-1">{{ $role->name }}</span></h6>
            <p><label class="custom_check"><input type="checkbox" name="invoice" id="selectall"><span
                        class="checkmark"></span></label>@lang('Allow All Modules')</p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('permissions.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="rol" id="rol_id" value="{{ $role->id }}" />
                            <table class="table table-center table-hover datatable" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Modules</th>
                                        <th>permiso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $uri = '';
                                    @endphp
                                    @foreach ($permission as $route)
                                        @php
                                            $inicio = explode('.', $route->name);
                                        @endphp
                                        @if ($inicio[0] != 'logout' && $inicio[0] != 'dashboard')
                                            <tr>
                                                <td class="role-data">{{ $route->name }}</td>
                                                <td>
                                                    <label class="custom_check">
                                                        <input name="permissions[]" type="checkbox"
                                                            value="{{ $route->name }}" class="form-control case"
                                                            {{ in_array($route->id, $rolePermissions) ? 'checked' : '' }} />
                                                        <span class="checkmark"></span>

                                                    </label>
                                                </td>
                                            </tr>
                                        @endif
                                        @php
                                            $uri = $inicio[0];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 btn-center my-4">
        <a href="{{ route('permissions') }}" class="btn btn-primary cancel me-2">@lang('Back')</a>
        <button type="submit" class="btn btn-primary">@lang('Update')</button>
    </div>
    </form>
@endsection
@section('js')
    <script>
        $("#selectall").on("click", function() {
            $(".case").prop("checked", this.checked);
        });

        // if all checkbox are selected, check the selectall checkbox and viceversa
        $(".case").on("click", function() {
            if ($(".case").length == $(".case:checked").length) {
                $("#selectall").prop("checked", true);
            } else {
                $("#selectall").prop("checked", false);
            }
        });
    </script>
@endsection
