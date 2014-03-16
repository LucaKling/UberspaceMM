<?php
	Header('Content-Type: text/html; charset=utf-8');
	require_once '../UberspaceMM.class.php';
	$path_info = explode('/', $_SERVER['PATH_INFO']);
	$uri_base = str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__);
	$meta_title = 'UberspaceMM Control Panel example';
	$global_page_title = '<a href="https://github.com/LucaKling/UberspaceMM"><i class="fa fa-github"></i> UberspaceMM</a> Control Panel example';
?>
<!DOCTYPE html>
<html lang="en" charset="utf-8">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Language" content="en">
		<meta name="robots" content="noindex,nofollow">
    	<title><?=$meta_title?></title>
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
            	<h1><?=$global_page_title?></h1>
            </div>
            <?php
			if(implode('', $path_info) == null || $path_info[1] == 'List') {
				echo '<h4>Username overview</h4>';
				echo '<table class="table table-bordered table-striped table-hover">';
				echo '<tr><th>Name</th><th>Type</th><th>Forwarding destinations</th><th>Actions</th></tr>';
				foreach(UberspaceMM::getUsernames() as $arrUser) {
					echo '<tr><td>' . $arrUser['name'] . '</td><td>' . ($arrUser['isMailbox'] ? 'Mailbox' : 'Forwarder') . '</td><td>' . implode(', ', $arrUser['forwards']) . '</td><td><a href="' . $uri_base . '/Edit/' . $arrUser['name'] . '/" class="fa fa-fw fa-pencil"></a><a href="' . $uri_base . '/Delete/' . $arrUser['name'] . '/" onclick="return confirm(\'Do you really want to delete the user \\\'' . $arrUser['name'] . '\\\'?\')" class="fa fa-fw fa-times"></a></td></tr>';
				}
				echo '</table>';
				echo '<hr>';
				echo '<h4>Add new mailbox</h4>';
echo <<<EOF
<form class="form-inline" role="form" action="$uri_base/AddMailbox/" method="POST">
  <div class="form-group">
    <label class="sr-only" for="mailbox_name">Address</label>
    <input type="text" class="form-control" id="mailbox_name" name="mailbox_name" placeholder="Address">
	@domain.tld
  </div>
  <div class="form-group">
    <label class="sr-only" for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label class="sr-only" for="password2">Retype password</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Retype password">
  </div>
  <button type="submit" class="btn btn-default">Add mailbox</button>
</form>
EOF;
				echo '<hr>';
				echo '<h4>Add new forwarder</h4>';
echo <<<EOF
<form class="form-inline" role="form" action="$uri_base/AddForwarder/" method="POST">
  <div class="form-group">
    <label class="sr-only" for="mailbox_name">Address</label>
    <input type="text" class="form-control" id="mailbox_name" name="mailbox_name" placeholder="Address">
	@domain.tld
  </div>
  <div class="form-group">
    <label class="sr-only" for="destinations">Destination(s)</label>
    <input type="text" class="form-control" id="destinations" name="destinations" placeholder="Destination(s)">
	<i class="fa fa-angle-double-left"></i> Comma separated
  </div>
  <button type="submit" class="btn btn-default">Add forwarder</button>
</form>
EOF;
				echo '<hr>';
echo <<<EOF
<form class="form-inline" role="form" action="$uri_base/SetupVirtualMailboxes/" method="POST">
  <button type="submit" class="btn btn-default">Setup virtual mailboxes</button>
</form>
EOF;
			} else {
				echo '<p><a href="' . $uri_base . '/List/"><i class="fa fa-arrow-left"></i> Back to the listing</a></p><hr>';
				if($path_info[1] == 'AddMailbox') {
					if(!empty($_POST['mailbox_name']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
						if(in_array($_POST['mailbox_name'], UberspaceMM::getUsernames(true)))
							$errors[] = 'The username <b>' . $_POST['mailbox_name'] . '</b> already exists';
						if($_POST['password'] != $_POST['password2'])
							$errors[] = 'The passwords do not match';
						if(empty($errors)) {
							if(UberspaceMM::addNewUser($_POST['mailbox_name'], $_POST['password']))
								echo '<div class="alert alert-success"><b>Yay!</b> Added user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
							else
								echo '<div class="alert alert-danger"><b>Fawk!</b> Could not add the user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
						} else {
							echo '<div class="alert alert-danger"><b>Damn, there were errors!</b><br>';
							echo '- ' . implode('<br>- ', $errors);
							echo '</div>';
						}
					} else {
						echo '<div class="alert alert-warning"><b>Hey, you!</b> Please fill out every field.</div>';
					}
				} else if($path_info[1] == 'AddForwarder') {
					if(!empty($_POST['mailbox_name']) && !empty($_POST['destinations'])) {
							if(!in_array($_POST['mailbox_name'], UberspaceMM::getUsernames(true))) {
								if(UberspaceMM::addNewAlias($_POST['mailbox_name'], implode(' ', explode(',', trim($_POST['destinations'])))))
									echo '<div class="alert alert-success"><b>Yay!</b> Added user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
								else
									echo '<div class="alert alert-danger"><b>Hmmpf!</b> Could not add the user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
							} else {
								echo '<div class="alert alert-danger"><b>Fawk!</b> The username <b>' . $_POST['mailbox_name'] . '</b> already exists.</div>';
							}
					} else {
						echo '<div class="alert alert-warning"><b>Ey!</b> Please fill out every field.</div>';
					}
				} else if($path_info[1] == 'Delete') {
					if(!empty($path_info[2])) {
						if(in_array($path_info[2], UberspaceMM::getUsernames(true))) {
							if(UberspaceMM::deleteUser($path_info[2]))
								echo '<div class="alert alert-success"><b>Yippieh!</b> The user <b>' . $path_info[2] . '</b> was successfully deleted.</div>';
							else
								echo '<div class="alert alert-danger"><b>Damn it!</b> Could not delete the user <b>' . $path_info[2] . '</b>.</div>';
						} else {
							echo '<div class="alert alert-warning"><b>OMG!</b> The user <b>' . $path_info[2] . '</b> does not even exist.</div>';
						}
					} else {
						echo '<div class="alert alert-warning"><b>Sorry!</b> I can not determine which user you want to delete. :/</div>';
					}
				} else if($path_info[1] == 'Edit') {
					if(!empty($path_info[2])) {
						$username = $path_info[2];
						if(in_array($path_info[2], UberspaceMM::getUsernames(true))) {
							echo '<h3>Edit user <b>' . $path_info[2] . '</b></h3>';
							echo '<h4>Set new password</h4>';
echo <<<EOF
<form class="form-inline" role="form" action="$uri_base/ChangePassword/" method="POST">
  <input id="mailbox_name" name="mailbox_name" type="hidden" value="$username">
  <div class="form-group">
    <label class="sr-only" for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label class="sr-only" for="password2">Retype password</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Retype password">
  </div>
  <button type="submit" class="btn btn-default">Change password</button>
</form>
EOF;
							echo '<hr>';
							echo '<h4>Change forwarding destinations</h4>';
							$usernames = UberspaceMM::getUsernames();
							$arrForwards = $usernames[$path_info[2]]['forwards'];
							$strForwards = implode(',', $arrForwards);
							unset($usernames);
							unset($arrForwards);
echo <<<EOF
<form class="form-inline" role="form" action="$uri_base/ChangeDestinations/" method="POST">
  <input id="mailbox_name" name="mailbox_name" type="hidden" value="$username">
  <div class="form-group">
    <label class="sr-only" for="destinations">Destination(s)</label>
    <input type="text" class="form-control" id="destinations" name="destinations" placeholder="Destination(s)" value="$strForwards">
	<i class="fa fa-angle-double-left"></i> Comma separated
  </div>
  <button type="submit" class="btn btn-default">Change destinations</button>
</form>
EOF;
						} else {
							echo '<div class="alert alert-warning"><b>OMG!</b> The user <b>' . $path_info[2] . '</b> does not even exist.</div>';
						}
					} else {
						echo '<div class="alert alert-warning"><b>Sorry!</b> I can not determine which user you want to delete. :/</div>';
					}
				} else if($path_info[1] == 'ChangePassword') {
					if(!empty($_POST['mailbox_name']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
							if(in_array($_POST['mailbox_name'], UberspaceMM::getUsernames(true))) {
								if($_POST['password'] == $_POST['password2']) {
									if(UberspaceMM::setNewPassword($_POST['mailbox_name'], $_POST['password']))
										echo '<div class="alert alert-success"><b>Yay!</b> Changed password for user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
									else
										echo '<div class="alert alert-danger"><b>Uncool!</b> Could not change the password for the user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
								} else {
									echo '<div class="alert alert-danger"><b>WTF?!</b> The passwords do not match.</div>';
								}
							} else {
								echo '<div class="alert alert-danger"><b>Fawk!</b> The user <b>' . $_POST['mailbox_name'] . '</b> does not exist.</div>';
							}
					} else {
						echo '<div class="alert alert-warning"><b>Ey!</b> Please fill out every field.</div>';
					}
				} else if($path_info[1] == 'ChangeDestinations') {
					if(!empty($_POST['mailbox_name'])) {
							if(in_array($_POST['mailbox_name'], UberspaceMM::getUsernames(true))) {
								if(UberspaceMM::changeForwards($_POST['mailbox_name'], implode(' ', explode(',', trim($_POST['destinations'])))))
									echo '<div class="alert alert-success"><b>Yay!</b> Changed forwarding destinations for user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
								else
									echo '<div class="alert alert-danger"><b>Fuack!</b> It was impossible for me to change the destinations for the user <b>' . $_POST['mailbox_name'] . '</b>.</div>';
							} else {
								echo '<div class="alert alert-danger"><b>Fawk!</b> The user <b>' . $_POST['mailbox_name'] . '</b> does not exist.</div>';
							}
					} else {
						echo '<div class="alert alert-warning"><b>Ey!</b> Please fill out every field.</div>';
					}
				} else if($path_info[1] == 'SetupVirtualMailboxes') {
					if(UberspaceMM::setupVirtualMailboxes())
						echo '<div class="alert alert-success"><b>Yay!</b> Successfully set up virtual mailboxes.</div>';
					else
						echo '<div class="alert alert-danger"><b>Fuack!</b> I encountered an error while trying to set virtual mailboxes up.</div>';
				} else {
					echo '<div class="alert alert-warning"><b>Oh noes!</b> This page does not exist.</div>';
				}
			}
            ?>
			<hr>
			<p>&copy; 2014 - <a href="https://github.com/LucaKling">Luca Kling</a></p>
        </div>
    	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </body>
</html>