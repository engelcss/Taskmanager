<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\User;
use App\Project;
use App\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Project::truncate();
        Task::truncate();
        DB::table('project_user')->truncate();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.local',
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

        $user1 = User::create([
            'name' => 'Bob',
            'email' => 'Bob@user.local',
            'password' => bcrypt('password'),
            'api_token' => Str::random(60),
        ]);

        $proj = Project::create([
            'title' => 'Project Manager Development',
            'description' => 'Write this app for managers',
            'manager_id' => $admin->id
        ]);

        $task1 = Task::create([
            'title' => 'Seed DB',
            'description' => 'Seed the DB with test data',
            'user_id' => $admin->id,
            'project_id' => $proj->id,
            'status_code' => 'COMP'
        ]);

        $task2 = Task::create([
            'title' => 'Complete Development',
            'description' => 'Write all code',
            'user_id' => $user1->id,
            'project_id' => $proj->id,
            'status_code' => 'OPEN'
        ]);

        $proj->users()->saveMany([$admin, $user1]);
    }
}
