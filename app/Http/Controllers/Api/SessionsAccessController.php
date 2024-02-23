<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Models\Session;
use App\Models\CourseAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserTracking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SessionsAccessController extends Controller
{
    public function show(Request $request) {

        $request->validate([
            'sessions_id' => ['required'],
            'courses_id' =>['required']
        ]);
        $user = Auth::guard('sanctum')->user();
        $session = Session::findOrFail($request->sessions_id);
        if($session->pdf != null){
            $session->pdf = 'http://medicalonlineacademy.com/pdf/'.$session->pdf;
        }
        $enrolled = CourseAccess::where('user_id',$user->id)->where('course_id',$request->courses_id)->get()->pluck('status')->contains('enrolled');
        if($enrolled){

            $counter = UserTracking::where('user_id',$user->id)->where('course_id',$request->courses_id)->first();
            if(isset($counter)){

                $counter->watching_counter += 1;
                $counter->save();
            }else{
                UserTracking::create([
                'user_id' => $user->id,
                'course_id' => $request->courses_id,
                'watching_counter' => 1 
                ]);
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://dev.vdocipher.com/api/videos/".$session->session_link."/otp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'annotate' => json_encode([[
                    'type' => 'rtext',
                    'text' => $user->name.' '.$user->mobile,
                    'alpha' => '0.6',
                    'color' => '0x0062FF',
                    'size' => '12',
                    'interval' => '10000',
                    'skip'=>'2000'
                ]]),
            ]),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Apisecret 8NuiJPd91pE1OjFNGH24W7CQRAFiSDPCAJbVrfzOKh6PI1izu34CplrQ6KuDcd1z",
                "Content-Type: application/json"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } 
            
            $temp = explode('","', $response);
            
            $otp = explode('":"', $temp[0]);
            $otp = $otp[1];
            $playbackInfo = explode('":"', $temp[1]);
            $playbackInfo = explode('"}', $playbackInfo[1]);
            $playbackInfo =$playbackInfo[0];
            $session->setAttribute('otp', $otp);
            $session->setAttribute('playbackInfo', $playbackInfo);
            $session->course_id = (int)$session->course_id;

            
            return Response::json([
                'session' => $session
            ], 200);
        }else{
            return Response::json([
                'message' => 'Sorry you are not registered to this course yet'
            ], 401);
        }
    }
}