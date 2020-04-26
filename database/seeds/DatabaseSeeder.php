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
        $users = factory(\App\User::class, 4)->create();
        // Insert fixed usergroups
        DB::table('usergroups')->insert([
            [
                'type' => 0,
                'name' => 'staff',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 1,
                'name' => 'student',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'type' => 2,
                'name' => 'parent',
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
