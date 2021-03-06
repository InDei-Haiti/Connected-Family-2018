@extends('dashboard.layouts.master')
@section('title', "Add Interview Dates")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Add Interview Dates<hr>
          <small>
            - <span class="text-warning">You can't add interview dates to closed events.</span><br>
            - <span class="text-info">You can add to unpublished, upcoming, and opened events.</span>
          </small>
        </h3>
        <div class="card-body">
          <form id="addInterviewForm">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="control-label">Event</label><br>
                  <select class="form-control input-sm" id="interviewEvent" required>
                    <option disabled="" value="">Select Event</option>
                    <optgroup label="Events">
                      @foreach($events as $event)
                        <option value="{{ $event->id }}" @if($loop->index == 0) selected="" @endif>{{ $event->name }} ({{ $event->year }})</option>
                      @endforeach
                    </optgroup>
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="event"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Preference</label><br>
                  <select class="form-control input-sm" id="interviewPreference" required>
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
                  <label class="control-label">Date</label><br>
                  <small class="text-primary font-bold">
                    The entered date must be in this form: Y-m-d H:i:s<br>
                    Ex: Sunday 17/09/2017 11:30AM Enter <u>2017-09-17 11:30:00</u><br>
                    Ex: Monday 18/09/2017 02:30PM Enter <u>2017-09-18 14:30:00</u><br>
                    Participant will see the date in this form Monday 18/09/2017 02:30PM.
                  </small>
                  <input class="form-control" id="interviewDate" type="text" placeholder="Select Date" required>
                  <small class="text-danger font-bold" id="errorMsg" data="date"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Max participants</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the max participants who can select this date.
                  </small>
                  <input class="form-control" id="interviewMax" type="number" placeholder="Max Participant" required>
                  <small class="text-danger font-bold" id="errorMsg" data="max"></small>
                </div>
                <button class="btn btn-success icon-btn" id="interviewSubmit" type="submit" style="float: right;">
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
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript">
    $('#interviewPreference').select2();
    $('#interviewEvent').select2();
    $('span.select2').attr('style', 'width: 100%');
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/interviews/add.js"></script>
@stop
