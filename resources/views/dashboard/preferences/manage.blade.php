@extends('dashboard.layouts.master')
@section('title', "Manage Preferences")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Manage Preferences<hr>
          <small>
            - <span class="text-warning">You can view preferences only for now. You can NOT manage preferences yet! We are working on this feature.</span>
          </small>
        </h3>
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="preferencesTable">
            <thead>
              <tr>
                <th>!#</th>
                <th>#</th>
                <th>Event</th>
                <th>Name</th>
                <th>Type</th>
                <th>Min.Year</th>
                <th>Colleges</th>
                <th>Departments</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $previous_event_id = $preferences[0]->event->id;
                $strip1 = "bg-info";  $strip2 = "bg-danger";  $strip = "bg-info";
              @endphp
              @foreach($preferences as $preference)
                @php
                  if($preference->event->id != $previous_event_id){
                    if($strip == $strip1) $strip = $strip2;
                    else if($strip == $strip2) $strip = $strip1;
                  }
                  $previous_event_id = $preference->event->id;
                @endphp
                <tr id="{{ $preference->id }}" class="{{ $strip }}">
                  <td>{{ $loop->iteration }}</td>
                  <td data="id">{{ $preference->id }}</td>
                  <td data="event_name">{{ $preference->event->name }} ({{ $preference->event->year }})</td>
                  <td data="name" width="30%">{{ $preference->name }}</td>
                  <td data="type">
                    @if($preference->type)
                      {{ $preference->type }}
                    @else
                      N/A
                    @endif
                  </td>
                  <td data="min_academic_year">
                    @if($preference->min_academic_year)
                      {{ $preference->min_academic_year->name }}
                    @else
                      ALL
                    @endif
                  </td>
                  <td data="colleges">
                    @forelse($preference->colleges as $college)
                      {{ $college->name }}@if(!$loop->last), @endif
                    @empty
                      ALL
                    @endforelse
                  </td>
                  <td data="departments">
                    @if(count($preference->departments) > 0)
                      <ul>
                        @foreach($preference->departments as $department)
                          <li>{{ $department->group->name }} - {{ $department->name }}</li>
                        @endforeach
                      </ul>
                    @else
                      ALL
                    @endif
                  </td>
                  <td>
                    @if(false)
                    @if(!$preference->event->isClosed() && !$preference->event->isOpened())
                      <button class="btn-sm btn-info" id="preferenceEditBtn" type="button"
                              data-toggle="modal" data-target="#preferenceEditModal"
                              value="{{ $preference->id }}">
                        <i class="fa fa-edit fa-fw"> </i> EDIT
                      </button>
                      <button class="btn-sm btn-danger" id="preferenceDeleteBtn" type="button"
                              value="{{ $preference->id }}">
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
        id="preferenceEditModal" aria-labelledby="preferenceEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="preferenceEditModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label><br>
              <select class="form-control input-sm" id="preferenceEventId" required>
                <optgroup label="Events">
                  @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }} ({{ $event->year }})</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input class="form-control" id="preferenceName" type="text" placeholder="Preference Name" required>
            </div>
            <div class="form-group">
              <label class="control-label">Description</label>
              <textarea class="form-control" id="preferenceDescription" placeholder="Preference Description" rows="6" style="resize: none;" required></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Type</label>
              <input class="form-control" id="preferencePreferenceType" type="text" placeholder="Course, Training, Membership, ...etc" required>
            </div>
            <div class="form-group">
              <label class="control-label">Steps</label>
              <input class="form-control" id="preferencePreferenceSteps" type="text" placeholder="PST>GD>IV" required>
            </div>
            <div class="form-group">
              <label class="control-label">Min. Academic Year</label>
              <input class="form-control" id="preferenceMinYear" type="number" placeholder="Min Year" required>
            </div>
            <div class="form-group">
              <label class="control-label">Colleges</label><br>
              <select class="form-control" id="preferenceColleges" multiple size="8">
                @foreach($colleges as $college)
                  @php if($college->name == 'Other') continue; @endphp
                  <option value="{{ $college->name }}">
                    {{ $college->type }} | {{ $college->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Departments</label><br>
              <select class="form-control" id="preferenceDepartments" multiple size="12">
                @foreach($department_groups as $department_group)
                  <optgroup label="{{ $department_group->name }}">
                    @foreach($department_group->departments as $department)
                      @php if($department->name == 'Other') continue; @endphp
                      <option value="{{ $department->name }}">
                        {{ $department->type }} | {{ $department->name }}
                      </option>
                    @endforeach
                  </optgroup>
                @endforeach
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
  <script type="text/javascript">dataTable('preferencesTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript">
    $('#preferenceEventId').select2();
    $('span.select2').attr('style', 'width: 100%');
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  {{--
  <script type="text/javascript" src="js/dashboard/asset/preferences/edit.js"></script>
  <script type="text/javascript" src="js/dashboard/asset/preferences/delete.js"></script>
  --}}
@stop
