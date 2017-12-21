<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513403002.
 * Generated on 2017-12-16 05:43:22 by marvin
 */
class PropelMigration_1513403002
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

ALTER TABLE `tf_user`

  DROP `calendar_view_positions`,

  DROP `calendar_view_status`,

  DROP `calendar_show_my_schedule_only`,

  DROP `calendar_view_locations`,

  DROP `preferences`,

  DROP `calendar_show_no_schedule`;

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

ALTER TABLE `tf_user`

  ADD `calendar_view_positions` VARCHAR(100) DEFAULT \'\' AFTER `activation_code`,

  ADD `calendar_view_status` VARCHAR(255) AFTER `calendar_view_positions`,

  ADD `calendar_show_my_schedule_only` VARCHAR(1) DEFAULT \'y\' AFTER `calendar_view_status`,

  ADD `calendar_view_locations` VARCHAR(100) DEFAULT \'\' AFTER `calendar_show_my_schedule_only`,

  ADD `preferences` TEXT AFTER `calendar_view_locations`,

  ADD `calendar_show_no_schedule` VARCHAR(1) DEFAULT \'y\' AFTER `preferences`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}