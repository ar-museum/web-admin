<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffModelTest extends TestCase
{
    private $email = 'cristip@museum.lc';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatingModel()
    {
        $staff = factory(App\Models\Staff::class)->make([
                                                            'first_name'     => 'Cristi',
                                                            'last_name'      => 'Popescu',
                                                            'email'          => $this->email,
                                                            'remember_token' => '',
                                                        ]);

        $this->assertLessThan(7, strlen($staff->first_name));
        $this->assertLessThan(8, strlen($staff->last_name));
        $this->assertEmpty($staff->remember_token);
        $this->assertTrue(filter_var($staff->email, FILTER_VALIDATE_EMAIL) === $this->email);
        $this->assertEquals($this->email, $staff->email);
    }
}
