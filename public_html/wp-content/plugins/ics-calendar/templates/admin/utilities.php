<div id="data-cache">

	<h3><?php printf(__('%1$s Data Cache', 'r34ics'), 'ICS Calendar'); ?></h3>

	<form id="r34ics-purge-calendar-transients" method="post" action="">
		<?php
		wp_nonce_field('r34ics','r34ics-purge-calendar-transients-nonce');
		?>
		<input type="submit" class="button button-primary" value="<?php echo esc_attr(__('Clear Cached Calendar Data', 'r34ics')); ?>" />
		<p><?php _e('This will immediately clear all existing cached calendar data (purge transients), forcing WordPress to reload all calendars the next time they are viewed. Caching will then resume as before.', 'r34ics'); ?></p>
	</form>

</div>

<hr />
	
<div id="ics-feed-url-tester">

	<h3><?php _e('ICS Feed URL Tester', 'r34ics'); ?></h3>

	<p><?php _e('If you are concerned that the plugin is not properly retrieving your feed, you can test the URL here. The raw data received by the plugin will be displayed below.', 'r34ics'); ?></p>

	<form id="r34ics-url-tester" method="post" action="#ics-feed-url-tester">
		<?php
		wp_nonce_field('r34ics','r34ics-url-tester-nonce');
		?>
		<div class="r34ics-input">
			<label for="r34ics-url-tester-url_to_test"><input type="text" name="url_to_test" id="r34ics-url-tester-url_to_test" value="<?php if (!empty($url_to_test)) { echo esc_attr($url_to_test); } ?>" placeholder="<?php echo esc_attr(__('Enter feed URL...', 'r34ics')); ?>" style="width: 50%;" /></label> <input type="submit" class="button button-primary" value="<?php echo esc_attr(__('Test URL', 'r34ics')); ?>" />
		</div>
	</form>
	
	<?php
	if (!empty($url_tester_result)) {
		?>
		<p><mark class="success"><?php printf(__('%s received.', 'r34ics'), size_format(strlen($url_tester_result), 2)); ?></mark></p>
		<?php
		if (strpos($url_tester_result,'BEGIN:VCALENDAR') !== 0) {
			?>
			<p><mark class="alert"><?php _e('This does not appear to be a valid ICS feed URL.', 'r34ics'); ?></mark></p>
			<?php
		}
		?>
		<textarea class="diagnostics-window" readonly="readonly" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php echo htmlentities($url_tester_result); ?></textarea>
		<?php
	}
	else {
		if (!empty($url_to_test)) {
			?>
			<p><mark class="error"><?php _e('Could not retrieve data from the requested URL.', 'r34ics'); ?></mark></p>
			<?php
		}
		elseif (isset($_POST['r34ics-url-tester-nonce'])) {
			?>
			<p><mark class="error"><?php _e('An unknown error occurred while attempting to retrieve the requested URL.', 'r34ics'); ?></mark></p>
			<?php
		}
	}
	if (!empty($url_to_test) && !empty($url_tester_debug[$url_to_test])) {
		?>
		<textarea class="diagnostics-window" readonly="readonly" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php
		if (!empty($url_tester_debug[$url_to_test]['Errors'])) {
			echo "Errors:\n";
			foreach ((array)$url_tester_debug[$url_to_test]['Errors'] as $item) {
				echo $item . "\n";
			}
			echo "\n";
		}
		if (!empty($url_tester_debug[$url_to_test]['Load status'])) {
			echo "Load status:\n";
			foreach ((array)$url_tester_debug[$url_to_test]['Load status'] as $item) {
				echo $item . "\n";
			}
			echo "\n";
		}
		if (!empty($url_tester_debug[$url_to_test]['URL contents retrieved'])) {
			echo "URL contents retrieved:\n";
			foreach ((array)$url_tester_debug[$url_to_test]['URL contents retrieved'] as $item) {
				echo $item . "\n";
			}
			echo "\n";
		}
		if (!empty($url_tester_debug[$url_to_test]['cURL info'])) {
			echo "cURL info:\n";
			foreach ((array)$url_tester_debug[$url_to_test]['cURL info'][0] as $key => $item) {
				echo $key . ': ' . implode(', ', (array)$item) . "\n";
			}
			echo "\n";
		}
		?></textarea>
		<?php
	}
	?>

</div>

<?php
// Restrict System Report to admins / super admins
if	(
			(is_multisite() && current_user_can('setup_network')) ||
			(!is_multisite() && current_user_can('manage_options'))
		)
{
	?>
	<hr />
	
	<div id="system-report">

		<h3><?php _e('System Report', 'r34ics'); ?></h3>

		<p><mark class="info"><?php _e('Please copy the following text and include it in your message when emailing support.', 'r34ics'); ?><br />
		<?php printf(__('Also please include the %1$s shortcode exactly as you have it entered on the affected page.', 'r34ics'), 'ICS Calendar'); ?></mark><br /><mark class="error"><?php printf(__('For your site security please do NOT post the System Report in the support forums.', 'r34ics')); ?></mark></p>

		<textarea class="diagnostics-window" readonly="readonly" style="cursor: copy;" onclick="this.select(); document.execCommand('copy');"><?php r34ics_system_report(); ?></textarea>

	</div>
	<?php
}
?>