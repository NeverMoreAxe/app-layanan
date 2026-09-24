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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->unsignedTinyInteger('step')->comment('1=Kabid, 2=Kadis');
            $table->foreignId('approver_id')->constrained('users')->restrictOnDelete();
            $table->string('decision')->default('pending'); // ApprovalDecision enum
            $table->text('notes')->nullable();
            $table->timestampTz('decided_at')->nullable();
            $table->timestampsTz();

            $table->index(['approvable_type', 'approvable_id', 'step'], 'approvals_approvable_step_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
