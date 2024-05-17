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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('userspecial_name')->unique();
            $table->string('Subscription')->nullable();
            $table->string('active_code')->nullable();
            $table->string('profil');
            $table->integer('isverified')->nullable();
            $table->integer('isadmin')->nullable();
            $table->string('whatcando')->nullable();
            $table->string('account_type')->nullable();
            $table->string('noads')->nullable();
            $table->date('ads_date_start')->nullable();
            $table->string('ads_date_end')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
