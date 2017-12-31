@extends('dashboard.layouts.master')
@section('title', "Add Group Discussion Dates")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Add Group Discussion Dates<hr>
          <small>
            - <span class="text-warning">You can't add droup discussion dates to opened nor closed events. You can add to unpublished events or even to upcoming events.</span>
          </small>
        </h3>
        <div class="card-body">
          <form id="addGroupDiscussionForm">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="control-label">Event</label><br>
                  <select class="form-control input-sm" id="groupDiscussionEvent" required>
                    <option disabled="" selected="" value="">Select Event</option>
                    <optgroup label="Events">
                      @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }} ({{ $event->year }})</option>
                      @endforeach
                    </optgroup>
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="event"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Preference</label><br>
                  <select class="form-control input-sm" id="groupDiscussionPreference" required>
                    <option selected="" disabled="" value="">Select preference</option>
                    @foreach($events as $event)
                      <optgroup label="{{ $event->name }}">
                        @foreach($event->preferences as $preference)
                          <option value="{{ $preference->id }}">{{ $preference->name }}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="preference"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Date</label>
                  <input class="form-control" id="groupDiscussionDate" type="text" placeholder="Select Date" required>
                  <small class="text-danger font-bold" id="errorMsg" data="date"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Max participants</label>
                  <input class="form-control" id="groupDiscussionMax" type="number" placeholder="Max Participant" required>
                  <small class="text-danger font-bold" id="errorMsg" data="max"></small>
                </div>
                <button class="btn btn-success icon-btn" id="groupDiscussionSubmit" type="submit" style="float: right;">
                  <i class="fa fa-fw fa-lg fa-plus-circle"></i>
                    Add
                </button>
                @include('vendor.clear')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript">
    $('#groupDiscussionDate').datepicker({
      format: "DD dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true
    });
    $('#groupDiscussionPreference').select2();
    $('#groupDiscussionEvent').select2();
    $('span.select2').attr('style', 'width: 100%');
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/group_discussions/add.js"></script>
@stop