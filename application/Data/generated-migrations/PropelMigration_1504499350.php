<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1504499350.
 * Generated on 2017-09-04 04:29:10 by marvin
 */
class PropelMigration_1504499350
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

ALTER TABLE `tf_user_work_plan_time`

  ADD `work_plan_cd` VARCHAR(32) AFTER `contact_id`;

CREATE INDEX `tf_user_work_plan_time_fi_d436f3` ON `tf_user_work_plan_time` (`work_plan_cd`);

ALTER TABLE `tf_user_work_plan_time` ADD CONSTRAINT `tf_user_work_plan_time_fk_d436f3`
    FOREIGN KEY (`work_plan_cd`)
    REFERENCES `tf_user_work_plan_code` (`work_plan_cd`);

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

ALTER TABLE `tf_user_work_plan_time` DROP FOREIGN KEY `tf_user_work_plan_time_fk_d436f3`;

DROP INDEX `tf_user_work_plan_time_fi_d436f3` ON `tf_user_work_plan_time`;

ALTER TABLE `tf_user_work_plan_time`

  DROP `work_plan_cd`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}