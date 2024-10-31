<?php
/**
 * GUMP - A fast, extensible PHP input validation class.
 *
 * @author      Damyan Mirchev
  * @copyright   Copyright (c) 2017 exigio.com
 *
 * @version     1.0
 */
class GUMP_Extended Extends Gump {
    protected function validate_color($field, $input, $param = null) {
		if (!isset($input[$field]) || empty($input[$field]))
            return;

		if(!ctype_xdigit($input[$field]))
			return;
			
		if(!strlen($input[$field]) == 6)
			return;
		
		
		return array(
			'field' => $field,
			'value' => $input[$field],
			'rule' => __FUNCTION__,
			'param' => $param,
		);
	}
}