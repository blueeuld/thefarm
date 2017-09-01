<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1504251151.
 * Generated on 2017-09-01 07:32:31 by marvin
 */
class PropelMigration_1504251151
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

CREATE INDEX `tf_form_fields_fi_8ba9c8` ON `tf_form_fields` (`form_id`);

ALTER TABLE `tf_form_fields` ADD CONSTRAINT `tf_form_fields_fk_56efb6`
    FOREIGN KEY (`field_id`)
    REFERENCES `tf_fields` (`field_id`);

ALTER TABLE `tf_form_fields` ADD CONSTRAINT `tf_form_fields_fk_8ba9c8`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

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

ALTER TABLE `tf_form_fields` DROP FOREIGN KEY `tf_form_fields_fk_56efb6`;

ALTER TABLE `tf_form_fields` DROP FOREIGN KEY `tf_form_fields_fk_8ba9c8`;

DROP INDEX `tf_form_fields_fi_8ba9c8` ON `tf_form_fields`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}