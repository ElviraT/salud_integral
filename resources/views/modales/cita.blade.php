<div id="add_event" class="modal custom-modal modal-lg fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0 title"></h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form-enviar" method="post">
                    <input type="hidden" id="method" name="_method" value="" />
                    @csrf
                    <input type="hidden" id="id" name="id" value=""
                        class="modal_registro_event_id" />
                    <div class="row">
                        <input type="hidden" name="id_medical" id="id_medical">
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Patient')</label>
                                <select class="form-control form-small select" name="id_patient" id="id_patient">
                                    <option>@lang('Select paciente')</option>
                                    @foreach ($patients as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control" type="hidden" name="title" id="title">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Familiar')</label>
                                <select class="form-control form-small select" name="id_familiar" id="id_familiar"
                                    disabled>
                                    <option>@lang('Select Familiar')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Type')</label>
                                <select class="form-control form-small select" name="id_type" id="id_type">
                                    <option>@lang('Select Tipo de cita')</option>
                                    @foreach ($type as $value)
                                        <option value="{{ $value->id }}"{{ $value->id == 1 ? 'selected' : '' }}>
                                            {{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Insurance number')</label>
                                <input class="form-control" type="text" name="n_seguro" id="n_seguro">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Sercices')</label>
                                <select class="form-control form-small select" name="id_service" id="id_service">
                                    <option>@lang('Select Service')</option>
                                    @foreach ($services as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Start')</label>
                                <input class="form-control" type="text" name="start" id="start" readonly>
                                <input class="form-control" type="text" name="startime" id="startime" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('End')</label>
                                <input class="form-control" type="text" name="end" id="end" readonly>
                                <input class="form-control" type="text" name="endtime" id="endtime" readonly>
                                <input type="hidden" name="duration" id="duration">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Colors')</label>
                                <input type="color" id="color" name="color" list="coloresPrimarios"
                                    class="form-control">
                                <datalist id="coloresPrimarios">
                                    @foreach ($colores as $value)
                                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>{{ 'Breve Decripción' }}</label>
                            <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary paid-continue-btn me-2">@lang('Submit')</button>
                        <button type="button" class="btn btn-danger cancel-btn" id="btnEliminar"
                            data-bs-dismiss="modal" hidden>@lang('Delete')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
