@extends('layouts.master')
@section('title')
  {{ $user->name }} Profile Edit
@stop
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-md-3 d-md-block d-none fixed">
      <div class="list-group" id="hash-btn-div">
        <button id="hash-btn" href="#pp-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer active">
          @if(count($user->memberHistories) > 0)
            <i class="fa fa-picture-o fa-fw" aria-hidden="true"> </i> | 
            Picture
          @else
            <i class="fa fa-user-circle fa-fw" aria-hidden="true"> </i> | 
            Avatar
          @endif
        </button>
        <button id="hash-btn" href="#bi-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer">
          <i class="fa fa-info-circle fa-fw" aria-hidden="true"> </i> | 
          Basic
        </button>
        <button id="hash-btn" href="#ei-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer">
          <i class="fa fa-graduation-cap fa-fw" aria-hidden="true"> </i> | 
          Education
        </button>
        <button id="hash-btn" href="#si-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer">
          <i class="fa fa-link fa-fw" aria-hidden="true"> </i> | 
          Social
        </button>
        <button id="hash-btn" href="#ai-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer">
          <i class="fa fa-universal-access fa-fw" aria-hidden="true"> </i> | 
          Additional
        </button>
        <button id="hash-btn" href="#p-card" type="button" 
                class="list-group-item list-group-item-action cursor-pointer">
          <i class="fa fa-user-secret fa-fw" aria-hidden="true"> </i> | 
          Privacy
        </button>
      </div>
    </div>
    <div class="col-md-1 d-md-block d-none"></div>
    <div class="col-md-8 offset-md-4">
      <div class="card" id="pp-card">
        @if(count($user->memberHistories) > 0)
          <div class="card-header">
            <div class="row">
              <div class="col-10 align-self-center">
                <h5>
                  <i class="fa fa-picture-o" aria-hidden="true"></i> |
                  <b>Profile Picture</b>
                </h5>
              </div>
            </div>
          </div>
          <div class="card-body clear-card">
            <form id="pp-picture-form" accept="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col align-self-lg-center">
                  <i class="fa fa-file-image-o fa-fw" aria-hidden="true"></i> |
                  <span class="text-muted text-uppercase">Upload file</span>
                </div>
              </div>
              <div class="clearfix d-none d-md-block"><br></div>
              <div class="row">
                <div class="col align-self-lg-center">
                  <div class="form-group">
                    <div class="clearfix d-block d-sm-none"><br></div>
                    <input class="form-control" type="file" id="pp-picture-input" name="picture">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="field" value="picture">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="type" value="pp">
                    <small id="pp-picture-text" class="form-text
                      @if(Session::has('picture'))
                        text-{{ Session::get('picture')['state'] }}
                      @endif
                    font-weight-bold">
                      @if(Session::has('picture'))
                        {!! Session::get('picture')['msg'] !!}
                      @endif
                    </small>
                    <small class="form-text text-muted font-weight-bold">
                      * <span class="text-primary">You can update your photo one time per month</span>.<br>
                      * <span class="text-primary">When uploading this may take a few more seconds than usual; due to photo scaling and resizing</span>.<br>
                      * Allowed formats are png and jpeg(jpg) only.<br>
                      * Max photo size is 1MB.<br>
                      * It's prefered that you upload a square picture else we'll crop it for you to be centered squared picture.
                    </small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col text-right align-self-lg-center">
                  <button id="pp-picture-btn" class="btn btn-md btn-success text-uppercase cursor-pointer" disabled="disabled">upload &amp; update profile picture</button>
                </div>
              </div>
            </form>
          </div>
        @else
          <div class="card-header">
            <div class="row">
              <div class="col-10 align-self-center">
                <h5>
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i> |
                  <b>Profile Avatar</b>
                </h5>
              </div>
            </div>
          </div>
          <div class="card-body clear-card">
            You can not update your profile avatar. We are working on this edit.
          </div>
        @endif
      </div>
      @include('vendor.clear')
      <div class="card" id="bi-card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 align-self-center">
              <h5>
                <i class="fa fa-info-circle" aria-hidden="true"></i> |
                <b>Basic Information</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-user fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">name</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <input class="form-control" type="text" id="bi-name-input" 
                          value="{{ $user->name }}">
                  <small id="bi-name-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="bi-name-btn" target="name" class="btn btn-md btn-success text-uppercase cursor-pointer">update name</button>
              </div>
            </div>
          </form>
          <hr>
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-envelope fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">email</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <input class="form-control" type="text" id="bi-email-input" 
                          value="{{ $user->email }}" disabled="">
                  <small id="bi-email-text" class="form-text font-weight-bold">You can not update your email. We are working on this edit.</small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="bi-email-btn" target="email" class="btn btn-md btn-success text-uppercase cursor-pointer" disabled="">update email</button>
              </div>
            </div>
          </form>
          <hr>
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-mobile fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">mobile</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <input class="form-control" type="text" id="bi-mobile-input" 
                          value="@php
                            if($user->mobile)
                              echo $user->mobile->number;
                          @endphp">
                  <small id="bi-mobile-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="bi-mobile-btn" target="mobile" class="btn btn-md btn-success text-uppercase cursor-pointer">update mobile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @include('vendor.clear')
      <div class="card" id="ei-card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 align-self-center">
              <h5>
                <i class="fa fa-graduation-cap" aria-hidden="true"></i> |
                <b>Educational Information</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <div class="d-none">
            <div id="colleges">[@foreach($colleges as $college){"name":"{{ $college->name }}","years":{{ $college->years }}}@if(!$loop->last),@endif @endforeach]</div>{{--<div id="departments">[@foreach($departments as $department)"{{ $department->name }}"@if(!$loop->last),@endif @endforeach]</div>--}}<div id="years">[@foreach($years as $year)"{{ $year->name }}"@if(!$loop->last),@endif @endforeach]</div>
          </div>
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">education</span><br>
                @if($user->educationalInformation)
                  <b><span id="ei-holder">{{ $user->educationalInformation->academic_year->name }}
                  @if($user->educationalInformation->department)
                    - {{ $user->educationalInformation->department->name }}
                  @endif
                  <br>
                  {{ $user->educationalInformation->college->name }} -
                  {{ $user->educationalInformation->uni->name }}</span></b>
                  <br>
                @else
                  <b><span id="ei-holder">NOT AVAILABLE</span></b><br>
                  *<span class="text-warning">You have to add your education!</span>
                @endif
                <hr>
                * <small class="text-primary font-weight-bold">You can update your education from the form below.</small><br>
                * <small class="text-warning font-weight-bold">It's recommended to choose your education and avoid adding new college or department; As some preferences are shown/hidden according to those data.</small>
                <br><br>
                <div class="form-group" id="ei-uni-row">
                  <label for="ei-uni-select">University</label>
                  <select class="form-control" id="ei-uni-select">
                    <option selected="" disabled="" value="None">Select your university</option>
                    @foreach($unis as $uni)
                      <option value="{{ $uni->name }}">{{ $uni->name }}</option>
                    @endforeach
                  </select>
                  <small id="ei-uni-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-other-uni-row">
                  <label for="ei-other-uni-input">Other University Name</label>
                  <input class="form-control" type="text" id="ei-other-uni-input" value="">
                  <small id="ei-other-uni-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-college-row">
                  <label for="ei-college-select">College</label>
                  <select class="form-control" id="ei-college-select">
                    <option selected="" disabled="" value="None">Select your college</option>
                    @foreach($colleges as $college)
                      <option value="{{ $college->name }}">{{ $college->name }}</option>
                    @endforeach
                  </select>
                  <small id="ei-college-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-other-college-row">
                  <label for="ei-other-college-input">Other College Name</label>
                  <input class="form-control" type="text" id="ei-other-college-input" value="">
                  <small id="ei-other-college-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-department-row">
                  <label for="ei-department-select">Department</label>
                  <select class="form-control" id="ei-department-select">
                    <option selected="" disabled="" value="None">Select your department</option>
                    @foreach($department_groups as $department_group)
                      <optgroup label="{{ $department_group->name }}">
                        @foreach($department_group->departments as $department)
                          @php if($department->type == 'other') continue; @endphp
                          <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                      </optgroup>
                    @endforeach
                  </select>
                  <small id="ei-department-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-other-department-row">
                  <label for="ei-other-department-input">Other Department Name</label>
                  <input class="form-control" type="text" id="ei-other-department-input" value="">
                  <small id="ei-other-department-text" class="form-text font-weight-bold"></small>
                </div>
                <div class="form-group" id="ei-year-row">
                  <label for="ei-year-select">Year</label>
                  <select class="form-control" id="ei-year-select">
                    <option selected="" disabled="" value="None">Select your year</option>
                  </select>
                  <small id="ei-year-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="ei-btn" type="submit" class="btn btn-md btn-success text-uppercase cursor-pointer">update education</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @include('vendor.clear')
      <div class="card" id="si-card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 align-self-center">
              <h5>
                <i class="fa fa-link" aria-hidden="true"></i> |
                <b>Social Links</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <div class="row">
            <div class="col-md-6 align-self-lg-center">
              <i class="fa fa-facebook-square fa-fw" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">facebook</span>
            </div>
            <div class="col-md-6 text-right align-self-lg-center">
              @if($user->socialLink("facebook") && $user->socialInformation("facebook")->linked)
                <span class="text-primary font-weight-bold">
                  <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                  Connected
                </span>
              @else
                <a class="btn btn-sm btn-primary bg-fb" href="{{ route('auth.social', ['provider' => 'facebook', 'wants' => 'connect']) }}" role="button">
                  <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i> 
                  Connect to Facebook
                </a>
              @endif
            </div>
          </div>         
          <hr>
          <div class="row">
            <div class="col-md-6 align-self-lg-center">
              <i class="fa fa-linkedin-square fa-fw" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">linkedin</span>
            </div>
            <div class="col-md-6 text-right align-self-lg-center">
              @if($user->socialLink("linkedin") && $user->socialInformation("linkedin")->linked)
                <span class="text-primary font-weight-bold">
                  <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                  Connected
                </span>
              @else
                <a class="btn btn-sm btn-primary bg-linkedin" href="{{ route('auth.social', ['provider' => 'linkedin', 'wants' => 'connect']) }}" role="button">
                  <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i> 
                  Connect to Linkedin
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @include('vendor.clear')  
      <div class="card" id="ai-card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 align-self-center">
              <h5>
                <i class="fa fa-universal-access" aria-hidden="true"></i> |
                <b>Additional Information</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-fire fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">nickname</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <input class="form-control" type="text" id="ai-nickname-input" 
                          value="@php
                              if($user->additionalInformations)
                                echo $user->additionalInformations->nickname;
                            @endphp">
                  <small id="ai-nickname-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="ai-nickname-btn" target="nickname" type="submit" class="btn btn-md btn-success text-uppercase cursor-pointer">update nickname</button>
              </div>
            </div>
            <hr>
          </form>
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">birthday</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <input class="form-control" type="date" id="ai-birthday-input" 
                          value="@php
                              if($user->birthday)
                                echo $user->birthday->editFormat();
                            @endphp">
                  <small class="form-text font-weight-bold">
                    *<span class="text-primary">
                      The birthday format is mm/dd/yyyy (Month, Day, Year).<br>
                    </span>
                    *<span class="text-primary">
                      The format may vary according to your browser, So it's recommended that you use the drop down calendar.
                    </span>
                  </small>
                  <small id="ai-birthday-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="ai-birthday-btn" target="birthday" type="submit" class="btn btn-md btn-success text-uppercase cursor-pointer">update birthday</button>
              </div>
            </div>
            <hr>
          </form>
          <form>
            <div class="row">
              <div class="col align-self-lg-center">
                <i class="fa fa-vcard-o fa-fw" aria-hidden="true"></i> |
                <span class="text-muted text-uppercase">bio</span>
              </div>
            </div>
            <div class="clearfix d-none d-md-block"><br></div>
            <div class="row">
              <div class="col align-self-lg-center">
                <div class="form-group">
                  <div class="clearfix d-block d-sm-none"><br></div>
                  <textarea class="form-control" id="ai-bio-input" rows="2" cols="50" 
                            style="resize: none;">@php
                              if($user->additionalInformations)
                                echo $user->additionalInformations->bio;
                            @endphp</textarea>
                  <small id="ai-bio-text" class="form-text font-weight-bold"></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col text-right align-self-lg-center">
                <button id="ai-bio-btn" target="bio" type="submit" class="btn btn-md btn-success text-uppercase cursor-pointer">update bio</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @include('vendor.clear')
      <div class="card" id="p-card">
        <div class="card-header">
          <h5>
            <i class="fa fa-user-secret" aria-hidden="true"></i> | 
            <b>Privacy</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          <label class="custom-control custom-checkbox">
            <input id="p-check-mobile" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("mobile"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show mobile to public</span>
          </label>
          <br>
          <label class="custom-control custom-checkbox">
            <input id="p-check-email" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("email"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show email to public</span>
          </label>
          <br>
          <label class="custom-control custom-checkbox">
            <input id="p-check-education" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("education"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show education to public</span>
          </label>
          <br>
          <label class="custom-control custom-checkbox">
            <input id="p-check-birthday" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("birthday"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show birthday to public</span>
          </label>
          <br>
          <label class="custom-control custom-checkbox">
            <input id="p-check-facebook" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("facebook"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show facebook to public</span>
          </label>
          <br>
          <label class="custom-control custom-checkbox">
            <input id="p-check-linkedin" type="checkbox" class="custom-control-input" @php
              if($user->checkPrivacy("linkedin"))
                echo "checked";
            @endphp>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Show linkedin to public</span>
          </label>
          <br>
          <small id="p-text" class="form-text font-weight-bold"></small>
          <div class="row">
            <div class="col text-right align-self-lg-center">
              <button id="p-btn" class="btn btn-md btn-success text-uppercase cursor-pointer">update privacy</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
@section('scripts')
  <script type="text/javascript" src="/js/ajax/profile/setup.js"></script>
  <script type="text/javascript" src="/js/ajax/profile/update.basicInformation.js?t={{ time() }}"></script>
  <script type="text/javascript" src="/js/ajax/profile/update.educationalInformation.js?t={{ time() }}"></script>
  <script type="text/javascript" src="/js/ajax/profile/update.privacies.js?t={{ time() }}"></script>
  <script type="text/javascript" src="/js/ajax/profile/update.additionalInformation.js?t={{ time() }}"></script>
  <script type="text/javascript" src="/js/ajax/profile/update.profilePicture.js"></script>
  <script type="text/javascript" src="/js/asset/adds-on/select.education.js"></script>
  <script type="text/javascript">
    $(document).ready(function() { 
      scrollSpySetup();
      setTimeout(function (){ 
        screenSetup();
        @if(Session::has('scrollTo'))
          if($("#{{ Session::get('scrollTo') }}-card").length)
            $('html, body').animate({
              scrollTop: $("#{{ Session::get('scrollTo') }}-card").offset().top - 94
            }, 500);
        @endif
        if($(document).scrollTop() != 0)
          $('html, body').animate({
            scrollTop: $(document).scrollTop() + 1
          }, 500);
      }, 200);
      @if(Session::has('si-errors'))
        myAlert('danger', "{!! Session::get('si-errors') !!}");
      @endif
    });
  </script>
@stop
