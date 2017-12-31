@extends('dashboard.layouts.master')
@section('title', "Manage Admins")
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
          <table class="table table-hover table-bordered" id="adminsTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Abilities</th>
                <th>Actios</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admins as $admin)
                <tr id="{{ $admin->id }}">
                  <td data="id">{{ $admin->user->id }}</td>
                  <td data="name">{{ $admin->user->name }}</td>
                  <td data="abilities">
                    @if($admin->abilities)
                      @foreach($admin->abilities as $ability)
                       {{ $ability->name }}@if(!$loop->last), @endif
                      @endforeach
                    @else
                      No Abilities Found!
                    @endforelse
                  </td>
                  <td>
                    <button class="btn-sm btn-info" id="adminEditBtn" type="button"
                            data-toggle="modal" data-target="#adminEditModal"
                            value="{{ $admin->id }}">
                      <i class="fa fa-edit fa-fw"> </i> EDIT
                    </button>
                    <button class="btn-sm btn-danger" id="adminDeleteBtn" type="button"
                            value="{{ $admin->id }}">
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
        id="adminEditModal" aria-labelledby="adminEditModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="adminEditModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group" style="margin-bottom: 0px;">
              <label class="control-label">Name:
                <h4 id="adminEditName"></h4>
              </label>
            </div>
            <div class="form-group">
              <label class="control-label">Committee</label><br>
              <select class="form-control input-sm" id="adminEditCommittee" required>

              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Position</label><br>
              <select class="form-control input-sm" id="adminEditPosition" required>

              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Year</label>
              <input class="form-control" id="adminEditYear" type="number" placeholder="Year" required>
            </div>
            @include('vendor.clear')
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="adminEditModalBtn">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('adminsTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/select2.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/admins/edit.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/asset/admins/delete.js"></script>
@stop
