<?php

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserSeeder constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    )
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
        $user = User::whereEmail('admin@laravelrestapi.com')->first();

        if (! $user) {
            User::create([
                'first_name' => 'User',
                'last_name' => 'Admin',
                'email' => 'admin@laravelrestapi.com',
                'password' => Hash::make('PasswordAdmin1234'),
                'email_verified_at' => Carbon::now()->toDate()
            ]);
        }
    }
}
