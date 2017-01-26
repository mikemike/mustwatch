<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountUpdateRequest;
use Auth;
use App\User;
use Session;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * User wants to edit their account
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('auth.account', [
            'user' => $user
        ]);
    }

    /**
     * Handles submission of the account details form
     *
     * @return \Illuminate\Http\Response
     */
    public function account_submit(AccountUpdateRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        Session::flash('message', 'Your account details have been updated.');
        return redirect(route('account'));
    }
}
