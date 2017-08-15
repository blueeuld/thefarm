<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502787002.
 * Generated on 2017-08-15 08:50:02 by marvin
 */
class PropelMigration_1502787002
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

CREATE INDEX `tf_form_fields_fi_8ba9c8` ON `tf_form_fields` (`form_id`);

ALTER TABLE `tf_form_fields` ADD CONSTRAINT `tf_form_fields_fk_56efb6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_fields` (`field_id`);

ALTER TABLE `tf_form_fields` ADD CONSTRAINT `tf_form_fields_fk_8ba9c8`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

ALTER TABLE `tf_items_related_facilities` DROP FOREIGN KEY `facility_fk`;

ALTER TABLE `tf_items_related_facilities` DROP FOREIGN KEY `item_fk2`;

DROP INDEX `facility_fk` ON `tf_items_related_facilities`;

DROP INDEX `item_fk2` ON `tf_items_related_facilities`;

ALTER TABLE `tf_items_related_forms` DROP FOREIGN KEY `form_fk2`;

DROP INDEX `item_fk1` ON `tf_items_related_forms`;

DROP INDEX `form_fk2` ON `tf_items_related_forms`;

ALTER TABLE `tf_items_related_forms`

  CHANGE `form_id` `form_id` INTEGER(5) NOT NULL AUTO_INCREMENT,

  CHANGE `item_id` `item_id` VARCHAR(255) NOT NULL,

  ADD PRIMARY KEY (`form_id`,`item_id`);

DROP INDEX `tf_items_related_users_fi_b49f13` ON `tf_items_related_users`;

DROP INDEX `tf_items_related_users_fk_6a6d09` ON `tf_items_related_users`;

CREATE INDEX `tf_items_related_users_fi_6a6d09` ON `tf_items_related_users` (`contact_id`);

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

ALTER TABLE `tf_form_fields` DROP FOREIGN KEY `tf_form_fields_fk_56efb6`;

ALTER TABLE `tf_form_fields` DROP FOREIGN KEY `tf_form_fields_fk_8ba9c8`;

DROP INDEX `tf_form_fields_fi_8ba9c8` ON `tf_form_fields`;

CREATE INDEX `facility_fk` ON `tf_items_related_facilities` (`facility_id`);

CREATE INDEX `item_fk2` ON `tf_items_related_facilities` (`item_id`);

ALTER TABLE `tf_items_related_facilities` ADD CONSTRAINT `facility_fk`
    FOREIGN KEY (`facility_id`)
    REFERENCES `tf_facilities` (`facility_id`);

ALTER TABLE `tf_items_related_facilities` ADD CONSTRAINT `item_fk2`
    FOREIGN KEY (`item_id`)
    REFERENCES `tf_items` (`item_id`);

ALTER TABLE `tf_items_related_forms`

  DROP PRIMARY KEY,

  CHANGE `form_id` `form_id` INTEGER NOT NULL,

  CHANGE `item_id` `item_id` INTEGER NOT NULL;

CREATE INDEX `item_fk1` ON `tf_items_related_forms` (`item_id`);

CREATE INDEX `form_fk2` ON `tf_items_related_forms` (`form_id`);

ALTER TABLE `tf_items_related_forms` ADD CONSTRAINT `form_fk2`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

DROP INDEX `tf_items_related_users_fi_6a6d09` ON `tf_items_related_users`;

CREATE INDEX `tf_items_related_users_fi_b49f13` ON `tf_items_related_users` (`item_id`);

CREATE INDEX `tf_items_related_users_fk_6a6d09` ON `tf_items_related_users` (`contact_id`);

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `work_plan_cd_fk`;

ALTER TABLE `tf_user_work_plan_day` DROP FOREIGN KEY `contact_fk2`;

CREATE INDEX `contact_fk1` ON `tf_user_work_plan_time` (`contact_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}