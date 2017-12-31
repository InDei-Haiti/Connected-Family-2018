@extends('dashboard.layouts.master')
@section('title', "Manage Group Discussion Dates")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Group Discussion Dates<hr>
          <small>
            - <span class="text-warning">You can view group discussion dates only for now. You can NOT manage group discussion dates yet! We are working on this feature.</span>
          </small>
        </h3>
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="groupDiscussionsTable">
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
                $previous_event_id = $group_discussions[0]->event->id;
                $strip1 = "bg-info";  $strip2 = "bg-danger";  $strip = "bg-info";
              @endphp
              @foreach($group_discussions as $group_discussion)
                @php
                  if($group_discussion->event->id != $previous_event_id){
                    if($strip == $strip1) $strip = $strip2;
                    else if($strip == $strip2) $strip = $strip1;
                  }
                  $previous_event_id = $group_discussion->event->id;
                @endphp
                <tr id="{{ $group_discussion->id }}" class="{{ $strip }}">
                  <td>{{ $loop->iteration }}</td>
                  <td data="id">{{ $group_discussion->id }}</td>
                  <td data="date" width="30%">{{ $group_discussion->date }}</td>
                  <td data="event_name">
                    @if($group_discussion->event_id)
                      {{ $group_discussion->event->name }}'@php echo substr($group_discussion->event->year, 2); @endphp
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="preference_name">
                    @if($group_discussion->preference_id)
                      {{ $group_discussion->preference->name }}
                    @else
                      ALL
                    @endif
                  </td>
                  <td data="available">
                    @if($group_discussion->available)
                      Available
                    @else
                      NOT Available
                    @endif
                  </td>
                  <td data="max">{{ $group_discussion->max }}</td>
                  <td data="taken">{{ $group_discussion->taken }}</td>
                  <td>
                    @if(false)
                    @if(!$group_discussion->event->isClosed() && !$group_discussion->event->isOpened())
                      <button class="btn-sm btn-info" id="interviewEditBtn" type="button" 
                              data-toggle="modal" data-target="#interviewEditModal"
                              value="{{ $group_discussion->id }}">
                        <i class="fa fa-edit fa-fw"> </i> EDIT
                      </button>
                      <button class="btn-sm btn-danger" id="interviewDeleteBtn" type="button" 
                              value="{{ $group_discussion->id }}">
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
              <input class="form-control" id="interviewName" type="text" placeholder="Group Discussion Name" required>
            </div>
            <div class="form-group">
              <label class="control-label">Description</label>
              <textarea class="form-control" id="interviewDescription" placeholder="Group Discussion Description" rows="6" style="resize: none;" required></textarea>
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
  <script type="text/javascript">dataTable('groupDiscussionsTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  {{--
  <script type="text/javascript" src="js/dashboard/asset/group_discussions/edit.js"></script>
  <script type="text/javascript" src="js/dashboard/asset/group_discussions/delete.js"></script>
  --}}
@stop