<?php

namespace Database\Seeders;

use App\Repositories\UserAccountRepository;
use Illuminate\Database\Seeder;

class CreateUserAccountSeeder extends Seeder
{
    private $userAccountRepository;

    public function __construct(UserAccountRepository $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userAccountRepository->store([
            'account_number' => 111111111,
            'account_status' => 1,
            'account_current_amount' => 1000000,
            'account_user_id' => 1
        ]);

        $this->userAccountRepository->store([
            'account_number' => 22222222,
            'account_status' => 0,
            'account_current_amount' => 0,
            'account_user_id' => 1
        ]);

        $this->userAccountRepository->store([
            'account_number' => 33333333,
            'account_status' => 1,
            'account_current_amount' => 100000,
            'account_user_id' => 1
        ]);
    }
}
