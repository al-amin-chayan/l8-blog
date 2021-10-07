<?php

namespace App\Http\Controllers;

use App\Jobs\ActivateUser;
use App\Jobs\InactiveUser;
use App\Models\User;
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
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function inactive()
    {
        try{
            User::where('is_active', true)->get()->each(function($user) {
                InactiveUser::dispatch($user);
            });

            return redirect()->route('home')->withSuccess('Inactivation Request Submitted');
        } catch (\Exception $e) {
            return redirect()->route('home')->withError($e->getMessage());
        }


    }

    public function activate()
    {
        try{
            User::where('is_active', false)->get()->each(function($user) {
                ActivateUser::dispatch($user);
            });

            return redirect()->route('home')->withSuccess('Activation Request Submitted');
        } catch (\Exception $e) {
            return redirect()->route('home')->withError($e->getMessage());
        }
    }
}
