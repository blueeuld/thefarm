<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513391985.
 * Generated on 2017-12-16 02:39:45 by marvin
 */
class PropelMigration_1513391985
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

ALTER TABLE `tf_event` DROP FOREIGN KEY `tf_booking_events_fk_1eba8a`;

ALTER TABLE `tf_event` DROP FOREIGN KEY `tf_booking_events_fk_b49f13`;

ALTER TABLE `tf_event` ADD CONSTRAINT `tf_event_fk_1eba8a`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_event` ADD CONSTRAINT `tf_event_fk_b49f13`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

ALTER TABLE `tf_event_user` DROP FOREIGN KEY `tf_booking_event_users_fk_0f1f34`;

ALTER TABLE `tf_event_user` DROP FOREIGN KEY `tf_booking_event_users_fk_e09fae`;

DROP INDEX `tf_booking_event_users_i_6ca017` ON `tf_event_user`;

CREATE INDEX `tf_event_user_i_6ca017` ON `tf_event_user` (`user_id`);

ALTER TABLE `tf_event_user` ADD CONSTRAINT `tf_event_user_fk_11d4fb`
    FOREIGN KEY (`event_id`)
    REFERENCES `tf_event` (`event_id`);

ALTER TABLE `tf_event_user` ADD CONSTRAINT `tf_event_user_fk_e09fae`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_user` (`user_id`);

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

ALTER TABLE `tf_event` DROP FOREIGN KEY `tf_event_fk_1eba8a`;

ALTER TABLE `tf_event` DROP FOREIGN KEY `tf_event_fk_b49f13`;

ALTER TABLE `tf_event` ADD CONSTRAINT `tf_booking_events_fk_1eba8a`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_event` ADD CONSTRAINT `tf_booking_events_fk_b49f13`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

ALTER TABLE `tf_event_user` DROP FOREIGN KEY `tf_event_user_fk_11d4fb`;

ALTER TABLE `tf_event_user` DROP FOREIGN KEY `tf_event_user_fk_e09fae`;

DROP INDEX `tf_event_user_i_6ca017` ON `tf_event_user`;

CREATE INDEX `tf_booking_event_users_i_6ca017` ON `tf_event_user` (`user_id`);

ALTER TABLE `tf_event_user` ADD CONSTRAINT `tf_booking_event_users_fk_0f1f34`
    FOREIGN KEY (`event_id`)
    REFERENCES `tf_event` (`event_id`);

ALTER TABLE `tf_event_user` ADD CONSTRAINT `tf_booking_event_users_fk_e09fae`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_user` (`user_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}