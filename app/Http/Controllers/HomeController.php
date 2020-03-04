<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Contracts;
use App\Models\Order;
use App\Models\Tag;
use App\Models\OrderTags;

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

    public function deletedItems() {
        
        $customers = Customer::where('trashed', 1)->get();

        $orders = Order::where('trashed', 1)->get();

        return view('available-restore', compact('customers','orders'));
    }

}
