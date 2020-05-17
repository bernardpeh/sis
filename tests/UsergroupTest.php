<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UsergroupTest extends TestCase
{
    /**
     * [GET] Get single Usergroup id 1
     *
     * @return void
     */
    public function testShouldReturnSingleUsergroup()
    {
        $res = $this->get("/api/usergroup/1", ['api_key' => 'student'])->response->getContent();
        $this->seeStatusCode(200);
        // should see student email
        $this->seeJsonContains(['name' => 'studentgroup']);
        // count number of users
        $res = json_decode($res);
        $this->assertEquals(1, count($res->users));
    }

    /**
     * [GET] Get all users
     *
     * @return void
     */
    public function testShouldReturnAllUsergroups()
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
    public function testShouldCreateEditDeletUsergroup()
    {
        // create
        $data = [
            'name' => 'teststudentgroup',
            'type' => 0,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->post("/api/usergroup", $data, ['api_key' => 'student']);
        // should get 201 if insert is successful
        $this->seeStatusCode(201);
        // should see new email
        $this->seeJsonContains(['name' => 'teststudentgroup']);
        $last_inserted_id = json_decode($this->response->getContent())->id;

        // edit newly inserted entry
        $data = [
            'name' => 'teststudentgroup1',
        ];
        $this->put("/api/usergroup/$last_inserted_id", $data, ['api_key' => 'student']);
        // should get 200 if insert is successful
        $this->seeStatusCode(200);
        // should see updated email
        $this->seeJsonContains(['name' => 'teststudentgroup1']);

        // delete newly inserted entry
        $this->delete("/api/usergroup/$last_inserted_id",['api_key' => 'student']);
        // should get 200 if delete is successful
        $this->seeStatusCode(200);
    }
}
