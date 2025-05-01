<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/light-theme.min.css" rel="stylesheet">
    <title>Storm Breaker - V3</title>

    <style>
        /* Black background and neon green text */
        body {
            background-color: black; /* Black background */
            color: #00FF00; /* Neon green text */
            font-family: Arial, sans-serif;
        }

        textarea {
            background-color: black;
            color: #00FF00;
            border: 2px solid #00FF00;
        }

        button {
            color: #00FF00;
            border: 2px solid #00FF00;
            background-color: black;
        }

        button:hover {
            background-color: #333;
        }

        #ourbody {
            background-color: black;
            color: #00FF00;
        }
    </style>
</head>
<body id="ourbody" onload="check_new_version()">

<div id="links"></div>

<div class="mt-2 d-flex justify-content-center">
    <textarea class="form-control w-50 m-3" placeholder="result ..." id="result" rows="15"></textarea>
</div>

<div class="mt-2 d-flex justify-content-center">
    <button class="btn btn-danger m-2" id="btn-listen">Listener Running / press to stop</button>
    <button class="btn btn-success m-2" id="btn-listen" onclick="saveTextAsFile(result.value, 'log.txt')">Download Logs</button>
    <button class="btn btn-warning m-2" id="btn-clear">Clear Logs</button>
</div>

<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="./assets/js/sweetalert2.min.js"></script>
<script src="./assets/js/growl-notification.min.js"></script>

</body>
</html>
