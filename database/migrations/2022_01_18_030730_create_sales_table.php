<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->decimal('quantity',8,2);
            $table->decimal('tax',3,2);
            $table->double('amount',15,2);
            $table->string('customer_name');
            $table->enum('status',['PAID','UNPAID','FAILED','CANCELED']);
            $table->timestamp('selling_date');
            $table->timestamp('payment_expired_at');
            $table->timestamp('payment_expired_id');
            $table->unsignedBigInteger('transportation_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('sales');
    }
}
