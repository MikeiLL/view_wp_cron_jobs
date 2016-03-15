<?php
/*
 * Plugin Name: View WP-Cron Jobs
 * */
if ( ! function_exists( 'mZ_write_to_file' ) ) {
	function mZ_write_to_file($message, $file_path='')
	{
			$file_path = ( ($file_path == '') || !file_exists($file_path) ) ? WP_CONTENT_DIR . '/mbo_cron_log.txt' : $file_path;
			$header = date('l dS \o\f F Y h:i:s A', strtotime("now")) . " \nMessage:\t ";

			if (is_array($message)) {
					$header = "\nCron Jobs:\n";
					$message = print_r($message, true);
			}
			$message .= "\n";
			file_put_contents(
					$file_path, 
					$header . $message, 
					FILE_APPEND | LOCK_EX
			);
	}
}

function mz_view_wp_cron_jobs_print_tasks() {
        mZ_write_to_file( _get_cron_array() );
}

mz_view_wp_cron_jobs_print_tasks();


?>
