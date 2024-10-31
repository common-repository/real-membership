# @todo add more currencies
# Links to lists of currencies:
# https://github.com/gregormck/multi-currencies-iso-codes-symbols-positions/blob/master/currencies.txt
# https://gist.github.com/allanlaal/6206895

INSERT INTO %%TABLE_NAME%%
(iso, name, symbol_before, unicode_before, symbol_after, unicode_after, is_default)
VALUES
('USD', 'US Dollar', '$', '&#36;', '', '', 1),
('EUR', 'Euro', '€', '&#128;', '', '', 0),
('CAD', 'Canadian Dollar', '$', '&#36;', '', '', 0),
('GBP', 'British Pound', '£', '&#163;', '', '', 0),
('AUD', 'Australian Dollar', '$', '&#36;', '', '', 0),
('CHF', 'Swiss Franc', 'Fr', 'Fr', '', '', 0),
('BGN', 'Bulgarian Lev', '', '', 'лв', '&#1083;&#1074;', 0),
('CNY', 'Yuan (Chinese) Renminbi', '¥', '&#165;', '', '', 0),
('JPY', 'Japanese Yen', '¥', '&#165;', '', '', 0)