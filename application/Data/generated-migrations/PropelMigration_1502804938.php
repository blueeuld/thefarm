<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502804938.
 * Generated on 2017-08-15 13:48:58 by marvin
 */
class PropelMigration_1502804938
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

ALTER TABLE `tf_items_related_forms`

  CHANGE `form_id` `form_id` INTEGER NOT NULL,

  CHANGE `item_id` `item_id` INTEGER NOT NULL;

CREATE INDEX `tf_items_related_forms_fi_b49f13` ON `tf_items_related_forms` (`item_id`);

ALTER TABLE `tf_items_related_forms` ADD CONSTRAINT `tf_items_related_forms_fk_8ba9c8`
    FOREIGN KEY (`form_id`)
    REFERENCES `tf_forms` (`form_id`);

ALTER TABLE `tf_items_related_forms` ADD CONSTRAINT `tf_items_related_forms_fk_b49f13`
    FOREIGN KEY (`item_id`)
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

ALTER TABLE `tf_items_related_forms` DROP FOREIGN KEY `tf_items_related_forms_fk_8ba9c8`;

ALTER TABLE `tf_items_related_forms` DROP FOREIGN KEY `tf_items_related_forms_fk_b49f13`;

DROP INDEX `tf_items_related_forms_fi_b49f13` ON `tf_items_related_forms`;

ALTER TABLE `tf_items_related_forms`

  CHANGE `form_id` `form_id` INTEGER(5) NOT NULL AUTO_INCREMENT,

  CHANGE `item_id` `item_id` VARCHAR(255) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}