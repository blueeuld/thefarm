<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513148982.
 * Generated on 2017-12-13 07:09:42 by marvin
 */
class PropelMigration_1513148982
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

RENAME TABLE `tf_users` TO `tf_user`;

ALTER TABLE `tf_booking_event_users` DROP FOREIGN KEY `booking_event_user_user_fk`;

ALTER TABLE `tf_booking_event_users` ADD CONSTRAINT `booking_event_user_user_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_author_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_called_by_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_cancelled_by_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_deleted_by_fk`;

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_author_fk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_called_by_fk`
    FOREIGN KEY (`called_by`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_cancelled_by_fk`
    FOREIGN KEY (`cancelled_by`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_deleted_by_fk`
    FOREIGN KEY (`deleted_by`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_bookings` DROP FOREIGN KEY `booking_author_fk`;

ALTER TABLE `tf_bookings` ADD CONSTRAINT `booking_author_fk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_user` (`contact_id`);

#ALTER TABLE `tf_items_related_users` DROP FOREIGN KEY `tf_items_related_users_fk_ed2f6c`;

DROP INDEX `tf_items_related_users_fi_ed2f6c` ON `tf_items_related_users`;

CREATE INDEX `tf_items_related_users_fi_6353fb` ON `tf_items_related_users` (`contact_id`);

ALTER TABLE `tf_items_related_users` ADD CONSTRAINT `tf_items_related_users_fk_6353fb`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`contact_id`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_9bb832`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`contact_id`);



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

RENAME TABLE `tf_user` TO `tf_users`;

ALTER TABLE `tf_booking_event_users` DROP FOREIGN KEY `booking_event_user_user_fk`;

ALTER TABLE `tf_booking_event_users` ADD CONSTRAINT `booking_event_user_user_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_author_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_called_by_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_cancelled_by_fk`;

ALTER TABLE `tf_booking_events` DROP FOREIGN KEY `booking_event_deleted_by_fk`;

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_author_fk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_called_by_fk`
    FOREIGN KEY (`called_by`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_cancelled_by_fk`
    FOREIGN KEY (`cancelled_by`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_booking_events` ADD CONSTRAINT `booking_event_deleted_by_fk`
    FOREIGN KEY (`deleted_by`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_bookings` DROP FOREIGN KEY `booking_author_fk`;

ALTER TABLE `tf_bookings` ADD CONSTRAINT `booking_author_fk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_items_related_users` DROP FOREIGN KEY `tf_items_related_users_fk_6353fb`;

DROP INDEX `tf_items_related_users_fi_6353fb` ON `tf_items_related_users`;

CREATE INDEX `tf_items_related_users_fi_ed2f6c` ON `tf_items_related_users` (`contact_id`);

ALTER TABLE `tf_items_related_users` ADD CONSTRAINT `tf_items_related_users_fk_ed2f6c`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_9bb832`;

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_b091b5`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_users` (`contact_id`);

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `tf_user_work_plan_time_fk_9bb832`;

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `tf_user_work_plan_time_fk_b091b5`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_users` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}