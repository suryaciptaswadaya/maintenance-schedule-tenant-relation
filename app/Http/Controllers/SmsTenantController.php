<?php

namespace App\Http\Controllers;

use App\Models\SmsHashtag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SmsTenantHashtag;

class SmsTenantController extends Controller
{

    public function html(Request $request)
    {
        //$filterHashTagCategories = $request->id_hash_tag_category !== null ? $request->hash_tag_category : [] ;
        $filterHashTagIds = $request->hash_tag_ids !== null ? $request->hash_tag_ids : [] ;
        //foreach ($filterHashTagCategories as $filterHashTagCategory) {
            if ($request->hash_tag_ids !== null) {
                $tenants = SmsTenantHashtag::select('sms_tenant_hashtags.*','sms_tenants.id as tenant_id','sms_tenants.name as tenant_name')
                ->leftJoin('sms_tenants', 'sms_tenants.id', '=', 'sms_tenant_hashtags.sms_tenant_id')
                ->whereIn('sms_tenant_hashtags.sms_hashtag_id',$filterHashTagIds)
                ->get();
                $tenantHtml = '<div class="row">';
                foreach ($tenants as $tenant){
                    $tenantHtml .= '<div class="col-sm-3">';
                    $tenantHtml .='<div class="form-group">';
                    $tenantHtml .='<div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">';
                    $tenantHtml .='<input id="'.$tenant->tenant_id.'" class="custom-control-input custom-control-input-danger tenant check-all-tenant" data-text="'.$tenant->tenant_name.'" type="checkbox" value="'.$tenant->tenant_id.'">';
                    $tenantHtml .='<label for="'.$tenant->tenant_id.'" class="custom-control-label">'.$tenant->tenant_name.'</label>';
                    $tenantHtml .='</div>';
                    $tenantHtml .='</div>';
                    $tenantHtml .='</div>';
                }
                $tenantHtml.='</div><hr>';
                return response()->json(['response' => $tenantHtml]);
            }else{
                return response()->json(['response' => 'empty']);

            }
    }

    public function json(Request $request)
    {
        $search = $request->search;
        $filterHashTag = $request->hash_tag !== null ? $request->hash_tag : [] ;

        $tenants = SmsTenantHashtag::select('sms_tenant_hashtags.*','sms_tenants.id as tenant_id','sms_tenants.name as tenant_name')
                    ->leftJoin('sms_tenants', 'sms_tenants.id', '=', 'sms_tenant_hashtags.sms_tenant_id')
                    ->whereIn('sms_tenant_hashtags.sms_hashtag_id',$filterHashTag)
                    ->where('sms_tenants.name', 'like', '%' . $search . '%')
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
