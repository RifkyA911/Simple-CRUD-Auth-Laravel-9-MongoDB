<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        // die(var_dump(session()->all()));
        $this->middleware('session');  // middleware selalu akan dijalankan sebelum $request http. file= app\Http\Middleware\Authenticate.php, app\Http\Kernel.php
    }


    public function index()
    {
        $this->cekSession();
        return view('users', [      // atau gunakan ini
            'users' => User::get()  // $users = User::get();
        ]);                         // return view('users', compact('users'));
    }

    public function manageView(Request $request, $page)
    {
        // dd($page);
        $this->cekSession();
        if ($page === 'home') {
            return view('users', [
                'users' => User::get(),
            ]);
        } elseif ($page === 'create') {
            return view('createUserForm');
        } elseif ($page === 'edit') {
            $user       = $user = User::find($request->input('id'));
            return view('updateUserForm', [
                'users' => $user
            ]);
        } elseif ($page === 'profile') {
            return 's';
        } elseif ($page === 'sesi') {
            return dd(session()->all());
        } else {
            return abort(404);
        }
    }

    public function manageRequest(Request $request)
    {
        $this->cekSession();
        $action     = $request->input('action'); // khusus didapatkan dari input form
        $username   = $request->input('name');
        // dd($request->input());
        if ($action === 'find') {
            return $this->find($username);
        } elseif ($action === 'insert') {
            $this->insert($request);
            return "berhasil insert data !\r\n<a type='button' href='home'>Kembali</a>";
        } elseif ($action === 'update') {
            return $this->update($request);
        } elseif ($action === 'delete') {
            return $this->delete($request);
        } else {
            return abort(404);
        }
    }

    private function find($username)
    {
        $users = User::where('name', $username)->get();
        return view('findUser', [
            'users' => $users
        ]);
    }

    private function insert(Request $request)
    {
        $user           = new User();
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password    = $request->input('password');
        $user->save();
    }

    private function update(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->save();
        return redirect()->back()->with('success', 'User data has been updated');
    }

    private function delete(Request $request)
    {
        $id             = $request->input('id');
        $user           = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted');
    }

    private function cekSession()
    {
        if (!session('userEmail')) {
            Auth::logout();
            // dd('no', session()->all());
            return redirect(url('/auth/login'))->withErrors(['email' => 'Session Anda telah berakhir, silahkan login kembali']);
        } else {
            // dd('ada', session()->all());
        }
        // dd(session()->all());
    }
}
