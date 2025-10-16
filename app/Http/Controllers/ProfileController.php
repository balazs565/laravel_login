<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $user = auth()->user();

       
        if ($user->avatar && \Storage::exists($user->avatar)) {
            \Storage::delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        $user->avatar = $path;
        $user->save();

        return back()->with('status', 'Avatar reactualizat!');
    }
}
