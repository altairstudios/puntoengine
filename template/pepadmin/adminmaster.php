<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
    <head profile="http://gmpg.org/xfn/11">
	<pep:place name="head" include="/template/pepadmin/head.php" />
    </head>
    <body>
	<pep:place name="menu" include="/template/pepadmin/menu.php" />
	<h1>test</h1>
	<h1><?php echo 'prueba prueba prueba'; ?></h1>
	<h1><?php echo $request->getParam('aver'); ?></h1>
	<pep:place name="content" />
    </body>
</html>