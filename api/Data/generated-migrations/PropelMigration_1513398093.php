<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513398093.
 * Generated on 2017-12-16 04:21:33 by marvin
 */
class PropelMigration_1513398093
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

DROP TABLE IF EXISTS `tf_form_entries`;

DROP TABLE IF EXISTS `tf_form_entries_1`;

DROP TABLE IF EXISTS `tf_form_entries_2`;

DROP TABLE IF EXISTS `tf_form_entries_3`;

DROP TABLE IF EXISTS `tf_form_entries_5`;

DROP TABLE IF EXISTS `tf_form_entries_6`;

DROP TABLE IF EXISTS `tf_form_entries_8`;

DROP TABLE IF EXISTS `tf_form_entries_9`;

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

CREATE TABLE `tf_form_entries`
(
    `entry_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER,
    `form_id` INTEGER NOT NULL,
    `field_id` INTEGER NOT NULL,
    `field_value` VARCHAR(200),
    PRIMARY KEY (`entry_id`),
    INDEX `form_entries_booking_fk` (`booking_id`),
    INDEX `form_entries_form_fk` (`form_id`),
    INDEX `form_entries_field_fk` (`field_id`),
    CONSTRAINT `form_entries_booking_fk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `form_entries_field_fk`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_fields` (`field_id`),
    CONSTRAINT `form_entries_form_fk`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
) ENGINE=InnoDB;

CREATE TABLE `tf_form_entries_1`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_29` TEXT,
    `field_id_52` TEXT,
    `field_id_54` TEXT,
    `field_id_53` TEXT,
    `field_id_55` TEXT,
    `field_id_58` TEXT,
    `field_id_57` TEXT,
    `field_id_56` TEXT,
    `field_id_51` TEXT,
    `field_id_50` TEXT,
    `field_id_49` TEXT,
    `field_id_48` TEXT,
    `field_id_47` TEXT,
    `field_id_46` TEXT,
    `field_id_45` TEXT,
    `field_id_44` TEXT,
    `field_id_43` TEXT,
    `field_id_42` TEXT,
    `field_id_41` TEXT,
    `field_id_40` TEXT,
    `field_id_37` TEXT,
    `field_id_35` TEXT,
    `field_id_33` TEXT,
    `field_id_32` TEXT,
    `field_id_31` TEXT,
    `field_id_30` TEXT,
    `field_id_28` TEXT,
    `field_id_26` TEXT,
    `field_id_25` TEXT,
    `field_id_19` TEXT,
    `field_id_18` TEXT,
    `field_id_17` TEXT,
    `field_id_6` TEXT,
    `field_id_5` TEXT,
    `field_id_4` TEXT,
    `field_id_2` TEXT,
    `field_id_1` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_2`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_3`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_5`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_6`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_18` TEXT,
    `field_id_17` TEXT,
    `field_id_5` TEXT,
    `field_id_4` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` int(5) unsigned,
    `completed_date` int(10) unsigned,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_8`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_196` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` INTEGER(5) NOT NULL,
    `completed_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

CREATE TABLE `tf_form_entries_9`
(
    `entry_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER(5) NOT NULL,
    `field_id_197` TEXT,
    `author_id` INTEGER(5) NOT NULL,
    `entry_date` INTEGER(10) NOT NULL,
    `edit_date` INTEGER(10) NOT NULL,
    `completed_by` INTEGER(5) NOT NULL,
    `completed_date` INTEGER(10) NOT NULL,
    PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}