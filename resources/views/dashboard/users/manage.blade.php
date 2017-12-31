@extends('dashboard.layouts.master')
@section('title', "Manage Users")
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
          <table class="table table-hover table-bordered" id="usersTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actios</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr id="{{ $user->id }}">
                  <td>{{ $user->id }}</td>
                  <td data="name">{{ $user->name }}</td>
                  <td data="username">{{ $user->username }}</td>
                  <td data="email">{{ $user->email }}</td>
                  <td>
                    <button class="btn-sm btn-danger" id="userDeleteBtn" type="button" 
                            value="{{ $user->id }}">
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
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dashboard/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">dataTable('usersTable');</script>
  <script type="text/javascript" src="/js/dashboard/plugins/sweetalert.min.js"></script>
  <script type="text/javascript">
    $("body").delegate("button#userDeleteBtn", 'click', function(event) {
      var user_id = $(this).val();
      var name = $("tr#" + user_id + " > td[data=name]").html();
      swal({
        title: "You're going to remove\n" + name + "\nAre you sure?",
        text: "User will be deleted permanently!",
        type: "error",
        showCancelButton: true,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function(isConfirm) {
        if (isConfirm) {
          /* Ajax Code! */
          swal("Deleted!", "User has been deleted permanently!", "success");
        } else {
          swal("Cancelled", "Your data is safe.", "error");
        }
      });
    });
  </script>
@stop