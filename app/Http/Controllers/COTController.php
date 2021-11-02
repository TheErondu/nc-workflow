<?php

namespace App\Http\Controllers;

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
    {   $reports = COT::all();
        $ext = '.txt';
        $name = $request->input('date');
        $date = $name;
        $message = 'Successfully dumped log for the date: '.$name;
        $lines = file('C:/Program Files/Indytek/Insta log/'.$name .$ext);
        foreach ($lines as $line){
            $parts = preg_split('/\s{4,}/', $line);
             $start_time = ($parts[0]);
             $end_time = ($parts[1]);
             $duration = ($parts[2]);
             $file_name = ($parts[3]);
             $remarks = ($parts[4]);
             $created = $date;
             $reports = new COT();
        $reports->start_time = $start_time;
        $reports->end_time = $end_time;
        $reports->duration = $duration;
        $reports->file_name = $file_name;
        $reports->remarks = $remarks;
        $reports->created_at = $created;
        $reports->save();
   }
        $request->session()->flash('message', $message);


        return redirect()->route('reports.create');

    }
}
