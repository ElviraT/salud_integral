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
                            @php
                                $uri = [];
                                $rutas = [
                                    'logout',
                                    'dashboard',
                                    'verification',
                                    'search',
                                    'shared',
                                    'favorites',
                                    'group',
                                    'user',
                                    'star',
                                    'send',
                                    'fetch',
                                    'message',
                                    'messages',
                                    'attachments',
                                    'download',
                                    'pusher',
                                    'auth',
                                    'seen',
                                    'contacts',
                                    'get',
                                    'update',
                                    'conversation',
                                    'delete',
                                    'avatar',
                                    'activeStatus',
                                    'set',
                                    'verification',
                                    'notice',
                                    'verify',
                                    'password',
                                    'confirm',
                                ];
                            @endphp
                            <div class="card sombra p-5">

                                @foreach ($permission as $key => $route)
                                    @php
                                        $inicio = explode('.', $route->name);
                                        $result = array_diff($inicio, $rutas);
                                    @endphp
                                    @if ($result)
                                        @if ($uri != $inicio[0])
                                            <h2>@lang(ucfirst($inicio[0])) </h2>
                                            <hr>
                                        @endif
                                        <tr>
                                            <ul>
                                                <li style="margin-inline-start: 1cm;">
                                                    <td class="role-data">{{ $route->name }}</td>
                                                    <td>
                                                        <label class="custom_check">
                                                            <input name="permissions[]" type="checkbox"
                                                                value="{{ $route->name }}" class="form-control case"
                                                                {{ in_array($route->id, $rolePermissions) ? 'checked' : '' }} />
                                                            <span class="checkmark"></span>

                                                        </label>
                                                    </td>
                                                </li><br>
                                            </ul>
                                        </tr>
                                    @endif
                                    @php
                                        $uri = $inicio[0];
                                    @endphp
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 btn-center my-4">
        <a href="{{ route('permissions') }}" class="btn btn-primary cancel me-2"
            onclick=" loading_show();">@lang('Back')</a>
        @can('permissions.store')
            <button type="submit" class="btn btn-primary">@lang('Update')</button>
        @endcan
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
