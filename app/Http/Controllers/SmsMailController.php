<?php

namespace App\Http\Controllers;

use App\Models\ScsHashtag;
use App\Models\SmsHashtagCategory;
use App\Models\SmsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB,DataTables;

class SmsMailController extends Controller
{
    public function index()
    {
        return view('layouts.administrator.sms-mail.index');

    }

    public function data()
    {
        // $datas = MaintenanceSchedule::orderBy("start_date_time","asc");

        // return DataTables::of($datas)
        // // ->editColumn('name', function ($umkmProduct) {
        // //     return '<a href="' .
        // //         ($umkmProduct->url_image != null ? $umkmProduct->url_image :  "/storage/image/static/empty.png") .
        // //         '" target="_blank"><img alt="image" class="table-avatar align-middle rounded" width="30px" height="30px" src="' .
        // //         ($umkmProduct->url_image != null ? $umkmProduct->url_image :  "/storage/image/static/empty.png") .
        // //         '"></a>' .
        // //         ' ' .
        // //         $umkmProduct->name;
        // // })
        // ->editColumn('action', function ($maintenanceSchedule) {
        //     $show =
        //         '<a href="' .
        //         route('administrator.maintenance-schedule.show', $maintenanceSchedule->id) .
        //         '" class="btn btn-info btn-flat btn-xs" title="Show"><i class="fa fa-eye fa-sm"></i></a>';
        //     $edit =
        //         '<a href="' .
        //         route('administrator.maintenance-schedule.edit', $maintenanceSchedule->id) .
        //         '" class="btn btn-warning btn-flat btn-xs" title="Edit"><i class="fa fa-pencil-alt fa-sm"></i></a>';

        //     $delete =
        //         '<a href="#" data-href="'.
        //         route('administrator.maintenance-schedule.destroy', $maintenanceSchedule->id) .
        //         '" class="btn btn-danger btn-flat btn-xs"
        //         title="Delete" data-toggle="modal"
        //         data-text="Apakah anda yakin untuk menghapus umkm '.$maintenanceSchedule->name.'"
        //         data-target="#modal-confirmation-delete" data-value="'.$maintenanceSchedule->id.'">
        //         <i class="fa fa-trash"></i>
        //         </a>';
        //     return $show.$edit.$delete;
        // })
        // ->rawColumns(['name','action'])
        // ->make(true);
    }

    public function create()
    {
        $data = new SmsMail();
        $title = "Buat Mail";
        $action = "create";
        $hashtagCategories = SmsHashtagCategory::withoutHrgaInformation()->get();
        return view('layouts.administrator.sms-mail.create', compact('title','data','action','hashtagCategories'));

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function testCreateEvent(Request $request)
    {


        DB::beginTransaction();
        try {
            $udid =  Str::uuid();
            $testCreateEvent =  new MaintenanceSchedule();
            $testCreateEvent->id =  $udid;
            $testCreateEvent->subject = $request->subject;
            $testCreateEvent->content = $request->content;
            $testCreateEvent->start_date_time = Carbon::parse($request->start_date)->format("Y-m-d").' '.$request->start_time;
            $testCreateEvent->end_date_time = Carbon::parse($request->end_date)->format("Y-m-d").' '.$request->start_time;
            $testCreateEvent->location = $request->location;
            $testCreateEvent->save();

            foreach ($request->input('email', []) as $i => $email) {
                $testCreateEventAttendee = new MaintenanceScheduleAttendee();
                $testCreateEventAttendee->maintenance_schedule_id = $udid;
                $testCreateEventAttendee->tenant_access_company_id = $request->company_id[$i];
                $testCreateEventAttendee->email = $request->email[$i];
                $testCreateEventAttendee->save();
            }
            //$testCreateEventAttendee

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return abort(500);
        }

        return ('success');
    }
}
