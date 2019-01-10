<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = "Sunil Prajapati";
        $user->email = "sunil@youngminds.com.np";
        $user->password = bcrypt('sunil');
        $user->type = bcrypt('admin');
        $user->password = bcrypt('sunil');
        $user->password = bcrypt('sunil');
        $user->save();
    }
}
