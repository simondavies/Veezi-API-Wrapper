<?php
require_once __DIR__ . '/src/start.php';

use VeeziAPI\VeeziAPIWrapper as VeeziAPI;

$Veezi = new VeeziAPI(VEEZI_API_TOKEN);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Veezi API Wrapper</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Simple Veezi App</h2>

    </div>
</body>
</html>