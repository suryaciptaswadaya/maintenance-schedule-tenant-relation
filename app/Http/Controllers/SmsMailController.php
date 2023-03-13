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
use App\Http\Controllers\MasterController;
use App\Models\SmsMailAttendee;
use App\Models\SmsTenant;
use App\Http\Traits\ReplacePlaceholderTrait;
use App\Models\SmsMailScheduler;
use App\Models\SmsMailTemplateCategory;
use Illuminate\Support\Facades\Log;

class SmsMailController extends MasterController
{
    use ReplacePlaceholderTrait;

    public function index()
    {
        //dd($datas = SmsMail::with('category')->orderBy("start_date","desc")->get());
        return $this->callFunction(null,'layouts.administrator.sms-mail.index');
    }



    public function data()
    {
        $datas = SmsMail::withCount(['affected_tenants','schedule_reminders'])->orderBy("start_date","desc");

        //Log::debug($datas);
        return DataTables::of($datas)
        ->editColumn('name', function ($data) {
            return $data->category->name.' - '.$data->template->name ;
        })
        ->editColumn('affected_tenant', function ($data) {
            return $data->affected_tenants_count.' Tenant';
        })
        ->editColumn('schedule_reminder', function ($data) {
            return $data->schedule_reminders_count.' Pengingat';
        })
        ->editColumn('action', function ($data) {
            $show =
                '<a href="' .
                route('administrator.sms-mail.show', $data->id) .
                '" class="btn btn-info btn-flat btn-xs" title="Show"><i class="fa fa-eye fa-sm"></i></a>';
            $edit =
                '<a href="' .
                route('administrator.sms-mail.edit', $data->id) .
                '" class="btn btn-warning btn-flat btn-xs" title="Edit"><i class="fa fa-pencil-alt fa-sm"></i></a>';

            $delete =
                '<a href="#" data-href="'.
                route('administrator.sms-mail.destroy', $data->id) .
                '" class="btn btn-danger btn-flat btn-xs"
                title="Delete" data-toggle="modal"
                data-text="Apakah anda yakin untuk menghapus Mail '.$data->name.'"
                data-target="#modal-confirmation-delete" data-value="'.$data->id.'">
                <i class="fa fa-trash"></i>
                </a>';
            return $show.$edit.$delete;
        })
        ->rawColumns(['name','action'])
        ->make(true);
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

        $func = function () use ($request){
            $smsMail = SmsMail::create([
                'id' => Str::uuid(),
                'start_date' => Carbon::parse($request->mail_template_hashtag['start_date'].' '.$request->mail_template_hashtag['start_time']),
                'end_date' => Carbon::parse(($request->mail_template_hashtag['end_date'] ?? $request->mail_template_hashtag['start_date']).' '.($request->mail_template_hashtag['end_time'] ?? $request->mail_template_hashtag['start_time'])),
                'sms_mail_template_categories_id' => SmsMailTemplateCategory::where('sms_mail_category_id',$request->category_mail)->where('sms_mail_template_id',$request->template_mail)->first()->id,
            ]);

            // Get selected tenants
            $smsTenants = SmsTenant::select('id', 'tenant_access_company_id', 'name')
            ->whereIn('id', $request->tenant)
            ->get();

            // Get template title and content
            $templateTitle = $request->mail_title;
            $templateContent = $request->mail_content;

            // Extract placeholders from title
            preg_match_all("/\[(.*?)\]/", $templateTitle, $getPlaceholders);
            $placeholders = $getPlaceholders[0];

            // Replace placeholders in title
            foreach ($smsTenants as $smsTenant) {
                $tenantName = $smsTenant->name;
                $mailDate =  $request->mail_template_hashtag['start_date'] ?? "";

                $mailTitle = $this->replaceKeyWithValue($placeholders, $templateTitle, $tenantName, $mailDate);
                $mailContent = $this->replaceKeyWithValue($placeholders, $templateContent, $tenantName);

                $smsMailAttendee = SmsMailAttendee::create([
                    'sms_mail_id' => $smsMail->id,
                    'sms_tenant_id'=>$smsTenant->id,
                    'mail_title' => $mailTitle,
                    'mail_content'=> $mailContent,
                ]);
            }

            // / foreach ($request->input('request_surcharge', []) as $i => $priceSurcharge) {

            foreach ($request->input('scheduler_date_time', []) as $i => $scheduler) {

                $smsMailScheduler = SmsMailScheduler::create([
                    'sms_mail_id' => $smsMail->id,
                    'send_date' =>  Carbon::parse($scheduler)
                ]);

            };
        };

        return $this->callFunction($func,'layouts.administrator.sms-mail.index');

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
