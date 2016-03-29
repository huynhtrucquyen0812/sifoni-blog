<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i=0; $i < 20; $i++) {
            $data[] = [
                'username' => $faker->username,
                'password' => md5($faker->password),
                'email'    => $faker->email,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName
            ];
        }
        $this->insert('users', $data);
    }
}
