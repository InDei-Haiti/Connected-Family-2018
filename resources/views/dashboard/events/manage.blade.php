@extends('dashboard.layouts.master')
@section('title', "Manage Events")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Events<hr>
          <small>
            - <span class="text-warning">You can't manage opened nor closed events!</span>
          </small>
        </h3>
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="eventsTable">
            <thead>
              <tr>
                <th>!#</th>
                <th>#</th>
                <th>Year</th>
                <th>Name</th>
                <th>Start</th>
                <th>End</th>
                <th>Description</th>
                <th>Pref. Type</th>
                <th>Published</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $previous_event_id = $events[0]->id;
                $strip1 = "bg-info";  $strip2 = "bg-danger";  $strip = "bg-info";
              @endphp
              @foreach($events as $event)
                @php
                  if($event->id != $previous_event_id){
                    if($strip == $strip1) $strip = $strip2;
                    else if($strip == $strip2) $strip = $strip1;
                  }
                  $previous_event_id = $event->id;
                @endphp
                <tr id="{{ $event->id }}" class="{{ $strip }}">
                  <td>{{ $loop->iteration }}</td>
                  <td data="id">{{ $event->id }}</td>
                  <td data="year">{{ $event->year }}</td>
                  <td data="name">{{ $event->name }}</td>
                  <td data="started_at">{{ $event->started_at }}</td>
                  <td data="ended_at">{{ $event->ended_at }}</td>
                  <td data="description">{{ $event->description }}</td>
                  <td data="preferences_type">{{ $event->preferences_type }}</td>
                  <td data="published">{{ $event->published }}</td>
                  <td>
                    @if(!$event->isClosed() && !$event->isOpened())
                      <button class="btn-sm btn-info" id="eventEditBtn" type="button"
                              data-toggle="modal" data-target="#eventEditModal"
                              value="{{ $event->id }}">
                        <i class="fa fa-edit fa-fw"> </i> EDIT
                      </button>
                      <button class="btn-sm btn-danger" id="eventDeleteBtn" type="button"
                              value="{{ $event->id }}">
                        <i class="fa fa-trash fa-fw"> </i> DELETE
                      </button>
                    @endif
                    @if(!$event->published)
                      <button class="btn-sm btn-success" id="eventPublishBtn" type="button"
                              value="{{ $event->id }}">
                        <i class="fa fa-rocket fa-fw"> </i> Publish
                      </button>
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
        id="eventEditModal" aria-labelledby="eventEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="eventEditModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form id="editEventForm">
            {{ csrf_field() }}
            <input id="eventId" type="hidden" required>
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
            <div class="form-group">
              <label class="control-label">Description</label>
              <textarea class="form-control" id="eventDescription" placeholder="Event Description" rows="6" style="resize: none;" required></textarea>
              <small class="text-danger font-bold" id="errorMsg" data="description"></small>
            </div>
            <div class="form-group">
              <label class="control-label">Preferences' Type</label>
              <input class="form-control" id="eventPreferencesType" type="text" placeholder="2|required:1" required>
              <small class="text-danger font-bold" id="errorMsg" data="preferences_type"></small>
            </div>
            @include('vendor.clear')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="eventSubmit">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('eventsTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/events/publish.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/events/delete.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/events/edit.js"></script>
@stop
