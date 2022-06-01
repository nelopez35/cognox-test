<?php

namespace Database\Seeders;

use App\Repositories\UserExternalAccountsRepository;
use Illuminate\Database\Seeder;

class ExternalAccountsSeeder extends Seeder
{
    private $userExternalAccountsRepository;

    public function __construct(UserExternalAccountsRepository $userExternalAccountsRepository)
    {
        $this->userExternalAccountsRepository = $userExternalAccountsRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userExternalAccountsRepository->store([
            'account_number' => 55555555,
            'account_status' => 1,
            'can_transfer' => 1
        ]);

        $this->userExternalAccountsRepository->store([
            'account_number' => 6666666,
            'account_status' => 0,
            'can_transfer' => 1
        ]);

        $this->userExternalAccountsRepository->store([
            'account_number' => 77777777,
            'account_status' => 1,
            'can_transfer' => 1
        ]);
    }
}
