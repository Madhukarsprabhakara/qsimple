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
        Schema::create('query_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('query_id')->constrained();
            $table->integer('old_table_record_count')->nullable();
            $table->integer('new_table_record_count')->nullable();
            $table->text('error')->nullable();
            $table->boolean('type')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('query_statuses');
    }
};
