<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513866020.
 * Generated on 2017-12-21 14:20:20 by marvin
 */
class PropelMigration_1513866020
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}