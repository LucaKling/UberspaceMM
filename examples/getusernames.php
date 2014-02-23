<?php
	Header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en" charset="utf-8">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Language" content="en">
		<meta name="robots" content="noindex,nofollow">
    	<title>UberspaceMM::getUsernames() example</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="//lucakling.de/favicon.ico" />
		<link rel="apple-touch-icon" href="//lucakling.de/favicons/favicon@144.png">
		<link rel="apple-touch-icon" sizes="57x57" href="//lucakling.de/favicons/favicon@57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="//lucakling.de/favicons/favicon@72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="//lucakling.de/favicons/favicon@114.png">
		<link rel="apple-touch-icon" sizes="144x144" href="//lucakling.de/favicons/favicon@144.png">
        <style>
        	a {
            	text-decoration: none !important;
            }
        </style>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
    	<div class="container">
        	<div class="page-header">
            	<h1><a href="https://github.com/LucaKling/UberspaceMM"><i class="fa fa-github"></i> UberspaceMM</a>::getUsernames() example</h1>
            </div>
            <?php
            require_once '../UberspaceMM.class.php';
            echo '<table class="table table-bordered table-hover">';
            echo '<tr><th>Name</th><th>Type</th><th>Forwarding destinations</th></tr>';
            foreach(UberspaceMM::getUsernames() as $arrUser) {
                echo '<tr><td>' . $arrUser['name'] . '</td><td>' . ($arrUser['isMailbox'] ? 'Mailbox' : 'Forwarder') . '</td><td>' . implode(', ', $arrUser['forwards']) . '</td></tr>';
            }
            echo '</table>';
            ?>
			<hr>
			<p>&copy; 2014 - <a href="https://github.com/LucaKling">Luca Kling</a></p>
        </div>
    	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>