<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->date('payment_month')->nullable();
        });


        DB::statement("
            UPDATE payments 
            SET payment_month = DATE_TRUNC('month', payment_date)::date
        ");

        DB::statement("
            ALTER TABLE payments 
            ALTER COLUMN payment_month SET NOT NULL"
        );

        Schema::table('payments', function (Blueprint $table) {
            $table->unique(
                ['member_id', 'payment_month'],
                'payments_member_month_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropUnique('payments_member_month_unique');
            $table->dropColumn('payment_month');
        });
    }
};
