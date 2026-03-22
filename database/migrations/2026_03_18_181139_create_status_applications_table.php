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
        Schema::create('status_applications', function (Blueprint $table) {
            $table->id();
            // A qué entidad aplica este status: users, customers, leads, etc.
            $table->string('applies_to');
            $table->boolean('is_active')->default(true);
            // Evita duplicados por status_id + applies_to
            $table->unique(['status_id', 'applies_to']);

            // Auditoría
            $table->timestamps();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('status_id')->constrained('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_applications');
    }
};
