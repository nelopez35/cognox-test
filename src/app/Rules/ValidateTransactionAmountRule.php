<?php

namespace App\Rules;

use App\Repositories\UserAccountRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ValidateTransactionAmountRule implements Rule
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var Request
     */
    private $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserAccountRepository $userAccountRepository, Request $request)
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $account_id = $this->request->input('origin_account');
        $account = $this->userAccountRepository->getById($account_id);
        $amount = (int) $this->request->input('real_amount');
        return (int) $account->account_current_amount > $amount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $account_id = $this->request->input('origin_account');
        $account = $this->userAccountRepository->getById($account_id);
        return 'The requested amount exceeds your actual amount ('
            .money_format('$%i', $account->account_current_amount)
            .').';
    }
}
