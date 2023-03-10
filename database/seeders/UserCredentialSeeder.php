<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserCredential;

class UserCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_credentials')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        UserCredential::factory()->count(10)->create();
    }
}
