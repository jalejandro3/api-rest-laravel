<?php

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserSeeder constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
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
