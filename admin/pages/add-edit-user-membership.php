<div class="wrap">
	<?php
		if(isset($addPage)) {
			$pageTitle = 'Add membership';
			$membership_data = $_REQUEST;

			$action 	= 'add';
			$subaction 	= 'save';

			$button_label = 'Add membership';
			$page_url = "admin.php?page=real_membership_user_memberships&action={$action}&subaction={$subaction}";
		}
		if(isset($editPage)) {
			$pageTitle = 'Edit membership';

			// $membership_data; // Is taken from db

			$action 	= 'edit';
			$subaction 	= 'save';
			
			$button_label = 'Update membership';
			$page_url = "admin.php?page=real_membership_user_memberships&action={$action}&subaction={$subaction}&id=" . $membership_data['id'];
		}
	?>	
	<h1><?php _e($pageTitle, 'real-membership'); ?></h1>
	
	<?php echo (isset($notice)) ? $notice : ''; ?>
	
	<form action="<?php echo $page_url; ?>" method="post" name="rmem_add_edit_plan" id="rmem_add_edit_plan" class="validate" novalidate="novalidate">
		<table class="form-table">
			<tbody>
				<?php if(isset($editPage)) { ?>
				<tr class="form-field">
					<th scope="row">
						<label for="name"><?php _e('User plan id', 'real-membership'); ?></label>
					</th>
					<td><?php echo $membership_data['id']; ?></td>
				</tr>
				<?php } ?>

				<tr class="form-field">
					<th scope="row">
						<label for="name"><?php _e('User', 'real-membership'); ?> *</label>
					</th>
					<td><?php echo $users_dropdown_html; ?></td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="is_active"><?php _e('Is active', 'real-membership'); ?></label>
					</th>
					<td><input name="is_active" id="is_active" type="checkbox" <?php echo (isset($membership_data['is_active']) AND in_array($membership_data['is_active'], array(1, 'on'))) ? 'checked' : ''; ?>></td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="name"><?php _e('Start date', 'real-membership'); ?> *</label>
					</th>
					<td>
						<input type="text" class="custom_date" name="start_date" maxlength="10" style="width: 100px;" value="<?php echo isset($membership_data['start_date']) ? $membership_data['start_date'] : ''; ?>" />
						<span class="dashicons dashicons-calendar-alt" style="line-height: 1.3;"></span>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="name"><?php _e('Based on', 'real-membership'); ?> *</label>
					</th>
					<td><?php echo $plans_dropdown_html; ?></td>
				</tr>

				
				<tr class="form-field form-required">
					<th scope="row">
						<label for="duration"><?php _e('Duration', 'real-membership'); ?> *</label>
					</th>
					<td>
						<input name="duration" id="duration" type="number" min="1" max="1000" style="width: 100px;" value="<?php echo isset($membership_data['duration']) ? $membership_data['duration'] : ''; ?>" >
						<?php
							$selected_type = isset($membership_data['duration_type']) ? $membership_data['duration_type'] : '';
							$duration_type_dropdown = new Real_Membership_Select_List_Duration_Type($selected_type);
							
							echo $duration_type_dropdown->get_select_html();
						
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="private_notes"><?php _e('Private notes', 'real-membership'); ?></label>
					</th>
					<td>
						<textarea name="private_notes" id="private_notes" rows="8"></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button button-primary" value="<?php _e($button_label, 'real-membership'); ?>">
		</p>
	</form>
</div>