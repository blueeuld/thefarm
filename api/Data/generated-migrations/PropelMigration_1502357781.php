<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502357781.
 * Generated on 2017-08-10 09:36:21 by marvin
 */
class PropelMigration_1502357781
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

UPDATE tf_booking_events e SET e.item_id = (SELECT i.item_id FROM tf_booking_items i WHERE i.booking_item_id=e.booking_item_id AND NOT ISNULL(i.`booking_item_id`) LIMIT 1)
WHERE ISNULL(e.item_id);

UPDATE tf_booking_events e SET e.booking_id = (SELECT i.booking_id FROM tf_booking_items i WHERE i.booking_item_id=e.booking_item_id AND NOT ISNULL(i.`booking_item_id`) LIMIT 1)
WHERE ISNULL(e.booking_id);

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_booking_item_by_fk`;

ALTER TABLE `tf_booking_events`

  DROP `booking_item_id`;

ALTER TABLE `tf_booking_items`

  DROP PRIMARY KEY,

  DROP `booking_item_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `tf_booking_events`

  ADD `booking_item_id` INTEGER AFTER `personalized`;

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_booking_item_by_fk`
    FOREIGN KEY (`booking_item_id`)
    REFERENCES `tf_booking_items` (`booking_item_id`);

ALTER TABLE `tf_booking_items`

  ADD `booking_item_id` INTEGER NOT NULL AUTO_INCREMENT FIRST,

  ADD PRIMARY KEY (`booking_item_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}