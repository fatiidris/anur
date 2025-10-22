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
         Schema::create('updates_settings', function (Blueprint $table) {
            $table->id();

            // ====== Text Fields ======
            $table->string('update_intro_title')->nullable();
            $table->text('update_intro_description')->nullable();

            $table->string('update_middle_title')->nullable();
            $table->text('update_middle_description')->nullable();

            $table->string('update_footer_title')->nullable();
            $table->text('update_footer_description')->nullable();

            // ====== Gallery Images (1–10) ======
            for ($i = 1; $i <= 10; $i++) {
                $table->string('update_gallery_image_' . $i)->nullable();
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('updates_settings');
    }
};
