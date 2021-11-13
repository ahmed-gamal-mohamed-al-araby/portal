<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Site;
use Illuminate\Http\Request;

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
        $count['sectors'] = Sector::count();
        $count['departments'] = Department::count();
        $count['projects'] = Project::count();
        $count['sites'] = Site::count();
        return view('dashboard-views.welcome', compact('count'));
    }
}
