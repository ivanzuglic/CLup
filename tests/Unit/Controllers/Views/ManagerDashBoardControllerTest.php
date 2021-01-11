<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\BasicFeatureCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagerDashBoardControllerTest extends BasicFeatureCase
{
    use refreshDatabase;


    /** @test */
    public function test_manager_dashboard_controller_store_parameters_if_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->storeParameters(Auth::user()->store_id);
        $this->assertEquals(3,Auth::user()->store_id);
    }

    /** @test */
    public function test_manager_dashboard_controller_store_parameters_else_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->storeParameters(2);
        $this->assertEquals(3,Auth::user()->store_id);
    }

    /** @test */
    public function test_manager_can_print_ticket_if_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->printTickets(Auth::user()->store_id);
        $this->assertEquals(3,Auth::user()->store_id);

    }

    /** @test */
    public function test_manager_can_print_ticket_else_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->printTickets(2);
        $this->assertEquals(3,Auth::user()->store_id);

    }

    /** @test */
    public function test_manager_can_see_store_statistics_if_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->storeStatistics(Auth::user()->store_id);
        $this->assertEquals(3,Auth::user()->store_id);

    }

    /** @test */
    public function test_manager_can_see_store_statistics_else_part()
    {
//        $this->seed();
        $this->user = $this->actingAsManager2();
        $response = app('App\Http\Controllers\Views\ManagerDashboardController')->storeStatistics(2);
        $this->assertEquals(3,Auth::user()->store_id);

    }
}
