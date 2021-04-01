<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function postStatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:1000'
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status')
        ]);

        return redirect()
            ->route('home')
            ->with('info', 'Запись успешно добавлена.');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, [
            "reply-{$statusId}" => 'required|max:1000'
        ], [
            'required' => 'Обязательно для заполнения'
        ]);

        $status = Status::notreply()->find($statusId);

        if( ! $status ) redirect()->route('home');

        if( ! Auth::user()->isFriendWith($status->user)
                && Auth::user()->id !== $status->user->id ) {
            return redirect()->route('home');
        }

        $reply = new Status();
        $reply->body = $request->input("reply-{$status->id}");
        $reply->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }
}
