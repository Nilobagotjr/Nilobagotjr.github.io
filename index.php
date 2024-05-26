<?php
$defaultaibehavior = "Hi gemeni, i am using your api, i want you to be like a gta saandreas bot, any response that is not related on samp or gta refuse it or say you are not design into it but dont refuse casual chats";
$response = isset($_GET['response']) ? $_GET['response'] : $defaultaibehavior;
$gemini_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAkoVOkYoY8DRO_TgaSIb8Zex2h_Zcue6k";

$data = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" => $defaultaibehavior."Human input:".$response
                ]
            ]
        ]
    ]
];

$data_string = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $gemini_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);

echo $response_data['candidates'][0]['content']['parts'][0]['text'];
?>