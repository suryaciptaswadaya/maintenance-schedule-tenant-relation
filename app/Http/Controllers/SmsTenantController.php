<?php

namespace App\Http\Controllers;

use App\Models\SmsHashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SmsTenantHashtag;

class SmsTenantController extends Controller
{
    public function json(Request $request)
    {
        $search = $request->search;
        $filterHashTag = $request->hash_tag !== null ? $request->hash_tag : [] ;

        $tenants = SmsTenantHashtag::select('sms_tenant_hashtags.*','sms_tenants.id as tenant_id','sms_tenants.name as tenant_name')
                    //->distinct()
                    ->leftJoin('sms_tenants', 'sms_tenants.id', '=', 'sms_tenant_hashtags.sms_tenant_id')
                    ->whereIn('sms_tenant_hashtags.sms_hashtag_id',$filterHashTag)
                    ->where('sms_tenants.name', 'like', '%' . $search . '%')
                    //->groupBy('sms_tenants.id')
                    ->get();

        $uniques = $tenants->unique('tenant_id');

        $response = [];
        foreach ($uniques as $tenant) {
            $response[] = [
                'id' => $tenant->tenant_id,
                'text' =>  $tenant->tenant_name
            ];
        }
        //Log::debug(json_encode($hashTags));
        echo json_encode($response);
        exit();
    }
}
