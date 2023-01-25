<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Auth\MongodbAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class AuthController extends Controller

{
    public function index()
    {
        return view('authLogin');
    }

    public function manageView(Request $request, $page)
    {
        if ($page === 'register') {
            return view('authRegister');
        } elseif ($page === 'login') {
            return view('authLogin');
        } else {
            return abort(404);
        }
    }

    public function manageAuth(Request $request)
    {
        $authType       = $request->input('auth');
        if ($authType === 'register') {
            $this->signUp($request);
            return view('authDoneRegister');
        } elseif ($authType === 'login') {
            return $this->login($request);
        } elseif ($authType === 'logOut') {
            return $this->logOut();
        }
    }

    private function signUp(Request $request)
    {
        # dd($request);
        $user           = new User;
        $user->name     = $request->input('username');
        $user->email     = $request->input('email');
        $user->password     = $request->input('password');
        if ($user->save()) {
            return '<script>alert("berhasil register user!")</script>';
        }
    }

    private function login(Request $request)
    {
        // Session::forget('userEmail');
        Session::flush();
        // dd(session()->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::where('email', $request->email)->first();
                    if (!$user) {
                        $fail("user tidak ditemukan");
                    } else if (!Hash::check($value, $user->password)) {
                        $fail("password yang anda masukkan salah");
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            // dd('salah di validator', $validator->fails(), redirect()->back());
            return redirect(url('/auth/login'))->withErrors($validator)->withInput();
        }
        $user = User::where('email', $request->email)->firstOrFail();
        // dd($user);

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // dd(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    session()->start();
                    Session::put('userEmail', Auth::user()->email);
                    Session::save();
                    // dd('berhasil', session()->all());
                    return redirect()->intended('/users/home');
                }
            } else {
                // dd('pwd', Auth::login($user));
                return redirect()->back()->withErrors(['password' => 'password yang anda masukkan salah']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'user tidak ditemukan']);
        }
    }

    private function logOut()
    {
        // dd('sd');
        Auth::logout();
        Session::flush();
        return redirect()->intended('/auth/login')->with('message', 'Berhasil logout !');;
    }
}
