<?php
// @link https://stackoverflow.com/questions/13221084/how-to-create-a-select-list-using-php-oop

class Real_Membership_Select_List_Duration_Type {
    protected $types;
    
	protected $select_list;
	protected $select_options = array();
    
	protected $select_html;

    public function __construct($selected_type = '') {
		$this->types = array('Days', 'Weeks', 'Months', 'Years', '-----', 'Minutes', 'Hours');
		
		foreach($this->types as $type) {
			$isSelected = ($selected_type == $type) ? true : false;
			$value = $type;

			$this->select_options[] = new Real_Membership_Select_List_Option($type, $value, $isSelected);
		}
		
		
		$this->select_list = new Real_Membership_Select_List($name_id = 'duration_type', $this->select_options);
		$this->select_html = $this->select_list->render();
    }
	
	public function get_select_html() {
		return $this->select_html;
	}
}