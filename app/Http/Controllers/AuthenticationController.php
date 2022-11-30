<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\UserRole;
use App\Models\UserLog;
use Carbon\Carbon;
use App\Models\User;

class AuthenticationController extends Controller
{

    public function gotoLogin(){
        $pageConfigs = ['blankPage' => true];
        return view('login', ['pageConfigs' => $pageConfigs]);
    }

    public function attemptLogin(Request $request){
        
        if (Auth::attempt(['username' => $request->username, 'password' =>$request->password]))
		{
            if(Auth::user()->role==1 || Auth::user()->role==2)
            {
                $store=Store::findOrFail(1); 
            }
            else $store=Store::findOrFail(Auth::user()->store_id);

            session(["store_name"=>$store->name]);
            session(["store_id"=>$store->id]);


            $role = UserRole::find(Auth::user()->role_id);
            session(["role"=>$role]);
            $user = User::find(Auth::id());
            $user->last_login_at = Carbon::now()->toDateTimeString();
            $user->last_login_ip = $request->getClientIp();
            $user->save();           
            
            $userlog = new UserLog;
            $userlog->user_id = Auth::id();
            $userlog->user_ip = $request->getClientIp();
            $userlog->save();

		    return redirect()->route('dashboard-store');
		}
        else{
            return back()->with('message', 'User name or password is incorrect');
        }
    }

    public function logout(){
        Auth::logout();
	    return redirect()->route('login');
    }

    // Forgot Password basic
    public function forgot_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Forgot Password cover
    public function forgot_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password basic
    public function reset_password_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-basic', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password cover
    public function reset_password_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-cover', ['pageConfigs' => $pageConfigs]);
    }

    // email verify basic
    public function verify_email_basic()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-basic', ['pageConfigs' => $pageConfigs]);
    }

    // email verify cover
    public function verify_email_cover()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-verify-email-cover', ['pageConfigs' => $pageConfigs]);
    }
}
