<?php

namespace Tests\Unit;

use App\Store;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StorePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_store_policy_view_test()
    {
        $this->seed();

        $user = User::where('id', 10)->first();
        $store = Store::where('store_id', 1)->first();

        $response = app('App\Policies\StorePolicy')->view($user, $store);
        $this->assertEquals(true,$response);
    }

    /** @test */
    public function test_store_policy_create_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();

        $response = app('App\Policies\StorePolicy')->create($user);
        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_store_policy_update_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $store = Store::where('store_id', 1)->first();

        $response = app('App\Policies\StorePolicy')->update($user, $store);
        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_store_policy_delete_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $store = Store::where('store_id', 1)->first();

        $response = app('App\Policies\StorePolicy')->delete($user, $store);
        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_store_policy_restore_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $store = Store::where('store_id', 1)->first();

        $response = app('App\Policies\StorePolicy')->restore($user, $store);
        $this->assertEquals(false,$response);
    }

    /** @test */
    public function test_store_policy_forceDelete_test()
    {
//        $this->seed();

        $user = User::where('id', 10)->first();
        $store = Store::where('store_id', 1)->first();

        $response = app('App\Policies\StorePolicy')->forceDelete($user, $store);
        $this->assertEquals(false,$response);
    }
}
