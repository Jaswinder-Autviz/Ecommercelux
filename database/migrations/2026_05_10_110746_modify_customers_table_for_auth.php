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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('name')->after('id')->nullable();
            $table->string('email')->after('name')->unique()->nullable();
            $table->string('gender')->after('phone')->nullable();
            $table->date('dob')->after('gender')->nullable();
            $table->string('profile_image')->after('dob')->nullable();
            $table->timestamp('phone_verified_at')->after('phone')->nullable();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->dropColumn(['name', 'email', 'gender', 'dob', 'profile_image', 'phone_verified_at', 'remember_token']);
        });
    }
};
