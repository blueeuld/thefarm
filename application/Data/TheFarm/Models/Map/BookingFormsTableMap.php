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
use TheFarm\Models\BookingForms;
use TheFarm\Models\BookingFormsQuery;


/**
 * This class defines the structure of the 'tf_booking_forms' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BookingFormsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.BookingFormsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_booking_forms';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\BookingForms';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.BookingForms';

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
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_booking_forms.booking_id';

    /**
     * the column name for the form_id field
     */
    const COL_FORM_ID = 'tf_booking_forms.form_id';

    /**
     * the column name for the required field
     */
    const COL_REQUIRED = 'tf_booking_forms.required';

    /**
     * the column name for the submitted field
     */
    const COL_SUBMITTED = 'tf_booking_forms.submitted';

    /**
     * the column name for the notify_user_on_submit field
     */
    const COL_NOTIFY_USER_ON_SUBMIT = 'tf_booking_forms.notify_user_on_submit';

    /**
     * the column name for the submitted_date field
     */
    const COL_SUBMITTED_DATE = 'tf_booking_forms.submitted_date';

    /**
     * the column name for the completed_by field
     */
    const COL_COMPLETED_BY = 'tf_booking_forms.completed_by';

    /**
     * the column name for the completed_date field
     */
    const COL_COMPLETED_DATE = 'tf_booking_forms.completed_date';

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
        self::TYPE_PHPNAME       => array('BookingId', 'FormId', 'Required', 'Submitted', 'NotifyUserOnSubmit', 'SubmittedDate', 'CompletedBy', 'CompletedDate', ),
        self::TYPE_CAMELNAME     => array('bookingId', 'formId', 'required', 'submitted', 'notifyUserOnSubmit', 'submittedDate', 'completedBy', 'completedDate', ),
        self::TYPE_COLNAME       => array(BookingFormsTableMap::COL_BOOKING_ID, BookingFormsTableMap::COL_FORM_ID, BookingFormsTableMap::COL_REQUIRED, BookingFormsTableMap::COL_SUBMITTED, BookingFormsTableMap::COL_NOTIFY_USER_ON_SUBMIT, BookingFormsTableMap::COL_SUBMITTED_DATE, BookingFormsTableMap::COL_COMPLETED_BY, BookingFormsTableMap::COL_COMPLETED_DATE, ),
        self::TYPE_FIELDNAME     => array('booking_id', 'form_id', 'required', 'submitted', 'notify_user_on_submit', 'submitted_date', 'completed_by', 'completed_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('BookingId' => 0, 'FormId' => 1, 'Required' => 2, 'Submitted' => 3, 'NotifyUserOnSubmit' => 4, 'SubmittedDate' => 5, 'CompletedBy' => 6, 'CompletedDate' => 7, ),
        self::TYPE_CAMELNAME     => array('bookingId' => 0, 'formId' => 1, 'required' => 2, 'submitted' => 3, 'notifyUserOnSubmit' => 4, 'submittedDate' => 5, 'completedBy' => 6, 'completedDate' => 7, ),
        self::TYPE_COLNAME       => array(BookingFormsTableMap::COL_BOOKING_ID => 0, BookingFormsTableMap::COL_FORM_ID => 1, BookingFormsTableMap::COL_REQUIRED => 2, BookingFormsTableMap::COL_SUBMITTED => 3, BookingFormsTableMap::COL_NOTIFY_USER_ON_SUBMIT => 4, BookingFormsTableMap::COL_SUBMITTED_DATE => 5, BookingFormsTableMap::COL_COMPLETED_BY => 6, BookingFormsTableMap::COL_COMPLETED_DATE => 7, ),
        self::TYPE_FIELDNAME     => array('booking_id' => 0, 'form_id' => 1, 'required' => 2, 'submitted' => 3, 'notify_user_on_submit' => 4, 'submitted_date' => 5, 'completed_by' => 6, 'completed_date' => 7, ),
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
        $this->setName('tf_booking_forms');
        $this->setPhpName('BookingForms');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\BookingForms');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('booking_id', 'BookingId', 'INTEGER', true, 5, null);
        $this->addPrimaryKey('form_id', 'FormId', 'INTEGER', true, 5, null);
        $this->addColumn('required', 'Required', 'VARCHAR', true, 1, 'n');
        $this->addColumn('submitted', 'Submitted', 'VARCHAR', true, 1, 'n');
        $this->addColumn('notify_user_on_submit', 'NotifyUserOnSubmit', 'VARCHAR', true, 255, '');
        $this->addColumn('submitted_date', 'SubmittedDate', 'INTEGER', false, 10, 0);
        $this->addColumn('completed_by', 'CompletedBy', 'INTEGER', false, null, null);
        $this->addColumn('completed_date', 'CompletedDate', 'INTEGER', false, 10, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \TheFarm\Models\BookingForms $obj A \TheFarm\Models\BookingForms object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getBookingId() || is_scalar($obj->getBookingId()) || is_callable([$obj->getBookingId(), '__toString']) ? (string) $obj->getBookingId() : $obj->getBookingId()), (null === $obj->getFormId() || is_scalar($obj->getFormId()) || is_callable([$obj->getFormId(), '__toString']) ? (string) $obj->getFormId() : $obj->getFormId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \TheFarm\Models\BookingForms object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \TheFarm\Models\BookingForms) {
                $key = serialize([(null === $value->getBookingId() || is_scalar($value->getBookingId()) || is_callable([$value->getBookingId(), '__toString']) ? (string) $value->getBookingId() : $value->getBookingId()), (null === $value->getFormId() || is_scalar($value->getFormId()) || is_callable([$value->getFormId(), '__toString']) ? (string) $value->getFormId() : $value->getFormId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \TheFarm\Models\BookingForms object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('FormId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? BookingFormsTableMap::CLASS_DEFAULT : BookingFormsTableMap::OM_CLASS;
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
     * @return array           (BookingForms object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BookingFormsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BookingFormsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BookingFormsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BookingFormsTableMap::OM_CLASS;
            /** @var BookingForms $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BookingFormsTableMap::addInstanceToPool($obj, $key);
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
            $key = BookingFormsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BookingFormsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BookingForms $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BookingFormsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BookingFormsTableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_FORM_ID);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_REQUIRED);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_SUBMITTED);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_NOTIFY_USER_ON_SUBMIT);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_SUBMITTED_DATE);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_COMPLETED_BY);
            $criteria->addSelectColumn(BookingFormsTableMap::COL_COMPLETED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.form_id');
            $criteria->addSelectColumn($alias . '.required');
            $criteria->addSelectColumn($alias . '.submitted');
            $criteria->addSelectColumn($alias . '.notify_user_on_submit');
            $criteria->addSelectColumn($alias . '.submitted_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(BookingFormsTableMap::DATABASE_NAME)->getTable(BookingFormsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BookingFormsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BookingFormsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BookingFormsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BookingForms or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BookingForms object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\BookingForms) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BookingFormsTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(BookingFormsTableMap::COL_BOOKING_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(BookingFormsTableMap::COL_FORM_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = BookingFormsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BookingFormsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BookingFormsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_booking_forms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BookingFormsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BookingForms or Criteria object.
     *
     * @param mixed               $criteria Criteria or BookingForms object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BookingForms object
        }


        // Set the correct dbName
        $query = BookingFormsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BookingFormsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BookingFormsTableMap::buildTableMap();
