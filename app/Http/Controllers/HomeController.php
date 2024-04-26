<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {

            $userId = Auth::id();

            $user = User::find($userId);

            if (!$user) {
                abort(404);
            }

            if ($user->hasRole('admin')) {
                return redirect()->route('categories.index');
            } else {
                return redirect()->route('tasks.index');
            }
        } else {
            return view('welcome');
        }
    }
}
