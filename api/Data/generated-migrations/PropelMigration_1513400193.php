<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513400193.
 * Generated on 2017-12-16 04:56:33 by marvin
 */
class PropelMigration_1513400193
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

RENAME TABLE `tf_fields` TO `tf_field`;

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_56efb6`;

DROP INDEX `tf_booking_form_entry_fi_56efb6` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_0427a6` ON `tf_booking_form_entry` (`field_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_0427a6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_field` (`field_id`);

ALTER TABLE `tf_form_field` DROP FOREIGN KEY `tf_form_field_fk_56efb6`;

ALTER TABLE `tf_form_field` ADD CONSTRAINT `tf_form_field_fk_0427a6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_field` (`field_id`);


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

DROP TABLE IF EXISTS `tf_field`;

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_0427a6`;

DROP INDEX `tf_booking_form_entry_fi_0427a6` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_56efb6` ON `tf_booking_form_entry` (`field_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_56efb6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_fields` (`field_id`);

ALTER TABLE `tf_form_field` DROP FOREIGN KEY `tf_form_field_fk_0427a6`;

ALTER TABLE `tf_form_field` ADD CONSTRAINT `tf_form_field_fk_56efb6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_fields` (`field_id`);

CREATE TABLE `tf_fields`
(
    `field_id` INTEGER NOT NULL AUTO_INCREMENT,
    `field_name` VARCHAR(100) NOT NULL,
    `field_label` VARCHAR(255) NOT NULL,
    `field_type` VARCHAR(32) NOT NULL,
    `settings` TEXT NOT NULL,
    `required` CHAR NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`field_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}