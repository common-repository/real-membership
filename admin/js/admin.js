(function( $ ) {
	'use strict';

	// jQuery onload
	$(function() {
		// Listing screens
		$('.delete-row').click(function(e) {
			if( confirm('Are you sure you wish to delete ?') ) {
				// Run the link
			} else {
				e.preventDefault();
			}
		});
		
		// Add/Edit plan: Color picker
		var planColorOptions = {
			palettes: true, // show a group of common colors beneath the square
			palettes: ['#000', '#f00', '#0f0', '#00f', '#fff', '#f0f']
		};
		$('#plan-color').wpColorPicker(planColorOptions);
		
		// Add/Edit screens - Activate Date picker
		$('span.dashicons-calendar-alt').click(function(e){
			if($(this).prev().hasClass('hasDatepicker'))
				$(this).prev().focus();
		});
		
		/* Custom Date Picker */
		$('.custom_date').datepicker({
			dateFormat : 'yy-mm-dd'
		});

		// Add/Edit membership
		$('#base_plans').on('change', function(){
			// Set duration values based on plan
			var planOption 	= $(this).find('option:selected');
			var planData 	= planOption.data();
			
			if( !jQuery.isEmptyObject(planData) ) {
				$('#duration').val( planData.duration );
				$('#duration_type').val( planData.durationType );
			}
		});
	});

	
	// Window onload
	$( window ).load(function() {
		// ...
	});

})( jQuery );