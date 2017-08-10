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
use TheFarm\Models\BookingEvent;
use TheFarm\Models\BookingEventQuery;


/**
 * This class defines the structure of the 'tf_booking_events' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BookingEventTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.BookingEventTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_booking_events';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\BookingEvent';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.BookingEvent';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 31;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 31;

    /**
     * the column name for the event_id field
     */
    const COL_EVENT_ID = 'tf_booking_events.event_id';

    /**
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_booking_events.booking_id';

    /**
     * the column name for the event_title field
     */
    const COL_EVENT_TITLE = 'tf_booking_events.event_title';

    /**
     * the column name for the start_dt field
     */
    const COL_START_DT = 'tf_booking_events.start_dt';

    /**
     * the column name for the end_dt field
     */
    const COL_END_DT = 'tf_booking_events.end_dt';

    /**
     * the column name for the facility_id field
     */
    const COL_FACILITY_ID = 'tf_booking_events.facility_id';

    /**
     * the column name for the all_day field
     */
    const COL_ALL_DAY = 'tf_booking_events.all_day';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'tf_booking_events.status';

    /**
     * the column name for the author_id field
     */
    const COL_AUTHOR_ID = 'tf_booking_events.author_id';

    /**
     * the column name for the entry_date field
     */
    const COL_ENTRY_DATE = 'tf_booking_events.entry_date';

    /**
     * the column name for the edit_date field
     */
    const COL_EDIT_DATE = 'tf_booking_events.edit_date';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'tf_booking_events.notes';

    /**
     * the column name for the called_by field
     */
    const COL_CALLED_BY = 'tf_booking_events.called_by';

    /**
     * the column name for the cancelled_by field
     */
    const COL_CANCELLED_BY = 'tf_booking_events.cancelled_by';

    /**
     * the column name for the cancelled_reason field
     */
    const COL_CANCELLED_REASON = 'tf_booking_events.cancelled_reason';

    /**
     * the column name for the date_cancelled field
     */
    const COL_DATE_CANCELLED = 'tf_booking_events.date_cancelled';

    /**
     * the column name for the personalized field
     */
    const COL_PERSONALIZED = 'tf_booking_events.personalized';

    /**
     * the column name for the is_active field
     */
    const COL_IS_ACTIVE = 'tf_booking_events.is_active';

    /**
     * the column name for the deleted_date field
     */
    const COL_DELETED_DATE = 'tf_booking_events.deleted_date';

    /**
     * the column name for the deleted_by field
     */
    const COL_DELETED_BY = 'tf_booking_events.deleted_by';

    /**
     * the column name for the item_id field
     */
    const COL_ITEM_ID = 'tf_booking_events.item_id';

    /**
     * the column name for the is_kids field
     */
    const COL_IS_KIDS = 'tf_booking_events.is_kids';

    /**
     * the column name for the incl_os_done_number field
     */
    const COL_INCL_OS_DONE_NUMBER = 'tf_booking_events.incl_os_done_number';

    /**
     * the column name for the incl_os_done_amount field
     */
    const COL_INCL_OS_DONE_AMOUNT = 'tf_booking_events.incl_os_done_amount';

    /**
     * the column name for the foc_os_done_number field
     */
    const COL_FOC_OS_DONE_NUMBER = 'tf_booking_events.foc_os_done_number';

    /**
     * the column name for the foc_os_done_amount field
     */
    const COL_FOC_OS_DONE_AMOUNT = 'tf_booking_events.foc_os_done_amount';

    /**
     * the column name for the not_incl_os_done_number field
     */
    const COL_NOT_INCL_OS_DONE_NUMBER = 'tf_booking_events.not_incl_os_done_number';

    /**
     * the column name for the not_incl_os_done_amount field
     */
    const COL_NOT_INCL_OS_DONE_AMOUNT = 'tf_booking_events.not_incl_os_done_amount';

    /**
     * the column name for the incl field
     */
    const COL_INCL = 'tf_booking_events.incl';

    /**
     * the column name for the not_incl field
     */
    const COL_NOT_INCL = 'tf_booking_events.not_incl';

    /**
     * the column name for the foc field
     */
    const COL_FOC = 'tf_booking_events.foc';

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
        self::TYPE_PHPNAME       => array('EventId', 'BookingId', 'EventTitle', 'StartDate', 'EndDate', 'FacilityId', 'AllDay', 'Status', 'AuthorId', 'EntryDate', 'EditDate', 'Notes', 'CalledBy', 'CancelledBy', 'CancelledReason', 'DateCancelled', 'Personalized', 'IsActive', 'DeletedDate', 'DeletedBy', 'ItemId', 'IsKids', 'InclOsDoneNumber', 'InclOsDoneAmount', 'FocOsDoneNumber', 'FocOsDoneAmount', 'NotInclOsDoneNumber', 'NotInclOsDoneAmount', 'Incl', 'NotIncl', 'Foc', ),
        self::TYPE_CAMELNAME     => array('eventId', 'bookingId', 'eventTitle', 'startDate', 'endDate', 'facilityId', 'allDay', 'status', 'authorId', 'entryDate', 'editDate', 'notes', 'calledBy', 'cancelledBy', 'cancelledReason', 'dateCancelled', 'personalized', 'isActive', 'deletedDate', 'deletedBy', 'itemId', 'isKids', 'inclOsDoneNumber', 'inclOsDoneAmount', 'focOsDoneNumber', 'focOsDoneAmount', 'notInclOsDoneNumber', 'notInclOsDoneAmount', 'incl', 'notIncl', 'foc', ),
        self::TYPE_COLNAME       => array(BookingEventTableMap::COL_EVENT_ID, BookingEventTableMap::COL_BOOKING_ID, BookingEventTableMap::COL_EVENT_TITLE, BookingEventTableMap::COL_START_DT, BookingEventTableMap::COL_END_DT, BookingEventTableMap::COL_FACILITY_ID, BookingEventTableMap::COL_ALL_DAY, BookingEventTableMap::COL_STATUS, BookingEventTableMap::COL_AUTHOR_ID, BookingEventTableMap::COL_ENTRY_DATE, BookingEventTableMap::COL_EDIT_DATE, BookingEventTableMap::COL_NOTES, BookingEventTableMap::COL_CALLED_BY, BookingEventTableMap::COL_CANCELLED_BY, BookingEventTableMap::COL_CANCELLED_REASON, BookingEventTableMap::COL_DATE_CANCELLED, BookingEventTableMap::COL_PERSONALIZED, BookingEventTableMap::COL_IS_ACTIVE, BookingEventTableMap::COL_DELETED_DATE, BookingEventTableMap::COL_DELETED_BY, BookingEventTableMap::COL_ITEM_ID, BookingEventTableMap::COL_IS_KIDS, BookingEventTableMap::COL_INCL_OS_DONE_NUMBER, BookingEventTableMap::COL_INCL_OS_DONE_AMOUNT, BookingEventTableMap::COL_FOC_OS_DONE_NUMBER, BookingEventTableMap::COL_FOC_OS_DONE_AMOUNT, BookingEventTableMap::COL_NOT_INCL_OS_DONE_NUMBER, BookingEventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, BookingEventTableMap::COL_INCL, BookingEventTableMap::COL_NOT_INCL, BookingEventTableMap::COL_FOC, ),
        self::TYPE_FIELDNAME     => array('event_id', 'booking_id', 'event_title', 'start_dt', 'end_dt', 'facility_id', 'all_day', 'status', 'author_id', 'entry_date', 'edit_date', 'notes', 'called_by', 'cancelled_by', 'cancelled_reason', 'date_cancelled', 'personalized', 'is_active', 'deleted_date', 'deleted_by', 'item_id', 'is_kids', 'incl_os_done_number', 'incl_os_done_amount', 'foc_os_done_number', 'foc_os_done_amount', 'not_incl_os_done_number', 'not_incl_os_done_amount', 'incl', 'not_incl', 'foc', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EventId' => 0, 'BookingId' => 1, 'EventTitle' => 2, 'StartDate' => 3, 'EndDate' => 4, 'FacilityId' => 5, 'AllDay' => 6, 'Status' => 7, 'AuthorId' => 8, 'EntryDate' => 9, 'EditDate' => 10, 'Notes' => 11, 'CalledBy' => 12, 'CancelledBy' => 13, 'CancelledReason' => 14, 'DateCancelled' => 15, 'Personalized' => 16, 'IsActive' => 17, 'DeletedDate' => 18, 'DeletedBy' => 19, 'ItemId' => 20, 'IsKids' => 21, 'InclOsDoneNumber' => 22, 'InclOsDoneAmount' => 23, 'FocOsDoneNumber' => 24, 'FocOsDoneAmount' => 25, 'NotInclOsDoneNumber' => 26, 'NotInclOsDoneAmount' => 27, 'Incl' => 28, 'NotIncl' => 29, 'Foc' => 30, ),
        self::TYPE_CAMELNAME     => array('eventId' => 0, 'bookingId' => 1, 'eventTitle' => 2, 'startDate' => 3, 'endDate' => 4, 'facilityId' => 5, 'allDay' => 6, 'status' => 7, 'authorId' => 8, 'entryDate' => 9, 'editDate' => 10, 'notes' => 11, 'calledBy' => 12, 'cancelledBy' => 13, 'cancelledReason' => 14, 'dateCancelled' => 15, 'personalized' => 16, 'isActive' => 17, 'deletedDate' => 18, 'deletedBy' => 19, 'itemId' => 20, 'isKids' => 21, 'inclOsDoneNumber' => 22, 'inclOsDoneAmount' => 23, 'focOsDoneNumber' => 24, 'focOsDoneAmount' => 25, 'notInclOsDoneNumber' => 26, 'notInclOsDoneAmount' => 27, 'incl' => 28, 'notIncl' => 29, 'foc' => 30, ),
        self::TYPE_COLNAME       => array(BookingEventTableMap::COL_EVENT_ID => 0, BookingEventTableMap::COL_BOOKING_ID => 1, BookingEventTableMap::COL_EVENT_TITLE => 2, BookingEventTableMap::COL_START_DT => 3, BookingEventTableMap::COL_END_DT => 4, BookingEventTableMap::COL_FACILITY_ID => 5, BookingEventTableMap::COL_ALL_DAY => 6, BookingEventTableMap::COL_STATUS => 7, BookingEventTableMap::COL_AUTHOR_ID => 8, BookingEventTableMap::COL_ENTRY_DATE => 9, BookingEventTableMap::COL_EDIT_DATE => 10, BookingEventTableMap::COL_NOTES => 11, BookingEventTableMap::COL_CALLED_BY => 12, BookingEventTableMap::COL_CANCELLED_BY => 13, BookingEventTableMap::COL_CANCELLED_REASON => 14, BookingEventTableMap::COL_DATE_CANCELLED => 15, BookingEventTableMap::COL_PERSONALIZED => 16, BookingEventTableMap::COL_IS_ACTIVE => 17, BookingEventTableMap::COL_DELETED_DATE => 18, BookingEventTableMap::COL_DELETED_BY => 19, BookingEventTableMap::COL_ITEM_ID => 20, BookingEventTableMap::COL_IS_KIDS => 21, BookingEventTableMap::COL_INCL_OS_DONE_NUMBER => 22, BookingEventTableMap::COL_INCL_OS_DONE_AMOUNT => 23, BookingEventTableMap::COL_FOC_OS_DONE_NUMBER => 24, BookingEventTableMap::COL_FOC_OS_DONE_AMOUNT => 25, BookingEventTableMap::COL_NOT_INCL_OS_DONE_NUMBER => 26, BookingEventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT => 27, BookingEventTableMap::COL_INCL => 28, BookingEventTableMap::COL_NOT_INCL => 29, BookingEventTableMap::COL_FOC => 30, ),
        self::TYPE_FIELDNAME     => array('event_id' => 0, 'booking_id' => 1, 'event_title' => 2, 'start_dt' => 3, 'end_dt' => 4, 'facility_id' => 5, 'all_day' => 6, 'status' => 7, 'author_id' => 8, 'entry_date' => 9, 'edit_date' => 10, 'notes' => 11, 'called_by' => 12, 'cancelled_by' => 13, 'cancelled_reason' => 14, 'date_cancelled' => 15, 'personalized' => 16, 'is_active' => 17, 'deleted_date' => 18, 'deleted_by' => 19, 'item_id' => 20, 'is_kids' => 21, 'incl_os_done_number' => 22, 'incl_os_done_amount' => 23, 'foc_os_done_number' => 24, 'foc_os_done_amount' => 25, 'not_incl_os_done_number' => 26, 'not_incl_os_done_amount' => 27, 'incl' => 28, 'not_incl' => 29, 'foc' => 30, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, )
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
        $this->setName('tf_booking_events');
        $this->setPhpName('BookingEvent');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\BookingEvent');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('event_id', 'EventId', 'INTEGER', true, null, null);
        $this->addForeignKey('booking_id', 'BookingId', 'INTEGER', 'tf_bookings', 'booking_id', false, null, null);
        $this->addColumn('event_title', 'EventTitle', 'VARCHAR', true, 100, null);
        $this->addColumn('start_dt', 'StartDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('end_dt', 'EndDate', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('facility_id', 'FacilityId', 'INTEGER', 'tf_facilities', 'facility_id', false, null, null);
        $this->addColumn('all_day', 'AllDay', 'INTEGER', true, 1, null);
        $this->addForeignKey('status', 'Status', 'VARCHAR', 'tf_event_status', 'status_cd', false, 16, null);
        $this->addForeignKey('author_id', 'AuthorId', 'INTEGER', 'tf_contacts', 'contact_id', false, null, null);
        $this->addColumn('entry_date', 'EntryDate', 'INTEGER', false, 10, 0);
        $this->addColumn('edit_date', 'EditDate', 'INTEGER', false, 10, 0);
        $this->addColumn('notes', 'Notes', 'VARCHAR', false, 255, '');
        $this->addForeignKey('called_by', 'CalledBy', 'INTEGER', 'tf_contacts', 'contact_id', false, null, null);
        $this->addForeignKey('cancelled_by', 'CancelledBy', 'INTEGER', 'tf_contacts', 'contact_id', false, null, null);
        $this->addColumn('cancelled_reason', 'CancelledReason', 'VARCHAR', false, 50, '');
        $this->addColumn('date_cancelled', 'DateCancelled', 'INTEGER', false, 10, 0);
        $this->addColumn('personalized', 'Personalized', 'VARCHAR', false, 100, '');
        $this->addColumn('is_active', 'IsActive', 'VARCHAR', false, 1, 'n');
        $this->addColumn('deleted_date', 'DeletedDate', 'INTEGER', false, 10, 0);
        $this->addForeignKey('deleted_by', 'DeletedBy', 'INTEGER', 'tf_contacts', 'contact_id', false, null, null);
        $this->addForeignKey('item_id', 'ItemId', 'INTEGER', 'tf_items', 'item_id', false, null, null);
        $this->addColumn('is_kids', 'IsKids', 'BOOLEAN', false, 1, false);
        $this->addColumn('incl_os_done_number', 'InclOsDoneNumber', 'VARCHAR', false, 20, null);
        $this->addColumn('incl_os_done_amount', 'InclOsDoneAmount', 'DECIMAL', true, 10, 0);
        $this->addColumn('foc_os_done_number', 'FocOsDoneNumber', 'VARCHAR', false, 20, null);
        $this->addColumn('foc_os_done_amount', 'FocOsDoneAmount', 'DECIMAL', true, 10, 0);
        $this->addColumn('not_incl_os_done_number', 'NotInclOsDoneNumber', 'VARCHAR', false, 20, null);
        $this->addColumn('not_incl_os_done_amount', 'NotInclOsDoneAmount', 'DECIMAL', true, 10, 0);
        $this->addColumn('incl', 'Incl', 'INTEGER', true, 1, null);
        $this->addColumn('not_incl', 'NotIncl', 'INTEGER', true, 1, null);
        $this->addColumn('foc', 'Foc', 'INTEGER', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContactRelatedByAuthorId', '\\TheFarm\\Models\\Contact', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':author_id',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('Booking', '\\TheFarm\\Models\\Booking', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':booking_id',
    1 => ':booking_id',
  ),
), null, null, null, false);
        $this->addRelation('ContactRelatedByCalledBy', '\\TheFarm\\Models\\Contact', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':called_by',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('ContactRelatedByCancelledBy', '\\TheFarm\\Models\\Contact', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cancelled_by',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('ContactRelatedByDeletedBy', '\\TheFarm\\Models\\Contact', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':deleted_by',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('Facility', '\\TheFarm\\Models\\Facility', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':facility_id',
    1 => ':facility_id',
  ),
), null, null, null, false);
        $this->addRelation('Item', '\\TheFarm\\Models\\Item', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':item_id',
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
        $this->addRelation('EventUser', '\\TheFarm\\Models\\EventUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':event_id',
    1 => ':event_id',
  ),
), null, null, 'EventUsers', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EventId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BookingEventTableMap::CLASS_DEFAULT : BookingEventTableMap::OM_CLASS;
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
     * @return array           (BookingEvent object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BookingEventTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BookingEventTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BookingEventTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BookingEventTableMap::OM_CLASS;
            /** @var BookingEvent $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BookingEventTableMap::addInstanceToPool($obj, $key);
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
            $key = BookingEventTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BookingEventTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BookingEvent $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BookingEventTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BookingEventTableMap::COL_EVENT_ID);
            $criteria->addSelectColumn(BookingEventTableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(BookingEventTableMap::COL_EVENT_TITLE);
            $criteria->addSelectColumn(BookingEventTableMap::COL_START_DT);
            $criteria->addSelectColumn(BookingEventTableMap::COL_END_DT);
            $criteria->addSelectColumn(BookingEventTableMap::COL_FACILITY_ID);
            $criteria->addSelectColumn(BookingEventTableMap::COL_ALL_DAY);
            $criteria->addSelectColumn(BookingEventTableMap::COL_STATUS);
            $criteria->addSelectColumn(BookingEventTableMap::COL_AUTHOR_ID);
            $criteria->addSelectColumn(BookingEventTableMap::COL_ENTRY_DATE);
            $criteria->addSelectColumn(BookingEventTableMap::COL_EDIT_DATE);
            $criteria->addSelectColumn(BookingEventTableMap::COL_NOTES);
            $criteria->addSelectColumn(BookingEventTableMap::COL_CALLED_BY);
            $criteria->addSelectColumn(BookingEventTableMap::COL_CANCELLED_BY);
            $criteria->addSelectColumn(BookingEventTableMap::COL_CANCELLED_REASON);
            $criteria->addSelectColumn(BookingEventTableMap::COL_DATE_CANCELLED);
            $criteria->addSelectColumn(BookingEventTableMap::COL_PERSONALIZED);
            $criteria->addSelectColumn(BookingEventTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(BookingEventTableMap::COL_DELETED_DATE);
            $criteria->addSelectColumn(BookingEventTableMap::COL_DELETED_BY);
            $criteria->addSelectColumn(BookingEventTableMap::COL_ITEM_ID);
            $criteria->addSelectColumn(BookingEventTableMap::COL_IS_KIDS);
            $criteria->addSelectColumn(BookingEventTableMap::COL_INCL_OS_DONE_NUMBER);
            $criteria->addSelectColumn(BookingEventTableMap::COL_INCL_OS_DONE_AMOUNT);
            $criteria->addSelectColumn(BookingEventTableMap::COL_FOC_OS_DONE_NUMBER);
            $criteria->addSelectColumn(BookingEventTableMap::COL_FOC_OS_DONE_AMOUNT);
            $criteria->addSelectColumn(BookingEventTableMap::COL_NOT_INCL_OS_DONE_NUMBER);
            $criteria->addSelectColumn(BookingEventTableMap::COL_NOT_INCL_OS_DONE_AMOUNT);
            $criteria->addSelectColumn(BookingEventTableMap::COL_INCL);
            $criteria->addSelectColumn(BookingEventTableMap::COL_NOT_INCL);
            $criteria->addSelectColumn(BookingEventTableMap::COL_FOC);
        } else {
            $criteria->addSelectColumn($alias . '.event_id');
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.event_title');
            $criteria->addSelectColumn($alias . '.start_dt');
            $criteria->addSelectColumn($alias . '.end_dt');
            $criteria->addSelectColumn($alias . '.facility_id');
            $criteria->addSelectColumn($alias . '.all_day');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.author_id');
            $criteria->addSelectColumn($alias . '.entry_date');
            $criteria->addSelectColumn($alias . '.edit_date');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.called_by');
            $criteria->addSelectColumn($alias . '.cancelled_by');
            $criteria->addSelectColumn($alias . '.cancelled_reason');
            $criteria->addSelectColumn($alias . '.date_cancelled');
            $criteria->addSelectColumn($alias . '.personalized');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.deleted_date');
            $criteria->addSelectColumn($alias . '.deleted_by');
            $criteria->addSelectColumn($alias . '.item_id');
            $criteria->addSelectColumn($alias . '.is_kids');
            $criteria->addSelectColumn($alias . '.incl_os_done_number');
            $criteria->addSelectColumn($alias . '.incl_os_done_amount');
            $criteria->addSelectColumn($alias . '.foc_os_done_number');
            $criteria->addSelectColumn($alias . '.foc_os_done_amount');
            $criteria->addSelectColumn($alias . '.not_incl_os_done_number');
            $criteria->addSelectColumn($alias . '.not_incl_os_done_amount');
            $criteria->addSelectColumn($alias . '.incl');
            $criteria->addSelectColumn($alias . '.not_incl');
            $criteria->addSelectColumn($alias . '.foc');
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
        return Propel::getServiceContainer()->getDatabaseMap(BookingEventTableMap::DATABASE_NAME)->getTable(BookingEventTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BookingEventTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BookingEventTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BookingEventTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a BookingEvent or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BookingEvent object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\BookingEvent) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BookingEventTableMap::DATABASE_NAME);
            $criteria->add(BookingEventTableMap::COL_EVENT_ID, (array) $values, Criteria::IN);
        }

        $query = BookingEventQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BookingEventTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BookingEventTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_booking_events table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BookingEventQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BookingEvent or Criteria object.
     *
     * @param mixed               $criteria Criteria or BookingEvent object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BookingEvent object
        }

        if ($criteria->containsKey(BookingEventTableMap::COL_EVENT_ID) && $criteria->keyContainsValue(BookingEventTableMap::COL_EVENT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BookingEventTableMap::COL_EVENT_ID.')');
        }


        // Set the correct dbName
        $query = BookingEventQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BookingEventTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BookingEventTableMap::buildTableMap();
