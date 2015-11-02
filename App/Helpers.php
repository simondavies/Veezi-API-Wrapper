<?php
/**
 * Helper methods
 */
if (!function_exists('logErrors')) {
	/**
	 * a simple visual output of any exceptions called
	 * how you want to do it is up to you though
	 * @param   $message
	 */
	function logErrors($message) {
		$_SESSION['errors'] = $message;
		header('Location: ../Examples/errors.php');
	}

}