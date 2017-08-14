<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502679240.
 * Generated on 2017-08-14 02:54:00 by marvin
 */
class PropelMigration_1502679240
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

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `user_work_plan_time_contact_fk`;

DROP INDEX `user_work_plan_time_contact_fk` ON `tf_user_work_plan_time`;

CREATE INDEX `tf_user_work_plan_time_fi_6a6d09` ON `tf_user_work_plan_time` (`contact_id`);

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `tf_user_work_plan_time_fk_6a6d09`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_contacts` (`contact_id`);

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

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `tf_user_work_plan_time_fk_6a6d09`;

DROP INDEX `tf_user_work_plan_time_fi_6a6d09` ON `tf_user_work_plan_time`;

CREATE INDEX `user_work_plan_time_contact_fk` ON `tf_user_work_plan_time` (`contact_id`);

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `user_work_plan_time_contact_fk`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_contacts` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}