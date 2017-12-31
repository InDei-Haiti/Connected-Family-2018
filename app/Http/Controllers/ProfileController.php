<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Helper;
use Exception;
use Validator;
use App\Models\Uni;
use App\Models\User;
use App\Models\Event;
use App\Models\Mobile;
use App\Models\College;
use App\Models\Privacy;
use App\Models\Birthday;
use App\Models\Department;
use App\Models\AcademicYear;
use App\Models\DepartmentGroup;
use App\Models\UserProfilePicture;
use App\Models\AdditionalInformation;
use App\Models\EducationalInformation;

class ProfileController extends Controller{

  /* DONE */
  public function show($username){
    $user = User::where('username', $username)->get()->first();
    if(!$user)
      return view('errors.404');
    return view('profile.profile')->with(['user' => $user, 'admin' => false]);
  }

  public function show2($username){
    $user = User::where('username', $username)->get()->first();
    if(!$user)
      return view('errors.404');
    return view('profile.profile-2')->with([
      'user' => $user,
      'admin' => false,
      'ideas' => $user->ideas->sortByDesc('created_at')
    ]);
  }

  /* DONE */
  public function admin($username){
    $user = User::where('username', $username)->get()->first();
    if(!$user)
      return view('errors.404');
    return view('profile.profile')->with(['user' => $user, 'admin' => true]);
  }

  /* DONE */
  public function showEdit($username){
    $user = User::where('username', $username)->get()->first();
    if(!$user)
      return view('errors.404');
    if(!Auth::check())
      return Auth::redirectToLogin('Login first, To be able to edit your data.');
    if(Auth::id() != $user->id)
      return redirect()->route('edit-profile', ['username' => Auth::user()->username]);
    $unis = Uni::where('type', 'main')->get()->all();
    $colleges = College::where('type', 'main')->get()->all();
    $department_groups = DepartmentGroup::all();
    $years = AcademicYear::all();
    return view('profile.edit')->with(
      [
        'user' => $user,
        'unis' => $unis,
        'colleges' => $colleges,
        'department_groups' => $department_groups,
        'years' => $years,
      ]
    );

  }

  public function edit($username, Request $request){
    // #Update Name --------------------------------------------------------------------------------------
    if($request->input('field') == 'name'){
      $validator = Validator::make($request->all(), [
        'value' => 'required|regex:/^[\pL\s\-]+$/u|max:64|min:8',
      ], [], $customAttributes = ['value' => 'name']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $user = Auth::user();
      if($user->name == $request->input('value'))
        return response()->json(['state' => 'warning', 'msg' => 'This is already your name!']);
      $user->name = $request->input('value');
      if($user->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[PI_N_ERR]']);
    }

    // #Update Email -------------------------------------------------------------------------------------
    if($request->input('field') == 'email'){
      return response()->json(['state' => 'danger', 'msg' => 'You can not update your email.']);
      $validator = Validator::make($request->all(), [
        'value' => 'required|email|unique:users,email|max:128',
      ], [
        'value.unique' => 'This is already your email!',
      ], $customAttributes = ['value' => 'email']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $user = Auth::user();
      $user->email = $request->input('value');
      if($user->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[PI_E_ERR]']);
    }

    // #Update Mobile ------------------------------------------------------------------------------------
    if($request->input('field') == 'mobile'){
      $validator = Validator::make($request->all(), [
        'value' => 'required|digits:11',
      ], [], ['value' => 'mobile']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $mobile = substr($request->input('value'), 0, 3);
      if(!in_array($mobile, ['010', '011', '012']))
        return response()->json(['state' => 'danger', 'msg' => 'Your mobile MUST start with one of these 010, 011, or 012']);
      $user = Auth::user();
      if(!$user->mobile){
        $mobile = Mobile::where('number', $request->input('value'))->get()->first();
        if($mobile)
          return response()->json(['state' => 'danger', 'msg' => 'The mobile number, you entered, is taken by someone else.']);
        $mobile = new Mobile;
        $mobile->user_id = $user->id;
        $mobile->number = $request->input('value');
        if($mobile->save())
          return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
        return response()->json(['state' => 'error', 'msg' => '[MOBERR1]']);
      }
      if($user->mobile->number == $request->input('value'))
        return response()->json(['state' => 'warning', 'msg' => 'This is already your mobile!']);
      $mobile = Mobile::where('number', $request->input('value'))->get()->first();
      if($mobile)
        return response()->json(['state' => 'danger', 'msg' => 'The mobile number, you entered, is taken by someone else.']);
      $mobile = Mobile::where('user_id', $user->id)->get()->first();
      $mobile->number = $request->input('value');
      if($mobile->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[MOBERR1]']);
    }

    // #Update Education ---------------------------------------------------------------------------------
    if($request->input('field') == 'education'){
      $validator = Validator::make($request->all(), [
        'uni' => 'required|exists:unis,name',
        'other_uni' => 'required_if:uni,Other',
        'college' => 'required|exists:colleges,name',
        'other_college' => 'required_if:college,Other',
        'department' => 'required_if:college,Faculty of Engineering',
        'other_department' => 'required_if:department,Other',
        'year' => 'required|exists:academic_years,name',
      ], [
        'other_uni.required_if' => 'The other university field is required.',
        'other_college.required_if' => 'The other college field is required.',
        'other_department.required_if' => 'The other department field is required.',
        'department.required_if' => 'The department field is required when college is Faculty of Engineering.',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      /*Required if rules*/
      // get other uni if required
      if($request->input('uni') == "Other"){
        $validator = Validator::make($request->all(), [
          'other_uni' => 'regex:/^[\pL\s\-]+$/u|max:50|min:3',
        ]);
        // response errors
        if ($validator->fails()) return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      }
      // get other college if required
      if($request->input('college') == "Other"){
        $validator = Validator::make($request->all(), [
          'other_college' => 'regex:/^[\pL\s\-]+$/u|max:50|min:3',
        ]);
        // response errors
        if ($validator->fails()) return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      }
      // get department if required
      if($request->input('college') == "Faculty of Engineering"){
        $validator = Validator::make($request->all(), [
          'department' => 'exists:departments,name'
        ],[
          'department.exists' => 'The selected department is invalid.'
        ]);
        // response errors
        if ($validator->fails()) return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      }
      // get other department if required
      if($request->input('department') == "Other"){
        $validator = Validator::make($request->all(), [
          'other_department' => 'regex:/^[\pL\s\-]+$/u|max:50|min:10',
        ]);
        // response errors
        if ($validator->fails()) return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      }
      $user = Auth::user();
      $uni = Uni::where('name', $request->input('uni'))->get()->first()->id;
      if($request->input('uni') == "Other"){
        $newUni = new Uni;
        $newUni->name = $request->input('other_uni');
        $newUni->save();
        $uni = $newUni->id;
      }
      $college = College::where('name', $request->input('college'))->get()->first()->id;
      if($request->input('college') == "Other"){
        $newCollege = new College;
        $newCollege->name = $request->input('other_college');
        $newCollege->save();
        $college = $newCollege->id;
      }
      if($request->input('college') != "Faculty of Engineering") $department = NULL;
      else if($request->input('department') == "Other"){
        $newDepartment = new Department;
        $newDepartment->name = $request->input('other_department');
        $newDepartment->save();
        $department = $newDepartment->id;
      } else $department = Department::where('name', $request->input('department'))->get()->first()->id;
      $year = AcademicYear::where('name', $request->input('year'))->get()->first()->id;
      if($user->educationalInformation) $ei = $user->educationalInformation;
      else $ei = new EducationalInformation;
      $ei->user_id = $user->id;
      $ei->uni_id = $uni;
      $ei->college_id = $college;
      $ei->department_id = $department;
      $ei->academic_year_id = $year;
      if($ei->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[EDU_ERR]']);
    }

    // #Update Privacies ---------------------------------------------------------------------------------
    if($request->input('field') == 'privacy'){
      $validator = Validator::make($request->all(), [
        'mobile' => 'required|boolean',
        'email' => 'required|boolean',
        'education' => 'required|boolean',
        'birthday' => 'required|boolean',
        'facebook' => 'required|boolean',
        'linkedin' => 'required|boolean',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'errors' => $validator->errors()]);
      $user = Auth::user();
      foreach (['mobile', 'email', 'education', 'birthday', 'facebook', 'linkedin'] as $attribute) {
        $p = Privacy::where('user_id', $user->id)->where('attribute', $attribute)->get()->first();
        if(!$p){
          $p = new Privacy;
          $p->user_id = $user->id;
          $p->attribute = $attribute;
        }
        $p->value = $request->input($attribute);
        $p->save();
      }
      return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
    }

    // #Update Nickname ----------------------------------------------------------------------------------
    if($request->input('field') == 'nickname'){
      $validator = Validator::make($request->all(), [
        'value' => 'required|alpha_num|max:15|min:2',
      ], [], ['value' => 'nickname']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $user = Auth::user();
      if($user->additionalInformations)
        if($user->additionalInformations->nickname == $request->input('value'))
          return response()->json(['state' => 'warning', 'msg' => 'This is already your nickname!']);
      if($user->additionalInformations)
        $ai = $user->additionalInformations;
      else {
        $ai = new AdditionalInformation;
        $ai->user_id = $user->id;
      }
      $ai->nickname = $request->input('value');
      if($ai->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[NK_ERR]']);
    }

    // #Update Bio ---------------------------------------------------------------------------------------
    if($request->input('field') == 'bio'){
      $validator = Validator::make($request->all(), [
        'value' => 'required|string|max:128|min:16',
      ], [], ['value' => 'bio']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $user = Auth::user();
      if($user->additionalInformations)
        if($user->additionalInformations->bio == $request->input('value'))
          return response()->json(['state' => 'warning', 'msg' => 'This is already your bio!']);
      if($user->additionalInformations)
        $ai = $user->additionalInformations;
      else {
        $ai = new AdditionalInformation;
        $ai->user_id = $user->id;
      }
      $ai->bio = $request->input('value');
      if($ai->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[BI_ERR]']);
    }

    // #Update Birthday ----------------------------------------------------------------------------------
    if($request->input('field') == 'birthday'){
      $validator = Validator::make($request->all(), [
        'value' => 'required|date',
      ], [], ['value' => 'birthday']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'msg' => $validator->errors()->toArray()['value']]);
      $user = Auth::user();
      if($user->birthday)
        $birthday = $user->birthday;
      else {
        $birthday = new Birthday;
        $birthday->user_id = $user->id;
      }
      $birthday->day = (int) explode('-', $request->input('value'))[2];
      $birthday->month = (int) explode('-', $request->input('value'))[1];
      $birthday->year = (int) explode('-', $request->input('value'))[0];
      if($birthday->save())
        return response()->json(['state' => 'success', 'msg' => 'Your data has been updated.']);
      return response()->json(['state' => 'error', 'msg' => '[BIR_ERR]']);
    }

    // #Update Profile Picture ---------------------------------------------------------------------------
    if($request->input('field') == 'picture'){
      $validator = Validator::make($request->all(), [
        'picture' => 'required|mimes:jpeg,png|max:1024',
      ]);
      if ($validator->fails())
        return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => $validator->errors()->toArray()['picture'][0]]]);
      $user = Auth::user();
      if(count($user->memberHistories) == 0)
        return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => 'You don\'t have the ability to update your profile picture. Reload the page to update your profile avatar.']]);
      if(!$user->emailConfirmation)
        return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => 'You\'ve to confirm your email first to be able to update your profile picture.']]);
      if(!$user->emailConfirmation->confirmed)
        return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => 'You\'ve to confirm your email first to be able to update your profile picture.']]);
      if($user->image) {
        $user_image_time = (int) date('yn', strtotime($user->image->updated_at));
        $current_time = (int) date('yn', time());
        if($user_image_time == $current_time)
          return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => 'You have already updated your photo this month!']]);
        $user_image = $user->image;
      } else {
        $user_image = new UserProfilePicture;
        $user_image->user_id = $user->id;
      }
      $user_image->src = basename($request->picture->store('public/imgs/original/pictures'));
      if($user_image->save()){
        Helper::run('ImgScaler');
        // Helper::run('ImgRemover');
        return redirect()->back()->with(['picture' => ['state' => 'success', 'msg' => 'Your profile picture has been updated.']]);
      }
      return redirect()->back()->with(['picture' => ['state' => 'danger', 'msg' => 'Error uploading your profile picture. Try again and if the same message is appeared feel free to contact us at <a href="mailto:it@connected-family.org">it@connected-family.org</a> and describe your issue.']]);

    }







  }




}
