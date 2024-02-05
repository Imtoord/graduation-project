<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id('CampaignID');
            $table->string('CampaignName');
            $table->text('Description');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->decimal('GoalAmount', 10, 2);
            $table->decimal('CurrentAmount', 10, 2);
            $table->foreignId('CharityID')->constrained('charities', 'CharityID');
            $table->string('Image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
