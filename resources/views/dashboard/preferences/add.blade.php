@extends('dashboard.layouts.master')
@section('title', "Add Preferences")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Add Preferences<hr>
          <small>
            - <span class="text-primary">New preferences by default is available for all colleges, departments, and academic years until you specify those constraints.</span><br>
            - <span class="text-warning">You can't add preferences to opened nor closed events. You can add to unpublished events or even to upcoming events.</span>
          </small>
        </h3>
        <div class="card-body">
          <form id="addPreferenceForm">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Event</label><br>
                  <select class="form-control input-sm" id="preferenceEventId" required>
                    <optgroup label="Events">
                      <option selected="" disabled="" value="">Select preference's event</option>
                      @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }} ({{ $event->year }})</option>
                      @endforeach
                    </optgroup>
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="event"></small>
                </div>  
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" id="preferenceName" type="text" placeholder="Preference Name" required>
                  <small class="text-danger font-bold" id="errorMsg" data="name"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Description</label>
                  <textarea class="form-control" id="preferenceDescription" placeholder="Preference Description" rows="6" style="resize: none;" required></textarea>
                  <small class="text-danger font-bold" id="errorMsg" data="description"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Type</label>
                  <input class="form-control" id="preferencePreferenceType" type="text" placeholder="Course, Training, Internship, or Membership" required value="Course">
                  <small class="text-danger font-bold" id="errorMsg" data="type"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Steps</label>
                  <input class="form-control" id="preferencePreferenceSteps" type="text" placeholder="PST>GD>IV" required value="IV">
                  <small class="text-danger font-bold" id="errorMsg" data="steps"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Min. Academic Year</label><br>
                  <select class="form-control input-sm" id="preferenceMinYear" required>
                    <optgroup label="Academic Years">
                      <option selected="" disabled="" value="">Select preference's min academic year</option>
                      @foreach($ac_years as $year)
                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                      @endforeach
                    </optgroup>
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="min_academic_year"></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Colleges</label><br>
                  <select class="form-control" id="preferenceColleges" multiple size="8">
                    @foreach($colleges as $college)
                      @php if($college->name == 'Other') continue; @endphp
                      <option value="{{ $college->id }}">{{ $college->type }} | {{ $college->name }}</option>
                    @endforeach
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="colleges"></small>
                </div>
                <div class="form-group">
                  <label class="control-label">Departments</label><br>
                  <select class="form-control" id="preferenceDepartments" multiple size="15">
                    @foreach($department_groups as $department_group)
                      <optgroup label="{{ $department_group->name }}">
                        @foreach($department_group->departments as $department)
                          @php if($department->name == 'Other') continue; @endphp
                          <option value="{{ $department->id }}">{{ $department->type }} | {{ $department->name }}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                  <small class="text-danger font-bold" id="errorMsg" data="departments"></small>
                </div>
                <button class="btn btn-success icon-btn" id="preferenceSubmit" type="submit" style="float: right;">
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
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript">
    $('#preferenceEventId').select2();
    $('#preferenceMinYear').select2();
    $('span.select2').attr('style', 'width: 100%');
  </script>
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/preferences/add.js"></script>
@stop