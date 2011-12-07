<?php
/**
 * Source code of installation base of the puntoengine application to configure
 * the basic configuration of the application same the .htaccess or admin xml
 * to determinate the admin access
 * @category puntoengine
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */
if(isset($_POST['install'])) {
	ini_set('display_errors', true);

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$path = dirname($_SERVER['PHP_SELF']).'/';

	$htaccess = 'Options +Indexes
Options +FollowSymlinks

<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase '.$path.'

	#Can\'t access to config files
	#RewriteRule .*config/.*.xml.* engine.php [L]

	#Can\'t access to php files
	#RewriteRule .*\.php engine.php [L]

	#If file exist, the request go to the file
	#RewriteCond %{REQUEST_FILENAME} -f [OR]
	#RewriteCond %{REQUEST_FILENAME} -d
	#RewriteRule . %{REQUEST_FILENAME} [L]

	RewriteRule . engine.php [L]
</IfModule>

DirectoryIndex engine.php';

	if(is_writable('.htaccess')) {
		file_put_contents('.htaccess', $htaccess);
		$htaccesswrited = true;
	} else {
		$htaccesswrited = false;
	}

	$simple = simplexml_load_file('config/admin.xml');

	$simple->Users->User->Credentials->attributes()->user = $user;
	$simple->Users->User->Credentials->attributes()->pass = $pass;

	if(is_writable('config/admin.xml')) {
		$simple->asXML('config/admin.xml');
		$adminwrited = true;
	} else {
		$adminwrited = false;
	}

	$installed = true;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" />
		<title>PuntoEngine - Installation</title>
		<link href="core/resources/css/admin.css" rel="stylesheet" type="text/css" media="all" />
	</head>
	<body>
		<header id="header">Install</header>
		<div id="wrapper">
			<div id="container">
				<header>
					<div id="logo" class="minibox center">
						<img src="core/resources/images/logo.png" alt="PuntoEngine" title="PuntoEngine" />
					</div>
				</header>
				<article>
					<div class="container minibox">
						<div class="content">
							<?php
								if(isset($installed)) {
							?>
								<h3>Remember remove the file install.php</h3>
								<?php
									if(!$htaccesswrited) {
								?>
									.htaccess<br/>
									<textarea cols="44" rows="15"><?php echo $htaccess; ?></textarea>
									<br/><br/><br/>
								<?php
									}

									if(!$adminwrited) {
								?>
									config/admin.xml<br/>
									<textarea cols="44" rows="15"><?php echo $simple->asXML(); ?></textarea>
							<?php
									}
								} else {
							?>
							<form method="post" action="install.php">
								<p>
									<label for="user">User:<br/>
										<input type="text" name="user" id="user" autocomplete="off" />
									</label>
								</p>
								<p>
									<label for="pass">Password:<br/>
										<input type="password" name="pass" id="pass" autocomplete="off" />
									</label>
								</p>
								<div class="float">
									<div class="right">
										<input type="submit" name="install" value="Install" />
									</div>
								</div>
							</form>
							<?php
								}
							?>

						</div>
					</div>
				</article>
				<footer class="center">
					<p>PuntoEngine &copy; 2011</p>
				</footer>
			</div>
		</div>
	</body>
</html>