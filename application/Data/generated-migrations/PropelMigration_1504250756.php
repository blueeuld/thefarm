<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1504250756.
 * Generated on 2017-09-01 07:25:56 by marvin
 */
class PropelMigration_1504250756
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

ALTER TABLE `tf_contacts`

  CHANGE `is_active` `is_active` TINYINT(1) NOT NULL;

CREATE INDEX `tf_items_related_facilities_fi_1eba8a` ON `tf_items_related_facilities` (`facility_id`);

ALTER TABLE `tf_items_related_facilities` ADD CONSTRAINT `tf_items_related_facilities_fk_1eba8a`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_items_related_facilities` ADD CONSTRAINT `tf_items_related_facilities_fk_b49f13`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

DROP INDEX `tf_items_related_users_fi_b49f13` ON `tf_items_related_users`;

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `work_plan_cd_fk`
    FOREIGN KEY (`work_code`)
    REFERENCES `tf_user_work_plan_code` (`work_plan_cd`);

ALTER TABLE `tf_user_work_plan_day` ADD CONSTRAINT `contact_fk2`
    FOREIGN KEY (`contact_id`)
    REFERENCES `tf_contacts` (`contact_id`);

DROP INDEX `contact_fk1` ON `tf_user_work_plan_time`;

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

ALTER TABLE `tf_contacts`

  CHANGE `is_active` `is_active` TINYINT(1) DEFAULT 1 NOT NULL;

ALTER TABLE `tf_items_related_facilities` DROP FOREIGN KEY `tf_items_related_facilities_fk_1eba8a`;

ALTER TABLE `tf_items_related_facilities` DROP FOREIGN KEY `tf_items_related_facilities_fk_b49f13`;

DROP INDEX `tf_items_related_facilities_fi_1eba8a` ON `tf_items_related_facilities`;

CREATE INDEX `tf_items_related_users_fi_b49f13` ON `tf_items_related_users` (`item_id`);

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `work_plan_cd_fk`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `contact_fk2`;

CREATE INDEX `contact_fk1` ON `tf_user_work_plan_time` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}