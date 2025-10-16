<?php

namespace App\Console\Commands;

use App\Models\COT;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class dumplogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports Logs From CSV to database';

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
    public function handle(Request $request)
    {
        $row = 0;
        if (($file     =   fopen("C:/xampp/htdocs/brave/public/Asrun-new.csv", "r")) !== FALSE) {
            while (($line = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($line);

                //$line is an array of the csv elements
                if ($row == 0) {
                    $row++;
                    continue;
                }   // continue is used for skip row 1

                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$row][] = $line[$c];
                }
                $row++;
            }
        }
        fclose($file);
        // print_r($importData_arr);
        array_pop($importData_arr);

        // Insert to MySQL database
        foreach ($importData_arr as $importData) {

            $insertData = array(
                "name" => $importData[3],
                "time" => $importData[1],
                "date" =>  \Carbon\Carbon::createFromFormat("Y/m/d", $importData[0])->format('Y-m-d'),
            );
            COT::insert($insertData);
        }
            $yesterday = date('d-M-Y',strtotime("-1 days"));
            $email = "nbdengineers@ke.nationmedia.com";
            $details = [
                'title' => 'Mail from NTV Logs Exporter',
                'body' => 'The MCR logs for yesterday : ' . $yesterday . ' has been sucessfully exported to the database'
            ];
            Mail::to($email)->send(new \App\Mail\SentLogs($details));
            $this->info('Logs Exported Successfully.');
    }
}
