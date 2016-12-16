<?php

use Illuminate\Database\Seeder;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->delete();

        DB::table('admin_roles')->insert([
            ['id' => 1, 'slug' => 'subscriber', 'name' => '閲覧者'],
            ['id' => 2, 'slug' => 'editor'    , 'name' => '編集者'],
            ['id' => 3, 'slug' => 'owner'     , 'name' => '管理者'],
            ['id' => 4, 'slug' => 'root'      , 'name' => 'システム管理者'],
        ]);
    }
}
