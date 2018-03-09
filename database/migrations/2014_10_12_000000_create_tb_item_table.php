<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_item', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('item_id')->unsigned()->scomment('商品id');
            $table->string('item_name', 64)->comment('商品名称');
            $table->string('item_img_url', 512)->comment('商品主图');
            $table->string('first_category_name', 32)->comment('商品类目名称');
            $table->string('tbk_url',512)->comment('淘宝客链接');
            $table->integer('item_price')->unsigned()->comment('商品价格');
            $table->integer('item_sales_num')->unsigned()->default(0)->comment('商品月销售数量');
            $table->integer('income_ratio')->unsigned()->default(0)->comment('收入比率(%)');
            $table->integer('kickback')->unsigned()->default(0)->comment('佣金');
            $table->string('wangwang', 32)->comment('卖家旺旺');
            $table->integer('shop_id')->unsigned()->default(0)->comment('卖家id');
            $table->integer('shop_name')->unsigned()->default(0)->comment('店铺名称');
            $table->integer('coupon_id')->unsigned()->default(0)->comment('优惠券id');
            $table->integer('coupon_total_num')->unsigned()->default(0)->comment('优惠券总量');
            $table->integer('coupon_remaining_num')->unsigned()->default(0)->comment('优惠券剩余量');
            $table->integer('coupon_threshold')->unsigned()->default(0)->comment('优惠券使用门槛');
            $table->integer('coupon_value')->unsigned()->default(0)->comment('优惠券面值');
            $table->integer('coupon_begin_time')->unsigned()->default(0)->comment('优惠券开始时间');
            $table->integer('coupon_end_time')->unsigned()->default(0)->comment('优惠券结束时间');
            $table->string('coupon_url',512)->comment('优惠券链接');
            $table->string('coupon_promotion_url',512)->comment('优惠券推广链接');
            $table->integer('create_time')->unsigned()->comment('创建时间');
            $table->integer('update_time')->unsigned()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_item');
    }
}
