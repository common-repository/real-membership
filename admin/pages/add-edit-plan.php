<div class="wrap">
	<?php
		if(isset($addPage)) {
			$pageTitle = 'Add Plan';
			$plan_data = $_REQUEST;

			$action 	= 'add';
			$subaction 	= 'save';

			$button_label = 'Add plan';
			$page_url = "admin.php?page=real_membership_plans&action={$action}&subaction={$subaction}";
		}
		if(isset($editPage)) {
			$pageTitle = 'Edit Plan';

			// $plan_data; // Is taken from db

			$action 	= 'edit';
			$subaction 	= 'save';
			
			$button_label = 'Update plan';
			$page_url = "admin.php?page=real_membership_plans&action={$action}&subaction={$subaction}&id=" . $plan_data['id'];
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
						<label for="name"><?php _e('Plan id', 'real-membership'); ?></label>
					</th>
					<td><?php echo $plan_data['id']; ?></td>
				</tr>
				<?php } ?>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="name"><?php _e('Plan name', 'real-membership'); ?></label>
					</th>
					<td><input name="name" id="name" type="text" style="width: 300px;" value="<?php echo isset($plan_data['name']) ? $plan_data['name'] : ''; ?>"></td>
				</tr>
				
				<tr class="form-field form-required">
					<th scope="row">
						<label for="name"><?php _e('Plan color', 'real-membership'); ?></label>
					</th><?php // The Iris Color Picker requires - for ids ?>
					<td><input type="text" value="<?php echo isset($plan_data['plan_color']) ? '#' . $plan_data['plan_color'] : ''; ?>" name="plan_color" id="plan-color" /></td>
				</tr>
				
				<tr class="form-field form-required">
					<th scope="row">
						<label for="is_active"><?php _e('Is active', 'real-membership'); ?></label>
					</th>
					<td><input name="is_active" id="is_active" type="checkbox" <?php echo (isset($plan_data['is_active']) AND in_array($plan_data['is_active'], array(1, 'on'))) ? 'checked' : ''; ?>></td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="base_price"><?php _e('Base price', 'real-membership'); ?></label>
					</th>
					<td>
						<input name="base_price" id="base_price" type="number" min="0.00" max="1000.00" step="0.01" style="width: 100px;" value="<?php echo isset($plan_data['base_price']) ? $plan_data['base_price'] : ''; ?>" /><br>
						<?php _e('If 0 the plan will be offered for free.', 'real-membership'); ?>
					</td>
				</tr>

				<tr class="form-field form-required">
					<th scope="row">
						<label for="duration"><?php _e('Plan duration', 'real-membership'); ?></label>
					</th>
					<td>
						<input name="duration" id="duration" type="number" min="1" max="1000" style="width: 100px;" value="<?php echo isset($plan_data['duration']) ? $plan_data['duration'] : ''; ?>" >
						<?php
							$selected_type = isset($plan_data['duration_type']) ? $plan_data['duration_type'] : '';
							$duration_type_dropdown = new Real_Membership_Select_List_Duration_Type($selected_type);
							
							echo $duration_type_dropdown->get_select_html();
						
						?>
					</td>
				</tr>
				<?php if(isset($editPage)) { ?>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="created_by"><?php _e('Created by', 'real-membership'); ?></label>
					</th>
					<td>
						<strong><?php echo $user->user_login; ?></strong>
						<input type="hidden" name="created_by" value="<?php echo $user->ID; ?>"></input>
					</td>
				</tr>
				<?php } ?>
				
				<tr class="form-field form-required">
					<th scope="row">
						<label for="teaser"><?php _e('Teaser', 'real-membership'); ?></label>
					</th>
					<td>
						<?php
							$teaser_content = isset($plan_data['teaser']) ? $plan_data['teaser'] : '';
							wp_editor( $teaser_content, 'teaser', $teaser_settings = array('textarea_rows' => 5));
						?>
						<?php // <input type="hidden" name="teaser" value=""></input> ?>
					</td>
				</tr>
				<tr class="form-field form-required">
					<th scope="row">
						<label for="description"><?php _e('Description', 'real-membership'); ?></label>
					</th>
					<td>
						<?php
							$description_content = isset($plan_data['description']) ? $plan_data['description'] : '';
							wp_editor( $description_content, 'description', $description_settings = array('textarea_rows' => 5));
						?>
						<?php // <input type="hidden" name="description" value=""></input> ?>
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