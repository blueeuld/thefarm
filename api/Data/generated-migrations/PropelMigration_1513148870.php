<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513148870.
 * Generated on 2017-12-13 07:07:50 by marvin
 */
class PropelMigration_1513148870
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

ALTER TABLE `tf_booking_event_users` DROP FOREIGN KEY `booking_event_user_user_fk`;

DROP INDEX `booking_event_user_user_fk` ON `tf_booking_event_users`;

ALTER TABLE `tf_booking_event_users`

  DROP PRIMARY KEY,

  CHANGE `staff_id` `user_id` INTEGER DEFAULT 0 NOT NULL,

  ADD PRIMARY KEY (`event_id`,`user_id`);

CREATE INDEX `tf_booking_event_users_i_6ca017` ON `tf_booking_event_users` (`user_id`);

ALTER TABLE `tf_booking_event_users` ADD CONSTRAINT `booking_event_user_user_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_users` (`contact_id`);

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

ALTER TABLE `tf_booking_event_users` DROP FOREIGN KEY `booking_event_user_user_fk`;

DROP INDEX `tf_booking_event_users_i_6ca017` ON `tf_booking_event_users`;

ALTER TABLE `tf_booking_event_users`

  DROP PRIMARY KEY,

  CHANGE `user_id` `staff_id` INTEGER DEFAULT 0 NOT NULL,

  ADD PRIMARY KEY (`event_id`,`staff_id`);

CREATE INDEX `booking_event_user_user_fk` ON `tf_booking_event_users` (`staff_id`);

ALTER TABLE `tf_booking_event_users` ADD CONSTRAINT `booking_event_user_user_fk`
    FOREIGN KEY (`staff_id`)
    REFERENCES `tf_users` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}