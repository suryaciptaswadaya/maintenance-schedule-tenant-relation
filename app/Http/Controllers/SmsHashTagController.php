<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsHashtag;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Foreach_;

use function PHPUnit\Framework\isEmpty;

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

    public function html(Request $request)
    {
        //$filterHashTagCategories = $request->id_hash_tag_category !== null ? $request->hash_tag_category : [] ;
        $filterHashTagCategory = $request->id_hash_tag_category;
        //Log::debug($filterHashTagCategory);
        //foreach ($filterHashTagCategories as $filterHashTagCategory) {
        $hashTags = SmsHashtag::where('sms_hashtag_category_id',$filterHashTagCategory)->get();
        //Log::debug(isset($hashTags));

        if (isset($hashTags)) {
            $hashtagHtml = '<div class="row">';
            foreach ($hashTags as $hashTag){
                $hashtagHtml .= '<div class="col-sm-3">';
                $hashtagHtml .='<div class="form-group">';
                $hashtagHtml .='<div class="custom-control custom-switch custom-switch-off-warning custom-switch-on-success">';
                $hashtagHtml .='<input id="'.$hashTag->id.'" class="custom-control-input custom-control-input-danger hashtag check-all-'.$filterHashTagCategory.'" data-text="'.$hashTag->name.'" type="checkbox" value="'.$hashTag->id.'">';
                $hashtagHtml .='<label for="'.$hashTag->id.'" class="custom-control-label">'.$hashTag->name.'</label>';
                $hashtagHtml .='</div>';
                $hashtagHtml .='</div>';
                $hashtagHtml .='</div>';
            }
            $hashtagHtml.='</div><hr>';
            return response()->json(['response' => $hashtagHtml]);

        }else{
            return response()->json(['response' => '']);

        }





    }

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
