<?php
	Header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en" charset="utf-8">
	<head>
    	<title>UberspaceMM::getUsernames() example</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <style>
        	.github-ref {
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
                <blockquote>
                  <h1><a class="github-ref" href="https://github.com/LucaKling/UberspaceMM"><i class="fa fa-github"></i> UberspaceMM</a>::getUsernames() example</h1>
                </blockquote>
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
        </div>
    	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>