<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\icebreakerService;

class icebreakerController extends Controller
{


    public function fullcontact(Request $request)
    {
    	$this->validate($request, [
                'email' => 'email|required'
            ]);

        $input = $request->input();

        try {

        	$response = (new icebreakerService)->fullcontact($request->get('email'));

	        if ($response['code'] != '200') {

	            return response()->json(['error' => $response['obj']->message], $response['code']);
	        }
	        
	        return response()->json([$response['obj']], 200);

        } catch(\Exception $e) {

        	return response()->json(['error' => $e->getMessage()], 500);
        }
      	
    }
}
