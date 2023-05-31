<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLedger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ledger', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('customer_id');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['debit', 'credit']);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_ledger', function (Blueprint $table) {
            //
        });
    }
}
