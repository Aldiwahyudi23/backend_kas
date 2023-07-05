<?php

namespace App\Http\Controllers;

use App\Models\AccessMenu;
use App\Models\AccessSubMenu;
use App\Models\LayoutAppUser;
use App\Models\Menu;
use App\Models\MenuFooter;
use App\Models\User;
use Database\Seeders\AccessSubMenuSeeder;
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
        $access_menu = AccessMenu::where('role_id', Auth::user()->role_id)->get();
        $sub_menu = AccessSubMenu::where('menu_id', 11)->where('user_id', Auth::user()->id)->get(); //mengambil datda dari home accessubmenu , , 
        return view('home', compact('access_menu', 'sub_menu'));
    }
    public function setting()
    {
        $title = MenuFooter::find(5);
        $data_layout_app = LayoutAppUser::where('user_id', Auth::user()->id)->first();

        return view('frontend.setting.index', compact('data_layout_app', 'title'));
    }
}
