<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Log;


class ImportMasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:masterdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import master data from CSV files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customerCsvFile = storage_path('app/customers.csv');
        $productCsvFile = storage_path('app/products.csv');

        // Import Customers
        $customerData = $this->parseCsv($customerCsvFile);

        foreach ($customerData as $row) {
            Customer::create($row);
        }

        // Import Products
        $productData = $this->parseCsv($productCsvFile);
        foreach ($productData as $row) {
            Product::create($row);
        }

        Log::info('Master data import completed.');
    }

    protected function parseCsv($filePath)
    {
        $csvData = [];
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $csvData[] = array_combine($header, $row);
        }

        fclose($file);
        return $csvData;
    }
}
