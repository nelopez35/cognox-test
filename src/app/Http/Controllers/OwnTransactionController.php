<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnTransactionRequest;
use App\Repositories\UserAccountRepository;
use App\Services\Transaction;
use Illuminate\Support\Facades\Auth;
use function view;

class OwnTransactionController extends Controller
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    private $user;
    /**
     * @var Transaction
     */
    private $makeTransaction;
    private $transaction;

    public function __construct(
        UserAccountRepository $userAccountRepository,
        Transaction $transaction
    ) {
        $this->middleware('auth');
        $this->user =  Auth::user();
        $this->userAccountRepository = $userAccountRepository;
        $this->transaction = $transaction;
    }

    public function show(){
        $accounts = $this->userAccountRepository->getActiveAccounts(Auth::id());
        return view('transactions.own-transaction', ['active_accounts' => $accounts]);
    }

    public function perform(OwnTransactionRequest $request)
    {
        $originId = $request->input('origin_account');
        $destineId = $request->input('destination_account');
        $amount = $request->input('real_amount');
        $transaction = $this->transaction->transfer($originId, $destineId, $amount);
        if ($transaction) {
            return redirect()->back()->with('message', 'Success transaction! #'.$transaction->transaction_id);

        } else {
            return redirect()->back()->with('error', 'Success transaction!');
        }
    }
}
