<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function store()
  {
    $attributes = request()->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    if (Auth::attempt($attributes)) {
      session()->regenerate();

      return redirect('/dashboard');
    } else {
      return redirect()->back()->with('error', 'Username atau password anda salah!');
    }
  }

  public function destroy()
  {
    Auth::logout();

    return redirect('/');
  }
}
