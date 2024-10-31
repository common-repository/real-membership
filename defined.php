<?php

// Real Membership Name
define('REAL_MEMBERSHIP_NAME', 'Real_Membership');

// Real Membership db prefix - digit in front keeps tables at the top
define('REAL_MEMBERSHIP_DB_PREFIX', '1rm_');


// Define root path
define( 'REAL_MEMBERSHIP_ROOT', plugin_dir_path(__FILE__) );

// Define admin paths
define( 'REAL_MEMBERSHIP_ADMIN_PATH', 			REAL_MEMBERSHIP_ROOT . '/admin/' );
define( 'REAL_MEMBERSHIP_ADMIN_PAGES_PATH', 	REAL_MEMBERSHIP_ADMIN_PATH . '/pages/' );

// Define public paths
define( 'REAL_MEMBERSHIP_FRONTEND_PATH', 		REAL_MEMBERSHIP_ROOT . '/frontend/' );
define( 'REAL_MEMBERSHIP_FRONTEND_PAGES_PATH', 	REAL_MEMBERSHIP_FRONTEND_PATH . '/pages/' );

// Define other paths
define( 'REAL_MEMBERSHIP_INCLUDES_PATH', 		REAL_MEMBERSHIP_ROOT . '/includes/' );
define( 'REAL_MEMBERSHIP_LANG_PATH', 			REAL_MEMBERSHIP_ROOT . '/languages/' );
define( 'REAL_MEMBERSHIP_SQL_PATH', 			REAL_MEMBERSHIP_ROOT . '/sql/' );
define( 'REAL_MEMBERSHIP_DATA_PATH', 			REAL_MEMBERSHIP_INCLUDES_PATH . '/data/' );
define( 'REAL_MEMBERSHIP_UTILS_PATH', 			REAL_MEMBERSHIP_INCLUDES_PATH . '/utils/' );
define( 'REAL_MEMBERSHIP_UI_PATH', 				REAL_MEMBERSHIP_INCLUDES_PATH . '/ui/' );


// Define create sql files
define('REAL_MEMBERSHIP_CREATE_PLANS_SQL', 				'create-plans.sql');
define('REAL_MEMBERSHIP_CREATE_USER_MEMBERSHIPS_SQL', 	'create-user-memberships.sql');
define('REAL_MEMBERSHIP_CREATE_SNAPSHOT_SQL', 			'create-snapshot.sql');
define('REAL_MEMBERSHIP_CREATE_CURRENCIES_SQL', 		'create-currencies.sql');
define('REAL_MEMBERSHIP_CREATE_SETTINGS_SQL', 			'create-settings.sql');

// Define insert sql files
define('REAL_MEMBERSHIP_INSERT_CURRENCIES_SQL', 'insert-currencies.sql');


// Utils
define('REAL_MEMBERSHIP_WHITESPACE', ' ');

// DATETIME related - used for replacement of NOW()
// true returns UTC/GMT. false is blog's local time. 
define('REAL_MEMBERSHIP_CURRENT_TIME', false);
