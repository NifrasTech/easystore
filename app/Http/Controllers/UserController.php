<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;
use App\Models\UserRole;

class UserController extends Controller
{
    // User List Page
    public function gotoUsers()
    {
        $pageConfigs = ['pageHeader' => false];
        return view('/users/users', ['pageConfigs' => $pageConfigs]);
    }

    public function gotoUserLogs()
    {
        $pageConfigs = ['pageHeader' => false];
        return view('/users/user-logs', ['pageConfigs' => $pageConfigs]);
    }

    public function getUserLogs(Request $request){
        $userlogs = UserLog::query();
        $userlogs = $userlogs->select('user_logs.*','users.username')->leftJoin('users','users.id','=','user_logs.user_id');
        if(isset($request->from) && isset($request->to))
        {
            $userlogs = $userlogs->whereBetween('user_logs.created_at',[$request->from.' 00:00:00', $request->to.' 23:59:59']);
        }

        return datatables()->eloquent($userlogs)
        ->editColumn('created_at', function($userlogs){return $userlogs->created_at->format("Y-m-d");})
        ->make(true);
    }

    public function gotoUserRoles()
    {
        $user_permissions = ['dashboard','pos','transactions','products','customers','suppliers','categories','transfers','purchases','sales','register','checques','expense','bank'];
        $roles = UserRole::where('id',"!=","1")->where('id',"!=","2")->get();
        $pageConfigs = ['pageHeader' => false,];
        return view('/users/user-roles', ['pageConfigs' => $pageConfigs,'permissions'=>$user_permissions,'roles'=>$roles]);
    }

    public function showUsers(Request $request)
    {
        $users = User::query();
        $users = $users->joined();
        return datatables()->eloquent($users)
                           ->editColumn('created_at', function($users){return $users->created_at->format("Y/m/d  g:i A");})
                           ->make(true);        
    }


}
