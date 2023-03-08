<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsMailCategory;
use App\Models\SmsMailTemplateCategory;
use Illuminate\Support\Facades\Log;

class SmsMailTemplateController extends Controller
{
    public function json(Request $request){
        $search = $request->search;
        $mailCategoryId = $request->mail_category_id !== null ? $request->mail_category_id : "" ;
        //$mailTemplates = SmsMailCategory::whereId($mailCategoryId)->first();

        $mailTemplates = SmsMailTemplateCategory::select('sms_mail_template_categories.*','sms_mail_templates.id as template_id','sms_mail_templates.name as template_name')
                    ->leftJoin('sms_mail_templates', 'sms_mail_templates.id', '=', 'sms_mail_template_categories.sms_mail_template_id')
                    ->where('sms_mail_template_categories.sms_mail_category_id',$mailCategoryId)
                    ->where('sms_mail_templates.name', 'like', '%' . $search . '%')
                    ->get();

        $response = [];
        foreach ($mailTemplates as $mailTemplate) {
            $response[] = [
                'id' => $mailTemplate->template_id,
                'text' =>  $mailTemplate->template_name//." - ".$hashTag->tenants,
            ];
        }
        //Log::debug(json_encode($hashTags));
        echo json_encode($response);
        exit();
    }
}
