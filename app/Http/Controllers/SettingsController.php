<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);
        
        return back()->with('success', 'Password updated successfully.');
    }
    
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'confirmation' => ['required', 'string', 'in:DELETE'],
        ]);
        
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        
        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
} 