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
use TheFarm\Models\FormEntries3;
use TheFarm\Models\FormEntries3Query;


/**
 * This class defines the structure of the 'tf_form_entries_3' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FormEntries3TableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.FormEntries3TableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_form_entries_3';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\FormEntries3';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.FormEntries3';

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
     * the column name for the entry_id field
     */
    const COL_ENTRY_ID = 'tf_form_entries_3.entry_id';

    /**
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_form_entries_3.booking_id';

    /**
     * the column name for the author_id field
     */
    const COL_AUTHOR_ID = 'tf_form_entries_3.author_id';

    /**
     * the column name for the entry_date field
     */
    const COL_ENTRY_DATE = 'tf_form_entries_3.entry_date';

    /**
     * the column name for the edit_date field
     */
    const COL_EDIT_DATE = 'tf_form_entries_3.edit_date';

    /**
     * the column name for the completed_by field
     */
    const COL_COMPLETED_BY = 'tf_form_entries_3.completed_by';

    /**
     * the column name for the completed_date field
     */
    const COL_COMPLETED_DATE = 'tf_form_entries_3.completed_date';

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
        self::TYPE_PHPNAME       => array('EntryId', 'BookingId', 'AuthorId', 'EntryDate', 'EditDate', 'CompletedBy', 'CompletedDate', ),
        self::TYPE_CAMELNAME     => array('entryId', 'bookingId', 'authorId', 'entryDate', 'editDate', 'completedBy', 'completedDate', ),
        self::TYPE_COLNAME       => array(FormEntries3TableMap::COL_ENTRY_ID, FormEntries3TableMap::COL_BOOKING_ID, FormEntries3TableMap::COL_AUTHOR_ID, FormEntries3TableMap::COL_ENTRY_DATE, FormEntries3TableMap::COL_EDIT_DATE, FormEntries3TableMap::COL_COMPLETED_BY, FormEntries3TableMap::COL_COMPLETED_DATE, ),
        self::TYPE_FIELDNAME     => array('entry_id', 'booking_id', 'author_id', 'entry_date', 'edit_date', 'completed_by', 'completed_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntryId' => 0, 'BookingId' => 1, 'AuthorId' => 2, 'EntryDate' => 3, 'EditDate' => 4, 'CompletedBy' => 5, 'CompletedDate' => 6, ),
        self::TYPE_CAMELNAME     => array('entryId' => 0, 'bookingId' => 1, 'authorId' => 2, 'entryDate' => 3, 'editDate' => 4, 'completedBy' => 5, 'completedDate' => 6, ),
        self::TYPE_COLNAME       => array(FormEntries3TableMap::COL_ENTRY_ID => 0, FormEntries3TableMap::COL_BOOKING_ID => 1, FormEntries3TableMap::COL_AUTHOR_ID => 2, FormEntries3TableMap::COL_ENTRY_DATE => 3, FormEntries3TableMap::COL_EDIT_DATE => 4, FormEntries3TableMap::COL_COMPLETED_BY => 5, FormEntries3TableMap::COL_COMPLETED_DATE => 6, ),
        self::TYPE_FIELDNAME     => array('entry_id' => 0, 'booking_id' => 1, 'author_id' => 2, 'entry_date' => 3, 'edit_date' => 4, 'completed_by' => 5, 'completed_date' => 6, ),
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
        $this->setName('tf_form_entries_3');
        $this->setPhpName('FormEntries3');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\FormEntries3');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entry_id', 'EntryId', 'INTEGER', true, 5, null);
        $this->addColumn('booking_id', 'BookingId', 'INTEGER', true, 5, null);
        $this->addColumn('author_id', 'AuthorId', 'INTEGER', true, 5, null);
        $this->addColumn('entry_date', 'EntryDate', 'INTEGER', true, 10, null);
        $this->addColumn('edit_date', 'EditDate', 'INTEGER', true, 10, null);
        $this->addColumn('completed_by', 'CompletedBy', 'INTEGER', false, 5, null);
        $this->addColumn('completed_date', 'CompletedDate', 'INTEGER', false, 10, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FormEntries3TableMap::CLASS_DEFAULT : FormEntries3TableMap::OM_CLASS;
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
     * @return array           (FormEntries3 object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FormEntries3TableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FormEntries3TableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FormEntries3TableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FormEntries3TableMap::OM_CLASS;
            /** @var FormEntries3 $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FormEntries3TableMap::addInstanceToPool($obj, $key);
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
            $key = FormEntries3TableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FormEntries3TableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FormEntries3 $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FormEntries3TableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FormEntries3TableMap::COL_ENTRY_ID);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_AUTHOR_ID);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_ENTRY_DATE);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_EDIT_DATE);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_COMPLETED_BY);
            $criteria->addSelectColumn(FormEntries3TableMap::COL_COMPLETED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.entry_id');
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.author_id');
            $criteria->addSelectColumn($alias . '.entry_date');
            $criteria->addSelectColumn($alias . '.edit_date');
            $criteria->addSelectColumn($alias . '.completed_by');
            $criteria->addSelectColumn($alias . '.completed_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(FormEntries3TableMap::DATABASE_NAME)->getTable(FormEntries3TableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FormEntries3TableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FormEntries3TableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FormEntries3TableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FormEntries3 or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FormEntries3 object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries3TableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\FormEntries3) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FormEntries3TableMap::DATABASE_NAME);
            $criteria->add(FormEntries3TableMap::COL_ENTRY_ID, (array) $values, Criteria::IN);
        }

        $query = FormEntries3Query::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FormEntries3TableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FormEntries3TableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_form_entries_3 table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FormEntries3Query::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FormEntries3 or Criteria object.
     *
     * @param mixed               $criteria Criteria or FormEntries3 object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries3TableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FormEntries3 object
        }

        if ($criteria->containsKey(FormEntries3TableMap::COL_ENTRY_ID) && $criteria->keyContainsValue(FormEntries3TableMap::COL_ENTRY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FormEntries3TableMap::COL_ENTRY_ID.')');
        }


        // Set the correct dbName
        $query = FormEntries3Query::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FormEntries3TableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FormEntries3TableMap::buildTableMap();
