<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * [GET] Get single User id 1
     *
     * @return void
     */
    public function testShouldReturnSingleUser()
    {
        $res = $this->get("/api/user/1", ['api_key' => 'student'])->response->getContent();
        $this->seeStatusCode(200);
        // should see student email
        $this->seeJsonContains(['email' => 'student@localhost']);
    }

    /**
     * [GET] Get all users
     *
     * @return void
     */
    public function testShouldReturnAllUsers()
    {
        $res = $this->get("/api/users", ['api_key' => 'student'])->response->getContent();
        $this->seeStatusCode(200);
        // should see 4 records
        $this->assertEquals(4, count(json_decode($res)));
    }

    /**
     * [POST] Create new student
     *
     * @return void
     */
    public function testShouldCreateEditDeletUser()
    {
        // create
        $data = [
            'first_name' => 'phpunit',
            'last_name' => 'Test',
            'pref_name' => 'phpunit',
            'email' => 'phpunit@localhost',
            'api_key' => 'phpunit',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->post("/api/user", $data, ['api_key' => 'student']);
        // should get 201 if insert is successful
        $this->seeStatusCode(201);
        // should see new email
        $this->seeJsonContains(['email' => 'phpunit@localhost']);

        // edit new id 5
        $data = [
            'email' => 'phpunit1@localhost',
        ];
        $this->put("/api/user/5", $data, ['api_key' => 'phpunit']);
        // should get 200 if insert is successful
        $this->seeStatusCode(200);
        // should see updated email
        $this->seeJsonContains(['email' => 'phpunit1@localhost']);

        // delete new id 5
        $this->delete('/api/user/5',['api_key' => 'phpunit']);
        // should get 200 if delete is successful
        $this->seeStatusCode(200);
    }
}
