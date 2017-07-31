<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1501469829.
 * Generated on 2017-07-31 02:57:09 by marvin
 */
class PropelMigration_1501469829
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

ALTER TABLE `tf_booking_events`

  CHANGE `deleted` `is_active` VARCHAR(1) DEFAULT \'n\';

ALTER TABLE `tf_bookings`

  CHANGE `is_active` `is_active` TINYINT(1) DEFAULT 1 NOT NULL;

ALTER TABLE `tf_contacts`

  ADD `is_active` TINYINT(1) NOT NULL AFTER `position_cd`,

  DROP `deleted`;

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

ALTER TABLE `tf_booking_events`

  CHANGE `is_active` `deleted` VARCHAR(1) DEFAULT \'n\';

ALTER TABLE `tf_bookings`

  CHANGE `is_active` `is_active` INTEGER(1) DEFAULT 1 NOT NULL;

ALTER TABLE `tf_contacts`

  ADD `deleted` SMALLINT(1) DEFAULT 0 NOT NULL AFTER `position_cd`,

  DROP `is_active`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}