<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Date;
use Helper;
use App\Models\Event;
use App\Models\InterviewDate;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      //

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

      $schedule->call(function () {
        echo date("D M d H:i:s", time()) . " UTC+2 " . date("Y", time()) . "\r\n";
        echo "Interview dates and Participants schedule.\r\n";
        $ivds = InterviewDate::where('date', '<', Date::after('day'))
                             ->get()->all();
        if($ivds) foreach($ivds as $ivd) if($ivd->participants) foreach ($ivd->participants as $participant) if($participant->updatable) {
            $participant->updatable = false;
            $participant->save();
        }
        echo "Participants, for tomorrow's and previous interview dates, have been updated to be not updatable.\r\n";
        $events = Event::all();
        foreach($events as $event) if($event->isClosed() && $event->participants) foreach($event->participants as $participant) if($participant->updatable) {
            $participant->updatable= false;
            $participant->save();
        }
        echo "Participants, in closed events, have been updated to be not updatable.\r\n";
        $ivds = InterviewDate::where('available', true)
                             ->where('date', '<', Date::now())
                             ->get()->all();
        if($ivds) foreach($ivds as $ivd) {
            $ivd->available = false;
            $ivd->save();
        }
        echo "Interview dates, that is in past, have been updated to be not available.\r\n";
        echo "Schedule is ran successfully.\r\n";
        echo "--------------------------------------------------------------";
      })->cron('59 23 * * *');

      $schedule->call(function () {
        echo date("D M d H:i:s", time()) . " UTC+2 " . date("Y", time()) . "\r\n";
        echo "MailerQueue schedule.\r\n";
        Helper::run('MailerQueue');
        echo "Schedule is ran successfully.\r\n";
        echo "--------------------------------------------------------------";
      })->cron('0 * * * *');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
