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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('company_name');
            $table->string('job_title');
            $table->string('location')->nullable();
            $table->text('job_description')->nullable();
            $table->string('source')->nullable();
            $table->string('external_url', 1024)->nullable();
            
            $table->enum('status', ['Applied', 'Interview', 'Offer', 'Rejected'])->default('Applied');
            $table->date('applied_at')->nullable();
            $table->dateTime('next_action_at')->nullable();
            $table->string('salary_range')->nullable();

            $table->string('recruiter_name')->nullable();
            $table->string('recruiter_email')->nullable();
            $table->string('recruiter_phone', 15)->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
