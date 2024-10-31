CREATE TABLE IF NOT EXISTS `userplans` (
  `plan_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` smallint(5) unsigned NOT NULL,
  `segment` enum('Articles','Uploads','Directory','Banners','VideoPromotion','AppAdvertising','Events','iCard') COLLATE cp1251_bulgarian_ci NOT NULL,
  `banners` set('MainSponsor','NewsSectionSponsor','Process118Sponsor') COLLATE cp1251_bulgarian_ci NOT NULL,
  `icard` set('CompanyProfile','AboutUs','LatestNews','DigitalLibrary','ProductRange','Videos','Events') COLLATE cp1251_bulgarian_ci NOT NULL,
  `type` enum('Bronze','Silver','Gold','Platinum','Premium') COLLATE cp1251_bulgarian_ci NOT NULL,
  `duration` tinyint(3) unsigned NOT NULL,
  `list_price` smallint(5) unsigned NOT NULL,
  `paid_price` smallint(5) NOT NULL,
  `start_date` date NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` varchar(500) COLLATE cp1251_bulgarian_ci NOT NULL
) 
ADD PRIMARY KEY (`plan_id`),