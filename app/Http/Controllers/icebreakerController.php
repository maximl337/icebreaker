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

        	$response = (new icebreakerService)->getData($request->get('email'));

	        if ($response['fullcontact']['code'] != '200') {

	            return response()->json(['error' => "We were not able to get any information for the email your provided. This can happen due to a few reason: (i) The person you are searching for is not very active online, (ii) Our robots are revolting for better working conditions. Try another email to see if the error is consistent."], 500);
	        }
	        
	        return response()->json([$response], 200);

        } catch(\Exception $e) {

        	return response()->json(['error' => $e->getMessage()], 500);
        }
      	
    }

    public function testTwitterAuth()
    {
    	try {

    		$response = (new icebreakerService)->testTwitter();
	        
	        return response()->json([$response['obj']], 200);

    	} catch(\Exception $e) {

    		return response()->json(['error' => $e->getMessage()], 500);
    	}
    }
}
