<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Installments;
use App\Models\Loan;
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
        $count = User::count();
        $branch = Branch::count();
        $plan = Loan::count();
        $installment = Installments::count();
        return view('admin.index',compact('count','branch','plan','installment'));
    }
}
