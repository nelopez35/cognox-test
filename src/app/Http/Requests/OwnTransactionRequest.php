<?php

namespace App\Http\Requests;

use App\Repositories\UserAccountRepository;
use App\Rules\ValidateAccountRule;
use App\Rules\ValidateDestinationRule;
use App\Rules\ValidateTransactionAmountRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnTransactionRequest extends FormRequest
{
    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;
    /**
     * @var Request
     */
    private $userRequest;

    public function __construct(UserAccountRepository $userAccountRepository, Request $request)
    {
        $this->userAccountRepository = $userAccountRepository;
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
                new ValidateDestinationRule($this->userAccountRepository, $this->userRequest)
            ],
            'real_amount' => [
                'required',
                'gt:0',
                new ValidateTransactionAmountRule($this->userAccountRepository, $this->userRequest)
            ]

        ];
    }
}
