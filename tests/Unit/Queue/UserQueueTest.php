<?php

namespace Tests\Unit\Queue;

use Tests\TestCase;
use App\Models\User;
use App\Service\UserService;
use App\Jobs\User\UserCreated;
use App\Jobs\User\UserDeleted;
use App\Jobs\User\UserUpdated;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserQueueTest extends TestCase
{
     use RefreshDatabase;

    private UserService $service;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->service = new UserService();
         $this->service = $this->app->make(UserService::class);
    }


     public function test_it_dispatches_user_creation_job_functionality(): void
    {
        Queue::fake();

        $request = [
            "name" => "john doe",
            "id" => 1,
            "email" => "test@nnpc.com",
        ];

        UserCreated::dispatch($request);

        Queue::assertPushed(UserCreated::class, function ($job) use ($request) {
            return $job->getData() == $request;
        });
    }


    public function test_it_dispatches_user_deletion_job_functionality(): void
    {

        Queue::fake();

        $user = User::factory()->create();

        UserDeleted::dispatch($user->id);

        Queue::assertPushed(UserDeleted::class, function ($job) use ($user) {
            return $job->getId() == $user->id;
        });
    }



}