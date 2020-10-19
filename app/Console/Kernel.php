<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Company;
use Carbon\Carbon;
use Mail;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {    
            $company = Company::whereDate('created_at', Carbon::today())->get();
            if(count($company) > 0){
                    // Mail::send('company.maildata', ['company' => $company], function ($m) use($company) {
                    //     $m->from('skill.hsdm@gmail.com','HSDM - New Registered Companies List');
                    //     $m->to('cso.hsdm@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('ambika.hsdm@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('dd.hsdm@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('rahul.hsdm@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('sumeetsingh.hsdm@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('ashishk0702@gmail.com')->subject('New Companies Registration');
                    //     $m->cc('snehas@hkcl.in')->subject('New Companies Registration');
                    // });
                    Mail::send('company.maildata', ['company' => $company], function ($m) use($company) {
                        $m->from('skill.hsdm@gmail.com','HSDM - New Registered Companies List');
                        $m->to('snehas@hkcl.in')->subject('New Companies Registration');
                    });
            }
        })->dailyAt('23:38'); 
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
