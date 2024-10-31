<?php
class Real_Membership_Select_List {
	protected $options = array();
	protected $name_id;

	public function __construct($name_id, $options) {
		$this->options = $options;
		$this->name_id = $name_id;
		
		if(!empty($data_params))
			$this->data_params = $data_params;
	}

    public function render() {
		$html = "<select name='{$this->name_id}' id='{$this->name_id}'>\n";
			foreach ($this->options as $option)
				$html .= $option->render();
        $html .= "</select>\n";

		return $html;
    }
}

class Real_Membership_Select_List_Option {
    protected $label;
    protected $value;
    protected $isSelected;
	protected $data_params = array();

    public function __construct($label, $value, $isSelected = false, $data_params = array()) {
      
		// Assign the properties
		$this->label 		= $label;
		$this->value 		= $value;
		$this->isSelected = $isSelected;

		if(!empty($data_params))
			$this->data_params = $data_params;

    }

    public function render() {
		$selected = '';
		if ($this->isSelected) $selected = ' selected="selected" ';

		$data_attrs = '';
		foreach($this->data_params as $param_name => $param_value) {
			$data_attrs .= " data-{$param_name}='{$param_value}' ";
		}
	
		$html = "<option value='{$this->value}' $data_attrs $selected >" . $this->label . "</option>\n";
		
		return $html;
    }
}