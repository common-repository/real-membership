<div class="wrap">
	<h1>
		<?php _e('Plans', 'real-membership'); ?>
		<a href="admin.php?page=real_membership_plans&action=add" class="page-title-action"><?php _e('Add plan', 'real-membership'); ?></a>
	</h1>
	<hr class="wp-header-end">

	<table class="wp-list-table widefat fixed striped pages">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-title" nowrap style="width: 60px;">
					<strong><?php _e('Active', 'real-membership'); ?></strong>
				</th>
				<th scope="col" class="manage-column column-title column-primary sortable desc">
					<strong>
						Id:
						<?php _e('Plan name', 'real-membership'); ?>
					</strong>
				</th>
				<th scope="col" class="manage-column column-base-price">
					<strong><?php _e('Base price', 'real-membership'); ?></strong>
				</th>

				<th scope="col" class="manage-column column-duration">
					<strong>
						<?php _e('Plan duration', 'real-membership'); ?>
					</strong><br>
					<?php _e('Plan color', 'real-membership'); ?>
				</th>
				<th scope="col" class="manage-column column-date-created">
					<strong><?php _e('Date created', 'real-membership'); ?></strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($plans as $plan) { ?>
				<?php
					$activeIcon = $plan->is_active ? '<div class="dashicons dashicons-yes rmem-active"></div>' : '<div class="dashicons dashicons-no rmem-inactive"></div>';
				?>
				<tr>
					<td><?php echo $activeIcon; ?></td>
					<td>
						<?php echo $plan->id . ': ' . $plan->name; ?>
						<div class="row-actions">
							<span class="edit"><a href="admin.php?page=real_membership_plans&action=edit&id=<?php echo $plan->id; ?>">Edit</a> | </span>
							<span class="trash"><a href="admin.php?page=real_membership_plans&action=delete&id=<?php echo $plan->id; ?>" class="delete-row">Delete</a></span>
						</div>
					</td>
					<td><strong><?php echo $default_currency->symbol_before . " {$plan->base_price} " . $default_currency->symbol_after; ?></strong></td>
					<td>
						<?php echo $plan->duration . ' ' . $plan->duration_type; ?><br>
						<div class="plan_color_sample" style="background-color: #<?php echo $plan->color; ?>"></div>
						
					</td>

					<td>
						<?php
							$date_created = date_create( $plan->date_created );
							echo date_format($date_created, get_option('date_format') . ' ' . get_option('time_format'));
						?><br>
						<?php _e('Created by:', 'real-membership'); ?>
						<?php
							$user = get_user_by('id', $plan->created_by);
							echo '<strong>' . $user->user_login . '</strong>';
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>