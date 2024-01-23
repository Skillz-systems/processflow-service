<?php

namespace Database\Seeders;

use App\Models\ProcessFlow;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProcessFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProcessFlow::factory()->count(20)->create();
    }
}
