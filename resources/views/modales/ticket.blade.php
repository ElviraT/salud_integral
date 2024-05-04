<div class="modal custom-modal modal-lg fade" id="add_ticket" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="form-header modal-header-title text-start mb-0">
                    <h4 class="mb-0">@lang('Add Ticket')</h4>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ route('tickets.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Subject')</label>
                                <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Assigned Name')</label>
                                <input type="text" name="assigned_name" class="form-control"
                                    placeholder="Enter Assigned Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Due Date')</label>
                                <div class="cal-icon cal-icon-info">
                                    <input type="text" name="due_date" id="due_date"
                                        class="datetimepicker form-control" placeholder="Select Date">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="input-block mb-3">
                                <label>@lang('Assignee Name')</label>
                                <select name="user_id" class="form-control form-small select">
                                    <option>@lang('Assignee Name')</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}&nbsp;{{ $item->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-block mb-0">
                                <label>@lang('Priority')</label>
                                <select name="priority_id" class="form-control form-small select">
                                    <option>Select Priority</option>
                                    @foreach ($priorities as $priority)
                                        <option value="{{ $priority->id }}">{{ $priority->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-block mb-0">
                                <label>@lang('Status')</label>
                                <select name="state_id" class="form-control form-small select">
                                    <option>Select Status</option>
                                    @foreach ($status as $item)
                                        @if ($item->id != '5')
                                            <option value="{{ $item->id }}">{{ $item->name }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-block mb-3">
                                <label>@lang('Description')</label>
                                <textarea name="description" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal"
                        class="btn btn-primary paid-cancel-btn me-2">@lang('Cancel')</a>
                    <button type="submit" class="btn btn-primary paid-continue-btn">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
