<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1513400082.
 * Generated on 2017-12-16 04:54:42 by marvin
 */
class PropelMigration_1513400082
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

DROP TABLE IF EXISTS `tf_form_fields`;

CREATE TABLE `tf_form_field`
(
    `field_id` INTEGER DEFAULT 0 NOT NULL,
    `form_id` INTEGER DEFAULT 0 NOT NULL,
    `form_field_order` INTEGER DEFAULT 0,
    PRIMARY KEY (`field_id`,`form_id`),
    INDEX `tf_form_field_fi_8ba9c8` (`form_id`),
    CONSTRAINT `tf_form_field_fk_56efb6`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_fields` (`field_id`),
    CONSTRAINT `tf_form_field_fk_8ba9c8`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
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

DROP TABLE IF EXISTS `tf_form_field`;

CREATE TABLE `tf_form_fields`
(
    `field_id` INTEGER DEFAULT 0 NOT NULL,
    `form_id` INTEGER DEFAULT 0 NOT NULL,
    `guest_only` CHAR NOT NULL,
    PRIMARY KEY (`field_id`,`form_id`),
    INDEX `tf_form_fields_fi_8ba9c8` (`form_id`),
    CONSTRAINT `tf_form_fields_fk_56efb6`
        FOREIGN KEY (`field_id`)
        REFERENCES `tf_fields` (`field_id`),
    CONSTRAINT `tf_form_fields_fk_8ba9c8`
        FOREIGN KEY (`form_id`)
        REFERENCES `tf_forms` (`form_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}