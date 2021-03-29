<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends.index', compact('friends', 'requests'));
    }

    public function getAdd($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('home')
                ->with('info', 'Пользователь не найден!');
        }

        if (Auth::user()->hasFriendRequestPending($user)
            || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Пользователю отправлен запрос в друзья.');
        }

        if (Auth::user()->isFriendWith($user)) {
            return redirect()
                ->route('profile.index', ['username' => $user->username])
                ->with('info', 'Пользователь уже в друзьях.');
        }

        Auth::user()->addFriend($user);

        return redirect()
            ->route('profile.index', ['username' => $username])
            ->with('info', 'Пользователю отправлен запрос в друзья.');
    }
}
