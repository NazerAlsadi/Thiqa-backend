<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Auth;


class AuthController extends Controller
{

    public function register(Request $request){
       //return $request->all();
       
    	$validatedData = $request->validate(
            [
                'phone' => ['required', 'numeric', 'regex:/(9)[0-9]{8}/', 'unique:users'],
                'password' => [ 'string', 'min:8'],
            ]
        );

        $validatedData['password'] = bcrypt($request->password);

		$user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;
       
        $user->verify_code = rand(1000 , 9999);

        $user->save();
        $user= User::find($user->id);
        $data=['User'=>'aqi325','Pass'=>'iqa131215','Msg'=>"Thiqa Activation Code:".$user->verify_code,'From'=>'Thiqa-az','Gsm'=>'963'.$user->phone,'Lang'=>'1'];
            $data = http_build_query($data);

            $handle = file_get_contents("https://services.mtnsyr.com:7443/General/MTNSERVICES/ConcatenatedSender.aspx?".$data, "r");
            
        return response(['user' => $user , 'accessToken' =>$accessToken]);

    }

    public function update_name(Request $request){
        
            $user = Auth::guard('api')->user();
            if($user){
            if($user->sms_verified_at){
                $user->name = $request->name ; 
                $user->save();
                return response()->json($user , 200); 
            }
        }

        return response()->json('Not autherized' , 501); 
        
    }
    

    public function login(Request $request){

        $loginData = $request->validate(
            [
                'phone' => ['required', 'numeric', 'regex:/(09)[0-9]{8}/']
            ]
        );
    
        if(User :: where('phone',$request->phone)->first())
        {
            $user= User :: where ('phone' , $request->phone)->first();
            $user->verify_code = rand(1000 , 9999);
            $user->sms_verified_at = null;
            $user->save();
            

        }
        else{
            $user = new User;
            $user->verify_code = rand(1000 , 9999);
            $user->phone = $request->phone;
            $user->password = "otp";
            $user->save();
            
        }
            Auth::loginUsingId($user->id);
            $accessToken = $user->createToken('authToken')->accessToken;
            $user = User :: Find($user->id);

        $data=['User'=>'aqi325','Pass'=>'iqa131215','Msg'=>"Thiqa Activation Code:".$user->verify_code,'From'=>'Thiqa-az','Gsm'=>'963'.$user->phone,'Lang'=>'1'];
            $data = http_build_query($data);

            $handle = file_get_contents("https://services.mtnsyr.com:7443/General/MTNSERVICES/ConcatenatedSender.aspx?".$data, "r");

        return response(['user' => Auth::user() , 'accessToken' =>$accessToken]);
        
    }

    public function verified(){

        $user = Auth::guard('api')->user();

        if($user){

            $user->sms_verified_at = Carbon::now()->toDateTimeString();
            $user->save();
            $content = [];
            $content['user']=$user;
            return response()->json($content , 200);
        }

        return response()->json('Not autherized' , 501); 
    }

}
