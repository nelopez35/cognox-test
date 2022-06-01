<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class HomeController extends Controller
{
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->middleware('auth');
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $transactions = $this->transactionRepository->getPaginateWithSearch(2, $request);
        return view('home', ['transactions' => $transactions]);
    }
}
