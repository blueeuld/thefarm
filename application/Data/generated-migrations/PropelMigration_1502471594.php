<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1502471594.
 * Generated on 2017-08-11 17:13:14 by marvin
 */
class PropelMigration_1502471594
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

DROP INDEX `contact_fk1` ON `tf_items_related_users`;

DROP INDEX `item_fk1` ON `tf_items_related_users`;

CREATE INDEX `fi_tact_fk1` ON `tf_items_related_users` (`contact_id`);

CREATE INDEX `fi_m_fk1` ON `tf_items_related_users` (`item_id`);

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

DROP INDEX `fi_tact_fk1` ON `tf_items_related_users`;

DROP INDEX `fi_m_fk1` ON `tf_items_related_users`;

CREATE INDEX `contact_fk1` ON `tf_items_related_users` (`contact_id`);

CREATE INDEX `item_fk1` ON `tf_items_related_users` (`item_id`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}