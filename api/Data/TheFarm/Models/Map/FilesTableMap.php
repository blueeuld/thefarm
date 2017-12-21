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
use TheFarm\Models\Files;
use TheFarm\Models\FilesQuery;


/**
 * This class defines the structure of the 'tf_files' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FilesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.FilesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_files';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Files';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Files';

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
     * the column name for the file_id field
     */
    const COL_FILE_ID = 'tf_files.file_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'tf_files.title';

    /**
     * the column name for the file_name field
     */
    const COL_FILE_NAME = 'tf_files.file_name';

    /**
     * the column name for the file_size field
     */
    const COL_FILE_SIZE = 'tf_files.file_size';

    /**
     * the column name for the upload_id field
     */
    const COL_UPLOAD_ID = 'tf_files.upload_id';

    /**
     * the column name for the upload_date field
     */
    const COL_UPLOAD_DATE = 'tf_files.upload_date';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_files.location_id';

    /**
     * the column name for the last_viewed field
     */
    const COL_LAST_VIEWED = 'tf_files.last_viewed';

    /**
     * the column name for the viewed_by field
     */
    const COL_VIEWED_BY = 'tf_files.viewed_by';

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
        self::TYPE_PHPNAME       => array('FileId', 'Title', 'FileName', 'FileSize', 'UploadId', 'UploadDate', 'LocationId', 'LastViewed', 'ViewedBy', ),
        self::TYPE_CAMELNAME     => array('fileId', 'title', 'fileName', 'fileSize', 'uploadId', 'uploadDate', 'locationId', 'lastViewed', 'viewedBy', ),
        self::TYPE_COLNAME       => array(FilesTableMap::COL_FILE_ID, FilesTableMap::COL_TITLE, FilesTableMap::COL_FILE_NAME, FilesTableMap::COL_FILE_SIZE, FilesTableMap::COL_UPLOAD_ID, FilesTableMap::COL_UPLOAD_DATE, FilesTableMap::COL_LOCATION_ID, FilesTableMap::COL_LAST_VIEWED, FilesTableMap::COL_VIEWED_BY, ),
        self::TYPE_FIELDNAME     => array('file_id', 'title', 'file_name', 'file_size', 'upload_id', 'upload_date', 'location_id', 'last_viewed', 'viewed_by', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('FileId' => 0, 'Title' => 1, 'FileName' => 2, 'FileSize' => 3, 'UploadId' => 4, 'UploadDate' => 5, 'LocationId' => 6, 'LastViewed' => 7, 'ViewedBy' => 8, ),
        self::TYPE_CAMELNAME     => array('fileId' => 0, 'title' => 1, 'fileName' => 2, 'fileSize' => 3, 'uploadId' => 4, 'uploadDate' => 5, 'locationId' => 6, 'lastViewed' => 7, 'viewedBy' => 8, ),
        self::TYPE_COLNAME       => array(FilesTableMap::COL_FILE_ID => 0, FilesTableMap::COL_TITLE => 1, FilesTableMap::COL_FILE_NAME => 2, FilesTableMap::COL_FILE_SIZE => 3, FilesTableMap::COL_UPLOAD_ID => 4, FilesTableMap::COL_UPLOAD_DATE => 5, FilesTableMap::COL_LOCATION_ID => 6, FilesTableMap::COL_LAST_VIEWED => 7, FilesTableMap::COL_VIEWED_BY => 8, ),
        self::TYPE_FIELDNAME     => array('file_id' => 0, 'title' => 1, 'file_name' => 2, 'file_size' => 3, 'upload_id' => 4, 'upload_date' => 5, 'location_id' => 6, 'last_viewed' => 7, 'viewed_by' => 8, ),
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
        $this->setName('tf_files');
        $this->setPhpName('Files');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Files');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('file_id', 'FileId', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('file_name', 'FileName', 'VARCHAR', true, 255, null);
        $this->addColumn('file_size', 'FileSize', 'INTEGER', true, null, null);
        $this->addColumn('upload_id', 'UploadId', 'INTEGER', true, 5, null);
        $this->addColumn('upload_date', 'UploadDate', 'INTEGER', true, 10, null);
        $this->addColumn('location_id', 'LocationId', 'INTEGER', true, 5, null);
        $this->addColumn('last_viewed', 'LastViewed', 'INTEGER', false, 10, null);
        $this->addColumn('viewed_by', 'ViewedBy', 'INTEGER', false, 5, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BookingAttachment', '\\TheFarm\\Models\\BookingAttachment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':file_id',
    1 => ':file_id',
  ),
), null, null, 'BookingAttachments', false);
        $this->addRelation('Category', '\\TheFarm\\Models\\Category', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cat_image',
    1 => ':file_id',
  ),
), null, null, 'Categories', false);
        $this->addRelation('Item', '\\TheFarm\\Models\\Item', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_image',
    1 => ':file_id',
  ),
), null, null, 'Items', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('FileId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FilesTableMap::CLASS_DEFAULT : FilesTableMap::OM_CLASS;
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
     * @return array           (Files object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FilesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FilesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FilesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FilesTableMap::OM_CLASS;
            /** @var Files $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FilesTableMap::addInstanceToPool($obj, $key);
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
            $key = FilesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FilesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Files $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FilesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FilesTableMap::COL_FILE_ID);
            $criteria->addSelectColumn(FilesTableMap::COL_TITLE);
            $criteria->addSelectColumn(FilesTableMap::COL_FILE_NAME);
            $criteria->addSelectColumn(FilesTableMap::COL_FILE_SIZE);
            $criteria->addSelectColumn(FilesTableMap::COL_UPLOAD_ID);
            $criteria->addSelectColumn(FilesTableMap::COL_UPLOAD_DATE);
            $criteria->addSelectColumn(FilesTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(FilesTableMap::COL_LAST_VIEWED);
            $criteria->addSelectColumn(FilesTableMap::COL_VIEWED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.file_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.file_name');
            $criteria->addSelectColumn($alias . '.file_size');
            $criteria->addSelectColumn($alias . '.upload_id');
            $criteria->addSelectColumn($alias . '.upload_date');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.last_viewed');
            $criteria->addSelectColumn($alias . '.viewed_by');
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
        return Propel::getServiceContainer()->getDatabaseMap(FilesTableMap::DATABASE_NAME)->getTable(FilesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FilesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FilesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FilesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Files or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Files object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Files) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FilesTableMap::DATABASE_NAME);
            $criteria->add(FilesTableMap::COL_FILE_ID, (array) $values, Criteria::IN);
        }

        $query = FilesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FilesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FilesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FilesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Files or Criteria object.
     *
     * @param mixed               $criteria Criteria or Files object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Files object
        }

        if ($criteria->containsKey(FilesTableMap::COL_FILE_ID) && $criteria->keyContainsValue(FilesTableMap::COL_FILE_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FilesTableMap::COL_FILE_ID.')');
        }


        // Set the correct dbName
        $query = FilesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FilesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FilesTableMap::buildTableMap();
