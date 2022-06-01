<?php

namespace App\Http\Requests;

use App\Repositories\UserAccountRepository;
use App\Repositories\UserExternalAccountsRepository;
use App\Rules\ValidateAccountRule;
use App\Rules\ValidateExternalDestinationRule;
use App\Rules\ValidateTransactionAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExternalTransactionRequest extends FormRequest
{

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var Request
     */
    private $userRequest;
    /**
     * @var UserExternalAccountsRepository
     */
    private $userExternalAccountsRepository;

    public function __construct(
        UserAccountRepository $userAccountRepository,
        UserExternalAccountsRepository $userExternalAccountsRepository,
        Request $request
    ) {
        $this->userAccountRepository = $userAccountRepository;
        $this->userExternalAccountsRepository = $userExternalAccountsRepository;
        $this->userRequest = $request;
        parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'origin_account' => [
                'required',
                new ValidateAccountRule($this->userAccountRepository),

            ],
            'destination_account' => [
                'required',
                new ValidateExternalDestinationRule($this->userExternalAccountsRepository)
            ],
            'real_amount' => [
                'required',
                'gt:0',
                new ValidateTransactionAmountRule($this->userAccountRepository, $this->userRequest)
            ]
        ];
    }
}
