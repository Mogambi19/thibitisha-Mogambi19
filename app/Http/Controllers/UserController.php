<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ...existing code...

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(User $user)
    {
        $user->password = Hash::make(env('USER_DEFAULT_PASSWORD','th1bit1sha'));
        $user->save();
        // @TODO : Notifications (email, sms)
        return redirect()->route('users.index')
            ->with('success', 'User Password Reset Succesfully');
    }
}
