<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502784568.
 * Generated on 2017-08-15 08:09:28 by marvin
 */
class PropelMigration_1502784568
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

  CHANGE `incl_os_done_amount` `incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00,

  CHANGE `foc_os_done_amount` `foc_os_done_amount` DECIMAL(10,2) DEFAULT 0.00,

  CHANGE `not_incl_os_done_amount` `not_incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00;

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

  CHANGE `incl_os_done_amount` `incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL,

  CHANGE `foc_os_done_amount` `foc_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL,

  CHANGE `not_incl_os_done_amount` `not_incl_os_done_amount` DECIMAL(10,2) DEFAULT 0.00 NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}