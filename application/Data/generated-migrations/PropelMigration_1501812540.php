<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1501812540.
 * Generated on 2017-08-04 02:09:00 by marvin
 */
class PropelMigration_1501812540
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

ALTER TABLE `tf_booking_event_users`

  ADD `is_guest` TINYINT(1) DEFAULT 0 AFTER `staff_id`;

ALTER TABLE `tf_booking_events`

  ADD `booking_id` INTEGER AFTER `event_id`;

CREATE INDEX `fi_king_fk` ON `tf_booking_events` (`booking_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_fk`
    FOREIGN KEY (`booking_id`)
    REFERENCES `tf_bookings` (`booking_id`);

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

ALTER TABLE `tf_booking_event_users`

  DROP `is_guest`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_fk`;

DROP INDEX `fi_king_fk` ON `tf_booking_events`;

ALTER TABLE `tf_booking_events`

  DROP `booking_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}