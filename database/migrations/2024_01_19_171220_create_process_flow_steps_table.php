<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('process_flow_steps', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment();
            $table->string("step_route")->comment();
            $table->string("assignee_user_route")->comment();
            $table->integer("next_user_designation")->comment()->nullable();
            $table->integer("next_user_department")->comment()->nullable();
            $table->integer("next_user_unit")->comment()->nullable();
            $table->integer("process_flow_id")->comment()->nullable();
            $table->integer("next_user_location")->comment()->nullable();
            $table->enum("step_type", ['create', 'delete', 'update', 'approve_auto_assign', 'approve_manual_assign'])->comment()->default("approve_auto_assign");
            $table->enum("user_type", ['user', 'supplier', 'customer', 'contractor'])->comment()->default("customer");
            $table->integer("next_step_id")->comment()->nullable();
            $table->integer("status")->comment()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_flow_steps');
    }
};
