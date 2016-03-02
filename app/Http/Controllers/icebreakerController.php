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

	            return response()->json(['error' => "stuff wnt wrong"], 500);
	        }
	        
	        return response()->json([$response], 200);

        } catch(\Exception $e) {

        	return response()->json(['error' => $e->getMessage()], 500);
        }

    //     	try {

    //     		$fullcontact = (new icebreakerService)->fullcontact($request->get('email'));

				// $response['fullcontact'] = $fullcontact;

				// $twitterExists = (new icebreakerService)->checkIfTwitterUrlGiven($fullcontact['obj']->socialProfiles);

				// if($twitterExists) {

				// 	$userName = $twitterExists->username;

				// 	$twitterData = (new icebreakerService)->getTwitterDataFromUserName($userName);

				// 	$response['twitter'] = $twitterData;
				// }

				// return response()->json([$response], 200);

    //     	} catch(\Exception $e) {

    //     		return response()->json(['error' => $e->getMessage()], 500);

    //     	}
        	

      	
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
