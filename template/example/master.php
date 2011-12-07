<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- MasterPage example demo -->
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
	<head profile="http://gmpg.org/xfn/11">
		<!-- Include a single file same php include or load control same .Net like ascx -->
	</head>
	<body>
		<!-- Example of execute a php code function -->
		<h1>test phpver: <?php echo phpversion(); ?></h1>
		<ul>
			<li><a href="example">Home</a></li>
			<li><a href="example.other">Other</a></li>
			<li><a href="example.pita">Pita</a></li>
		</ul>
		<!-- Example of placeholder -->
		<php:place name="content" />
	</body>
</html>