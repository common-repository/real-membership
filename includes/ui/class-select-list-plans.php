<?php
// @link https://stackoverflow.com/questions/13221084/how-to-create-a-select-list-using-php-oop

class Real_Membership_Select_List_Plans {
    protected $types;
    
	protected $select_list;
	protected $select_options = array();
    
	protected $select_html;

    public function __construct($selected_plan_id = 0) {
		$plans = Real_Membership_Data_Plans::get_all('*', $where = 'is_active = 1');
	
		$this->select_options[] = new Real_Membership_Select_List_Option(__('Select plan', 'real-membership'), '', false);
		
		foreach($plans as $plan) {
			$is_selected = ($selected_plan_id == $plan->id) ? true : false;
			
			$this->select_options[] = new Real_Membership_Select_List_Option($plan->name, $plan->id, $is_selected, $data_params = array('duration' => $plan->duration, 'duration-type' => $plan->duration_type));
		}
		
		$this->select_list = new Real_Membership_Select_List($name_id = 'base_plans', $this->select_options);
		$this->select_html = $this->select_list->render();

    }
	
	/*
	 *
	 * Returns the dropdown html, initially rendered in the constructor.
	 *
	 */
	public function get_select_html() {
		return $this->select_html;
	}
}