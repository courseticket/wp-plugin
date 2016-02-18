<?php
function ct_settings_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Courseticket API settings')?></h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'ct-settings-group' ); ?>
			<?php do_settings_sections( 'ct-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e('Account ID')?></th>
					<td><input type="text" name="ct_id" value="<?php
						echo esc_attr( get_option('ct_id') ); ?>" /></td>
				</tr>

<!--				<tr valign="top">-->
<!--					<th scope="row">--><?php //_e('API key')?><!--</th>-->
<!--					<td><input type="text" name="api_key" value="--><?php
//						echo esc_attr( get_option('api_key') ); ?><!--" /></td>-->
<!--				</tr>-->

				<tr valign="top">
					<th scope="row"><?php _e('Overview page name')?></th>
					<td><input type="text" name="overview_page" value="<?php
						echo esc_attr( get_option('overview_page') ); ?>" /></td>
				</tr>
			</table>

			<?php submit_button(); ?>

		</form>
	</div>
<?php
}
?>