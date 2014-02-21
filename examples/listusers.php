<?php
ob_start();
require_once '../UberspaceMM.class.php';
echo '<table class="table table-bordered table-hover">';
echo '<tr><th>Name</th><th>Mailbox</th><th>Forwarding destinations</th></tr>';
foreach(UberspaceMM::getUsernames() as $arrUser) {
	echo '<tr><td>' . $arrUser['name'] . '</td><td>' . ($arrUser['isMailbox'] ? 'Mailbox' : 'Forwarder') . '</td><td>' . implode(', ', $arrUser['aliases']) . '</td></tr>';
}
echo '</table>';
$strContents = ob_get_flush();
?>
<!DOCTYPE html>
<html lang="de" charset="utf-8">
	<head>
    	<title>UberspaceMM :: ListUsers example</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body>
    	<?=$strContents?>
    	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>