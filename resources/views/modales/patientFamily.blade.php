<div class="modal custom-modal modal-lg fade" id="add_patientFamily" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_patientF_id" />
                    <input type="hidden" name="id_patient" value="{{ $id_pariente }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-groups-item">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Relationship')</label>
                                                <select class="form-control form-small select" name="id_relation"
                                                    id="id_relation">
                                                    <option>@lang('Select relacion')</option>
                                                    @foreach ($relacion as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Name')</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Last Name')</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control" placeholder="Enter Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('DNI')</label>
                                                <input type="text" name="dni" id="dni" class="form-control"
                                                    placeholder="Enter DNI">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Date of Birth')</label>
                                                <div class="cal-icon cal-icon-info">
                                                    <input type="text" name="birthdate" id="birthdate"
                                                        class="datetimepicker form-control" placeholder="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Gender')</label>
                                                <select class="form-control form-small select" name="id_gender"
                                                    id="id_gender">
                                                    <option>@lang('Select Gender')</option>
                                                    @foreach ($genders as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="input-block mb-3">
                                                <label>@lang('Marital State')</label>
                                                <select class="form-control form-small select" name="id_marital"
                                                    id="id_marital">
                                                    <option>@lang('Select Marital State')</option>
                                                    @foreach ($maritals as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-back cancel-btn me-2">@lang('Close')</button>
                    <button type="submit" data-bs-dismiss="modal"
                        class="btn btn-primary paid-continue-btn">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
