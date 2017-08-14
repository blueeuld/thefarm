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
use TheFarm\Models\Item;
use TheFarm\Models\ItemQuery;


/**
 * This class defines the structure of the 'tf_items' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.ItemTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_items';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Item';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Item';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the item_id field
     */
    const COL_ITEM_ID = 'tf_items.item_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'tf_items.title';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'tf_items.description';

    /**
     * the column name for the duration field
     */
    const COL_DURATION = 'tf_items.duration';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'tf_items.amount';

    /**
     * the column name for the uom field
     */
    const COL_UOM = 'tf_items.uom';

    /**
     * the column name for the abbr field
     */
    const COL_ABBR = 'tf_items.abbr';

    /**
     * the column name for the max_provider field
     */
    const COL_MAX_PROVIDER = 'tf_items.max_provider';

    /**
     * the column name for the for_sale field
     */
    const COL_FOR_SALE = 'tf_items.for_sale';

    /**
     * the column name for the item_image field
     */
    const COL_ITEM_IMAGE = 'tf_items.item_image';

    /**
     * the column name for the bookable field
     */
    const COL_BOOKABLE = 'tf_items.bookable';

    /**
     * the column name for the time_settings field
     */
    const COL_TIME_SETTINGS = 'tf_items.time_settings';

    /**
     * the column name for the is_active field
     */
    const COL_IS_ACTIVE = 'tf_items.is_active';

    /**
     * the column name for the item_icon field
     */
    const COL_ITEM_ICON = 'tf_items.item_icon';

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
        self::TYPE_PHPNAME       => array('ItemId', 'Title', 'Description', 'Duration', 'Amount', 'Uom', 'Abbr', 'MaxProvider', 'ForSale', 'ItemImage', 'Bookable', 'TimeSettings', 'IsActive', 'ItemIcon', ),
        self::TYPE_CAMELNAME     => array('itemId', 'title', 'description', 'duration', 'amount', 'uom', 'abbr', 'maxProvider', 'forSale', 'itemImage', 'bookable', 'timeSettings', 'isActive', 'itemIcon', ),
        self::TYPE_COLNAME       => array(ItemTableMap::COL_ITEM_ID, ItemTableMap::COL_TITLE, ItemTableMap::COL_DESCRIPTION, ItemTableMap::COL_DURATION, ItemTableMap::COL_AMOUNT, ItemTableMap::COL_UOM, ItemTableMap::COL_ABBR, ItemTableMap::COL_MAX_PROVIDER, ItemTableMap::COL_FOR_SALE, ItemTableMap::COL_ITEM_IMAGE, ItemTableMap::COL_BOOKABLE, ItemTableMap::COL_TIME_SETTINGS, ItemTableMap::COL_IS_ACTIVE, ItemTableMap::COL_ITEM_ICON, ),
        self::TYPE_FIELDNAME     => array('item_id', 'title', 'description', 'duration', 'amount', 'uom', 'abbr', 'max_provider', 'for_sale', 'item_image', 'bookable', 'time_settings', 'is_active', 'item_icon', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ItemId' => 0, 'Title' => 1, 'Description' => 2, 'Duration' => 3, 'Amount' => 4, 'Uom' => 5, 'Abbr' => 6, 'MaxProvider' => 7, 'ForSale' => 8, 'ItemImage' => 9, 'Bookable' => 10, 'TimeSettings' => 11, 'IsActive' => 12, 'ItemIcon' => 13, ),
        self::TYPE_CAMELNAME     => array('itemId' => 0, 'title' => 1, 'description' => 2, 'duration' => 3, 'amount' => 4, 'uom' => 5, 'abbr' => 6, 'maxProvider' => 7, 'forSale' => 8, 'itemImage' => 9, 'bookable' => 10, 'timeSettings' => 11, 'isActive' => 12, 'itemIcon' => 13, ),
        self::TYPE_COLNAME       => array(ItemTableMap::COL_ITEM_ID => 0, ItemTableMap::COL_TITLE => 1, ItemTableMap::COL_DESCRIPTION => 2, ItemTableMap::COL_DURATION => 3, ItemTableMap::COL_AMOUNT => 4, ItemTableMap::COL_UOM => 5, ItemTableMap::COL_ABBR => 6, ItemTableMap::COL_MAX_PROVIDER => 7, ItemTableMap::COL_FOR_SALE => 8, ItemTableMap::COL_ITEM_IMAGE => 9, ItemTableMap::COL_BOOKABLE => 10, ItemTableMap::COL_TIME_SETTINGS => 11, ItemTableMap::COL_IS_ACTIVE => 12, ItemTableMap::COL_ITEM_ICON => 13, ),
        self::TYPE_FIELDNAME     => array('item_id' => 0, 'title' => 1, 'description' => 2, 'duration' => 3, 'amount' => 4, 'uom' => 5, 'abbr' => 6, 'max_provider' => 7, 'for_sale' => 8, 'item_image' => 9, 'bookable' => 10, 'time_settings' => 11, 'is_active' => 12, 'item_icon' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
        $this->setName('tf_items');
        $this->setPhpName('Item');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Item');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('item_id', 'ItemId', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('duration', 'Duration', 'INTEGER', true, 5, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, 5, null);
        $this->addColumn('uom', 'Uom', 'VARCHAR', true, 10, null);
        $this->addColumn('abbr', 'Abbr', 'VARCHAR', false, 16, null);
        $this->addColumn('max_provider', 'MaxProvider', 'INTEGER', false, 3, 1);
        $this->addColumn('for_sale', 'ForSale', 'VARCHAR', true, 1, 'y');
        $this->addForeignKey('item_image', 'ItemImage', 'INTEGER', 'tf_files', 'file_id', false, null, null);
        $this->addColumn('bookable', 'Bookable', 'VARCHAR', true, 1, 'y');
        $this->addColumn('time_settings', 'TimeSettings', 'VARCHAR', true, 100, null);
        $this->addColumn('is_active', 'IsActive', 'INTEGER', true, 1, 1);
        $this->addColumn('item_icon', 'ItemIcon', 'VARCHAR', false, 50, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Files', '\\TheFarm\\Models\\Files', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':item_image',
    1 => ':file_id',
  ),
), null, null, null, false);
        $this->addRelation('BookingEvent', '\\TheFarm\\Models\\BookingEvent', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, 'BookingEvents', false);
        $this->addRelation('BookingItem', '\\TheFarm\\Models\\BookingItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, 'BookingItems', false);
        $this->addRelation('Booking', '\\TheFarm\\Models\\Booking', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':room_id',
    1 => ':item_id',
  ),
), null, null, 'Bookings', false);
        $this->addRelation('ItemCategory', '\\TheFarm\\Models\\ItemCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, 'ItemCategories', false);
        $this->addRelation('ItemsRelatedUser', '\\TheFarm\\Models\\ItemsRelatedUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, 'ItemsRelatedUsers', false);
        $this->addRelation('PackageItem', '\\TheFarm\\Models\\PackageItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':item_id',
    1 => ':item_id',
  ),
), null, null, 'PackageItems', false);
        $this->addRelation('Contact', '\\TheFarm\\Models\\Contact', RelationMap::MANY_TO_MANY, array(), null, null, 'Contacts');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ItemId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ItemTableMap::CLASS_DEFAULT : ItemTableMap::OM_CLASS;
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
     * @return array           (Item object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ItemTableMap::OM_CLASS;
            /** @var Item $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ItemTableMap::addInstanceToPool($obj, $key);
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
            $key = ItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Item $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ItemTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ItemTableMap::COL_ITEM_ID);
            $criteria->addSelectColumn(ItemTableMap::COL_TITLE);
            $criteria->addSelectColumn(ItemTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ItemTableMap::COL_DURATION);
            $criteria->addSelectColumn(ItemTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ItemTableMap::COL_UOM);
            $criteria->addSelectColumn(ItemTableMap::COL_ABBR);
            $criteria->addSelectColumn(ItemTableMap::COL_MAX_PROVIDER);
            $criteria->addSelectColumn(ItemTableMap::COL_FOR_SALE);
            $criteria->addSelectColumn(ItemTableMap::COL_ITEM_IMAGE);
            $criteria->addSelectColumn(ItemTableMap::COL_BOOKABLE);
            $criteria->addSelectColumn(ItemTableMap::COL_TIME_SETTINGS);
            $criteria->addSelectColumn(ItemTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(ItemTableMap::COL_ITEM_ICON);
        } else {
            $criteria->addSelectColumn($alias . '.item_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.duration');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.uom');
            $criteria->addSelectColumn($alias . '.abbr');
            $criteria->addSelectColumn($alias . '.max_provider');
            $criteria->addSelectColumn($alias . '.for_sale');
            $criteria->addSelectColumn($alias . '.item_image');
            $criteria->addSelectColumn($alias . '.bookable');
            $criteria->addSelectColumn($alias . '.time_settings');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.item_icon');
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
        return Propel::getServiceContainer()->getDatabaseMap(ItemTableMap::DATABASE_NAME)->getTable(ItemTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ItemTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ItemTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ItemTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Item or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Item object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Item) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ItemTableMap::DATABASE_NAME);
            $criteria->add(ItemTableMap::COL_ITEM_ID, (array) $values, Criteria::IN);
        }

        $query = ItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_items table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Item or Criteria object.
     *
     * @param mixed               $criteria Criteria or Item object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Item object
        }

        if ($criteria->containsKey(ItemTableMap::COL_ITEM_ID) && $criteria->keyContainsValue(ItemTableMap::COL_ITEM_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ItemTableMap::COL_ITEM_ID.')');
        }


        // Set the correct dbName
        $query = ItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ItemTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ItemTableMap::buildTableMap();
