<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getSearch(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            redirect()->route('home');
        }

        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"),
                            'LIKE', "%{$query}%")
                        ->orWhere('username', 'LIKE', "%{$query}%")
                        ->get();

        return view('search.results')->with('users', $users);
    }
}
