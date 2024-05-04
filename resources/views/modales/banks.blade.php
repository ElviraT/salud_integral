<div class="modal custom-modal fade" id="bank_details" role="dialog">
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
                    <input type="hidden" id="id" name="id" value="" class="modal_registro_bank_id" />
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Bank Name') <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Enter Bank Name">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Account Number') <span class="text-danger">*</span></label>
                                <input type="number" name="account" id="account" class="form-control"
                                    placeholder="Enter Account Number">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Account Holder Name') <span class="text-danger">*</span></label>
                                <input type="text" name="titular" id="titular" class="form-control"
                                    placeholder="Enter Account Holder Name">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Amount') <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                    placeholder="Enter Amount">
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
        </div>
        </form>
    </div>
</div>
