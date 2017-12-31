@extends('dashboard.layouts.master')
@section('title', "Recruitment Participants")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Recruitment Participants<hr>
        </h3>
        {{ csrf_field() }}
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="interviewsTable">
            <thead>
              <tr>
                <th>!#</th>
                <th>Date</th>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Education</th>
                <th>Facebook</th>
                <th>Preferences</th>
                <th>State</th>
                <th>Old Member</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php $stPref = 0; $total = 0; @endphp
              @foreach($participants as $participant)
                @php $total++; @endphp
                <tr id="{{ $participant->id }}" class="">
                  <td data="time">
                    @if($participant->interview)
                      {{ strtotime($participant->interview->date) }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="interview" class="
                      @if($participant->interview)
                        @if(strtotime($participant->interview->date) < time())
                          bg-success
                        @else
                          bg-warning
                        @endif
                      @else
                        bg-danger
                      @endif
                    ">
                    @if($participant->interview)
                      {{ Date::format($participant->interview->date, "interview") }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="id">{{ $participant->id }}</td>
                  <td data="name">{{ $participant->user->name }}</td>
                  <td data="email">{{ $participant->user->email }}</td>
                  <td data="mobile">
                    @if($participant->user->mobile)
                      {{ $participant->user->mobile->number }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="education">
                    @if($participant->user->educationalInformation)
                      {{ $participant->user->educationalInformation->academic_year->name }}
                      @if($participant->user->educationalInformation->department)
                        - {{ $participant->user->educationalInformation->department->name }}
                      @endif
                      ,
                      {{ $participant->user->educationalInformation->college->name }} -
                      {{ $participant->user->educationalInformation->uni->name }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="facebook">
                    @if($participant->user->socialLink("facebook"))
                      <i class="fa fa-external-link" aria-hidden="true"></i>
                      <a href="{{ $participant->user->socialLink("facebook") }}" target="_blank">
                        {{ $participant->user->name }} on Facebook
                        @if($participant->user->socialInformation('facebook')->linked)
                          <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                        @endif
                      </a>
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="preferences" class="
                      @if($participant->preferences[0]->id == $re_preference_id)
                        bg-success
                        @php $stPref++ @endphp
                      @else
                        bg-danger
                      @endif
                    ">
                    @foreach($participant->preferences as $preference)
                      {{ $preference->name }}@if(!$loop->last), @endif
                    @endforeach
                  </td>
                  <td id="td_iv_state_{{ $participant->id }}" data="state" class="
                      @if($participant->interview)
                        @if($participant->participantInterview->result == NULL)
                          bg-warning
                        @elseif($participant->participantInterview->result == 1)
                          bg-success
                        @else
                          bg-danger
                        @endif
                      @else
                        bg-warning
                      @endif
                    ">
                    @if($participant->interview)
                      @if($participant->participantInterview->result == NULL)
                        Waiting
                      @elseif($participant->participantInterview->result == 1)
                        Accepted for {{ $participant->participantInterview->preference->name }}
                      @else
                        Rejected
                      @endif
                    @else
                      Waiting. NO IV.
                    @endif
                  </td>
                  <td class="
                      @if(count($participant->user->memberHistories) > 0) bg-success @else bg-danger @endif
                    ">
                    @if(count($participant->user->memberHistories) > 0) Yes @else NO @endif
                  </td>
                  <td id="td_iv_btn_{{ $participant->id }}">
                    {{--
                    @if($participant->interview)
                      @foreach($participant->preferences as $preference)
                        <button class="btn-xs btn-success" id="{{ $participant->id }}" name="state-button" for="iv" state="1" prefId="{{ $preference->id }}">
                          Accept for {{ $preference->name }}
                        </button><br><br>
                      @endforeach
                      <button class="btn-xs btn-danger" id="{{ $participant->id }}" name="state-button" for="iv" state="0">
                        Reject
                      </button>
                    @else
                      N/A
                    @endif
                    --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <br>
            <a style="float: right;" class="btn btn-success" href="{{ route("dashboard.recruitment.participants.export.request") }}">Export</a>
          </div>
        </div>
        <hr>
        <h3>Short Statistics</h3>
        <div class="row">
          <div class="col-md-6">
            <div class="widget-small info"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Total applied for your Committee</h4>
                <p> <b>{{ $total }}</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="widget-small primary"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Total applied as 1st Preference</h4>
                <p> <b>{{ $stPref }}</b></p>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <h3>Colors keys</h3>
        <div class="row">
          <div class="col-md-12">
            <h4>For Dates</h4>
            <table class="table table-responsive table-bordered">
              <tr>
                <td class="bg-success text-center">Green</td><td>Date is Passed</td>
                <td class="bg-warning text-center">Yellow</td><td>Date is Upcoming</td>
                <td class="bg-danger text-center">Red</td><td>Date is N/A</td>
              </tr>
            </table>
          </div>
          <div class="col-md-12">
            <h4>For State</h4>
            <table class="table table-responsive table-bordered">
              <tr>
                <td class="bg-warning text-center">Yellow</td><td>Waiting</td>
                <td class="bg-success text-center">Green</td><td>Accepted</td>
                <td class="bg-danger text-center">Red</td><td>Rejected</td>
              </tr>
            </table>
          </div>
          <div class="col-md-12">
            <h4>For Preferences</h4>
            <table class="table table-responsive table-bordered">
              <tr>
                <td class="bg-success text-center">Green</td><td>1st Preference is your committee</td>
                <td class="bg-danger text-center">Red</td><td>Otherwise</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('interviewsTable');</script>
  <script type="text/javascript" src="/js/dashboard/asset/recruitment/participants/state.js"></script>
  {{--
  <script type="text/javascript" src="js/dashboard/asset/interviews/edit.js"></script>
  <script type="text/javascript" src="js/dashboard/asset/interviews/delete.js"></script>
  --}}
@stop
