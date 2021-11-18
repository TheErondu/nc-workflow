<?php

namespace App\Http\Controllers;

use App\Models\COT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Print_;

class COTController extends Controller
{
    public function index()
    {
        $reports = COT::where('id', '>=', '1')->orderby('date', 'DESC')->paginate(50);
        $name = request()->query('name');
        $stump = ' 00:00:00';
        $start = request()->query('start_date') . $stump;
        $end = request()->query('end_date') . $stump;
        $results = DB::select("SELECT * FROM `c_o_t_s`
        WHERE name LIKE '%$name%'
        AND date >= '$start' AND date <= '$end';");

        return view('dashboard.reports.cots.index', compact('reports', 'results'))->with('no', 1);
    }

    // public function download () {
    //     // Retrieve all products from the db
    //     $reports = COT::where('id', '>=','1')->orderby('created_at', 'DESC')->paginate(50);
    //     $name = request()->query('name');
    //     $stump = ' 00:00:00';
    //     $start = request()->query('start_date') . $stump;
    //     $end = request()->query('end_date') . $stump;
    //     $results = DB::select("SELECT * FROM `reports`
    //     WHERE file_name LIKE '%$name%' AND remarks NOT LIKE '%Skipped%'
    //     AND created_at >= '$start' AND created_at <= '$end';");
    //     $data = array(
    //         'reports' => $reports,
    //         'results' => $results,
    //     );
    //     view()->share ('data',$data);
    //     $pdf = PDF ::loadView ('reports.index', $data);
    //     return $pdf->download ('file-pdf.pdf');
    // }

    public function Create()
    {
        return view('dashboard.reports.cots.create');
    }



    public function DumpLogs(Request $request)
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
            $request->session()->flash('message', 'Successfully added logs');
            return redirect()->route('cots.index');
        }

}
