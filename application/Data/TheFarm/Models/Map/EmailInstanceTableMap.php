<?php

namespace TheFarm\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use TheFarm\Models\EmailInstance;
use TheFarm\Models\EmailInstanceQuery;


/**
 * This class defines the structure of the 'tf_email_instance' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmailInstanceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.EmailInstanceTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_email_instance';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\EmailInstance';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.EmailInstance';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the email_instance_id field
     */
    const COL_EMAIL_INSTANCE_ID = 'tf_email_instance.email_instance_id';

    /**
     * the column name for the email_subject field
     */
    const COL_EMAIL_SUBJECT = 'tf_email_instance.email_subject';

    /**
     * the column name for the email_body field
     */
    const COL_EMAIL_BODY = 'tf_email_instance.email_body';

    /**
     * the column name for the from_email_address field
     */
    const COL_FROM_EMAIL_ADDRESS = 'tf_email_instance.from_email_address';

    /**
     * the column name for the to_email_address field
     */
    const COL_TO_EMAIL_ADDRESS = 'tf_email_instance.to_email_address';

    /**
     * the column name for the email_status_cd field
     */
    const COL_EMAIL_STATUS_CD = 'tf_email_instance.email_status_cd';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('EmailInstanceId', 'EmailSubject', 'EmailBody', 'FromEmailAddress', 'ToEmailAddress', 'EmailStatusCd', ),
        self::TYPE_CAMELNAME     => array('emailInstanceId', 'emailSubject', 'emailBody', 'fromEmailAddress', 'toEmailAddress', 'emailStatusCd', ),
        self::TYPE_COLNAME       => array(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, EmailInstanceTableMap::COL_EMAIL_SUBJECT, EmailInstanceTableMap::COL_EMAIL_BODY, EmailInstanceTableMap::COL_FROM_EMAIL_ADDRESS, EmailInstanceTableMap::COL_TO_EMAIL_ADDRESS, EmailInstanceTableMap::COL_EMAIL_STATUS_CD, ),
        self::TYPE_FIELDNAME     => array('email_instance_id', 'email_subject', 'email_body', 'from_email_address', 'to_email_address', 'email_status_cd', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EmailInstanceId' => 0, 'EmailSubject' => 1, 'EmailBody' => 2, 'FromEmailAddress' => 3, 'ToEmailAddress' => 4, 'EmailStatusCd' => 5, ),
        self::TYPE_CAMELNAME     => array('emailInstanceId' => 0, 'emailSubject' => 1, 'emailBody' => 2, 'fromEmailAddress' => 3, 'toEmailAddress' => 4, 'emailStatusCd' => 5, ),
        self::TYPE_COLNAME       => array(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID => 0, EmailInstanceTableMap::COL_EMAIL_SUBJECT => 1, EmailInstanceTableMap::COL_EMAIL_BODY => 2, EmailInstanceTableMap::COL_FROM_EMAIL_ADDRESS => 3, EmailInstanceTableMap::COL_TO_EMAIL_ADDRESS => 4, EmailInstanceTableMap::COL_EMAIL_STATUS_CD => 5, ),
        self::TYPE_FIELDNAME     => array('email_instance_id' => 0, 'email_subject' => 1, 'email_body' => 2, 'from_email_address' => 3, 'to_email_address' => 4, 'email_status_cd' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tf_email_instance');
        $this->setPhpName('EmailInstance');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\EmailInstance');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('email_instance_id', 'EmailInstanceId', 'INTEGER', true, null, null);
        $this->addColumn('email_subject', 'EmailSubject', 'VARCHAR', true, 100, null);
        $this->addColumn('email_body', 'EmailBody', 'LONGVARCHAR', false, null, null);
        $this->addColumn('from_email_address', 'FromEmailAddress', 'VARCHAR', true, 100, null);
        $this->addColumn('to_email_address', 'ToEmailAddress', 'VARCHAR', true, 100, null);
        $this->addColumn('email_status_cd', 'EmailStatusCd', 'VARCHAR', true, 20, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('EmailInstanceId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EmailInstanceTableMap::CLASS_DEFAULT : EmailInstanceTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (EmailInstance object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmailInstanceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmailInstanceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmailInstanceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmailInstanceTableMap::OM_CLASS;
            /** @var EmailInstance $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmailInstanceTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EmailInstanceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmailInstanceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var EmailInstance $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmailInstanceTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID);
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_EMAIL_SUBJECT);
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_EMAIL_BODY);
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_FROM_EMAIL_ADDRESS);
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_TO_EMAIL_ADDRESS);
            $criteria->addSelectColumn(EmailInstanceTableMap::COL_EMAIL_STATUS_CD);
        } else {
            $criteria->addSelectColumn($alias . '.email_instance_id');
            $criteria->addSelectColumn($alias . '.email_subject');
            $criteria->addSelectColumn($alias . '.email_body');
            $criteria->addSelectColumn($alias . '.from_email_address');
            $criteria->addSelectColumn($alias . '.to_email_address');
            $criteria->addSelectColumn($alias . '.email_status_cd');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EmailInstanceTableMap::DATABASE_NAME)->getTable(EmailInstanceTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmailInstanceTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmailInstanceTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmailInstanceTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a EmailInstance or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or EmailInstance object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailInstanceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\EmailInstance) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmailInstanceTableMap::DATABASE_NAME);
            $criteria->add(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, (array) $values, Criteria::IN);
        }

        $query = EmailInstanceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmailInstanceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmailInstanceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_email_instance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmailInstanceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a EmailInstance or Criteria object.
     *
     * @param mixed               $criteria Criteria or EmailInstance object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailInstanceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from EmailInstance object
        }

        if ($criteria->containsKey(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID) && $criteria->keyContainsValue(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID.')');
        }


        // Set the correct dbName
        $query = EmailInstanceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmailInstanceTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmailInstanceTableMap::buildTableMap();
