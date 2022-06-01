<?php

namespace App\Rules;

use App\Repositories\UserAccountRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ValidateDestinationRule implements Rule
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserAccountRepository $userAccountRepository, Request $request)
    {
        $this->request = $request;
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $origin_account = $this->request->input('origin_account');
        $origin_account = $this->userAccountRepository->getById($origin_account);
        $destination_account = $this->userAccountRepository->getById($value);
        return $destination_account->account_number != $origin_account->account_number;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The origin account cannot be the same as the destination account';
    }
}
