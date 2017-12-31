@extends('dashboard.layouts.master')
@section('title', $event->name . " (" . $event->year . ")" . " Statistics")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <center>
          <h1 class="card-title">
            Event's Statistics
          </h1>
        </center>
        <hr>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="widget-small info"><i class="icon fa fa-calendar fa-3x"></i>
                <div class="info">
                  <h4>{{ $event->name }}</h4>
                  <p> <b>{{ $event->year }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="widget-small info"><i class="icon fa fa-calendar fa-3x"></i>
                <div class="info">
                  <h4>Start Date</h4>
                  <p> <b>{{ $event->started_at }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="widget-small info"><i class="icon fa fa-calendar fa-3x"></i>
                <div class="info">
                  <h4>End Date</h4>
                  <p> <b>{{ $event->ended_at }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="widget-small info"><i class="icon fa fa-info fa-3x"></i>
                <div class="info">
                  <h4>Description</h4>
                  <p> <b>
                    @if($event->description)
                      @php echo substr($event->description, 0, 512); @endphp...
                    @else
                      NO Description Found
                    @endif
                  </b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small danger"><i class="icon fa fa-star fa-3x"></i>
                <div class="info">
                  <h4>Preferences' Type</h4>
                  <p> <b>{{ $event->preferences_type }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small danger"><i class="icon fa fa-star fa-3x"></i>
                <div class="info">
                  <h4>Preferences' Count</h4>
                  <p> <b>{{ count($event->preferences) }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small warning"><i class="icon fa fa-calendar fa-3x"></i>
                <div class="info">
                  <h4>Interview Dates Count</h4>
                  <p> <b>{{ count($event->interviewDates) }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small warning"><i class="icon fa fa-calendar fa-3x"></i>
                <div class="info">
                  <h4>Group Discussion Dates Count</h4>
                  <p> <b>{{ count($event->groupDiscussionDates) }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small primary"><i class="icon fa fa-edit fa-3x"></i>
                <div class="info">
                  <h4>PST Questions Count</h4>
                  <p> <b>{{ count($event->PSTS) }}</b></p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="widget-small info"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                  <h4>Participants Count</h4>
                  <p> <b>{{ count($event->participants) }}</b></p>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <center>
                <h2>Statistics of Event's Preferences</h2>
              </center>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="embed-responsive embed-responsive-16by9">
                  <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
                </div>
                <h4 class="card-title">
                  <small>Chart shows how many participants selected each preference. Preferences are labeled as numbers due to space! You can match preference's number and name from the list below (or next to) the chart.</small>
                </h4>
              </div>
            </div>
            <div class="col-md-6">
              @forelse($event->preferences as $preference)
                <span style="font-size: 18px;">{{ $loop->iteration }}.
                  <span class="font-cyan">{{ $preference->name }}</span>
                </span>
                <br>
                <span style="font-size: 13px;">
                  <b>Selected by:</b>
                    <b class="text-warning">{{ count($preference->participantPreference) }}</b>
                    participant(s) as 1st or 2nd preference.
                  <br>
                  <b>Description:</b>
                  @if($preference->description)
                    {{ $preference->description }}
                  @else
                    No Description Found
                  @endif
                  <br>
                  <b>Available for college(s)</b>:
                  @forelse($preference->colleges as $college)
                    {{ $college->name }}@if(!$loop->last),@endif
                  @empty
                    ALL Colleges
                  @endforelse
                  <br>
                  <b>Available for year(s)</b>:
                  @if($preference->min_academic_year)
                    {{ $preference->min_academic_year->name }} (or greater)
                  @else
                    ALL Years
                  @endforelse
                  <br>
                  <b>Available for department(s)</b>:
                  @if(count($preference->departments) > 0)
                    <br>
                    <ul>
                      @foreach($preference->departments as $department)
                        <li>{{ $department->group->name }} - {{ $department->name }}</li>
                      @endforeach
                    </ul>
                  @else
                    ALL Departments
                  @endif
                </sapn>
                @if(!$loop->last)<hr>@endif
              @empty
                <center>
                  <span class="text-muted text-uppercase">no preferences found</span>
                </center>
              @endforelse
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <center>
                <h2>Statistics of Event's Interview dates</h2>
              </center>
            </div>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="interviewsTable">
                  <thead>
                    <tr>
                      <th>!#</th>
                      <th>#</th>
                      <th>Date</th>
                      <th>Event</th>
                      <th>Preference</th>
                      <th>Available</th>
                      <th>Max</th>
                      <th>Taken</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $totalMax = 0;
                      $totalTaken = 0;
                      $totalSlots = count($event->interviewDates);
                    @endphp
                    @foreach($event->interviewDates as $interview)
                      @php
                        $totalMax += $interview->max;
                        $totalTaken += $interview->taken;
                      @endphp
                      <tr id="{{ $interview->id }}" class="bg-info">
                        <td>{{ $loop->iteration }}</td>
                        <td data="id">{{ $interview->id }}</td>
                        <td data="date">{{ Date::format($interview->date, "interview") }}</td>
                        <td data="event_name">
                          @if($interview->event_id)
                            {{ $interview->event->name }}'@php echo substr($interview->event->year, 2); @endphp
                          @else
                            N/A
                          @endif
                        </td>
                        <td data="preference_name">
                          @if($interview->preference_id)
                            {{ $interview->preference->name }}
                          @else
                            ALL
                          @endif
                        </td>
                        <td data="available">
                          @if($interview->available)
                            Available
                          @else
                            NOT Available
                          @endif
                        </td>
                        <td data="max">{{ $interview->max }}</td>
                        <td data="taken">{{ $interview->taken }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @if($totalSlots > 0)
            <div class="row">
              <div class="col-md-6">
                <div class="widget-small info"><i class="icon fa fa-calendar fa-3x"></i>
                  <div class="info">
                    <h4>Total Slots</h4>
                    <p> <b>{{ $totalMax }}</b></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                  <div class="info">
                    <h4>Total Taken</h4>
                    <p> <b>{{ $totalTaken }}</b></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="widget-small info"><i class="icon fa fa-star fa-3x"></i>
                  <div class="info">
                    <h4>Average Max per Slot</h4>
                    <p> <b>{{ round($totalMax/$totalSlots, 2) }}</b></p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="widget-small warning"><i class="icon fa fa-star fa-3x"></i>
                  <div class="info">
                    <h4>Average Taken per Slot</h4>
                    <p> <b>{{ round($totalTaken/$totalSlots, 2) }}</b></p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="widget-small danger"><i class="icon fa fa-users fa-3x"></i>
                  <div class="info">
                    <h4>Recommended future max per slot</h4>
                    <p> <b>{{ round((1+$totalTaken/$totalMax)*$totalTaken/$totalSlots) }}</b></p>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/chart.js"></script>
  <script type="text/javascript">
    var data = {
      labels: [
        @forelse($event->preferences as $preference)
          "{{ $loop->iteration }}" @if(!$loop->last), @endif
        @empty
        @endforelse
      ],
      datasets: [
        {
          label: "Preferences' Participants Count",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [
            @forelse($event->preferences as $preference)
              {{ count($preference->participantPreference) }} @if(!$loop->last), @endif
            @empty
            @endforelse
          ]
        }
      ]
    };
    var pdata = [
      {
        value: 300,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "Red"
      },
      {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
      },
      {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
      }
    ]

    // var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    // var lineChart = new Chart(ctxl).Line(data);

    var ctxb = $("#barChartDemo").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(data);

    // var ctxr = $("#radarChartDemo").get(0).getContext("2d");
    // var barChart = new Chart(ctxr).Radar(data);

    // var ctxpo = $("#polarChartDemo").get(0).getContext("2d");
    // var barChart = new Chart(ctxpo).PolarArea(pdata);

    // var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    // var barChart = new Chart(ctxp).Pie(pdata);

    // var ctxd = $("#doughnutChartDemo").get(0).getContext("2d");
    // var barChart = new Chart(ctxd).Doughnut(pdata);
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('interviewsTable');</script>
@stop
