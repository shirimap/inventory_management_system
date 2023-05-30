<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sbidhaa;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
class ProductStockCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:check-stock';
   

    /**
     * The console command description.
     *
     * @var string
     */
     
     protected $description = 'Check product stock and send SMS if out of stock';

     

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
        $productsOutOfStock = [];
        $currentDate= date('Y-m-d');
       
        $products = Product::all();
        $pius= Order::select('total_amount')->whereDate('created_at',$currentDate)->where('status','IMEUZWA')->sum('total_amount');
       // $pius =Sell::whereBetween('created_at',array($fromDate." 00:00:00",$toDate." 23::59:59"))->where('status','IMEUZWA')->sum('total_amount');
        foreach ($products as $product) {
            if ($product->quantity <= $product->sbidhaa->threshold) {
                $productsOutOfStock[] = $product->sbidhaa->name;
            }
        }

        
        if (!empty($productsOutOfStock)) {
            $phone_number = 756007671; // Replace with the actual phone number to send the SMS
            $sms = 'hello,The following products are out of stock: ' . implode(', ', $productsOutOfStock).'\ln the amount told is:'.$pius;

            $url = 'http://smsportal.imartgroup.co.tz/app/smsapi/index.php';
            $params = [
                'campaign' => 266,
                'routeid' => 8,
                'key' => '36281862404933',
                'type' => 'text',
                'contacts' => $phone_number,
                'senderid' => 'Spring-Tech',
                'msg' => $sms,
            ];

            $response = Http::get($url, $params);

            // Handle the response as needed

            // ...
        }
    }
}
