<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- MasterPage example demo -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
    <head profile="http://gmpg.org/xfn/11">
		<!-- Include a single file same php include or load control same .Net like ascx -->
		<pep:place name="head" include="/template/test/head.php" />
    </head>
    <body>
		<!-- Include a single file same php include or load control same .Net like ascx -->
		<pep:place name="menu" include="/template/test/menu.php" />
		<!-- Example of execute a php code function -->
		<h1>test phpver: <?php echo phpversion(); ?></h1>
		<!-- Example of placeholder -->
		<pep:place name="content" />
		<hr/>
		<!-- Example of capture a request value and print it -->
		<?php echo $request->getParam('value'); ?>
    </body>
</html>