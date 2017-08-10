<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502001291.
 * Generated on 2017-08-06 06:34:51 by marvin
 */
class PropelMigration_1502001291
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

UPDATE `tf_booking_forms` SET `required`=IF(`required`=\'y\', \'1\', \'0\');
UPDATE `tf_booking_forms` SET `submitted`=IF(`submitted`=\'y\', \'1\', \'0\');

ALTER TABLE `tf_booking_forms`

  CHANGE `booking_id` `booking_id` INTEGER NOT NULL,

  CHANGE `form_id` `form_id` INTEGER NOT NULL,

  CHANGE `required` `required` TINYINT(1) DEFAULT 0,

  CHANGE `submitted` `submitted` TINYINT(1) DEFAULT 0;

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

ALTER TABLE `tf_booking_forms`

  CHANGE `booking_id` `booking_id` INTEGER(5) NOT NULL,

  CHANGE `form_id` `form_id` INTEGER(5) NOT NULL,

  CHANGE `required` `required` VARCHAR(1) DEFAULT \'n\' NOT NULL,

  CHANGE `submitted` `submitted` VARCHAR(1) DEFAULT \'n\' NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}