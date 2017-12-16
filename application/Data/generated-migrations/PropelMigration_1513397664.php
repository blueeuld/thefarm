<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513397664.
 * Generated on 2017-12-16 04:14:24 by marvin
 */
class PropelMigration_1513397664
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

CREATE TABLE `tf_booking_form_entry`
(
    `booking_form_id` INTEGER,
    `field_id` INTEGER NOT NULL,
    `field_value` VARCHAR(200),
    INDEX `tf_booking_form_entry_fi_782e8c` (`booking_form_id`),
    INDEX `tf_booking_form_entry_fi_56efb6` (`field_id`),
    CONSTRAINT `tf_booking_form_entry_fk_782e8c`
        FOREIGN KEY (`booking_form_id`)
        REFERENCES `tf_booking_form` (`booking_form_id`),
    CONSTRAINT `tf_booking_form_entry_fk_56efb6`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_fields` (`field_id`)
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS `tf_booking_form_entry`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}