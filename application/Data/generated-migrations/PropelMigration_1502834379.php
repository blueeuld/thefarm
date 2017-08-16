<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502834379.
 * Generated on 2017-08-15 21:59:39 by marvin
 */
class PropelMigration_1502834379
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

ALTER TABLE `tf_bookings` DROP FOREIGN KEY `booking_room_fk`;

DROP INDEX `booking_package_fk` ON `tf_bookings`;

DROP INDEX `booking_guest_fk` ON `tf_bookings`;

DROP INDEX `booking_author_fk` ON `tf_bookings`;

DROP INDEX `booking_room_fk` ON `tf_bookings`;

DROP INDEX `booking_status_fk` ON `tf_bookings`;

CREATE INDEX `fi_king_author_fk` ON `tf_bookings` (`author_id`);

CREATE INDEX `fi_king_guest_fk` ON `tf_bookings` (`guest_id`);

CREATE INDEX `fi_king_package_fk` ON `tf_bookings` (`package_id`);

CREATE INDEX `tf_bookings_fi_30729d` ON `tf_bookings` (`room_id`);

CREATE INDEX `fi_king_status_fk` ON `tf_bookings` (`status`);

ALTER TABLE `tf_bookings` ADD CONSTRAINT `tf_bookings_fk_30729d`
    FOREIGN KEY (`room_id`)
    REFERENCES `tf_items` (`item_id`);

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

ALTER TABLE `tf_bookings` DROP FOREIGN KEY `tf_bookings_fk_30729d`;

DROP INDEX `fi_king_author_fk` ON `tf_bookings`;

DROP INDEX `fi_king_guest_fk` ON `tf_bookings`;

DROP INDEX `fi_king_package_fk` ON `tf_bookings`;

DROP INDEX `tf_bookings_fi_30729d` ON `tf_bookings`;

DROP INDEX `fi_king_status_fk` ON `tf_bookings`;

CREATE INDEX `booking_package_fk` ON `tf_bookings` (`package_id`);

CREATE INDEX `booking_guest_fk` ON `tf_bookings` (`guest_id`);

CREATE INDEX `booking_author_fk` ON `tf_bookings` (`author_id`);

CREATE INDEX `booking_room_fk` ON `tf_bookings` (`room_id`);

CREATE INDEX `booking_status_fk` ON `tf_bookings` (`status`);

ALTER TABLE `tf_bookings` ADD CONSTRAINT `booking_room_fk`
    FOREIGN KEY (`room_id`)
    REFERENCES `tf_items` (`item_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}