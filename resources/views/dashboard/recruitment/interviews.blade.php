@extends('dashboard.layouts.master')
@section('title', "Recruitment Interview Dates")
@section('container')
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Recruitment Interview Dates<hr>
        </h3>
        <h3>Colors keys</h3>
        <table class="table table-responsive table-bordered">
          <tr>
            <td class="bg-success text-center">Green</td><td>Date is Available for participants to select</td>
            <td class="bg-danger text-center">Red</td><td>Otherwise</td>
          </tr>
        </table>
        <hr>
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="interviewDatesTable">
            <thead>
              <tr>
                <th>!#</th>
                <th>Date</th>
                <th>Added by</th>
                <th>Available</th>
                <th>Max</th>
                <th>Taken</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php $added_dates = 0; $added_slots = 0; $taken_slots = 0; $available_slots = 0; @endphp
              @foreach($interview_dates as $interview_date)
                @php
                  $added_dates++;
                  $added_slots += $interview_date->max;
                  $taken_slots += $interview_date->taken;
                @endphp
                <tr id="{{ $interview_date->id }}" class="
                    @if($interview_date->available)
                      bg-success
                    @else
                      bg-danger
                    @endif
                  ">
                  <td data="time">
                    {{ strtotime($interview_date->date) }}
                  </td>
                  <td data="date">{{ Date::format($interview_date->date, "interview") }}</td>
                  <td data="admin_title_name">{{ $interview_date->admin->title }} - {{ $interview_date->admin->user->name }}</td>
                  <td data="available">
                    @if($interview_date->available)
                      @php $available_slots++ @endphp
                      Available
                    @else
                      NOT Available
                    @endif
                  </td>
                  <td data="max">{{ $interview_date->max }}</td>
                  <td data="taken">{{ $interview_date->taken }}</td>
                  <td>
                    <button class="btn btn-danger btn-sm" value="{{ $interview_date->id }}" id="deleteInterview">
                      Delete
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <hr>
        <h3>Short Statistics</h3>
        <div class="row">
          <div class="col-md-6">
            <div class="widget-small info"><i class="icon fa fa-calendar fa-3x"></i>
              <div class="info">
                <h4>Total added interview dates</h4>
                <p> <b>{{ $added_dates }}</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="widget-small primary"><i class="icon fa fa-calendar fa-3x"></i>
              <div class="info">
                <h4>Total added slots</h4>
                <p> <b>{{ $added_slots }}</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Total taken slots</h4>
                <p> <b>{{ $taken_slots }}</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="widget-small warning"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Total available slots</h4>
                <p> <b>{{ $available_slots }}</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('interviewDatesTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/recruitment/interviews/delete.js"></script>
@stop