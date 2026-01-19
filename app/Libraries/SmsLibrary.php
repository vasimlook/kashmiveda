<?php

namespace App\Libraries;

class SmsLibrary
{
    protected $apiKey;
    protected $senderId;
    protected $baseUrl = "http://sms.smslab.in/api/sendhttp.php";

    public function __construct()
    {
        // Store your API Key in .env or a Config file
        $this->apiKey = env('SMS_API_KEY');
        $this->senderId = "PINJAR";
    }

    public function sendOtp($mobileNumber, $otp)
    {
        $message = urlencode("$otp is your OTP For phone verification. Do not share this with anyone. PINJAR");
        $dltId = "1307170236037209632";

        // Build the URL with query parameters
        $url = "{$this->baseUrl}?authkey={$this->apiKey}&mobiles=$mobileNumber&message=$message&sender={$this->senderId}&route=4&DLT_TE_ID=$dltId";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            log_message('error', "SMS API Error: $error");
            return false;
        }

        return $response;
    }
}