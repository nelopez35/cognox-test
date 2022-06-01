<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\UserAccountRepository;
use Illuminate\Support\Facades\Auth;

class ValidateAccountRule implements Rule
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserAccountRepository $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->user =  Auth::user();
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
        return $this->userAccountRepository->existsActiveAccount(Auth::id(), $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('This account is not yours');
    }
}
