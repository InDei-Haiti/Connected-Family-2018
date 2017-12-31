@extends('layouts.master')
@section('title', $event->name . " Interview")
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-calendar" aria-hidden="true"></i> |
            <b>@if($participant->interview && $participant->updatable) Update @else Select @endif interview date</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          <div class="row">
            <div class="col-md-8 offset-md-2"> 
              @if(count($interview_dates) > 0)
                @if($participant->interview)
                  <center>
                    <h4>
                      You have selected your interview date and it's date
                      @if(strtotime($participant->interview->date) < time()) was @else will be @endif
                      at <br>
                      <u><b>{{ Date::format($participant->interview->date, "iv") }}</b></u>
                    </h4>
                  </center>
                @endif
                @if($participant->updatable)
                  <form id="interviewForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="interview">Interview date</label>
                      <select class="form-control" id="interview">
                        <option
                          @if(!$participant->interview)
                            selected=""
                          @endif
                          disabled="" value="">Select Interview Date</option>
                        @foreach($interview_dates as $interview_date)
                          <option value="{{ $interview_date->id }}"
                            @if($participant->interview)
                              @if($participant->interview->date == $interview_date->date)
                                selected="" 
                              @endif
                            @endif
                          >{{ Date::format($interview_date->date, "interview") }}</option>
                        @endforeach
                      </select>
                      <small class="text-danger font-weight-bold" id="errorMsg" data="interview"></small>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary cursor-pointer float-right" id="interviewBtn"
                              type="submit">
                        @if($participant->interview) Update @else Select @endif Interview
                      </button>
                    </div>
                  </form>
                @else
                  <center>
                    <i class="fa fa-times-circle fa-5x text-danger" aria-hidden="true"></i>
                    <h3 class="text-danger">
                      You can't update your interview from now on.
                    </h3>
                    <p class="text-muted">
                      If you think this is a mistake feel free to contact-us via facebook page and describe the error.
                    </p>
                  </center>
                @endif
              @else
                <center>
                  <i class="fa fa-exclamation-circle fa-5x text-warning" aria-hidden="true"></i>
                  <h3>
                    No interview dates found for {{ $event->name }}'@php echo substr($event->year, 2); @endphp event!
                  </h3>
                  <p class="text-muted">
                    If you think this is a mistake feel free to contact-us via facebook page and describe the error.
                  </p>
                </center>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/ajax/interview/select.js"></script>
@stop