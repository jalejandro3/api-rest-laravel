<?php

use Illuminate\Database\Seeder;

use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorityFilePath = resource_path('json');
        $prioritiesFileContent = file_get_contents($priorityFilePath . DIRECTORY_SEPARATOR . "priorities.json");
        $content = json_decode($prioritiesFileContent, true);

        foreach ($content['priorities'] as $priority) {
            if (! Priority::whereName($priority['name'])->first()) {
                Priority::create($priority);
            }
        }
    }
}
