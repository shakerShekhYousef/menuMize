<?php

namespace App\Http\Controllers\dashboard\business;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\qrCode\GenerateQrCodeRequest;
use App\Models\QrCode as Qr;
use App\Traits\System\FileTrait;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    //Traits
    use FileTrait;

    //Generate qr code function
    public function generate(GenerateQrCodeRequest $request)
    {
        //Start transaction
        DB::beginTransaction();
        //Get auth business info
        $business = auth()->user()->business;
        //Generate random string
        $str = rand();
        $result = md5($str);
        //create token
        $token = md5(rand());
        //Convert HEX  to RGB
        $rgb = $this->hexToRgb($request->color);
        //Generate qr code
        $qrcode = QrCode::format('png')->merge('/public/storage/'.$business->business_logo)
            ->backgroundColor($rgb['r'], $rgb['g'], $rgb['b'])
            ->size(400)
            ->generate(WEBSITE_URL.'?business_id='.$business->id.'&table_token='.$token.'&table_number='.$request->table_number,
                public_path('/storage/'.Qr_CODE_PATH.'/'.$result.'.png'));
        //url
        $url = Qr_CODE_PATH.'/'.$result.'.png';
        //Store in table
        $qr_code = $business->qr_codes()->create([
            'url' => $url,
            'token' => $token,
            'table_number' => $request->table_number,
        ]);
        DB::commit();

        return success_response($qr_code);
    }

    //Delete qr code
    public function delete_qr_code(Qr $qrCode)
    {
        //Start transaction
        DB::beginTransaction();
        //Delete qr code image
        unlink('storage/'.$qrCode->url);
        //Delete qr code from table
        $qrCode->delete();
        //Response
        return success_response('Qr Code has been deleted successfully');
    }

    public function hexToRgb($hex, $alpha = false)
    {
        $hex = str_replace('#', '', $hex);
        $length = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ($alpha) {
            $rgb['a'] = $alpha;
        }

        return $rgb;
    }
}
