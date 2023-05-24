<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllRouteUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('all_route_urls')->insert([
            'nama' => 'Home',
            'route_name' => 'home',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Menu Index',
            'route_name' => 'menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Sub Menu Index',
            'route_name' => 'sub-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Route Index',
            'route_name' => 'route-url.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Role Index',
            'route_name' => 'role.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Access Menu Index',
            'route_name' => 'access-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Access Menu Index',
            'route_name' => 'access-sub-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Menu Sampah',
            'route_name' => 'menu.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Sub Menu Sampah',
            'route_name' => 'sub-menu.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Route Sampah',
            'route_name' => 'route-urls.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Role Sampah',
            'route_name' => 'role.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Access Menu Sampah',
            'route_name' => 'access-menu.trash',
            'deskripsi' => 'a',
        ]);
    }
}
