<?php

if (!function_exists('send_otp_sms')) {
    function send_otp_sms($mobile, $otp)
    {
        $apiKey = getenv('FAST2SMS_API_KEY');
        $message = "Your mondoF OTP is $otp. Valid for 10 minutes.";
        $senderId = "FSTSMS";
        $route = "v3";

        $postData = [
            'sender_id' => $senderId,
            'message' => $message,
            'language' => 'english',
            'route' => $route,
            'numbers' => $mobile,
        ];

        $headers = [
            "authorization: $apiKey",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
