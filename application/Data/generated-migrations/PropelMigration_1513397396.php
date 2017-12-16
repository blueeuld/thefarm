<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513397396.
 * Generated on 2017-12-16 04:09:56 by marvin
 */
class PropelMigration_1513397396
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

  DROP `is_active`,

  DROP `verification_key`,

  DROP `is_verified`,

  DROP `is_approved`,

  DROP `activation_code`;

ALTER TABLE `tf_user`

  ADD `is_active` TINYINT(1) NOT NULL AFTER `user_order`,

  ADD `verification_key` VARCHAR(255) DEFAULT \'\' AFTER `is_active`,

  ADD `is_verified` TINYINT(1) DEFAULT 0 AFTER `verification_key`,

  ADD `is_approved` TINYINT(1) DEFAULT 0 AFTER `is_verified`,

  ADD `activation_code` INTEGER AFTER `is_approved`;

CREATE TABLE `tf_booking_form`
(
    `booking_form_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER NOT NULL,
    `form_id` INTEGER NOT NULL,
    `author_id` INTEGER,
    `entry_date` DATETIME,
    `edit_date` DATETIME,
    `completed_by` INTEGER,
    `completed_date` DATETIME,
    PRIMARY KEY (`booking_form_id`),
    INDEX `fi_king_booking_pk` (`booking_id`),
    INDEX `fi_king_form_form_pk` (`form_id`),
    INDEX `fi_king_form_author_pk` (`author_id`),
    INDEX `fi_king_form_cb_pk` (`completed_by`),
    CONSTRAINT `booking_booking_pk`
        FOREIGN KEY (`booking_id`)
        REFERENCES `tf_bookings` (`booking_id`),
    CONSTRAINT `booking_form_form_pk`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`),
    CONSTRAINT `booking_form_author_pk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_form_cb_pk`
        FOREIGN KEY (`completed_by`)
        REFERENCES `tf_user` (`user_id`)
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

DROP TABLE IF EXISTS `tf_booking_form`;

ALTER TABLE `tf_contacts`

  ADD `is_active` TINYINT(1) NOT NULL AFTER `position_cd`,

  ADD `verification_key` VARCHAR(255) DEFAULT \'\' AFTER `is_active`,

  ADD `is_verified` TINYINT(1) DEFAULT 0 AFTER `verification_key`,

  ADD `is_approved` TINYINT(1) DEFAULT 0 AFTER `bio`,

  ADD `activation_code` INTEGER AFTER `is_approved`;

ALTER TABLE `tf_user`

  DROP `is_active`,

  DROP `verification_key`,

  DROP `is_verified`,

  DROP `is_approved`,

  DROP `activation_code`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}