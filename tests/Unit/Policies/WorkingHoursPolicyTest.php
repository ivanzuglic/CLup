<?php

namespace Tests\Unit;

use App\User;
use App\WorkingHours;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkingHoursPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_working_hours_policy_view_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $working_hours = WorkingHours::where('store_id',1)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->view($user, $working_hours);

        $this->assertEquals(true,$response);
    }

    /** @test */
    public function test_working_hours_policy_create_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->create($user);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_working_hours_policy_update_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $working_hours = WorkingHours::where('store_id',1)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->update($user,$working_hours);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_working_hours_policy_delete_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $working_hours = WorkingHours::where('store_id',1)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->delete($user,$working_hours);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_working_hours_policy_restore_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $working_hours = WorkingHours::where('store_id',1)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->restore($user,$working_hours);

        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_working_hours_policy_forceDelete_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $working_hours = WorkingHours::where('store_id',1)->first();

        $response = app('App\Policies\WorkingHoursPolicy')->forceDelete($user,$working_hours);

        $this->assertEquals(false,$response);
    }
}
