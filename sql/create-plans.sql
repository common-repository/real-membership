CREATE TABLE IF NOT EXISTS %%TABLE_NAME%%
(
	id   					INT NOT NULL AUTO_INCREMENT,
	name	   				VARCHAR(100) NOT NULL, # Cannot be more than 100 chars - triggers error
	color					char(6) NULL,
	is_active				TINYINT DEFAULT 1,

	base_price				DECIMAL(10,2),

	duration				SMALLINT NOT NULL,
	duration_type 			ENUM('Minutes', 'Hours', 'Days', 'Weeks', 'Months', 'Years') NOT NULL,
	
	created_by				INT NOT NULL,
	date_created			DATETIME NOT NULL,

	teaser					TEXT,
	description				TEXT,
	private_notes			TEXT,

	PRIMARY KEY (`id`),
	UNIQUE KEY `plan_name` (`name`)
)