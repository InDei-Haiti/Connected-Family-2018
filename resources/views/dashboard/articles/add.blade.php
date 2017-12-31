@extends('dashboard.layouts.master')
@section('title', "Add Articles")
@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h3 class="card-title">
          Add Articles<hr>
        </h3>
        <div class="card-body">
          <form id="addArticleForm" method="POST" action="requests/add" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <label class="control-label">Title</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the article title.
                  </small>
                  <input class="form-control" name="title" id="title" type="text" placeholder="Title"  value="{{ old('title') }}">
                  @if ($errors->has('title'))
                    <small class="text-danger font-bold" id="errorMsg" data="title">
                      {{ $errors->first('title') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="control-label">Name</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the name of the article's owner.
                  </small>
                  <input class="form-control" name="name" id="name" type="text" placeholder="Name"  value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <small class="text-danger font-bold" id="errorMsg" data="name">
                      {{ $errors->first('name') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="control-label">Email</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the email of the article's owner.
                  </small>
                  <input class="form-control" name="email" id="email" type="email" placeholder="Email"  value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <small class="text-danger font-bold" id="errorMsg" data="email">
                      {{ $errors->first('email') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                  <label class="control-label">Owner Picture</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the picture of the article's owner.
                  </small>
                  <input class="form-control" name="picture" id="image" type="file">
                  @if ($errors->has('picture'))
                    <small class="text-danger font-bold" id="errorMsg" data="picture">
                      {{ $errors->first('picture') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                  <label class="control-label">Image</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the image of the article.
                  </small>
                  <input class="form-control" name="image" id="image" type="file">
                  @if ($errors->has('image'))
                    <small class="text-danger font-bold" id="errorMsg" data="image">
                      {{ $errors->first('image') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                  <label class="control-label">Content</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the article content.
                  </small>
                  <textarea class="form-control" id="content" rows="10" cols="50" placeholder="Content..." style="resize: none;" name="content">{{ old('content') }}</textarea>
                  @if ($errors->has('content'))
                    <small class="text-danger font-bold" id="errorMsg" data="content">
                      {{ $errors->first('content') }}
                    </small>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('lang') ? ' has-error' : '' }}">
                  <label class="control-label">Language</label><br>
                  <small class="text-primary font-bold">
                    In this field you define the the article language.
                  </small><br>
                  <input class="" name="lang" type="radio" value="ar" required> AR
                  <input class="" name="lang" type="radio" value="en" required> EN
                  @if ($errors->has('lang'))
                    <small class="text-danger font-bold" id="errorMsg" data="lang">
                      {{ $errors->first('lang') }}
                    </small>
                  @endif
                </div>
                <button class="btn btn-success icon-btn" id="articleSubmit" type="submit" style="float: right;">
                  <i class="fa fa-fw fa-lg fa-plus-circle"></i>
                    Add
                </button>
                @include('vendor.clear')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script type="text/javascript" src="/js/dashboard/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript">
    @if (Session::has('success'))
      $(document).ready(function() {
        $.notify({
          title: "Add Complete : ",
          message: "Article has been added successfully!",
          icon: 'fa fa-check'
        },{
          type: "success"
        });
      });
    @endif
  </script>
  {{-- <script type="text/javascript" src="/js/dashboard/asset/articles/add.js"></script> --}}
@stop
