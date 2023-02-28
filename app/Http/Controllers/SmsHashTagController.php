<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsHashtag;
use Illuminate\Support\Facades\Log;

class SmsHashTagController extends Controller
{
    // private function hashTags($request)
    // {
    //     $search = $request->search;
    //     $filter = $request->filter !== null ? $request->filter : [] ;
    //     $hashTags = SmsHashtag::whereIn('sms_hashtag_category_id',$filter)->where('name', 'like', '%' . $search . '%')->paginate(30);
    //     //dd($hashTags);
    //     return $hashTags;
    // }

    public function json(Request $request)
    {
        $search = $request->search;
        $filter = $request->hash_tag_category !== null ? $request->hash_tag_category : [] ;
        $hashTags = SmsHashtag::whereIn('sms_hashtag_category_id',$filter)->where('name', 'like', '%' . $search . '%')->paginate(30);
        //dd($hashTags);

        $response = [];
        foreach ($hashTags as $hashTag) {
            $response[] = [
                'id' => $hashTag->id,
                'text' =>  str_replace('_', ' ', strtoupper($hashTag->hashTagCategory->name)) ." - ". $hashTag->name//." - ".$hashTag->tenants,
            ];
        }
        //Log::debug(json_encode($hashTags));
        echo json_encode($response);
        exit();
    }


}
