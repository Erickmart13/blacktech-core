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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            // 🔥 jerarquía
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('resources')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('code');

            $table->string('route')->nullable();
            $table->string('icon')->nullable();

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            // LLaves foráneas
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();

            // Auditoría
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();

            $table->timestamps();

            $table->unique(['code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
