<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsMailCategory;

class SmsMailCategoryController extends Controller
{
    public function json(Request $request){
        $search = $request->search;
        //$filter = $request->hash_tag_category !== null ? $request->hash_tag_category : [] ;
        $mailCategories = SmsMailCategory::where('name', 'like', '%' . $search . '%')->paginate(15);
        //dd($hashTags);

        $response = [];
        foreach ($mailCategories as $mailCategory) {
            $response[] = [
                'id' => $mailCategory->id,
                'text' =>  $mailCategory->name//." - ".$hashTag->tenants,
            ];
        }
        //Log::debug(json_encode($hashTags));
        echo json_encode($response);
        exit();
    }
}
