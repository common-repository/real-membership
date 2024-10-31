CREATE TABLE IF NOT EXISTS %%TABLE_NAME%%
(
	`iso`   			CHAR(3) NOT NULL DEFAULT '',
	`name`   			VARCHAR(100) NOT NULL,

	`symbol_before`		VARCHAR(5),
	`unicode_before` 	VARCHAR(10),

	`symbol_after`		VARCHAR(5),
	`unicode_after` 	VARCHAR(10),
	
	`is_default`		TINYINT DEFAULT 0,

	PRIMARY KEY (`iso`),
	UNIQUE KEY `name` (`name`)
)