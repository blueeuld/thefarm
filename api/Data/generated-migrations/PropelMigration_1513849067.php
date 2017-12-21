<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513849067.
 * Generated on 2017-12-21 09:37:47 by marvin
 */
class PropelMigration_1513849067
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

DROP TABLE IF EXISTS `tf_booking_form`;

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_782e8c`;

DROP INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_2ce3c9` ON `tf_booking_form_entry` (`booking_form_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_2ce3c9`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_forms` (`booking_form_id`);

DROP INDEX `tf_booking_forms_i_31c724` ON `tf_booking_forms`;

DROP INDEX `tf_booking_forms_i_5d1c0d` ON `tf_booking_forms`;

DROP INDEX `tf_booking_forms_i_44c5a0` ON `tf_booking_forms`;

ALTER TABLE `tf_booking_forms`

  ADD `author_id` INTEGER AFTER `form_id`,

  DROP `notify_user_on_submit`;

CREATE INDEX `fi_king_booking_pk` ON `tf_booking_forms` (`booking_id`);

CREATE INDEX `fi_king_form_form_pk` ON `tf_booking_forms` (`form_id`);

CREATE INDEX `fi_king_form_author_pk` ON `tf_booking_forms` (`author_id`);

CREATE INDEX `fi_king_form_cb_pk` ON `tf_booking_forms` (`completed_by`);

ALTER TABLE `tf_booking_forms` ADD CONSTRAINT `booking_booking_pk`
    FOREIGN KEY (`booking_id`)
    REFERENCES `tf_bookings` (`booking_id`);

ALTER TABLE `tf_booking_forms` ADD CONSTRAINT `booking_form_form_pk`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

ALTER TABLE `tf_booking_forms` ADD CONSTRAINT `booking_form_author_pk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_booking_forms` ADD CONSTRAINT `booking_form_cb_pk`
    FOREIGN KEY (`completed_by`)
    REFERENCES `tf_user` (`user_id`);

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

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_2ce3c9`;

DROP INDEX `tf_booking_form_entry_fi_2ce3c9` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_entry` (`booking_form_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_782e8c`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_form` (`booking_form_id`);

ALTER TABLE `tf_booking_forms` DROP FOREIGN KEY `booking_booking_pk`;

ALTER TABLE `tf_booking_forms` DROP FOREIGN KEY `booking_form_form_pk`;

ALTER TABLE `tf_booking_forms` DROP FOREIGN KEY `booking_form_author_pk`;

ALTER TABLE `tf_booking_forms` DROP FOREIGN KEY `booking_form_cb_pk`;

DROP INDEX `fi_king_booking_pk` ON `tf_booking_forms`;

DROP INDEX `fi_king_form_form_pk` ON `tf_booking_forms`;

DROP INDEX `fi_king_form_author_pk` ON `tf_booking_forms`;

DROP INDEX `fi_king_form_cb_pk` ON `tf_booking_forms`;

ALTER TABLE `tf_booking_forms`

  ADD `notify_user_on_submit` VARCHAR(255) DEFAULT \'\' NOT NULL AFTER `submitted`,

  DROP `author_id`;

CREATE INDEX `tf_booking_forms_i_31c724` ON `tf_booking_forms` (`completed_by`);

CREATE INDEX `tf_booking_forms_i_5d1c0d` ON `tf_booking_forms` (`booking_id`);

CREATE INDEX `tf_booking_forms_i_44c5a0` ON `tf_booking_forms` (`form_id`);

CREATE TABLE `tf_booking_form`
(
    `booking_form_id` INTEGER NOT NULL AUTO_INCREMENT,
    `booking_id` INTEGER NOT NULL,
    `form_id` INTEGER NOT NULL,
    `required` TINYINT(1) DEFAULT 0,
    `submitted` TINYINT(1) DEFAULT 0,
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
    CONSTRAINT `booking_form_author_pk`
        FOREIGN KEY (`author_id`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_form_cb_pk`
        FOREIGN KEY (`completed_by`)
        REFERENCES `tf_user` (`user_id`),
    CONSTRAINT `booking_form_form_pk`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}