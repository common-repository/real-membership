<div class="wrap">
	<h1>
		<?php _e('User Memberships', 'real-membership'); ?>
		<a href="admin.php?page=real_membership_user_memberships&action=add" class="page-title-action"><?php _e('Add membership', 'real-membership'); ?></a>
	</h1>
	<hr class="wp-header-end">
	
	<table class="wp-list-table widefat fixed striped pages">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-title" nowrap style="width: 10px;">
					<strong><?php _e('User', 'real-membership'); ?></strong>
				</th>
				<th scope="col" class="manage-column column-title" nowrap style="width: 10px;">
					<strong><?php _e('Active', 'real-membership'); ?></strong>
				</th>
				<th scope="col" class="manage-column column-title" nowrap style="width: 30px;">
					<strong><?php _e('Based on', 'real-membership'); ?></strong>
				</th>
				<th scope="col" class="manage-column column-title" nowrap style="width: 30px;">
					<strong><?php _e('Start date', 'real-membership'); ?></strong><br>
					<strong><?php _e('Duration', 'real-membership'); ?></strong>
				</th>
				<th scope="col" class="manage-column column-title" nowrap style="width: 30px;">
					<strong><?php _e('Expires', 'real-membership'); ?></strong>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($memberships as $membership) { ?>
				<?php
					$activeIcon = $membership->is_active ? '<div class="dashicons dashicons-yes rmem-active"></div>' : '<div class="dashicons dashicons-no rmem-inactive"></div>';
				?>
			<tr>
				<td>
					<?php // @todo Make gravatar image dynamic ?>
					<img src="http://2.gravatar.com/avatar/e97556d88456a550faf4bb0dcef9c100?s=96&amp;d=mm&amp;r=g" width="24" height="24">
					<span title="<?php echo $membership->user_login; ?>"><?php echo $membership->user_login; ?></span>
				</td>
				<td><?php echo $activeIcon; ?></td>
				<td>
					<?php echo $membership->name; ?> <?php _e('plan', 'real-membership'); ?>
					<div class="row-actions">
						<span class="edit"><a href="admin.php?page=real_membership_user_memberships&action=edit&id=<?php echo $membership->id; ?>"><?php _e('Edit', 'real-membership'); ?></a> | </span>
						<span class="trash"><a href="admin.php?page=real_membership_user_memberships&action=delete&id=<?php echo $membership->id; ?>" class="delete-row"><?php _e('Delete', 'real-membership'); ?></a></span>
					</div>
				</td>
				<td>
					<?php
						$start_date = date_create( $membership->start_date );
						echo date_format($start_date, get_option('date_format') . ' ' . get_option('time_format'));
					?>
					<br>
					<strong><?php echo $membership->duration . ' ' . $membership->duration_type; ?></strong>
					<div class="plan_color_duration" style="width: 30px; background-color: #999" title="<?php _e('Plan duration in days', 'real-membership'); ?>"></div>
				</td>
				<td><?php echo $membership->expires->format(get_option('date_format') . ' ' . get_option('time_format')); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
				
</div>