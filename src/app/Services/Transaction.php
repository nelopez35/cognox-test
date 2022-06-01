<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\UserAccountRepository;
use App\Repositories\UserExternalAccountsRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Transaction
{
    use HasFactory;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var TransactionRepository
     */
    private $transactionRepository;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;
    /**
     * @var UserExternalAccountsRepository
     */
    private $userExternalAccountsRepository;

    public function __construct(
        UserAccountRepository $userAccountRepository,
        TransactionRepository $transactionRepository,
        UserExternalAccountsRepository $userExternalAccountsRepository,
        array $attributes = []
    )
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userExternalAccountsRepository = $userExternalAccountsRepository;
        $this->user =  Auth::user();
    }

    public function transfer($originId, $destineId, $amount)
    {
        DB::beginTransaction();
        try {
            #adjust account amounts
            $originAccount = $this->userAccountRepository->getById($originId);
            $originAccount->account_current_amount -= $amount;
            $originAccount->save();

            $destineAccount = $this->userAccountRepository->getById($destineId);
            $destineAccount->account_current_amount += $amount;
            $destineAccount->save();

            #create transactions
            $this->transactionRepository->store([
                'origin_account_id' => $originId,
                'origin_account_number' => $originAccount->account_number,
                'destination_account_id' => $destineId,
                'destination_account_number' => $destineAccount->account_number,
                'amount' => $amount,
                'origin_user_id' => Auth::id()
            ]);

            DB::commit();
            return $originAccount;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            DB::rollBack();
            return false;
        }

    }

    public function externalTransfer($originId, $destineId, $amount)
    {
        DB::beginTransaction();
        try {
            #adjust account amounts
            $originAccount = $this->userAccountRepository->getById($originId);
            $originAccount->account_current_amount -= $amount;
            $originAccount->save();

            $destineAccount = $this->userExternalAccountsRepository->getById($destineId);

            #create transactions
            $this->transactionRepository->store([
                'origin_account_id' => $originId,
                'origin_account_number' => $originAccount->account_number,
                'destination_account_id' => NULL,
                'destination_account_number' => $destineAccount->account_number,
                'external_destination_account_id' => $destineId,
                'amount' => $amount,
                'origin_user_id' => Auth::id()
            ]);

            DB::commit();
            return $originAccount;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            DB::rollBack();
            return false;
        }

    }
}
