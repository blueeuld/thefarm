<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513784484.
 * Generated on 2017-12-20 15:41:24 by marvin
 */
class PropelMigration_1513784484
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

ALTER TABLE `tf_booking_form`

  ADD `required` TINYINT(1) DEFAULT 0 AFTER `form_id`,

  ADD `submitted` TINYINT(1) DEFAULT 0 AFTER `required`;

DROP INDEX `booking_form_completed_fk` ON `tf_booking_forms`;

DROP INDEX `booking_form_fk` ON `tf_booking_forms`;

UPDATE `tf_booking_forms` SET `submitted_date`=NULL, `completed_date`=NULL;

ALTER TABLE `tf_booking_forms`

  DROP PRIMARY KEY,

  CHANGE `submitted_date` `submitted_date` DATETIME,

  CHANGE `completed_date` `completed_date` DATETIME,

  ADD `booking_form_id` INTEGER NOT NULL AUTO_INCREMENT FIRST,

  ADD PRIMARY KEY (`booking_form_id`);

CREATE INDEX `tf_booking_forms_i_31c724` ON `tf_booking_forms` (`completed_by`);

CREATE INDEX `tf_booking_forms_i_5d1c0d` ON `tf_booking_forms` (`booking_id`);

CREATE INDEX `tf_booking_forms_i_44c5a0` ON `tf_booking_forms` (`form_id`);

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

ALTER TABLE `tf_booking_form`

  DROP `required`,

  DROP `submitted`;

DROP INDEX `tf_booking_forms_i_31c724` ON `tf_booking_forms`;

DROP INDEX `tf_booking_forms_i_5d1c0d` ON `tf_booking_forms`;

DROP INDEX `tf_booking_forms_i_44c5a0` ON `tf_booking_forms`;

ALTER TABLE `tf_booking_forms`

  DROP PRIMARY KEY,

  CHANGE `submitted_date` `submitted_date` INTEGER(10) DEFAULT 0,

  CHANGE `completed_date` `completed_date` int(10) unsigned DEFAULT 0,

  DROP `booking_form_id`,

  ADD PRIMARY KEY (`booking_id`,`form_id`);

CREATE INDEX `booking_form_completed_fk` ON `tf_booking_forms` (`completed_by`);

CREATE INDEX `booking_form_fk` ON `tf_booking_forms` (`form_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}