<?php

namespace App\Jobs\User;

use App\Service\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     /**
     * The data for creating the unit.
     *
     * @var array
     */
    private array $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param UserService $service
     * @return void
     */
    public function handle(): void
    {
         $service = new  UserService();
         $service->createUser($this->data);

    }

     public function getData(): array
    {
        return $this->data;
    }
}