<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502691653.
 * Generated on 2017-08-14 06:20:53 by marvin
 */
class PropelMigration_1502691653
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

DROP INDEX `tf_user_work_plan_time_fi_6a6d09` ON `tf_user_work_plan_time`;

ALTER TABLE `tf_user_work_plan_time`

  CHANGE `is_working` `is_working` TINYINT(1) DEFAULT 1 NOT NULL,

  ADD PRIMARY KEY (`contact_id`,`start_date`,`end_date`,`is_working`);

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

ALTER TABLE `tf_items_related_users` DROP FOREIGN KEY `tf_items_related_users_fk_6a6d09`;

DROP INDEX `tf_items_related_users_fi_6a6d09` ON `tf_items_related_users`;

ALTER TABLE `tf_user_work_plan_time`

  DROP PRIMARY KEY,

  CHANGE `is_working` `is_working` TINYINT(1) DEFAULT 1;

CREATE INDEX `tf_user_work_plan_time_fi_6a6d09` ON `tf_user_work_plan_time` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}