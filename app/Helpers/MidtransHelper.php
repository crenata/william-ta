<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransHelper extends Controller {
    public static function getSnapUrl(int $grossAmount, string $invoiceNumber = null) {
        if (empty($invoiceNumber)) {
            $now = Carbon::now();
            $invoiceNumber = $now->format("Y-") .
                Str::random(4) .
                $now->format("-m-") .
                Str::random(4) .
                $now->format("-d-") .
                Str::random(12);
        }

        Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        Config::$isProduction = env("MIDTRANS_PRODUCTION");
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Config::$overrideNotifUrl = env("MIDTRANS_OVERRIDE_NOTIFICATION_URL");

        $result = new \stdClass();
        $result->invoice_number = $invoiceNumber;
        $result->snap_url = Snap::getSnapUrl([
            "transaction_details" => [
                "order_id" => $invoiceNumber,
                "gross_amount" => $grossAmount
            ]
        ]);

        return $result;
    }
}
