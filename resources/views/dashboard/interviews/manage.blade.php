@extends('dashboard.layouts.master')
@section('title', "Manage Interview Dates")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Interview Dates<hr>
          <small>
            - <span class="text-warning">You can view interview dates only for now. You can NOT manage interview dates yet! We are working on this feature.</span>
          </small>
        </h3>
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $previous_event_id = $interviews[0]->event->id;
                $strip1 = "bg-info";  $strip2 = "bg-danger";  $strip = "bg-info";
              @endphp
              @foreach($interviews as $interview)
                @php
                  if($interview->event->id != $previous_event_id){
                    if($strip == $strip1) $strip = $strip2;
                    else if($strip == $strip2) $strip = $strip1;
                  }
                  $previous_event_id = $interview->event->id;
                @endphp
                <tr id="{{ $interview->id }}" class="{{ $strip }}">
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
                  <td>
                    @if(false)
                    @if(!$interview->event->isClosed() && !$interview->event->isOpened())
                      <button class="btn-sm btn-info" id="interviewEditBtn" type="button"
                              data-toggle="modal" data-target="#interviewEditModal"
                              value="{{ $interview->id }}">
                        <i class="fa fa-edit fa-fw"> </i> EDIT
                      </button>
                      <button class="btn-sm btn-danger" id="interviewDeleteBtn" type="button"
                              value="{{ $interview->id }}">
                        <i class="fa fa-trash fa-fw"> </i> DELETE
                      </button>
                    @endif
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog"
        id="interviewEditModal" aria-labelledby="interviewEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="interviewEditModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input class="form-control" id="interviewName" type="text" placeholder="Interview Name" required>
            </div>
            <div class="form-group">
              <label class="control-label">Description</label>
              <textarea class="form-control" id="interviewDescription" placeholder="Interview Description" rows="6" style="resize: none;" required></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Interviews' Type</label>
              <input class="form-control" id="interviewInterviewsType" type="text" placeholder="Course, Training, Membership, ...etc" required>
            </div>
            <div class="form-group">
              <label class="control-label">Min. Academic Year</label>
              <input class="form-control" id="interviewMinYear" type="number" placeholder="Min Year" required>
            </div>
            <div class="form-group">
              <label class="control-label">Colleges</label><br>
              <select class="form-control" id="interviewColleges" multiple size="8">


              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Departments</label><br>
              <select class="form-control" id="interviewDepartments" multiple size="8">


              </select>
            </div>
            @include('vendor.clear')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('interviewsTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  {{--
  <script type="text/javascript" src="js/dashboard/asset/interviews/edit.js"></script>
  <script type="text/javascript" src="js/dashboard/asset/interviews/delete.js"></script>
  --}}
@stop
