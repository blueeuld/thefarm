<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1501465096.
 * Generated on 2017-07-31 01:38:16 by marvin
 */
class PropelMigration_1501465096
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

ALTER TABLE `tf_contacts`

  CHANGE `deleted` `is_active` SMALLINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `tf_groups`

  CHANGE `dashboard_top` `dashboard_top` VARCHAR(255) NOT NULL,

  CHANGE `dashboard_middle` `dashboard_middle` VARCHAR(255) NOT NULL,

  CHANGE `dashboard_bottom` `dashboard_bottom` VARCHAR(255) NOT NULL,

  CHANGE `calendar_header_right` `calendar_header_right` VARCHAR(255) NOT NULL;

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

ALTER TABLE `tf_contacts`

  CHANGE `is_active` `deleted` SMALLINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `tf_groups`

  CHANGE `dashboard_top` `dashboard_top` VARCHAR NOT NULL,

  CHANGE `dashboard_middle` `dashboard_middle` VARCHAR NOT NULL,

  CHANGE `dashboard_bottom` `dashboard_bottom` VARCHAR NOT NULL,

  CHANGE `calendar_header_right` `calendar_header_right` VARCHAR NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}