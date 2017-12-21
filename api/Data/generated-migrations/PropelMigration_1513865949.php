<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513865949.
 * Generated on 2017-12-21 14:19:09 by marvin
 */
class PropelMigration_1513865949
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

ALTER TABLE `tf_booking_form` ADD CONSTRAINT `booking_booking_pk`
    FOREIGN KEY (`booking_id`)
    REFERENCES `tf_bookings` (`booking_id`);

ALTER TABLE `tf_booking_form` ADD CONSTRAINT `booking_form_form_pk`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

ALTER TABLE `tf_booking_form` ADD CONSTRAINT `booking_form_author_pk`
    FOREIGN KEY (`author_id`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_booking_form` ADD CONSTRAINT `booking_form_cb_pk`
    FOREIGN KEY (`completed_by`)
    REFERENCES `tf_user` (`user_id`);

ALTER TABLE `tf_booking_form_data` DROP FOREIGN KEY `tf_booking_form_entry_fk_0427a6`;

ALTER TABLE `tf_booking_form_data` DROP FOREIGN KEY `tf_booking_form_entry_fk_782e8c`;

DROP INDEX `tf_booking_form_entry_fi_0427a6` ON `tf_booking_form_data`;

DROP INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_data`;

CREATE INDEX `tf_booking_form_data_fi_782e8c` ON `tf_booking_form_data` (`booking_form_id`);

CREATE INDEX `tf_booking_form_data_fi_0427a6` ON `tf_booking_form_data` (`field_id`);

ALTER TABLE `tf_booking_form_data` ADD CONSTRAINT `tf_booking_form_data_fk_782e8c`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_form` (`booking_form_id`);

ALTER TABLE `tf_booking_form_data` ADD CONSTRAINT `tf_booking_form_data_fk_0427a6`
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

ALTER TABLE `tf_booking_form` DROP FOREIGN KEY `booking_booking_pk`;

ALTER TABLE `tf_booking_form` DROP FOREIGN KEY `booking_form_form_pk`;

ALTER TABLE `tf_booking_form` DROP FOREIGN KEY `booking_form_author_pk`;

ALTER TABLE `tf_booking_form` DROP FOREIGN KEY `booking_form_cb_pk`;

ALTER TABLE `tf_booking_form_data` DROP FOREIGN KEY `tf_booking_form_data_fk_782e8c`;

ALTER TABLE `tf_booking_form_data` DROP FOREIGN KEY `tf_booking_form_data_fk_0427a6`;

DROP INDEX `tf_booking_form_data_fi_782e8c` ON `tf_booking_form_data`;

DROP INDEX `tf_booking_form_data_fi_0427a6` ON `tf_booking_form_data`;

CREATE INDEX `tf_booking_form_entry_fi_0427a6` ON `tf_booking_form_data` (`field_id`);

CREATE INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_data` (`booking_form_id`);

ALTER TABLE `tf_booking_form_data` ADD CONSTRAINT `tf_booking_form_entry_fk_0427a6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_field` (`field_id`);

ALTER TABLE `tf_booking_form_data` ADD CONSTRAINT `tf_booking_form_entry_fk_782e8c`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_form` (`booking_form_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}