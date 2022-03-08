<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = date('l');
        $paymentClose = false;
        $records = Project::get();
        foreach($records as $record){
            $paymentClose = self::checkSalaryPayment($record) or self::checkBonusPayment($record);
            dd($record);
            if($paymentClose){
                self::sendEmails();
                return 0;
            }
        }
        return 0;
    }

    protected function sendEmails(){
        $admins = User::get();
        foreach($admins as $admin){
            Mail::to($admin)->send(new ReminderEmail());
        }
    }
    
    protected function checkSalaryPayment(Project $record){
        $year = (int)date('Y');
        $month = (int)date('m', strtotime($record->month));
        $day = (int)$record->salary_payment_day;
        $paymentDate = $year.'-'.$month.'-'.$day;

        if(Carbon::parse($paymentDate)->diffInDays(Carbon::now()) <= 2 and Carbon::parse($paymentDate)->diffInDays(Carbon::now()) >= 0 )
            return true;
        return false;
    }

    protected function checkBonusPayment(Project $record){
        $year = (int)date('Y');
        $month = (int)date('m', strtotime($record->month));
        $day = (int)$record->bonus_payment_day;
        $paymentDate = $year.'-'.$month.'-'.$day;

        if(Carbon::parse($paymentDate)->diffInDays(Carbon::now()) <= 2 and Carbon::parse($paymentDate)->diffInDays(Carbon::now()) >= 0 )
            return true;
        return false;
    }
}
