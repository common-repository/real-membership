<div class="wrap">
	<h1>Settings</h1>

	<?php echo (isset($notice)) ? $notice : ''; ?>
	
	<form method="post" name="rmem_settings" id="rmem_settings" class="validate" novalidate="novalidate">
		<input name="action" type="hidden" value="save">
	
		<table class="form-table">
			<tbody>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="user_login"><?php _e('Default currency', 'real-membership'); ?></label>
					</th>
					<td>
						<select name="default_currency" id="default_currency">
							<?php
								foreach($currencies as $currency) {
									$name 		= $currency->name;
									$value 		= $currency->iso;
									$symbols	= $currency->symbol_before . $currency->symbol_after;

									$selected 	= '';
									if($currency->is_default) $selected = "selected='selected'";
									
									echo "<option $selected value='$value'>$name ($symbols)</option>";
								}
							?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		
		<p class="submit">
			<input type="submit" class="button button-primary" value="Save settings">
		</p>
	</form>
</div>