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
use TheFarm\Models\Facility;
use TheFarm\Models\FacilityQuery;


/**
 * This class defines the structure of the 'tf_facilities' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FacilityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.FacilityTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_facilities';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Facility';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Facility';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the facility_id field
     */
    const COL_FACILITY_ID = 'tf_facilities.facility_id';

    /**
     * the column name for the facility_name field
     */
    const COL_FACILITY_NAME = 'tf_facilities.facility_name';

    /**
     * the column name for the bg_color field
     */
    const COL_BG_COLOR = 'tf_facilities.bg_color';

    /**
     * the column name for the max_accomodation field
     */
    const COL_MAX_ACCOMODATION = 'tf_facilities.max_accomodation';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_facilities.location_id';

    /**
     * the column name for the abbr field
     */
    const COL_ABBR = 'tf_facilities.abbr';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'tf_facilities.status';

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
        self::TYPE_PHPNAME       => array('FacilityId', 'FacilityName', 'BgColor', 'MaxAccomodation', 'LocationId', 'Abbr', 'Status', ),
        self::TYPE_CAMELNAME     => array('facilityId', 'facilityName', 'bgColor', 'maxAccomodation', 'locationId', 'abbr', 'status', ),
        self::TYPE_COLNAME       => array(FacilityTableMap::COL_FACILITY_ID, FacilityTableMap::COL_FACILITY_NAME, FacilityTableMap::COL_BG_COLOR, FacilityTableMap::COL_MAX_ACCOMODATION, FacilityTableMap::COL_LOCATION_ID, FacilityTableMap::COL_ABBR, FacilityTableMap::COL_STATUS, ),
        self::TYPE_FIELDNAME     => array('facility_id', 'facility_name', 'bg_color', 'max_accomodation', 'location_id', 'abbr', 'status', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('FacilityId' => 0, 'FacilityName' => 1, 'BgColor' => 2, 'MaxAccomodation' => 3, 'LocationId' => 4, 'Abbr' => 5, 'Status' => 6, ),
        self::TYPE_CAMELNAME     => array('facilityId' => 0, 'facilityName' => 1, 'bgColor' => 2, 'maxAccomodation' => 3, 'locationId' => 4, 'abbr' => 5, 'status' => 6, ),
        self::TYPE_COLNAME       => array(FacilityTableMap::COL_FACILITY_ID => 0, FacilityTableMap::COL_FACILITY_NAME => 1, FacilityTableMap::COL_BG_COLOR => 2, FacilityTableMap::COL_MAX_ACCOMODATION => 3, FacilityTableMap::COL_LOCATION_ID => 4, FacilityTableMap::COL_ABBR => 5, FacilityTableMap::COL_STATUS => 6, ),
        self::TYPE_FIELDNAME     => array('facility_id' => 0, 'facility_name' => 1, 'bg_color' => 2, 'max_accomodation' => 3, 'location_id' => 4, 'abbr' => 5, 'status' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('tf_facilities');
        $this->setPhpName('Facility');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Facility');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('facility_id', 'FacilityId', 'INTEGER', true, null, null);
        $this->addColumn('facility_name', 'FacilityName', 'VARCHAR', true, 255, null);
        $this->addColumn('bg_color', 'BgColor', 'VARCHAR', true, 7, null);
        $this->addColumn('max_accomodation', 'MaxAccomodation', 'INTEGER', true, 5, null);
        $this->addForeignKey('location_id', 'LocationId', 'INTEGER', 'tf_locations', 'location_id', false, null, null);
        $this->addColumn('abbr', 'Abbr', 'VARCHAR', true, 16, '');
        $this->addColumn('status', 'Status', 'SMALLINT', true, 1, 1);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Location', '\\TheFarm\\Models\\Location', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':location_id',
    1 => ':location_id',
  ),
), null, null, null, false);
        $this->addRelation('BookingEvent', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':facility_id',
    1 => ':facility_id',
  ),
), null, null, 'BookingEvents', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FacilityId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FacilityTableMap::CLASS_DEFAULT : FacilityTableMap::OM_CLASS;
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
     * @return array           (Facility object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FacilityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FacilityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FacilityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FacilityTableMap::OM_CLASS;
            /** @var Facility $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FacilityTableMap::addInstanceToPool($obj, $key);
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
            $key = FacilityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FacilityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Facility $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FacilityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FacilityTableMap::COL_FACILITY_ID);
            $criteria->addSelectColumn(FacilityTableMap::COL_FACILITY_NAME);
            $criteria->addSelectColumn(FacilityTableMap::COL_BG_COLOR);
            $criteria->addSelectColumn(FacilityTableMap::COL_MAX_ACCOMODATION);
            $criteria->addSelectColumn(FacilityTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(FacilityTableMap::COL_ABBR);
            $criteria->addSelectColumn(FacilityTableMap::COL_STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.facility_id');
            $criteria->addSelectColumn($alias . '.facility_name');
            $criteria->addSelectColumn($alias . '.bg_color');
            $criteria->addSelectColumn($alias . '.max_accomodation');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.abbr');
            $criteria->addSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(FacilityTableMap::DATABASE_NAME)->getTable(FacilityTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FacilityTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FacilityTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FacilityTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Facility or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Facility object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Facility) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FacilityTableMap::DATABASE_NAME);
            $criteria->add(FacilityTableMap::COL_FACILITY_ID, (array) $values, Criteria::IN);
        }

        $query = FacilityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FacilityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FacilityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_facilities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FacilityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Facility or Criteria object.
     *
     * @param mixed               $criteria Criteria or Facility object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Facility object
        }

        if ($criteria->containsKey(FacilityTableMap::COL_FACILITY_ID) && $criteria->keyContainsValue(FacilityTableMap::COL_FACILITY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FacilityTableMap::COL_FACILITY_ID.')');
        }


        // Set the correct dbName
        $query = FacilityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FacilityTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FacilityTableMap::buildTableMap();
