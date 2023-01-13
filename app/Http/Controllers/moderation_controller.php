<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reports;
use Illuminate\Http\Request;
use App\Models\Report_Reason;

class moderation_controller extends Controller
{
    //returns user info page only visible by moderators
    public function getUserPage(User $user){
        return view('moderation.userPage',[
            'userData'=>$user
        ]);
    }
    //returns moderation view
    public function moderation(){
        $reports=Reports::all()->sortBy('created_at')->take(5);
        
        return view('moderation.moderation',[
        ])->with('reports',$reports);
    }
    //returns report view
    public function report(User $user){
        $report_reasons=Report_Reason::all();
        return view('moderation.report',[
            'report_reasons'=>$report_reasons,
            'user'=>$user
        ]);
    }
    //reports users
    public function reportUser(Request $request){
        Reports::create([
            'user_id'=>$request->user,
            'report_reason_id'=>$request->reason
        ]);
        return redirect('/')->with('message','User has been successfully reported');
    }
    //prevents user from commenting
    public function prohibitComment(User $user, Request $request){
        if($request->prohibit_comment_button==="false"){
            
            $user->update([
                'can_comment'=>false
            ]);
            return redirect('/users/'.$user->id)->with('message','User can no longer comment');
        }
        
        if($request->prohibit_comment_button==="true"){
                $user->update([
                    'can_comment'=>true
                ]);
                return redirect('/users/'.$user->id)->with('message','User can now comment');
            }
    }
    //prevents user from posting new recipes to public
    public function prohibitPost(User $user, Request $request){
        if($request->prohibit_post_button==="false"){
            
            $user->update([
                'can_post'=>false
            ]);
            return redirect('/users/'.$user->id)->with('message','User can no longer publish recipes');
        }
        
        if($request->prohibit_post_button==="true"){
                $user->update([
                    'can_post'=>true
                ]);
                return redirect('/users/'.$user->id)->with('message','User can now publish recipes');
            }
    }
    //deletes report
    public function deleteReport(Reports $report){
        $report->delete();
        return redirect()->back();
    }

}
