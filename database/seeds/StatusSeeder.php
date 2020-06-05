<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusFilePath = resource_path('json');
        $statusesFileContent = file_get_contents($statusFilePath . DIRECTORY_SEPARATOR . "statuses.json");
        $content = json_decode($statusesFileContent, true);

        foreach ($content['statuses'] as $status) {
            if (! Status::whereName($status['name'])->first()) {
                Status::create($status);
            }
        }
    }
}
