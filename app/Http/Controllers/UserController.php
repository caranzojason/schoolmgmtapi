<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Enrollment;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try 
        {

            // $string_to_encrypt="Test";
            // $password="password";
            // $encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
            // $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
            $objResult = [
                'username' => "",
                'found' => false,
                'message' => "",
                'session' => ""
            ];
         
            $matchThese = ['username' =>  $request->username, 'password' => $request->password];
            $results = Users::where($matchThese)->first();
            
            if($results){
                $objResult['username'] = $results['username'];
                $objResult['session'] = openssl_encrypt($request->password,"AES-128-ECB",$request->password);
                $objResult['found'] = true;
            }else{
                $dob = substr($request->password, 0, 4).'-'.substr($request->password, 4, 2).'-'.substr($request->password, 6, 2);
                $matchThese = ['ref_no' => $request->username, 'dob' =>    $dob ];
                $results = Enrollment::where($matchThese)->first();
                if($results){
                    $objResult['username'] = $results['ref_no']; 
                    $objResult['session'] = openssl_encrypt($request->password,"AES-128-ECB",$request->password);
                    $objResult['found'] = true;
                }else{
                    $objResult['message'] = "user not found";
                    return response()->json([$objResult] , 200);
                }
            }
            return response()->json($objResult , 200);
        } catch (Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
}
