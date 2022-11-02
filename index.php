<?php
$webhook = "INSERT WEBHOOK HERE";
$username = "IP Results";
$timestamp = date("c", strtotime("now"));

$ip = isset($_SERVER['HTTP_CLIENT_IP']) 
    ? $_SERVER['HTTP_CLIENT_IP'] 
    : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
      ? $_SERVER['HTTP_X_FORWARDED_FOR'] 
      : $_SERVER['REMOTE_ADDR']);
      
$ip_info = file_get_contents("http://ip-api.com/json/" . $ip);
$ip_json = json_decode($ip_info);

$json_data = json_encode([
    "content" => "",
    "username" => $username,
    "tts" => false,
    "embeds" => [
        [
            "title" => "New IP Logged!",
            "type" => "rich",
            "timestamp" => $timestamp,
            "color" => hexdec( "637dff" ),
            "footer" => [
                "text" => "New visitor"
            ],
            
            "fields" => [
                [
                    "name" => "**:globe_with_meridians: IP-Address:**",
                    "value" => $ip_json->query,
                    "inline" => true
                ],
                [
                    "name" => "**:telephone: Provider:**",
                    "value" => $ip_json->isp,
                    "inline" => true
                ],
                [
                    "name" => "**:map: Timezone:**",
                    "value" => $ip_json->timezone,
                    "inline" => true
                ],
                [
                    "name" => "**:flag_white: Country:**",
                    "value" => $ip_json->country,
                    "inline" => true
                ],
                [
                    "name" => "**:park: Region:**",
                    "value" => $ip_json->region,
                    "inline" => true
                ],
                [
                    "name" => "**:cityscape: Zip Code: **",
                    "value" => $ip_json->zip,
                    "inline" => true
                ],
                [
                    "name" => "**:cityscape: City: **",
                    "value" => $ip_json->city,
                    "inline" => true
                ],
                [
                    "name" => "**:printer: AS: **",
                    "value" => $ip_json->as,
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhook );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Test</title>
</head>

<body>
    <h1> Ip Logging test</h1>

    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>WARNING</strong>
        <BR>
        <BR> BY USING THIS WEBSITE YOU AGREE YOUR IP TO BE COLLECTED TO ANALYITICAL USE
    </div>
</body>



</html>
