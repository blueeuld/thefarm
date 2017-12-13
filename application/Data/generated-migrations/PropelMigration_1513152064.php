<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513152064.
 * Generated on 2017-12-13 08:01:04 by marvin
 */
class PropelMigration_1513152064
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

ALTER TABLE `tf_items_related_users` DROP FOREIGN KEY `tf_items_related_users_fk_ed2f6c`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_9bb832`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_ed2f6c`;

DROP INDEX `contact_fk1` ON `tf_user_work_plan_day`;

CREATE INDEX `user_fk1` ON `tf_user_work_plan_day` (`contact_id`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_cce09f`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `tf_user_work_plan_time_fk_ed2f6c`;

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `tf_user_work_plan_time_fk_cce09f`
    FOREIGN KEY (`contact_id`)
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

ALTER TABLE `tf_booking_event_users` ADD CONSTRAINT `booking_event_user_user_fk`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_items_related_users` ADD CONSTRAINT `tf_items_related_users_fk_ed2f6c`
    FOREIGN KEY (`user_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_cce09f`;

DROP INDEX `user_fk1` ON `tf_user_work_plan_day`;

CREATE INDEX `contact_fk1` ON `tf_user_work_plan_day` (`contact_id`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_9bb832`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_ed2f6c`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `tf_user_work_plan_time_fk_cce09f`;

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `tf_user_work_plan_time_fk_ed2f6c`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_user` (`user_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}