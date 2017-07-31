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
use TheFarm\Models\UploadPrefs;
use TheFarm\Models\UploadPrefsQuery;


/**
 * This class defines the structure of the 'tf_upload_prefs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UploadPrefsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.UploadPrefsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_upload_prefs';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\UploadPrefs';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.UploadPrefs';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the upload_id field
     */
    const COL_UPLOAD_ID = 'tf_upload_prefs.upload_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'tf_upload_prefs.name';

    /**
     * the column name for the max_size field
     */
    const COL_MAX_SIZE = 'tf_upload_prefs.max_size';

    /**
     * the column name for the max_height field
     */
    const COL_MAX_HEIGHT = 'tf_upload_prefs.max_height';

    /**
     * the column name for the max_width field
     */
    const COL_MAX_WIDTH = 'tf_upload_prefs.max_width';

    /**
     * the column name for the upload_path field
     */
    const COL_UPLOAD_PATH = 'tf_upload_prefs.upload_path';

    /**
     * the column name for the allowed_types field
     */
    const COL_ALLOWED_TYPES = 'tf_upload_prefs.allowed_types';

    /**
     * the column name for the url field
     */
    const COL_URL = 'tf_upload_prefs.url';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_upload_prefs.location_id';

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
        self::TYPE_PHPNAME       => array('UploadId', 'Name', 'MaxSize', 'MaxHeight', 'MaxWidth', 'UploadPath', 'AllowedTypes', 'Url', 'LocationId', ),
        self::TYPE_CAMELNAME     => array('uploadId', 'name', 'maxSize', 'maxHeight', 'maxWidth', 'uploadPath', 'allowedTypes', 'url', 'locationId', ),
        self::TYPE_COLNAME       => array(UploadPrefsTableMap::COL_UPLOAD_ID, UploadPrefsTableMap::COL_NAME, UploadPrefsTableMap::COL_MAX_SIZE, UploadPrefsTableMap::COL_MAX_HEIGHT, UploadPrefsTableMap::COL_MAX_WIDTH, UploadPrefsTableMap::COL_UPLOAD_PATH, UploadPrefsTableMap::COL_ALLOWED_TYPES, UploadPrefsTableMap::COL_URL, UploadPrefsTableMap::COL_LOCATION_ID, ),
        self::TYPE_FIELDNAME     => array('upload_id', 'name', 'max_size', 'max_height', 'max_width', 'upload_path', 'allowed_types', 'url', 'location_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('UploadId' => 0, 'Name' => 1, 'MaxSize' => 2, 'MaxHeight' => 3, 'MaxWidth' => 4, 'UploadPath' => 5, 'AllowedTypes' => 6, 'Url' => 7, 'LocationId' => 8, ),
        self::TYPE_CAMELNAME     => array('uploadId' => 0, 'name' => 1, 'maxSize' => 2, 'maxHeight' => 3, 'maxWidth' => 4, 'uploadPath' => 5, 'allowedTypes' => 6, 'url' => 7, 'locationId' => 8, ),
        self::TYPE_COLNAME       => array(UploadPrefsTableMap::COL_UPLOAD_ID => 0, UploadPrefsTableMap::COL_NAME => 1, UploadPrefsTableMap::COL_MAX_SIZE => 2, UploadPrefsTableMap::COL_MAX_HEIGHT => 3, UploadPrefsTableMap::COL_MAX_WIDTH => 4, UploadPrefsTableMap::COL_UPLOAD_PATH => 5, UploadPrefsTableMap::COL_ALLOWED_TYPES => 6, UploadPrefsTableMap::COL_URL => 7, UploadPrefsTableMap::COL_LOCATION_ID => 8, ),
        self::TYPE_FIELDNAME     => array('upload_id' => 0, 'name' => 1, 'max_size' => 2, 'max_height' => 3, 'max_width' => 4, 'upload_path' => 5, 'allowed_types' => 6, 'url' => 7, 'location_id' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('tf_upload_prefs');
        $this->setPhpName('UploadPrefs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\UploadPrefs');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('upload_id', 'UploadId', 'INTEGER', true, 5, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('max_size', 'MaxSize', 'INTEGER', true, null, null);
        $this->addColumn('max_height', 'MaxHeight', 'INTEGER', true, null, null);
        $this->addColumn('max_width', 'MaxWidth', 'INTEGER', true, null, null);
        $this->addColumn('upload_path', 'UploadPath', 'VARCHAR', true, 255, null);
        $this->addColumn('allowed_types', 'AllowedTypes', 'VARCHAR', true, 100, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 255, null);
        $this->addColumn('location_id', 'LocationId', 'INTEGER', true, 5, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('UploadId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UploadPrefsTableMap::CLASS_DEFAULT : UploadPrefsTableMap::OM_CLASS;
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
     * @return array           (UploadPrefs object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UploadPrefsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UploadPrefsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UploadPrefsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UploadPrefsTableMap::OM_CLASS;
            /** @var UploadPrefs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UploadPrefsTableMap::addInstanceToPool($obj, $key);
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
            $key = UploadPrefsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UploadPrefsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UploadPrefs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UploadPrefsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_UPLOAD_ID);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_NAME);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_MAX_SIZE);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_MAX_HEIGHT);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_MAX_WIDTH);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_UPLOAD_PATH);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_ALLOWED_TYPES);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_URL);
            $criteria->addSelectColumn(UploadPrefsTableMap::COL_LOCATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.upload_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.max_size');
            $criteria->addSelectColumn($alias . '.max_height');
            $criteria->addSelectColumn($alias . '.max_width');
            $criteria->addSelectColumn($alias . '.upload_path');
            $criteria->addSelectColumn($alias . '.allowed_types');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.location_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(UploadPrefsTableMap::DATABASE_NAME)->getTable(UploadPrefsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UploadPrefsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UploadPrefsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UploadPrefsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UploadPrefs or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UploadPrefs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UploadPrefsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\UploadPrefs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UploadPrefsTableMap::DATABASE_NAME);
            $criteria->add(UploadPrefsTableMap::COL_UPLOAD_ID, (array) $values, Criteria::IN);
        }

        $query = UploadPrefsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UploadPrefsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UploadPrefsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_upload_prefs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UploadPrefsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UploadPrefs or Criteria object.
     *
     * @param mixed               $criteria Criteria or UploadPrefs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UploadPrefsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UploadPrefs object
        }

        if ($criteria->containsKey(UploadPrefsTableMap::COL_UPLOAD_ID) && $criteria->keyContainsValue(UploadPrefsTableMap::COL_UPLOAD_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UploadPrefsTableMap::COL_UPLOAD_ID.')');
        }


        // Set the correct dbName
        $query = UploadPrefsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UploadPrefsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UploadPrefsTableMap::buildTableMap();
