<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Models\COT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class COTController extends Controller
{
    public function index()
    {
        $reports = COT::where('id', '>=','1')->orderby('date', 'DESC')->paginate(50);
        $name = request()->query('name');
        $stump = ' 00:00:00';
        $start = request()->query('start_date');
        $end = request()->query('end_date');
        if (null !== request()->query('name')){
        $results = DB::select("SELECT * FROM `c_o_t_s`
        WHERE name LIKE '%$name%'
        AND date >= '$start' AND date <= '$end';");
        }
        else{
            $results = null;
        }

        return view('dashboard.reports.cots.index',compact('reports','results'))->with('no', 1);
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

        $row = 1;
if (($handle = fopen("C:/logs/Asrun.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
//         $ext = '.csv';
//         $name = 'Asrun';
//         $date = date('d-m-Y');
//         $message = 'Successfully dumped log for the date: '.$date;
//         $lines = file('C:/logs/'.$name .$ext);

//         foreach ($lines as $line){

//             $parts = explode("," , "$line");
//             dd($parts);
//         //      $date = ($parts[0]);
//         //      $duration = ($parts[1]);
//         //      $name = ($parts[2]);
//         //      $c_o_t_s = new COT();
//         //  $c_o_t_s->name = $name;
//         //  $c_o_t_s->duration = $duration;
//         //  $c_o_t_s->date = $date;
//         //  $c_o_t_s->save();
//    }


//    $date = date('d-m-Y');
//    $email = "erone007@gmail.com";
//    $details = [
//     'title' => 'Mail from MCR Logs Exporter',
//     'body' => 'The MCR logs for today : '.$date. ' has been sucessfully exported to the database'
// ];
//    Mail::to($email)->send( new \App\Mail\SentLogs($details));
//    $this->info('Weekly report has been sent successfully');
//    $request->session()->flash('message', 'Successfully added Issue');
//    return redirect()->route('cots.index');

    }
}
