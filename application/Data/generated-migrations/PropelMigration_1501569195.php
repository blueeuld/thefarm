<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1501569195.
 * Generated on 2017-08-01 06:33:15 by marvin
 */
class PropelMigration_1501569195
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

DROP TABLE IF EXISTS `tf_migrations`;

DROP TABLE IF EXISTS `tf_sessions`;

CREATE TABLE `tf_email_instance`
(
    `email_instance_id` INTEGER NOT NULL AUTO_INCREMENT,
    `email_subject` VARCHAR(100) NOT NULL,
    `email_body` TEXT,
    `from_email_address` VARCHAR(100) NOT NULL,
    `to_email_address` VARCHAR(100) NOT NULL,
    `email_status_cd` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`email_instance_id`)
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS `tf_email_instance`;

CREATE TABLE `tf_migrations`
(
    `version` BIGINT NOT NULL
) ENGINE=MyISAM;

CREATE TABLE `tf_sessions`
(
    `id` VARCHAR(40) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` BLOB NOT NULL,
    INDEX `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}