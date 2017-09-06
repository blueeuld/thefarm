<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1504658355.
 * Generated on 2017-09-06 00:39:15 by marvin
 */
class PropelMigration_1504658355
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

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `work_plan_cd_fk`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `contact_fk2`;

DROP INDEX `fi_k_plan_cd_fk` ON `tf_user_work_plan_day`;

ALTER TABLE `tf_user_work_plan_day`

  CHANGE `work_code` `work_plan_cd` VARCHAR(32) NOT NULL;

CREATE INDEX `tf_user_work_plan_day_fi_a9b2fd` ON `tf_user_work_plan_day` (`work_plan_cd`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_a9b2fd`
    FOREIGN KEY (`work_plan_cd`)
    REFERENCES `tf_work_plan` (`work_plan_cd`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `tf_user_work_plan_day_fk_6a6d09`
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

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_a9b2fd`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `tf_user_work_plan_day_fk_6a6d09`;

DROP INDEX `tf_user_work_plan_day_fi_a9b2fd` ON `tf_user_work_plan_day`;

ALTER TABLE `tf_user_work_plan_day`

  CHANGE `work_plan_cd` `work_code` VARCHAR(32) NOT NULL;

CREATE INDEX `fi_k_plan_cd_fk` ON `tf_user_work_plan_day` (`work_code`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `work_plan_cd_fk`
    FOREIGN KEY (`work_code`)
    REFERENCES `tf_work_plan` (`work_plan_cd`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `contact_fk2`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_contacts` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}