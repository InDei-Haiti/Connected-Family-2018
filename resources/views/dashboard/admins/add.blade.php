@extends('dashboard.layouts.master')
@section('title', "Add Members")
@section('container')
  <div class="page-title">
    <div>
      <h1>Bla form</h1>
      <small>Bla bla...</small>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="card">
        <h3 class="card-title">Add Member</h3>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label class="control-label">Name</label><br>
              <select class="form-control input-sm" id="memberUser" required>
                <optgroup label="Users">
                  @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Committee</label><br>
              <select class="form-control input-sm" id="memberCommittee" required>
                <optgroup label="Committees">
                  @foreach($committees as $committee)
                    <option value="{{ $committee->id }}">{{ $committee->name }}</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Position</label><br>
              <select class="form-control input-sm" id="memberPosition" required>
                <optgroup label="Positions">
                  @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Year</label>
              <input class="form-control" id="memberYear" type="number" placeholder="Year" required>
            </div>
            <div class="card-footer">
              <button class="btn btn-success icon-btn" type="submit" style="float: right;">
                <i class="fa fa-fw fa-lg fa-plus-circle"></i>
                  Add
              </button>
            </div>
            @include('vendor.clear')
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript">
    $('#memberUser').select2();
    $('#memberCommittee').select2();
    $('#memberPosition').select2();
    $('span.select2').attr('style', 'width: 100%');
  </script>
  <script type="text/javascript" src="/js/dashboard/asset/members/add.js"></script>
@stop