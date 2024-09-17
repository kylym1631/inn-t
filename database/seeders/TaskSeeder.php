<?php

namespace Database\Seeders;

use App\Models\Task;
use App\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create(['description' => 'Первая задача', 'status' => TaskStatus::TODO->value]);
        Task::create(['description' => 'Вторая задача', 'status' => TaskStatus::DOING->value]);
        Task::create(['description' => 'Третья задача', 'status' => TaskStatus::DONE->value]);
        Task::create(['description' => 'Четвертая задача ', 'status' => TaskStatus::TODO->value]);
        Task::create(['description' => 'Пятая задача', 'status' => TaskStatus::DOING->value]);
        Task::create(['description' => 'Шестая задача', 'status' => TaskStatus::DONE->value]);
    }
}
