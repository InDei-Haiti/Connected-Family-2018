@extends('dashboard.layouts.master')
@section('title', "Manage Members")
@section('container')
  <div class="page-title">
    <div>
      <h1>Bla Table</h1>
      <small>Bla bla...</small>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="table-responsive">
          <table class="table table-hover table-bordered" id="membersTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Committee</th>
                <th>Position</th>
                <th>Year</th>
                <th>Actios</th>
              </tr>
            </thead>
            <tbody>
              @foreach($members as $member)
                <tr id="{{ $member->id }}">
                  <td data="id">{{ $member->user->id }}</td>
                  <td data="name">{{ $member->user->name }}</td>
                  <td data="committee">{{ $member->committee->name }}</td>
                  <td data="position">{{ $member->position->name }}</td>
                  <td data="year">{{ $member->year }}</td>
                  <td>
                    <button class="btn-sm btn-info" id="memberEditBtn" type="button" 
                            data-toggle="modal" data-target="#memberEditModal"
                            value="{{ $member->id }}">
                      <i class="fa fa-edit fa-fw"> </i> EDIT
                    </button>
                    <button class="btn-sm btn-danger" id="memberDeleteBtn" type="button" 
                            value="{{ $member->id }}">
                      <i class="fa fa-trash fa-fw"> </i> DELETE
                    </button>
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
        id="memberEditModal" aria-labelledby="memberEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="memberEditModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group" style="margin-bottom: 0px;">
              <label class="control-label">Name:
                <h4 id="memberEditName"></h4>
              </label>
            </div>
            <div class="form-group">
              <label class="control-label">Committee</label><br>
              <select class="form-control input-sm" id="memberEditCommittee" required>
                <optgroup label="Committees">
                  @foreach($committees as $committee)
                    <option value="{{ $committee->id }}">{{ $committee->name }}</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Position</label><br>
              <select class="form-control input-sm" id="memberEditPosition" required>
                <optgroup label="Positions">
                  @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Year</label>
              <input class="form-control" id="memberEditYear" type="number" placeholder="Year" required>
            </div>
            @include('vendor.clear')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="memberEditModalBtn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('membersTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/members/edit.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/members/delete.js"></script>
@stop