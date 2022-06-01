<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\UserRepository;


class CreateUserSeeder extends Seeder
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userRepository->store([
            'name' => 'User test',
            'email' => 'test@test.com',
            'id_number' => 1234567890,
            'password' => bcrypt(1234)
        ]);
    }
}
