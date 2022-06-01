<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\UserExternalAccountsRepository;

class ValidateExternalDestinationRule implements Rule
{
    /**
     * @var UserExternalAccountsRepository
     */
    private $userExternalAccountsRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(UserExternalAccountsRepository $userExternalAccountsRepository)
    {
        $this->userExternalAccountsRepository = $userExternalAccountsRepository;
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
        return $this->userExternalAccountsRepository->existsActiveAccount($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Destination account is not subscribed.';
    }
}
