<?php
/**
 * Source code of engine base of the puntoengine application to load the kernel
 * to process all request and load the application servlet to manage the request
 * @category puntoengine
 * @author Juan Benavides Romero <jbalde@gmail.com>
 * @since 0.1.1
 * @license: GPLv3 or above
 */
include( 'core/Kernel.php' );

Kernel::get()->process($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES);