CREATE TABLE IF NOT EXISTS %%TABLE_NAME%%
(
	id				INT NOT NULL AUTO_INCREMENT,
	plan_id			INT NOT NULL,
	is_active		TINYINT DEFAULT 1,

	user_id  		INT NOT NULL,
	order_id		INT NOT NULL DEFAULT 0, # Here we should keep base price, paid price, discount, currency, payment method, etc ...

	start_date   	DATETIME NOT NULL,
	duration	 	SMALLINT,
	duration_type	ENUM('minutes', 'hours', 'days', 'weeks', 'months', 'years'),

	private_notes	TEXT,

	PRIMARY KEY (`id`)
	# UNIQUE KEY `plan_user_id` (`plan_id`, `user_id`) # Confirm if plan_id + user_id should be unique
)