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
use TheFarm\Models\Statuses;
use TheFarm\Models\StatusesQuery;


/**
 * This class defines the structure of the 'tf_statuses' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class StatusesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.StatusesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_statuses';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Statuses';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Statuses';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the status_id field
     */
    const COL_STATUS_ID = 'tf_statuses.status_id';

    /**
     * the column name for the group_id field
     */
    const COL_GROUP_ID = 'tf_statuses.group_id';

    /**
     * the column name for the status_cd field
     */
    const COL_STATUS_CD = 'tf_statuses.status_cd';

    /**
     * the column name for the status_name field
     */
    const COL_STATUS_NAME = 'tf_statuses.status_name';

    /**
     * the column name for the status_order field
     */
    const COL_STATUS_ORDER = 'tf_statuses.status_order';

    /**
     * the column name for the status_style field
     */
    const COL_STATUS_STYLE = 'tf_statuses.status_style';

    /**
     * the column name for the include_in_sales field
     */
    const COL_INCLUDE_IN_SALES = 'tf_statuses.include_in_sales';

    /**
     * the column name for the include_in_duplicate_checking field
     */
    const COL_INCLUDE_IN_DUPLICATE_CHECKING = 'tf_statuses.include_in_duplicate_checking';

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
        self::TYPE_PHPNAME       => array('StatusId', 'GroupId', 'StatusCd', 'StatusName', 'StatusOrder', 'StatusStyle', 'IncludeInSales', 'IncludeInDuplicateChecking', ),
        self::TYPE_CAMELNAME     => array('statusId', 'groupId', 'statusCd', 'statusName', 'statusOrder', 'statusStyle', 'includeInSales', 'includeInDuplicateChecking', ),
        self::TYPE_COLNAME       => array(StatusesTableMap::COL_STATUS_ID, StatusesTableMap::COL_GROUP_ID, StatusesTableMap::COL_STATUS_CD, StatusesTableMap::COL_STATUS_NAME, StatusesTableMap::COL_STATUS_ORDER, StatusesTableMap::COL_STATUS_STYLE, StatusesTableMap::COL_INCLUDE_IN_SALES, StatusesTableMap::COL_INCLUDE_IN_DUPLICATE_CHECKING, ),
        self::TYPE_FIELDNAME     => array('status_id', 'group_id', 'status_cd', 'status_name', 'status_order', 'status_style', 'include_in_sales', 'include_in_duplicate_checking', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('StatusId' => 0, 'GroupId' => 1, 'StatusCd' => 2, 'StatusName' => 3, 'StatusOrder' => 4, 'StatusStyle' => 5, 'IncludeInSales' => 6, 'IncludeInDuplicateChecking' => 7, ),
        self::TYPE_CAMELNAME     => array('statusId' => 0, 'groupId' => 1, 'statusCd' => 2, 'statusName' => 3, 'statusOrder' => 4, 'statusStyle' => 5, 'includeInSales' => 6, 'includeInDuplicateChecking' => 7, ),
        self::TYPE_COLNAME       => array(StatusesTableMap::COL_STATUS_ID => 0, StatusesTableMap::COL_GROUP_ID => 1, StatusesTableMap::COL_STATUS_CD => 2, StatusesTableMap::COL_STATUS_NAME => 3, StatusesTableMap::COL_STATUS_ORDER => 4, StatusesTableMap::COL_STATUS_STYLE => 5, StatusesTableMap::COL_INCLUDE_IN_SALES => 6, StatusesTableMap::COL_INCLUDE_IN_DUPLICATE_CHECKING => 7, ),
        self::TYPE_FIELDNAME     => array('status_id' => 0, 'group_id' => 1, 'status_cd' => 2, 'status_name' => 3, 'status_order' => 4, 'status_style' => 5, 'include_in_sales' => 6, 'include_in_duplicate_checking' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('tf_statuses');
        $this->setPhpName('Statuses');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Statuses');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('status_id', 'StatusId', 'INTEGER', true, 5, null);
        $this->addColumn('group_id', 'GroupId', 'INTEGER', true, 5, null);
        $this->addColumn('status_cd', 'StatusCd', 'VARCHAR', true, 40, null);
        $this->addColumn('status_name', 'StatusName', 'VARCHAR', true, 255, null);
        $this->addColumn('status_order', 'StatusOrder', 'INTEGER', true, 2, null);
        $this->addColumn('status_style', 'StatusStyle', 'LONGVARCHAR', false, null, null);
        $this->addColumn('include_in_sales', 'IncludeInSales', 'VARCHAR', false, 1, 'y');
        $this->addColumn('include_in_duplicate_checking', 'IncludeInDuplicateChecking', 'VARCHAR', false, 1, 'y');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('StatusId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? StatusesTableMap::CLASS_DEFAULT : StatusesTableMap::OM_CLASS;
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
     * @return array           (Statuses object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = StatusesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StatusesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StatusesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StatusesTableMap::OM_CLASS;
            /** @var Statuses $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StatusesTableMap::addInstanceToPool($obj, $key);
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
            $key = StatusesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StatusesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Statuses $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StatusesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StatusesTableMap::COL_STATUS_ID);
            $criteria->addSelectColumn(StatusesTableMap::COL_GROUP_ID);
            $criteria->addSelectColumn(StatusesTableMap::COL_STATUS_CD);
            $criteria->addSelectColumn(StatusesTableMap::COL_STATUS_NAME);
            $criteria->addSelectColumn(StatusesTableMap::COL_STATUS_ORDER);
            $criteria->addSelectColumn(StatusesTableMap::COL_STATUS_STYLE);
            $criteria->addSelectColumn(StatusesTableMap::COL_INCLUDE_IN_SALES);
            $criteria->addSelectColumn(StatusesTableMap::COL_INCLUDE_IN_DUPLICATE_CHECKING);
        } else {
            $criteria->addSelectColumn($alias . '.status_id');
            $criteria->addSelectColumn($alias . '.group_id');
            $criteria->addSelectColumn($alias . '.status_cd');
            $criteria->addSelectColumn($alias . '.status_name');
            $criteria->addSelectColumn($alias . '.status_order');
            $criteria->addSelectColumn($alias . '.status_style');
            $criteria->addSelectColumn($alias . '.include_in_sales');
            $criteria->addSelectColumn($alias . '.include_in_duplicate_checking');
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
        return Propel::getServiceContainer()->getDatabaseMap(StatusesTableMap::DATABASE_NAME)->getTable(StatusesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(StatusesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(StatusesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new StatusesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Statuses or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Statuses object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StatusesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Statuses) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StatusesTableMap::DATABASE_NAME);
            $criteria->add(StatusesTableMap::COL_STATUS_ID, (array) $values, Criteria::IN);
        }

        $query = StatusesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StatusesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StatusesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_statuses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return StatusesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Statuses or Criteria object.
     *
     * @param mixed               $criteria Criteria or Statuses object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StatusesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Statuses object
        }

        if ($criteria->containsKey(StatusesTableMap::COL_STATUS_ID) && $criteria->keyContainsValue(StatusesTableMap::COL_STATUS_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StatusesTableMap::COL_STATUS_ID.')');
        }


        // Set the correct dbName
        $query = StatusesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // StatusesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
StatusesTableMap::buildTableMap();
