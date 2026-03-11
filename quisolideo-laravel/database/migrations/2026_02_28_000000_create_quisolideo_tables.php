<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // users table is created by Laravel default migrations; we rely on it.

        if (!Schema::hasTable('partners')) {
            Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('trainings')) {
            Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description', 512)->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('seats')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('training_partner')) {
            Schema::create('training_partner', function (Blueprint $table) {
                $table->foreignId('training_id')->constrained('trainings')->cascadeOnDelete();
                $table->foreignId('partner_id')->constrained('partners')->cascadeOnDelete();
                $table->primary(['training_id','partner_id']);
            });
        }

        if (!Schema::hasTable('media')) {
            Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['image','video','lottie'])->default('image');
            $table->string('path')->nullable();
            $table->string('alt')->nullable();
            $table->timestamps();
            });
        }

        if (!Schema::hasTable('contact_messages')) {
            Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message')->nullable();
            $table->boolean('read_flag')->default(false);
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('media');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('training_partner');
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('partners');
    }
};
