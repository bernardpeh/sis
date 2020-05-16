<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Disable foreign key checking because truncate() will fail
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \App\User::truncate();
        \App\Usergroup::truncate();
        \App\UserUsergroup::truncate();

        // create users using faker
        // $users = factory(\App\User::class, 4)->create();

        // create users by specifying specific users
        DB::table('users')->insert([
            [
                'first_name' => 'Student',
                'last_name' => 'Test',
                'pref_name' => 'student',
                'email' => 'student@localhost',
                'api_key' => 'student',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'first_name' => 'Parent',
                'last_name' => 'Test',
                'pref_name' => 'parent',
                'email' => 'parent@localhost',
                'api_key' => 'parent',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'first_name' => 'Staff',
                'last_name' => 'Test',
                'pref_name' => 'staffttest',
                'email' => 'stafft@localhost',
                'api_key' => 'staff',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Test',
                'pref_name' => 'admintest',
                'email' => 'admin@localhost',
                'api_key' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ]);

        // Insert fixed usergroups
        DB::table('usergroups')->insert([
            [
                'type' => 0,
                'name' => 'student',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'name' => 'parent',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 2,
                'name' => 'staff',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 3,
                'name' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        $usergroups = \App\Usergroup::all();
        $users = \App\User::all();

        foreach ($users as $k => $v) {
            DB::table('user_usergroups')->insert([
                'user_id' => $v->id,
                'usergroup_id' => $usergroups[$k]->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        // Enable it back
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
