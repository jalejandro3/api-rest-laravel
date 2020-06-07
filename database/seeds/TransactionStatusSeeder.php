<?php

use App\Models\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionStatusFilePath = resource_path('json');
        $transactionStatusesFileContent = file_get_contents($transactionStatusFilePath . DIRECTORY_SEPARATOR . "transaction_statuses.json");
        $content = json_decode($transactionStatusesFileContent, true);

        foreach ($content['transaction_statuses'] as $status) {
            if (! TransactionStatus::whereName($status['name'])->first()) {
                TransactionStatus::create($status);
            }
        }
    }
}
