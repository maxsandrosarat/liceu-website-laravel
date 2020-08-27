<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutroLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:outro');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $authOK = Auth::guard('outro')->attempt($credentials, $request->remember);

        if($authOK) {
            return redirect()->intended(route('outro.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email','remember'))->with('mensagem', 'Os dados informados estão incorretos, verifique e tente novamente!');
    }

    public function index(){
        return view('auth.login_outro');
    }
}
