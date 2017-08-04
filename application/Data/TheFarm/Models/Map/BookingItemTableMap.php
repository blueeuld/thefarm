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
use TheFarm\Models\BookingItem;
use TheFarm\Models\BookingItemQuery;


/**
 * This class defines the structure of the 'tf_booking_items' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BookingItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.BookingItemTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_booking_items';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\BookingItem';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.BookingItem';

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
     * the column name for the booking_item_id field
     */
    const COL_BOOKING_ITEM_ID = 'tf_booking_items.booking_item_id';

    /**
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_booking_items.booking_id';

    /**
     * the column name for the item_id field
     */
    const COL_ITEM_ID = 'tf_booking_items.item_id';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'tf_booking_items.quantity';

    /**
     * the column name for the included field
     */
    const COL_INCLUDED = 'tf_booking_items.included';

    /**
     * the column name for the foc field
     */
    const COL_FOC = 'tf_booking_items.foc';

    /**
     * the column name for the upsell field
     */
    const COL_UPSELL = 'tf_booking_items.upsell';

    /**
     * the column name for the inventory field
     */
    const COL_INVENTORY = 'tf_booking_items.inventory';

    /**
     * the column name for the upgrade field
     */
    const COL_UPGRADE = 'tf_booking_items.upgrade';

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
        self::TYPE_PHPNAME       => array('BookingItemId', 'BookingId', 'ItemId', 'Quantity', 'Included', 'Foc', 'Upsell', 'Inventory', 'Upgrade', ),
        self::TYPE_CAMELNAME     => array('bookingItemId', 'bookingId', 'itemId', 'quantity', 'included', 'foc', 'upsell', 'inventory', 'upgrade', ),
        self::TYPE_COLNAME       => array(BookingItemTableMap::COL_BOOKING_ITEM_ID, BookingItemTableMap::COL_BOOKING_ID, BookingItemTableMap::COL_ITEM_ID, BookingItemTableMap::COL_QUANTITY, BookingItemTableMap::COL_INCLUDED, BookingItemTableMap::COL_FOC, BookingItemTableMap::COL_UPSELL, BookingItemTableMap::COL_INVENTORY, BookingItemTableMap::COL_UPGRADE, ),
        self::TYPE_FIELDNAME     => array('booking_item_id', 'booking_id', 'item_id', 'quantity', 'included', 'foc', 'upsell', 'inventory', 'upgrade', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('BookingItemId' => 0, 'BookingId' => 1, 'ItemId' => 2, 'Quantity' => 3, 'Included' => 4, 'Foc' => 5, 'Upsell' => 6, 'Inventory' => 7, 'Upgrade' => 8, ),
        self::TYPE_CAMELNAME     => array('bookingItemId' => 0, 'bookingId' => 1, 'itemId' => 2, 'quantity' => 3, 'included' => 4, 'foc' => 5, 'upsell' => 6, 'inventory' => 7, 'upgrade' => 8, ),
        self::TYPE_COLNAME       => array(BookingItemTableMap::COL_BOOKING_ITEM_ID => 0, BookingItemTableMap::COL_BOOKING_ID => 1, BookingItemTableMap::COL_ITEM_ID => 2, BookingItemTableMap::COL_QUANTITY => 3, BookingItemTableMap::COL_INCLUDED => 4, BookingItemTableMap::COL_FOC => 5, BookingItemTableMap::COL_UPSELL => 6, BookingItemTableMap::COL_INVENTORY => 7, BookingItemTableMap::COL_UPGRADE => 8, ),
        self::TYPE_FIELDNAME     => array('booking_item_id' => 0, 'booking_id' => 1, 'item_id' => 2, 'quantity' => 3, 'included' => 4, 'foc' => 5, 'upsell' => 6, 'inventory' => 7, 'upgrade' => 8, ),
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
        $this->setName('tf_booking_items');
        $this->setPhpName('BookingItem');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\BookingItem');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('booking_item_id', 'BookingItemId', 'INTEGER', true, null, null);
        $this->addForeignKey('booking_id', 'BookingId', 'INTEGER', 'tf_bookings', 'booking_id', true, null, null);
        $this->addForeignKey('item_id', 'ItemId', 'INTEGER', 'tf_items', 'item_id', true, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, 5, null);
        $this->addColumn('included', 'Included', 'INTEGER', true, 1, null);
        $this->addColumn('foc', 'Foc', 'INTEGER', true, 1, 0);
        $this->addColumn('upsell', 'Upsell', 'INTEGER', true, 1, 0);
        $this->addColumn('inventory', 'Inventory', 'INTEGER', false, 5, 0);
        $this->addColumn('upgrade', 'Upgrade', 'SMALLINT', false, 1, 0);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Booking', '\\TheFarm\\Models\\Booking', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':booking_id',
    1 => ':booking_id',
  ),
), null, null, null, false);
        $this->addRelation('Item', '\\TheFarm\\Models\\Item', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, null, false);
        $this->addRelation('BookingEvent', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':booking_item_id',
    1 => ':booking_item_id',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BookingItemId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BookingItemTableMap::CLASS_DEFAULT : BookingItemTableMap::OM_CLASS;
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
     * @return array           (BookingItem object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BookingItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BookingItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BookingItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BookingItemTableMap::OM_CLASS;
            /** @var BookingItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BookingItemTableMap::addInstanceToPool($obj, $key);
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
            $key = BookingItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BookingItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BookingItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BookingItemTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BookingItemTableMap::COL_BOOKING_ITEM_ID);
            $criteria->addSelectColumn(BookingItemTableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(BookingItemTableMap::COL_ITEM_ID);
            $criteria->addSelectColumn(BookingItemTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(BookingItemTableMap::COL_INCLUDED);
            $criteria->addSelectColumn(BookingItemTableMap::COL_FOC);
            $criteria->addSelectColumn(BookingItemTableMap::COL_UPSELL);
            $criteria->addSelectColumn(BookingItemTableMap::COL_INVENTORY);
            $criteria->addSelectColumn(BookingItemTableMap::COL_UPGRADE);
        } else {
            $criteria->addSelectColumn($alias . '.booking_item_id');
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.item_id');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.included');
            $criteria->addSelectColumn($alias . '.foc');
            $criteria->addSelectColumn($alias . '.upsell');
            $criteria->addSelectColumn($alias . '.inventory');
            $criteria->addSelectColumn($alias . '.upgrade');
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
        return Propel::getServiceContainer()->getDatabaseMap(BookingItemTableMap::DATABASE_NAME)->getTable(BookingItemTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BookingItemTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BookingItemTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BookingItemTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BookingItem or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BookingItem object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\BookingItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BookingItemTableMap::DATABASE_NAME);
            $criteria->add(BookingItemTableMap::COL_BOOKING_ITEM_ID, (array) $values, Criteria::IN);
        }

        $query = BookingItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BookingItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BookingItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_booking_items table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BookingItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BookingItem or Criteria object.
     *
     * @param mixed               $criteria Criteria or BookingItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BookingItem object
        }

        if ($criteria->containsKey(BookingItemTableMap::COL_BOOKING_ITEM_ID) && $criteria->keyContainsValue(BookingItemTableMap::COL_BOOKING_ITEM_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BookingItemTableMap::COL_BOOKING_ITEM_ID.')');
        }


        // Set the correct dbName
        $query = BookingItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BookingItemTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BookingItemTableMap::buildTableMap();
