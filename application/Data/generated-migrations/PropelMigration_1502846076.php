<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502846076.
 * Generated on 2017-08-16 01:14:36 by marvin
 */
class PropelMigration_1502846076
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

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_facility_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_item_by_fk`;

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `tf_booking_events_fk_1eba8a`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `tf_booking_events_fk_b49f13`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

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

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `tf_booking_events_fk_1eba8a`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `tf_booking_events_fk_b49f13`;

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_facility_fk`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_item_by_fk`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}