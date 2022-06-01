<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExternalTransactionRequest;
use App\Repositories\UserAccountRepository;
use App\Repositories\UserExternalAccountsRepository;
use App\Services\Transaction;
use Illuminate\Support\Facades\Auth;

class ExternalTransactionController extends Controller
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    private $user;
    /**
     * @var \App\Services\Transaction
     */
    private $makeTransaction;
    private $transaction;
    /**
     * @var UserExternalAccountsRepository
     */
    private $userExternalAccountsRepository;

    public function __construct(
        UserAccountRepository $userAccountRepository,
        UserExternalAccountsRepository $userExternalAccountsRepository,
        Transaction $transaction
    ) {
        $this->middleware('auth');
        $this->user =  Auth::user();
        $this->userAccountRepository = $userAccountRepository;
        $this->userExternalAccountsRepository = $userExternalAccountsRepository;
        $this->transaction = $transaction;
    }

    public function show(){
        $ownAccounts = $this->userAccountRepository->getActiveAccounts(Auth::id());
        $externalAccounts = $this->userExternalAccountsRepository->getActiveAccounts();
        return view(
            'transactions.external-transaction',
            [
                'own_active_accounts' => $ownAccounts,
                'external_active_accounts' => $externalAccounts
            ]);
    }

    public function perform(ExternalTransactionRequest $request)
    {
        $originId = $request->input('origin_account');
        $destineId = $request->input('destination_account');
        $amount = $request->input('real_amount');
        if ($this->transaction->externalTransfer($originId, $destineId, $amount)) {
            return redirect()->back()->with('message', 'Success transaction!');
        } else {
            return redirect()->back()->with('error', 'Success transaction!');
        }
    }
}
