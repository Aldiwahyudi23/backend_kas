<?php

namespace App\Http\Controllers;

use App\Models\LayoutAppUser;
use App\Models\MenuFooter;
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
        return view('backend.home');
    }
    public function setting()
    {
        $title = MenuFooter::find(5);
        $data_layout_app = LayoutAppUser::where('user_id', Auth::user()->id)->first();

        return view('frontend.setting.index', compact('data_layout_app', 'title'));
    }
}
