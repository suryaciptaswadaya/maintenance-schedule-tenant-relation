<?php

namespace App\Http\Controllers;

use App\Models\SmsMailTemplate;
use Illuminate\Http\Request;
use App\Models\SmsMailTemplateHashtag;
use Illuminate\Support\Facades\Log;

class SmsMailTemplateHashtagController extends Controller
{
    public function html(Request $request)
    {

        $mailTemplateHashTags = SmsMailTemplateHashtag::where('sms_mail_template_id',$request->id)->get();
        $mailTemplate = SmsMailTemplate::whereId($request->id)->first();

        $informationHtml = '<div class="row">';

        foreach ($mailTemplateHashTags as $mailTemplateHashTag) {
            $informationHtml .= '<div class="col-md-4">';
            $informationHtml .=     '<div class="form-group">';
            $informationHtml .=         '<label for="'.$mailTemplateHashTag->field.'">'.$mailTemplateHashTag->title.'</label>';
            $informationHtml .=         '<input type="text" class="form-control information-template '.SmsMailTemplateHashtag::VALUE_TYPE_HTML_CLASS[$mailTemplateHashTag->value_type].'" id="'.$mailTemplateHashTag->field.'" placeholder="Masukkan '.$mailTemplateHashTag->title.'">';
            $informationHtml .=     '</div>';
            $informationHtml .= '</div>';
        }
        $informationHtml.='</div><hr>';

        return response()->json(['response' => $informationHtml, 'title' => $mailTemplate->title, 'content'=> $mailTemplate->content]);
    }
}
