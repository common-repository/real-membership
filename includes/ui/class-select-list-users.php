<?php
// @link https://stackoverflow.com/questions/13221084/how-to-create-a-select-list-using-php-oop
class Real_Membership_Select_List_Users {
    protected $types;
    
	protected $select_list;
	protected $select_options = array();
    
	protected $select_html;

    public function __construct($selected_user_id = 0, $show_label = true) {
		$users = get_users();
		
		if($show_label)
			$this->select_options[] = new Real_Membership_Select_List_Option(__('Select user', 'real-membership'), '', false);
		
		foreach($users as $user) {
			$is_selected = ($selected_user_id == $user->ID) ? true : false;
			
			$label = $user->user_login . " (ID {$user->ID})";
			$value = $user->ID;
			$this->select_options[] = new Real_Membership_Select_List_Option($label, $value, $is_selected);
		}
		
		$this->select_list = new Real_Membership_Select_List($name_id = 'users', $this->select_options);
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