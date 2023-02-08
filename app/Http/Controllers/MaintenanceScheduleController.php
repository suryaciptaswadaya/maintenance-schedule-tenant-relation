<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceScheduleAttendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;

class MaintenanceScheduleController extends Controller
{
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
