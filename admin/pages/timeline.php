<?php
	// @todo Move these to the class above - 1 hour
	$currentYear = date("Y");
	$yearRangeStart = $currentYear - 5;
	$yearRangeEnd = $currentYear + 5;

	$focusyear = $currentYear;
	if(isset($_REQUEST['focusyear']))
		$focusyear = (int)$_REQUEST['focusyear'];

	$paged = 1;
	if(isset($_REQUEST['paged']))
		$paged = (int)$_REQUEST['paged'];
?>
<div class="wrap">
	<h1>
		Timeline
	
		<span id="label_focusyear">Focus Year:</span>
		<input type="hidden" name="page" value="piiv2_userplans">
		<input type="hidden" name="paged" value="1">
		<?php // @todo Move these to a separate ui class - 30 mins ?>
		<select name="focusyear" id="focusyear">
			<?php for($i = $yearRangeStart; $i < $yearRangeEnd; $i++) {
					$selected = '';
					if($i == $focusyear) $selected = 'selected';
					echo "<option value='$i' $selected>$i</option>";
				}
			?>
		</select>
	</h1>
	<p>2 Full days of work</p>
	<br>
	
	<div id="plan-shapes">
		<strong>Plans:</strong>
		<?php // @todo Get & list plans - 1 hour ?>
		<div id="Free" 		class="PlanShape">Free</div>
		<div id="Bronze" 	class="PlanShape">Bronze</div>
		<div id="Silver" 	class="PlanShape">Silver</div>
		<div id="Gold" 		class="PlanShape">Gold</div>
		<div id="Platinum" 	class="PlanShape">Platinum</div>
		<span>Open all</span>
	</div>
	
	<table id="user-plans">
		<thead>
			<tr>
				<th scope="col" rowspan="2">Users</th>
				<th scope="col" colspan="12" align="center"><strong>2016</strong></th>
				<th scope="col" colspan="12" align="center" style="background: #fffff0;"><strong>2017</strong></th>
				<th scope="col" colspan="12" align="center"><strong>2018</strong></th>
			</tr>
			<tr>
				<th scope="col" class="month">Jan</th>
				<th scope="col" class="month">Feb</th>
				<th scope="col" class="month">Mar</th>
				<th scope="col" class="month">Apr</th>
				<th scope="col" class="month">May</th>
				<th scope="col" class="month">Jun</th>
				<th scope="col" class="month">Jul</th>
				<th scope="col" class="month">Aug</th>
				<th scope="col" class="month">Sep</th>
				<th scope="col" class="month">Oct</th>
				<th scope="col" class="month">Nov</th>
				<th scope="col" class="month">Dec</th>

				<th scope="col" class="month" style="background: #fffff0;">Jan</th>
				<th scope="col" class="month" style="background: #fffff0;">Feb</th>
				<th scope="col" class="month" style="background: #fffff0;">Mar</th>
				<th scope="col" class="month" style="background: #fffff0;">Apr</th>
				<th scope="col" class="month" style="background: #fffff0;">May</th>
				<th scope="col" class="month" style="background: #fffff0;">Jun</th>
				<th scope="col" class="month" style="background: #fffff0;">Jul</th>
				<th scope="col" class="month" style="background: #fffff0;">Aug</th>
				<th scope="col" class="month" style="background: #fffff0;">Sep</th>
				<th scope="col" class="month" style="background: #fffff0;">Oct</th>
				<th scope="col" class="month" style="background: #fffff0;">Nov</th>
				<th scope="col" class="month" style="background: #fffff0;">Dec</th>

				<th scope="col" class="month">Jan</th>
				<th scope="col" class="month">Feb</th>
				<th scope="col" class="month">Mar</th>
				<th scope="col" class="month">Apr</th>
				<th scope="col" class="month">May</th>
				<th scope="col" class="month">Jun</th>
				<th scope="col" class="month">Jul</th>
				<th scope="col" class="month">Aug</th>
				<th scope="col" class="month">Sep</th>
				<th scope="col" class="month">Oct</th>
				<th scope="col" class="month">Nov</th>
				<th scope="col" class="month">Dec</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($users as $user) {
					// var_dump( $user );
					// var_dump( $user->user_login );
					
					$avatar_url = get_avatar_url($user->ID);
					
					// @todo Check the user has plan - 1 hour
					// @todo Add display name & email to the title attribute - 20 mins
					$avatar_title = ' : ';
					
					// @todo Compute today shift - 1 hour
			?>
			<tr class="User hasPlan" id="User2">
				<td class="Username Closed">
					<img src="<?php echo $avatar_url; ?>" width="24" height="24" />
					<span title="<?php echo $user->nicename; ?>"><?php echo $user->user_login; ?></span>
				</td>
				<td colspan="36" class="Today" style="background-position: 1164px 0;"></td>
			</tr>
			<?php } ?>
		</tbody>
		<?php // @todo tfoot should be like thead ?>
	</table>
</div>