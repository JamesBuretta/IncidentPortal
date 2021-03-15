<?php

namespace App\Console\Commands;

use App\Models\CustomerSupportMessage;
use App\Models\SupportCategory;
use App\Models\SupportCategoryContact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SupportMessageSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'support:message';

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
        //Check if Not Send to Support
        if (CustomerSupportMessage::where(['mail_send_status' => 0])->count() > 0){
            $all_messages = CustomerSupportMessage::where(['mail_send_status' => 0])->get();
            foreach ($all_messages as $message_detail){
                //Get Support Contact's
                if (SupportCategoryContact::where(['support_category_id' =>  $message_detail->support_category])->count() > 0){
                    $support_informations = SupportCategoryContact::where(['support_category_id' => $message_detail->support_category])->get();
                    foreach ($support_informations as $infos){
                        if (filter_var($infos->email_address, FILTER_VALIDATE_EMAIL)) {
                            $to_address = $infos->email_address;

                            Mail::send('mails.reset_password', ['email' =>$infos->email_address,'user_name' => $user_details->firstname. " ".$user_details->lastname, 'password' => $new_password], function($message) use ($to_address)
                            {
                                $message->to($to_address)->subject('Customer Support');
                                $message->from('surveying@xfrey.co.tz',"Citizen Portal System");
                            });

                            Log::info('Cron Password Reset successfully send email to '.$recipient);
                        }

                        //Update Request Status
                        $update_status = CronInstruction::where(['id'=> $q->id])->first();
                        $update_status->status = 1;
                        $update_status->save();

                    }
                }
                else{
                    $category = SupportCategory::where(['id' =>  $message_detail->support_category])->first();

                    Log::critical('Add Support Team for Category: '.$category->support_category.' You have a pending unread message');
                }


            }
        }

        return 0;
    }
}
