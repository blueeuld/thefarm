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
use TheFarm\Models\Packages;
use TheFarm\Models\PackagesQuery;


/**
 * This class defines the structure of the 'tf_packages' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PackagesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.PackagesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_packages';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Packages';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Packages';

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
     * the column name for the package_id field
     */
    const COL_PACKAGE_ID = 'tf_packages.package_id';

    /**
     * the column name for the package_name field
     */
    const COL_PACKAGE_NAME = 'tf_packages.package_name';

    /**
     * the column name for the package_type field
     */
    const COL_PACKAGE_TYPE = 'tf_packages.package_type';

    /**
     * the column name for the duration field
     */
    const COL_DURATION = 'tf_packages.duration';

    /**
     * the column name for the package_type_id field
     */
    const COL_PACKAGE_TYPE_ID = 'tf_packages.package_type_id';

    /**
     * the column name for the personalized field
     */
    const COL_PERSONALIZED = 'tf_packages.personalized';

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
        self::TYPE_PHPNAME       => array('PackageId', 'PackageName', 'PackageType', 'Duration', 'PackageTypeId', 'Personalized', ),
        self::TYPE_CAMELNAME     => array('packageId', 'packageName', 'packageType', 'duration', 'packageTypeId', 'personalized', ),
        self::TYPE_COLNAME       => array(PackagesTableMap::COL_PACKAGE_ID, PackagesTableMap::COL_PACKAGE_NAME, PackagesTableMap::COL_PACKAGE_TYPE, PackagesTableMap::COL_DURATION, PackagesTableMap::COL_PACKAGE_TYPE_ID, PackagesTableMap::COL_PERSONALIZED, ),
        self::TYPE_FIELDNAME     => array('package_id', 'package_name', 'package_type', 'duration', 'package_type_id', 'personalized', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PackageId' => 0, 'PackageName' => 1, 'PackageType' => 2, 'Duration' => 3, 'PackageTypeId' => 4, 'Personalized' => 5, ),
        self::TYPE_CAMELNAME     => array('packageId' => 0, 'packageName' => 1, 'packageType' => 2, 'duration' => 3, 'packageTypeId' => 4, 'personalized' => 5, ),
        self::TYPE_COLNAME       => array(PackagesTableMap::COL_PACKAGE_ID => 0, PackagesTableMap::COL_PACKAGE_NAME => 1, PackagesTableMap::COL_PACKAGE_TYPE => 2, PackagesTableMap::COL_DURATION => 3, PackagesTableMap::COL_PACKAGE_TYPE_ID => 4, PackagesTableMap::COL_PERSONALIZED => 5, ),
        self::TYPE_FIELDNAME     => array('package_id' => 0, 'package_name' => 1, 'package_type' => 2, 'duration' => 3, 'package_type_id' => 4, 'personalized' => 5, ),
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
        $this->setName('tf_packages');
        $this->setPhpName('Packages');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Packages');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('package_id', 'PackageId', 'INTEGER', true, null, null);
        $this->addColumn('package_name', 'PackageName', 'VARCHAR', true, 255, null);
        $this->addColumn('package_type', 'PackageType', 'VARCHAR', true, 255, null);
        $this->addColumn('duration', 'Duration', 'SMALLINT', true, 3, null);
        $this->addColumn('package_type_id', 'PackageTypeId', 'INTEGER', true, 5, null);
        $this->addColumn('personalized', 'Personalized', 'SMALLINT', true, 1, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Bookings', '\\TheFarm\\Models\\Bookings', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':package_id',
    1 => ':package_id',
  ),
), null, null, 'Bookingss', false);
        $this->addRelation('PackageItems', '\\TheFarm\\Models\\PackageItems', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':package_id',
    1 => ':package_id',
  ),
), null, null, 'PackageItemss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PackageId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PackagesTableMap::CLASS_DEFAULT : PackagesTableMap::OM_CLASS;
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
     * @return array           (Packages object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PackagesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PackagesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PackagesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PackagesTableMap::OM_CLASS;
            /** @var Packages $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PackagesTableMap::addInstanceToPool($obj, $key);
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
            $key = PackagesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PackagesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Packages $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PackagesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PackagesTableMap::COL_PACKAGE_ID);
            $criteria->addSelectColumn(PackagesTableMap::COL_PACKAGE_NAME);
            $criteria->addSelectColumn(PackagesTableMap::COL_PACKAGE_TYPE);
            $criteria->addSelectColumn(PackagesTableMap::COL_DURATION);
            $criteria->addSelectColumn(PackagesTableMap::COL_PACKAGE_TYPE_ID);
            $criteria->addSelectColumn(PackagesTableMap::COL_PERSONALIZED);
        } else {
            $criteria->addSelectColumn($alias . '.package_id');
            $criteria->addSelectColumn($alias . '.package_name');
            $criteria->addSelectColumn($alias . '.package_type');
            $criteria->addSelectColumn($alias . '.duration');
            $criteria->addSelectColumn($alias . '.package_type_id');
            $criteria->addSelectColumn($alias . '.personalized');
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
        return Propel::getServiceContainer()->getDatabaseMap(PackagesTableMap::DATABASE_NAME)->getTable(PackagesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PackagesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PackagesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PackagesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Packages or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Packages object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Packages) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PackagesTableMap::DATABASE_NAME);
            $criteria->add(PackagesTableMap::COL_PACKAGE_ID, (array) $values, Criteria::IN);
        }

        $query = PackagesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PackagesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PackagesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_packages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PackagesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Packages or Criteria object.
     *
     * @param mixed               $criteria Criteria or Packages object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Packages object
        }

        if ($criteria->containsKey(PackagesTableMap::COL_PACKAGE_ID) && $criteria->keyContainsValue(PackagesTableMap::COL_PACKAGE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PackagesTableMap::COL_PACKAGE_ID.')');
        }


        // Set the correct dbName
        $query = PackagesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PackagesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PackagesTableMap::buildTableMap();
