<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513849147.
 * Generated on 2017-12-21 09:39:07 by marvin
 */
class PropelMigration_1513849147
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

RENAME TABLE `tf_booking_forms` TO `tf_booking_form`;

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_2ce3c9`;

DROP INDEX `tf_booking_form_entry_fi_2ce3c9` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_entry` (`booking_form_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_782e8c`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_form` (`booking_form_id`);


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

ALTER TABLE `tf_booking_form_entry` DROP FOREIGN KEY `tf_booking_form_entry_fk_782e8c`;

DROP INDEX `tf_booking_form_entry_fi_782e8c` ON `tf_booking_form_entry`;

CREATE INDEX `tf_booking_form_entry_fi_2ce3c9` ON `tf_booking_form_entry` (`booking_form_id`);

ALTER TABLE `tf_booking_form_entry` ADD CONSTRAINT `tf_booking_form_entry_fk_2ce3c9`
    FOREIGN KEY (`booking_form_id`)
    REFERENCES `tf_booking_forms` (`booking_form_id`);


# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}