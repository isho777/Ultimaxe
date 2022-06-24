<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class reminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $response = $this->sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode( $return);
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
    }

    public function sendsignal(){
        $response = $this->sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode( $return);
        print("\n\nJSON received:\n");
        print($return);
        print("\n");
    }

    function sendMessage(){
        $content = array(
            "en" => 'Clocking Reminder'
        );

        $fields = array(

            'app_id' => "6dcf1195-9d33-42b7-966e-fbc2ecea86e6",
            'included_segments' => array('All'),
            'data' => array("foo" => "Please clock in into the system."),
            'large_icon' =>"ic_launcher_round.png",
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZjU0ZWUxN2ItZjVlZi00ZTFjLTg5ODktZjNiZDUzZTllNmUx'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
