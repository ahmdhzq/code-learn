<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);

        $adminUser = \App\Models\User::firstOrCreate(
            ['email' => 'admin@codelearn.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole($adminRole);
        }

        $this->call([
            UserSeeder::class,
            TrackSeeder::class,
            // CommentSeeder::class,
            PointsSeeder::class,
        ]);
    }
}