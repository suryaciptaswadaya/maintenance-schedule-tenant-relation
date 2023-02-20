<?php

namespace App\Http\Controllers;


class TenantAccessCompanyController extends Controller
{

    public function tenantAccessCompanyJson(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $umkms = Umkm::paginate(10);
        } else {
            $umkms = Umkm::where('name', 'like', '%' . $search . '%')
                ->paginate(25);
        }

        $response = [];
        foreach ($umkms as $umkm) {
            $response[] = [
                'id' => $umkm->id,
                'text' =>$umkm->name
            ];
        }

        //Log::debug(json_encode($response));

        echo json_encode($response);
        exit();
    }
}
