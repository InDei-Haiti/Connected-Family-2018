<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;

use App\Models\Event;

class SiteController extends Controller
{

  /* DONE */
  public function home(){
    $lastEvent = Event::where('published', true)->get()->last();
    return view('public.home')->with(['event' => $lastEvent]);
  }

  public function home2(){
    $lastEvent = Event::where('published', true)->get()->last();
    return view('public.home2')->with(['event' => $lastEvent]);
  }

  /* DONE */
  public function about(){
    return view('public.about');
  }

  /* DONE */
  public function termsAndPrivacy(){
    return view('public.terms-and-privacies');
  }

  /* DONE */
  public function redirectToRegister(){
    $new_event = Event::getNewEvent();
    if($new_event)
      return redirect()->route('event-registration', ["event" => $new_event->name . "-" . $new_event->year]);
    return redirect()->route('register');
  }

  /* DONE */
  public function contactUs(){
    return view('public.contact');
  }

  /* DONE */
  public function submitContactUs(Request $request){
    $this->validate($request,[
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:64|min:8',
        'email' => 'required|email|max:128',
        'content' => 'required|string|max:255',
      ]
    );
    $fileContents = $request->input('name') . "!#~ArtistS17_#?"
                    . $request->input('email') . "!#~ArtistS17_#?"
                    . $request->input('content');
    Storage::put('contact-us/' . uniqid() . '.txt', $fileContents);
    return redirect()->back()->with(['done' => "Your message is sent to us successfully. We'll response as soon as possible. Thanks for your interest."]);
  }


}
