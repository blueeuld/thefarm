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
use TheFarm\Models\Bookings;
use TheFarm\Models\BookingsQuery;


/**
 * This class defines the structure of the 'tf_bookings' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BookingsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.BookingsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_bookings';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Bookings';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Bookings';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_bookings.booking_id';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'tf_bookings.title';

    /**
     * the column name for the package_id field
     */
    const COL_PACKAGE_ID = 'tf_bookings.package_id';

    /**
     * the column name for the start_date field
     */
    const COL_START_DATE = 'tf_bookings.start_date';

    /**
     * the column name for the end_date field
     */
    const COL_END_DATE = 'tf_bookings.end_date';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'tf_bookings.notes';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'tf_bookings.status';

    /**
     * the column name for the guest_id field
     */
    const COL_GUEST_ID = 'tf_bookings.guest_id';

    /**
     * the column name for the fax field
     */
    const COL_FAX = 'tf_bookings.fax';

    /**
     * the column name for the author_id field
     */
    const COL_AUTHOR_ID = 'tf_bookings.author_id';

    /**
     * the column name for the entry_date field
     */
    const COL_ENTRY_DATE = 'tf_bookings.entry_date';

    /**
     * the column name for the edit_date field
     */
    const COL_EDIT_DATE = 'tf_bookings.edit_date';

    /**
     * the column name for the personalized field
     */
    const COL_PERSONALIZED = 'tf_bookings.personalized';

    /**
     * the column name for the room_id field
     */
    const COL_ROOM_ID = 'tf_bookings.room_id';

    /**
     * the column name for the restrictions field
     */
    const COL_RESTRICTIONS = 'tf_bookings.restrictions';

    /**
     * the column name for the package_type_id field
     */
    const COL_PACKAGE_TYPE_ID = 'tf_bookings.package_type_id';

    /**
     * the column name for the is_active field
     */
    const COL_IS_ACTIVE = 'tf_bookings.is_active';

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
        self::TYPE_PHPNAME       => array('BookingId', 'Title', 'PackageId', 'StartDate', 'EndDate', 'Notes', 'Status', 'GuestId', 'Fax', 'AuthorId', 'EntryDate', 'EditDate', 'Personalized', 'RoomId', 'Restrictions', 'PackageTypeId', 'IsActive', ),
        self::TYPE_CAMELNAME     => array('bookingId', 'title', 'packageId', 'startDate', 'endDate', 'notes', 'status', 'guestId', 'fax', 'authorId', 'entryDate', 'editDate', 'personalized', 'roomId', 'restrictions', 'packageTypeId', 'isActive', ),
        self::TYPE_COLNAME       => array(BookingsTableMap::COL_BOOKING_ID, BookingsTableMap::COL_TITLE, BookingsTableMap::COL_PACKAGE_ID, BookingsTableMap::COL_START_DATE, BookingsTableMap::COL_END_DATE, BookingsTableMap::COL_NOTES, BookingsTableMap::COL_STATUS, BookingsTableMap::COL_GUEST_ID, BookingsTableMap::COL_FAX, BookingsTableMap::COL_AUTHOR_ID, BookingsTableMap::COL_ENTRY_DATE, BookingsTableMap::COL_EDIT_DATE, BookingsTableMap::COL_PERSONALIZED, BookingsTableMap::COL_ROOM_ID, BookingsTableMap::COL_RESTRICTIONS, BookingsTableMap::COL_PACKAGE_TYPE_ID, BookingsTableMap::COL_IS_ACTIVE, ),
        self::TYPE_FIELDNAME     => array('booking_id', 'title', 'package_id', 'start_date', 'end_date', 'notes', 'status', 'guest_id', 'fax', 'author_id', 'entry_date', 'edit_date', 'personalized', 'room_id', 'restrictions', 'package_type_id', 'is_active', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('BookingId' => 0, 'Title' => 1, 'PackageId' => 2, 'StartDate' => 3, 'EndDate' => 4, 'Notes' => 5, 'Status' => 6, 'GuestId' => 7, 'Fax' => 8, 'AuthorId' => 9, 'EntryDate' => 10, 'EditDate' => 11, 'Personalized' => 12, 'RoomId' => 13, 'Restrictions' => 14, 'PackageTypeId' => 15, 'IsActive' => 16, ),
        self::TYPE_CAMELNAME     => array('bookingId' => 0, 'title' => 1, 'packageId' => 2, 'startDate' => 3, 'endDate' => 4, 'notes' => 5, 'status' => 6, 'guestId' => 7, 'fax' => 8, 'authorId' => 9, 'entryDate' => 10, 'editDate' => 11, 'personalized' => 12, 'roomId' => 13, 'restrictions' => 14, 'packageTypeId' => 15, 'isActive' => 16, ),
        self::TYPE_COLNAME       => array(BookingsTableMap::COL_BOOKING_ID => 0, BookingsTableMap::COL_TITLE => 1, BookingsTableMap::COL_PACKAGE_ID => 2, BookingsTableMap::COL_START_DATE => 3, BookingsTableMap::COL_END_DATE => 4, BookingsTableMap::COL_NOTES => 5, BookingsTableMap::COL_STATUS => 6, BookingsTableMap::COL_GUEST_ID => 7, BookingsTableMap::COL_FAX => 8, BookingsTableMap::COL_AUTHOR_ID => 9, BookingsTableMap::COL_ENTRY_DATE => 10, BookingsTableMap::COL_EDIT_DATE => 11, BookingsTableMap::COL_PERSONALIZED => 12, BookingsTableMap::COL_ROOM_ID => 13, BookingsTableMap::COL_RESTRICTIONS => 14, BookingsTableMap::COL_PACKAGE_TYPE_ID => 15, BookingsTableMap::COL_IS_ACTIVE => 16, ),
        self::TYPE_FIELDNAME     => array('booking_id' => 0, 'title' => 1, 'package_id' => 2, 'start_date' => 3, 'end_date' => 4, 'notes' => 5, 'status' => 6, 'guest_id' => 7, 'fax' => 8, 'author_id' => 9, 'entry_date' => 10, 'edit_date' => 11, 'personalized' => 12, 'room_id' => 13, 'restrictions' => 14, 'package_type_id' => 15, 'is_active' => 16, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
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
        $this->setName('tf_bookings');
        $this->setPhpName('Bookings');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Bookings');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('booking_id', 'BookingId', 'INTEGER', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 200, null);
        $this->addForeignKey('package_id', 'PackageId', 'INTEGER', 'tf_packages', 'package_id', false, null, null);
        $this->addColumn('start_date', 'StartDate', 'INTEGER', true, null, null);
        $this->addColumn('end_date', 'EndDate', 'INTEGER', true, null, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', true, null, null);
        $this->addForeignKey('status', 'Status', 'VARCHAR', 'tf_event_status', 'status_cd', false, 16, null);
        $this->addForeignKey('guest_id', 'GuestId', 'INTEGER', 'tf_contacts', 'contact_id', false, null, null);
        $this->addColumn('fax', 'Fax', 'SMALLINT', false, 3, 0);
        $this->addForeignKey('author_id', 'AuthorId', 'INTEGER', 'tf_contacts', 'contact_id', false, 5, 1);
        $this->addColumn('entry_date', 'EntryDate', 'INTEGER', false, 10, 0);
        $this->addColumn('edit_date', 'EditDate', 'INTEGER', false, 10, 0);
        $this->addColumn('personalized', 'Personalized', 'SMALLINT', false, 1, 0);
        $this->addForeignKey('room_id', 'RoomId', 'INTEGER', 'tf_items', 'item_id', false, null, null);
        $this->addColumn('restrictions', 'Restrictions', 'LONGVARCHAR', true, null, null);
        $this->addColumn('package_type_id', 'PackageTypeId', 'INTEGER', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContactsRelatedByAuthorId', '\\TheFarm\\Models\\Contacts', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('ContactsRelatedByGuestId', '\\TheFarm\\Models\\Contacts', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':guest_id',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('Packages', '\\TheFarm\\Models\\Packages', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':package_id',
    1 => ':package_id',
  ),
), null, null, null, false);
        $this->addRelation('Items', '\\TheFarm\\Models\\Items', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':room_id',
    1 => ':item_id',
  ),
), null, null, null, false);
        $this->addRelation('EventStatus', '\\TheFarm\\Models\\EventStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':status',
    1 => ':status_cd',
  ),
), null, null, null, false);
        $this->addRelation('BookingAttachments', '\\TheFarm\\Models\\BookingAttachments', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':booking_id',
    1 => ':booking_id',
  ),
), null, null, 'BookingAttachmentss', false);
        $this->addRelation('BookingItems', '\\TheFarm\\Models\\BookingItems', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':booking_id',
    1 => ':booking_id',
  ),
), null, null, 'BookingItemss', false);
        $this->addRelation('FormEntries', '\\TheFarm\\Models\\FormEntries', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':booking_id',
    1 => ':booking_id',
  ),
), null, null, 'FormEntriess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('BookingId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BookingsTableMap::CLASS_DEFAULT : BookingsTableMap::OM_CLASS;
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
     * @return array           (Bookings object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BookingsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BookingsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BookingsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BookingsTableMap::OM_CLASS;
            /** @var Bookings $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BookingsTableMap::addInstanceToPool($obj, $key);
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
            $key = BookingsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BookingsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Bookings $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BookingsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BookingsTableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_TITLE);
            $criteria->addSelectColumn(BookingsTableMap::COL_PACKAGE_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_START_DATE);
            $criteria->addSelectColumn(BookingsTableMap::COL_END_DATE);
            $criteria->addSelectColumn(BookingsTableMap::COL_NOTES);
            $criteria->addSelectColumn(BookingsTableMap::COL_STATUS);
            $criteria->addSelectColumn(BookingsTableMap::COL_GUEST_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_FAX);
            $criteria->addSelectColumn(BookingsTableMap::COL_AUTHOR_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_ENTRY_DATE);
            $criteria->addSelectColumn(BookingsTableMap::COL_EDIT_DATE);
            $criteria->addSelectColumn(BookingsTableMap::COL_PERSONALIZED);
            $criteria->addSelectColumn(BookingsTableMap::COL_ROOM_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_RESTRICTIONS);
            $criteria->addSelectColumn(BookingsTableMap::COL_PACKAGE_TYPE_ID);
            $criteria->addSelectColumn(BookingsTableMap::COL_IS_ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.package_id');
            $criteria->addSelectColumn($alias . '.start_date');
            $criteria->addSelectColumn($alias . '.end_date');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.guest_id');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.author_id');
            $criteria->addSelectColumn($alias . '.entry_date');
            $criteria->addSelectColumn($alias . '.edit_date');
            $criteria->addSelectColumn($alias . '.personalized');
            $criteria->addSelectColumn($alias . '.room_id');
            $criteria->addSelectColumn($alias . '.restrictions');
            $criteria->addSelectColumn($alias . '.package_type_id');
            $criteria->addSelectColumn($alias . '.is_active');
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
        return Propel::getServiceContainer()->getDatabaseMap(BookingsTableMap::DATABASE_NAME)->getTable(BookingsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BookingsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BookingsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BookingsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Bookings or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Bookings object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Bookings) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BookingsTableMap::DATABASE_NAME);
            $criteria->add(BookingsTableMap::COL_BOOKING_ID, (array) $values, Criteria::IN);
        }

        $query = BookingsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BookingsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BookingsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_bookings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BookingsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Bookings or Criteria object.
     *
     * @param mixed               $criteria Criteria or Bookings object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Bookings object
        }

        if ($criteria->containsKey(BookingsTableMap::COL_BOOKING_ID) && $criteria->keyContainsValue(BookingsTableMap::COL_BOOKING_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BookingsTableMap::COL_BOOKING_ID.')');
        }


        // Set the correct dbName
        $query = BookingsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BookingsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BookingsTableMap::buildTableMap();
