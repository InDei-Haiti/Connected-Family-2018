@extends('dashboard.layouts.master')
@section('title', "Add Events")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Add Events<hr>
          <small>
            - <span class="text-primary">New events by default is not published, You can publish it from <a href="/dashboard/events/manage" class="alert-link">manage events</a> page.</span>
          </small>
        </h3>
        <div class="card-body">
          <form id="addEventForm">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Year</label>
                  <input class="form-control" id="eventYear" type="number" placeholder="Event Year" required>
                  <small class="text-danger font-bold" id="errorMsg" data="year"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" id="eventName" type="text" placeholder="Event Name" required>
                  <small class="text-danger font-bold" id="errorMsg" data="name"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Start Date</label>
                  <input class="form-control" id="eventStartDate" type="text" placeholder="Select Start Date" required>
                  <small class="text-danger font-bold" id="errorMsg" data="started_at"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">End Date</label>
                  <input class="form-control" id="eventEndDate" type="text" placeholder="Select End Date" required>
                  <small class="text-danger font-bold" id="errorMsg" data="ended_at"></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Description</label>
                  <textarea class="form-control" id="eventDescription" placeholder="Event Description" rows="6" style="resize: none;" required></textarea>
                  <small class="text-danger font-bold" id="errorMsg" data="description"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Preferences' Type</label>
                  <input class="form-control" id="eventPreferencesType" type="text" placeholder="2r2" required>
                  <small class="text-danger font-bold" id="errorMsg" data="preferences_type"></small>
                </div>
                <button class="btn btn-success icon-btn" id="eventSubmit" type="submit" style="float: right;">
                  <i class="fa fa-fw fa-lg fa-plus-circle"></i>
                    Add
                </button>
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
  <script type="text/javascript">
    $('#eventStartDate').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true
    });
    $('#eventEndDate').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      todayHighlight: true
    });
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/events/add.js"></script>
@stop