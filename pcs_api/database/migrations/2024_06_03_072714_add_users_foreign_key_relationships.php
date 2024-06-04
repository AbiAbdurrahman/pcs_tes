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
        Schema::table('carts', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('cart_items', function(Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('coupons', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('order_items', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['cart_id']);
        });

        Schema::table('carts', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('cart_items', function(Blueprint $table) {
            $table->dropForeign(['cart_id','product_id']);
        });

        Schema::table('coupons', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('order_items', function(Blueprint $table) {
            $table->dropForeign(['order_id','product_id']);
        });
    }
};
