
-- residential
ALTER TABLE `requests` 
CHANGE COLUMN `unit_type` `unit_type` VARCHAR(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL DEFAULT 'personal' ;
select distinct(unit_type) from requests;
update requests set unit_type = 'residential' where unit_type = 'personal' or unit_type = '';


ALTER TABLE `requests` 
CHANGE COLUMN `unit_type` `unit_type` ENUM('residential', 'commercial', 'land') COLLATE 'utf8mb4_unicode_ci' NOT NULL DEFAULT 'residential' ;

-- ---------------------------------------------------------------------------------------------------------------------

CREATE TABLE `user_edits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('deskEdit') COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci


-- ----------------------------------------------------------------------------------------------------------------------

ALTER TABLE `admin_notifications` CHANGE `type` `type` ENUM('switch','task','to_do','close_deal','finish_task','project','added_lead','note_lead','broadcast','broadcast_event') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;


