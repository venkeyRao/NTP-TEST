<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNtpAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App\Models\User::forceCreate([
            'email' => 'ntp_admin@ntp.au',
            'name' => 'NTP Admin',
            'role' => 'ntp_admin',
            'status' => 'approved',
            'mobile' => null,
            'password' => bcrypt('ntp@123')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
