<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>AC Booth Registration</title>
    <style>
      body {
        background-color: white;
        background-image: url('img.jpg');
        background-size: cover;
        font-family: 'Sofia';
        font-size: 10px;
        width: 100%;
        overflow-x: hidden;
      }

      fieldset {
        padding: 10px;
        background-color: lightgray;
        border: 1px solid #CCC;
        border-radius:30px;
        margin: 2px auto;
      }

      legend {
        background: deeppink;
        padding: 7px;
        border: 1px solid #CCC;
        color:#FFF;
        border-radius: 10px;
        font-size: 18px;
        font-style: italic;
        border: 2px solid deeppink;
        cursor: default;
      }

      select {
        padding: 3px;
        width: 96%;
        display: block;
        border-radius: 14px;
        font-style: italic;
        font-size: 13px
      }

      label {
        margin-bottom: 0px;
        font-size: 16px;
        padding-left: 5px;
      }

      input {
        margin-bottom: 0px;
        display: block;
        border-radius: 15px;
        font-style: italic;
      }

      input[type="text"] {
        padding: 4px;
        width: 92%;
        font-style: italic;
        font-size: 13px;
      }

      small {
        color: rgba(255,0,0,0.8);
        font-family: 'Sofia';
        font-size: 14px;
        display: block;
      }

      .logo>img:hover{
        animation: Rotation 1s infinite linear;
      }
      @keyframes Rotation
      {
         from{
          transform:rotateZ(0deg);
        }
         to{
          transform:rotateZ(360deg);
        }
      }

      .loadpref input{
        width: 300px;
        margin: 0 auto;
        padding: 5px;
        font-size: 15px;
        font-weight: bold;
        background-color: dodgerblue;
        border: 1px;
        color: #FFF;
        font-style: italic;
        border: 2px solid dodgerblue;
      }

      .loadpref input:hover{
        color:black;
        background-color:white;
      } /* Load Preference Button */

      .buttonholder input{
        width: 100px;
        padding: 5px;
        font-size: 15px;
        font-weight:bold;
        background-color: dodgerblue;
        border: 1px;
        color: #FFF;
        font-style: italic;
        border: 2px solid dodgerblue;
        float: right;
        margin-top: -15px;
        margin-right: 15px;
      }
      .resetholder input{
        width: 100px;
        padding: 5px;
        font-size: 15px;
        font-weight:bold;
        background-color: deeppink;
        border: 1px;
        color: #FFF;
        font-style: italic;
        border: 2px solid deeppink;
        float: left;
      }
      select:focus, input:focus {
        outline: none;
      }
      select:focus {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
      }
      .buttonholder input:hover{
        color:black;
        background-color:white;
        cursor: pointer;
      } /* Register Buttons */
      .resetholder input:hover{
        color:black;
        background-color:white;
        cursor: pointer;
      } /* Register Buttons */

      .new{
        width: 70%;
        margin: 0 auto;
        border-radius: 5px;
      }
      .part1{
        width: 45%;
        float: left;
        padding-left: 10px;
      }
      .part2{
        width: 45%;
        float: right;
        padding-right: 10px;
      }
      @media (max-width: 1500px)
      {
        .new {
          width: 75%;
        }
      }
      @media (max-width: 1080px)
      {
        .new{
          width: 80%;
        }
      }
      @media (max-width: 776px)
      {
        .new {
          width: 90%;
        }
      }

    </style>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="shortcut icon" href="logo.png">
  </head>
  <body>
    <div class="logo" style="text-align: center;">
      <img src="logo.png" alt="Connected Family" height="128"
            style="
              display: inline;
              margin: -25px 0px;">
      <div style="color: white;" style="display: inline;">
        <h1>
          AC Booth Registration Form
        </h1>
        <h2>Designed By Aya Kamal</h2>
      </div>
    </div>
    <form name="register" id="reg-form">
      {{ csrf_field() }}
      <div style="display: none;">
        <div id="colleges">[@foreach($colleges as $college){"name":"{{ $college->name }}","years":{{ $college->years }}}@if(!$loop->last),@endif @endforeach]</div>{{--<div id="departments">[@foreach($departments as $department)"{{ $department->name }}"@if(!$loop->last),@endif @endforeach]</div>--}}<div id="years">[@foreach($years as $year)"{{ $year->name }}"@if(!$loop->last),@endif @endforeach]</div>
      </div>
      <div class="container">
        <div class="new">
          <fieldset>
            <legend>NEW PARTICIPANT FORM</legend>
            <div class="part1">
              <label>Name:</label>
              <input type="text" name="name" placeholder="Type Your Name">
              <small data="name"></small>
              <label>Email:</label>
              <input type="text" name="email" placeholder="Type Your Email">
              <small data="email"></small>
              <label>Mobile:</label>
              <input type="text" name="mobile" placeholder="Type Your Mobile">
              <small data="mobile"></small>
              <label>University:</label>
              <select name="uni" class="form-control" id="ei-uni-select">
                <option selected="" disabled="" value="None">Select Your University</option>
                @foreach($unis as $uni)
                  <option value="{{ $uni->name }}">{{ $uni->name }}</option>
                @endforeach
              </select>
              <small data="uni"></small>
              <div id="ei-other-uni-row">
                <label>Other University:</label>
                <input type="text" name="other_uni" placeholder="Type Your University Name">
                <small data="other_uni"></small>
              </div>
              <label>College:</label>
              <select name="college" id="ei-college-select">
                <option selected="" disabled="" value="None">Select Your College</option>
                @foreach($colleges as $college)
                  <option value="{{ $college->name }}">{{ $college->name }}</option>
                @endforeach
              </select>
              <small data="college"></small>
              <div id="ei-other-college-row">
                <label>Other College:</label>
                <input type="text" name="other_college" placeholder="Type Your College Name">
                <small data="other_college"></small>
              </div>
            </div>
            <div class="part2">
              <div id="ei-department-row">
                <label>Department:</label>
                <select name="department" id="ei-department-select">
                  <option selected="" disabled="" value="None">Select Your Department</option>
                  @foreach($department_groups as $department_group)
                    <optgroup label="{{ $department_group->name }}">
                      @foreach($department_group->departments as $department)
                        @php if($department->type == 'other') continue; @endphp
                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
                <small data="department"></small>
              </div>
              <div id="ei-other-department-row">
                <label>Other Department:</label>
                <input type="text" name="other_department" placeholder="Type Your Department Name">
                <small data="other_department"></small>
              </div>
              <label>Academic Year:</label>
              <select name="year" id="ei-year-select">
                <option selected="" disabled="" value="None">Select Your Year</option>
              </select>
              <small data="year"></small>
              <label>1<sup>st</sup> Preference:</label>
              <select name="stPreference" id="pref1-select">
                <option value="" selected="" disabled="">Select Your Preference</option>
                @foreach($preferences as $preference)
                  <option value="{{ $preference->id }}">{{ $preference->name }}</option>
                @endforeach
              </select>
              <small data="stPreference"></small>
              <label>2<sup>nd</sup> Preference:</label>
              <select name="ndPreference" id="pref2-select">
                <option value="" selected="" disabled="">Select Your Preference</option>
                @foreach($preferences as $preference)
                  <option value="{{ $preference->id }}">{{ $preference->name }}</option>
                @endforeach
              </select>
              <small data="ndPreference"></small>
              <br>
              <div class="resetholder">
                <input type="submit" value="Reset" name="registration2Reset">
              </div>
              <br>
              <div class="buttonholder">
                <input type="submit" value="Register" name="register">
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </form>
    <script type="text/javascript" src="/js/lib/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/asset/adds-on/select.education.js?<?php echo time(); ?>"></script>
    <script type="text/javascript" src="/js/asset/adds-on/select.preferences.booth.js?<?php echo time(); ?>"></script>
    <script type="text/javascript" src="/js/ajax/registration/booth.js?<?php echo time(); ?>"></script>
  </body>
</html>
