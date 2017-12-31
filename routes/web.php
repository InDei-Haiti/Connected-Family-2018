<?php

include 'web-test.php';

// >> Site
Route::get('/', [
  'uses' => 'SiteController@home',
  'as' => 'home'
]);
Route::get('about', [
  'uses' => 'SiteController@about',
  'as' => 'about'
]);
Route::get('registration', [
  'uses' => 'SiteController@redirectToRegister'
]);
Route::get('terms-and-privacies', [
  'uses' => 'SiteController@termsAndPrivacy',
  'as' => 'terms-and-privacies'
]);
Route::get('contact-us', [
  'uses' => 'SiteController@contactUs',
  'as' => 'public.contact-us'
]);
Route::post('contact-us', [
  'uses' => 'SiteController@submitContactUs'
]);

// >> Crew
Route::get('crew/{year?}', [
  'uses' => 'CrewController@show',
  'as' => 'crew'
]);
Route::get('crew/{year}/export', [
  'uses' => 'CrewController@export',
  'as' => 'crew'
])->middleware('ability:full');

// >> Booth Registration
Route::group(['prefix' => 'booth-registration'], function () {
  // >> view
  Route::get('/', [
    'uses' => 'BoothRegistrationController@index',
    'as' => 'booth-registration'
  ]);
  // Requests
  Route::post('/', [
    'uses' => 'BoothRegistrationController@register',
  ]);
});

// >> Committees
Route::get('committees', [
  'uses' => 'CommitteeController@all',
  'as' => 'committees'
]);
Route::get('committee/{short_name}/{year?}', [
  'uses' => 'CommitteeController@show',
  'as' => 'committee'
]);

// >> Events
Route::get('events', [
  'uses' => 'EventController@all',
  'as' => 'events'
]);
Route::group(['prefix' => 'event/{event}'], function ($event) {
  // >> Event
  Route::get('/', [
    'uses' => 'EventController@show',
    'as' => 'event'
  ]);
  // >> Registration
  Route::group(['prefix' => 'registration'], function ($event) {
      // >> Register
    Route::get('', [
      'uses' => 'EventController@showRegister',
      'as' => 'event-registration'
    ]);
      Route::post('', [
      'uses' => 'EventController@register'
    ]);
    // >> Tracking
    Route::get('tracking', [
      'uses' => 'EventController@showTracking',
      'as' => 'event-registration-tracking'
    ]);
  });
  // >> Interview Selection
  Route::get('interview', [
    'uses' => 'InterviewController@show',
    'as' => 'interview-selection'
  ]);
    Route::post('interview', [
    'uses' => 'InterviewController@select'
  ]);
  // Stop here ------------------------------------------------------------------------------------
  return;
  // >> GroupDiscussion Selection
  Route::get('group-discussion', [
    'uses' => 'GroupDiscussionController@show',
    'as' => 'group-discussion-selection'
  ]);
    Route::post('group-discussion', [
    'uses' => 'GroupDiscussionController@select'
  ]);
  // >> PST
  Route::get('pst', [
    'uses' => 'PSTController@show',
    'as' => 'pst'
  ]);
    Route::post('pst', [
    'uses' => 'PSTController@end'
  ]);
});

// >> Auth
Route::group(['prefix' => 'auth'], function () {
  // >> Register
  Route::get('register', [
    'uses' => 'Auth\RegisterController@show',
    'as' => 'register'
  ]);
    Route::post('register', [
    'uses' => 'Auth\RegisterController@register'
  ]);
    Route::get('register/request-email-confirmation', [
    'uses' => 'Auth\RegisterController@sendRequest',
    'as' => 'request-email-confirmation'
  ]);
    Route::get('register/{token}', [
    'uses' => 'Auth\RegisterController@confirm'
  ]);
  // >> Login
  Route::get('login', [
    'uses' => 'Auth\LoginController@show',
    'as' => 'login'
  ]);
    Route::post('login', [
    'uses' => 'Auth\LoginController@login'
  ]);
  // >> Logout
  Route::post('logout', [
    'uses' => 'Auth\LogoutController@logout',
    'as' => 'logout'
  ]);
  // >> Reset Password
  Route::get('reset-password-request', [
    'uses' => 'Auth\ResetPasswordController@showRequest',
    'as' => 'reset-password-request'
  ]);
    Route::post('reset-password-request', [
    'uses' => 'Auth\ResetPasswordController@request',
    'as' => 'send-reset-password-request'
  ]);
    Route::get('reset-password/{token}', [
    'uses' => 'Auth\ResetPasswordController@showReset',
  ]);
    Route::post('reset-password', [
    'uses' => 'Auth\ResetPasswordController@reset',
    'as' => 'reset-password'
  ]);

  // >> Social
  Route::group(['prefix' => 'social'], function () {
      // >> Facebook
    Route::get('{provider}/callback/{wants?}', [
      'uses' => 'Auth\AutoAuthController@habdleProviderCallback',
      'as' => 'auth.social.callback'
    ]);
      Route::get('{provider}/{wants?}', [
      'uses' => 'Auth\AutoAuthController@redirectToProvider',
      'as' => 'auth.social'
    ]);
  });
});

// >> Profile
Route::group(['prefix' => 'profile'], function () {
  // >> Show
  Route::get('{username}', [
    'uses' => 'ProfileController@show',
    'as' => 'profile'
  ]);
  // >> Edit
  Route::get('{username}/edit', [
    'uses' => 'ProfileController@showEdit',
    'as' => 'edit-profile'
  ]);
  Route::patch('{username}/edit', [
    'uses' => 'ProfileController@edit',
    'as' => 'patch-edit-profile'
  ]);
  Route::get('{username}/admin', [
    'uses' => 'ProfileController@admin',
    'as' => 'admin.view.profile'
  ])->middleware('ability:full');
  // >> Requests
  Route::group(['prefix' => '{username}/requests'], function () {
    Route::group(['prefix' => 'idea'], function () {
      Route::put('add', [
        'uses' => 'IdeaController@add',
        'as' => 'put-idea'
      ]);
    });
  });
  // >> ?
});


// >> Helpers
Route::get('Helper/{function}/{token?}', [
  'uses' => 'HelperController@handler',
  'as' => 'helper'
]);

// >> Dashboard
Route::group(['prefix' => 'dashboard'], function () {
    // >> home
  Route::get('', [
    'uses' => 'Dashboard\DashboardController@show',
    'as' => 'dashboard'
  ])->middleware('ability:all');

  // >> Recruitment
  Route::group(['prefix' => 'recruitment'], function () {
    Route::get('interviews', [
      'uses' => 'Dashboard\RecruitmentController@showInterveiws',
      'as' => 'dashboard.recruitment.interviews'
    ])->middleware('ability:recruitment');
    Route::get('participants', [
      'uses' => 'Dashboard\RecruitmentController@showParticipants',
      'as' => 'dashboard.recruitment.participants'
    ])->middleware('ability:recruitment');
    Route::group(['prefix' => 'requests'], function () {
      Route::delete('delete', [
        'uses' => 'Dashboard\RecruitmentController@doInterviewDelete',
        'as' => 'dashboard.recruitment.interviews.delete.request'
      ])->middleware('ability:recruitment');
      Route::get('export-participants', [
        'uses' => 'Dashboard\RecruitmentController@doExportParticipants',
        'as' => 'dashboard.recruitment.participants.export.request'
      ])->middleware('ability:recruitment');
      Route::patch('state-participant', [
        'uses' => 'Dashboard\RecruitmentController@stateParticipant',
        'as' => 'dashboard.events.edit.request'
      ])->middleware('ability:recruitment');
      /*
      Route::put('add', [
        'uses' => 'Dashboard\EventController@doAdd',
        'as' => 'dashboard.events.add.request'
      ])->middleware('ability:events.add');
      Route::patch('publish', [
        'uses' => 'Dashboard\EventController@doPublish',
        'as' => 'dashboard.events.publish.request'
      ])->middleware('ability:events.manage');
      */
      });
  });

  // >> events
  Route::group(['prefix' => 'events'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\EventController@showAdd',
      'as' => 'dashboard.events.add'
    ])->middleware('ability:events.add');
    Route::get('manage', [
      'uses' => 'Dashboard\EventController@showManage',
      'as' => 'dashboard.events.manage'
    ])->middleware('ability:events.manage');
    Route::get('statistics/{event}', [
      'uses' => 'Dashboard\EventController@showStatistics',
      'as' => 'dashboard.events.statistics'
    ])->middleware('ability:events.statistics');
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\EventController@doAdd',
        'as' => 'dashboard.events.add.request'
      ])->middleware('ability:events.add');
      Route::patch('edit', [
        'uses' => 'Dashboard\EventController@doEdit',
        'as' => 'dashboard.events.edit.request'
      ])->middleware('ability:events.manage');
      Route::delete('delete', [
        'uses' => 'Dashboard\EventController@doDelete',
        'as' => 'dashboard.events.delete.request'
      ])->middleware('ability:events.manage');
      Route::patch('publish', [
        'uses' => 'Dashboard\EventController@doPublish',
        'as' => 'dashboard.events.publish.request'
      ])->middleware('ability:events.manage');
    });
  });

  // >> preferences
  Route::group(['prefix' => 'preferences'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\PreferenceController@showAdd',
      'as' => 'dashboard.preferences.add'
    ])->middleware('ability:preferences.add');
    Route::get('manage', [
      'uses' => 'Dashboard\PreferenceController@showManage',
      'as' => 'dashboard.preferences.manage'
    ])->middleware('ability:preferences.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\PreferenceController@doAdd',
        'as' => 'dashboard.preferences.add.request'
      ])->middleware('ability:preferences.add');
      Route::patch('edit', [
        'uses' => 'Dashboard\PreferenceController@doEdit',
        'as' => 'dashboard.preferences.edit.request'
      ])->middleware('ability:preferences.manage');
      Route::delete('delete', [
        'uses' => 'Dashboard\PreferenceController@doDelete',
        'as' => 'dashboard.preferences.delete.request'
      ])->middleware('ability:preferences.manage');
    });
  });

  // >> interviews
  Route::group(['prefix' => 'interviews'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\InterviewController@showAdd',
      'as' => 'dashboard.interviews.add'
    ])->middleware('ability:interviews.add');
    Route::get('manage', [
      'uses' => 'Dashboard\InterviewController@showManage',
      'as' => 'dashboard.interviews.manage'
    ])->middleware('ability:interviews.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\InterviewController@doAdd',
        'as' => 'dashboard.interviews.add.request'
      ])->middleware('ability:interviews.add');
      Route::patch('edit', [
        'uses' => 'Dashboard\InterviewController@doEdit',
        'as' => 'dashboard.interviews.edit.request'
      ])->middleware('ability:interviews.manage');
      Route::delete('delete', [
        'uses' => 'Dashboard\InterviewController@doDelete',
        'as' => 'dashboard.interviews.delete.request'
      ])->middleware('ability:interviews.manage');
      });
  });

  // >> group_discussions
  Route::group(['prefix' => 'group_discussions'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\GroupDiscussionController@showAdd',
      'as' => 'dashboard.group_discussions.add'
    ])->middleware('ability:group_discussions.add');
    Route::get('manage', [
      'uses' => 'Dashboard\GroupDiscussionController@showManage',
      'as' => 'dashboard.group_discussions.manage'
    ])->middleware('ability:group_discussions.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\GroupDiscussionController@doAdd',
        'as' => 'dashboard.group_discussions.add.request'
      ])->middleware('ability:group_discussions.add');
      Route::patch('edit', [
        'uses' => 'Dashboard\GroupDiscussionController@doEdit',
        'as' => 'dashboard.group_discussions.edit.request'
      ])->middleware('ability:group_discussions.manage');
      Route::delete('delete', [
        'uses' => 'Dashboard\GroupDiscussionController@doDelete',
        'as' => 'dashboard.group_discussions.delete.request'
      ])->middleware('ability:group_discussions.manage');
      });
  });

  // >> users
  Route::group(['prefix' => 'users'], function () {
    Route::get('manage', [
      'uses' => 'Dashboard\UserController@showManage',
      'as' => 'dashboard.users.manage'
    ])->middleware('ability:users.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::post('delete', [
        'uses' => 'Dashboard\UserController@doDelete',
        'as' => 'dashboard.users.delete.request'
      ])->middleware('ability:users.manage');
    });
  });

  // >> participants
  Route::group(['prefix' => 'participants'], function () {
    Route::get('manage', [
      'uses' => 'Dashboard\ParticipantsController@show',
      'as' => 'dashboard.participants.manage'
    ])->middleware('ability:participants.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::get('export', [
        'uses' => 'Dashboard\ParticipantsController@export',
        'as' => 'dashboard.participants.export.request'
      ])->middleware('ability:participants.manage');
      Route::patch('state', [
        'uses' => 'Dashboard\ParticipantsController@state',
        'as' => 'dashboard.participants.state.request'
      ])->middleware('ability:participants.manage');
    });
  });

  // >> members
  Route::group(['prefix' => 'members'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\MemberController@showAdd',
      'as' => 'dashboard.members.add'
    ])->middleware('ability:members.add');
    Route::get('manage', [
      'uses' => 'Dashboard\MemberController@showManage',
      'as' => 'dashboard.members.manage'
    ])->middleware('ability:members.manage');
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\MemberController@doAdd',
        'as' => 'dashboard.members.add.request'
      ])->middleware('ability:members.add');
      Route::patch('edit', [
        'uses' => 'Dashboard\MemberController@doEdit',
        'as' => 'dashboard.members.edit.request'
      ])->middleware('ability:members.manage');
      Route::delete('delete', [
        'uses' => 'Dashboard\MemberController@doDelete',
        'as' => 'dashboard.members.delete.request'
      ])->middleware('ability:members.manage');
    });
  });

  // >> admins
  Route::group(['prefix' => 'admins'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\AdminController@showAdd',
      'as' => 'dashboard.admins.add'
    ])->middleware('ability:full');
    Route::get('manage', [
      'uses' => 'Dashboard\AdminController@showManage',
      'as' => 'dashboard.admins.manage'
    ])->middleware('ability:full');
    Route::group(['prefix' => 'requests'], function () {
      Route::post('add', [
        'uses' => 'Dashboard\AdminController@doAdd',
        'as' => 'dashboard.admins.add.request'
      ])->middleware('ability:full');
      Route::post('edit', [
        'uses' => 'Dashboard\AdminController@doEdit',
        'as' => 'dashboard.admins.edit.request'
      ])->middleware('ability:full');
      Route::post('delete', [
        'uses' => 'Dashboard\AdminController@doDelete',
        'as' => 'dashboard.admins.delete.request'
      ])->middleware('ability:full');
    });
  });

  // >> articles
  Route::group(['prefix' => 'articles'], function () {
    Route::get('add', [
      'uses' => 'Dashboard\ArticleController@showAdd',
      'as' => 'dashboard.articles.add'
    ])->middleware('ability:full');
    /*
    Route::get('manage', [
      'uses' => 'Dashboard\ArticleController@showManage',
      'as' => 'dashboard.articles.manage'
    ])->middleware('ability:full');
    */
    Route::group(['prefix' => 'requests'], function () {
      Route::put('add', [
        'uses' => 'Dashboard\ArticleController@doAdd',
        'as' => 'dashboard.articles.add.request'
      ])->middleware('ability:full');
      /*
      Route::post('edit', [
        'uses' => 'Dashboard\AdminController@doEdit',
        'as' => 'dashboard.admins.edit.request'
      ])->middleware('ability:full');
      Route::post('delete', [
        'uses' => 'Dashboard\AdminController@doDelete',
        'as' => 'dashboard.admins.delete.request'
      ])->middleware('ability:full');
      */
    });
  });
});

