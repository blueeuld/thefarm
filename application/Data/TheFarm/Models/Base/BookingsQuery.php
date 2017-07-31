<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\Bookings as ChildBookings;
use TheFarm\Models\BookingsQuery as ChildBookingsQuery;
use TheFarm\Models\Map\BookingsTableMap;

/**
 * Base class that represents a query for the 'tf_bookings' table.
 *
 *
 *
 * @method     ChildBookingsQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildBookingsQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ChildBookingsQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildBookingsQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildBookingsQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildBookingsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBookingsQuery orderByGuestId($order = Criteria::ASC) Order by the guest_id column
 * @method     ChildBookingsQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ChildBookingsQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildBookingsQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildBookingsQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildBookingsQuery orderByPersonalized($order = Criteria::ASC) Order by the personalized column
 * @method     ChildBookingsQuery orderByRoomId($order = Criteria::ASC) Order by the room_id column
 * @method     ChildBookingsQuery orderByRestrictions($order = Criteria::ASC) Order by the restrictions column
 * @method     ChildBookingsQuery orderByPackageTypeId($order = Criteria::ASC) Order by the package_type_id column
 * @method     ChildBookingsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method     ChildBookingsQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingsQuery groupByTitle() Group by the title column
 * @method     ChildBookingsQuery groupByPackageId() Group by the package_id column
 * @method     ChildBookingsQuery groupByStartDate() Group by the start_date column
 * @method     ChildBookingsQuery groupByEndDate() Group by the end_date column
 * @method     ChildBookingsQuery groupByNotes() Group by the notes column
 * @method     ChildBookingsQuery groupByStatus() Group by the status column
 * @method     ChildBookingsQuery groupByGuestId() Group by the guest_id column
 * @method     ChildBookingsQuery groupByFax() Group by the fax column
 * @method     ChildBookingsQuery groupByAuthorId() Group by the author_id column
 * @method     ChildBookingsQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildBookingsQuery groupByEditDate() Group by the edit_date column
 * @method     ChildBookingsQuery groupByPersonalized() Group by the personalized column
 * @method     ChildBookingsQuery groupByRoomId() Group by the room_id column
 * @method     ChildBookingsQuery groupByRestrictions() Group by the restrictions column
 * @method     ChildBookingsQuery groupByPackageTypeId() Group by the package_type_id column
 * @method     ChildBookingsQuery groupByIsActive() Group by the is_active column
 *
 * @method     ChildBookingsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingsQuery leftJoinContactsRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactsRelatedByAuthorId relation
 * @method     ChildBookingsQuery rightJoinContactsRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactsRelatedByAuthorId relation
 * @method     ChildBookingsQuery innerJoinContactsRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactsRelatedByAuthorId relation
 *
 * @method     ChildBookingsQuery joinWithContactsRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactsRelatedByAuthorId relation
 *
 * @method     ChildBookingsQuery leftJoinWithContactsRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the ContactsRelatedByAuthorId relation
 * @method     ChildBookingsQuery rightJoinWithContactsRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the ContactsRelatedByAuthorId relation
 * @method     ChildBookingsQuery innerJoinWithContactsRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the ContactsRelatedByAuthorId relation
 *
 * @method     ChildBookingsQuery leftJoinContactsRelatedByGuestId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactsRelatedByGuestId relation
 * @method     ChildBookingsQuery rightJoinContactsRelatedByGuestId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactsRelatedByGuestId relation
 * @method     ChildBookingsQuery innerJoinContactsRelatedByGuestId($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactsRelatedByGuestId relation
 *
 * @method     ChildBookingsQuery joinWithContactsRelatedByGuestId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactsRelatedByGuestId relation
 *
 * @method     ChildBookingsQuery leftJoinWithContactsRelatedByGuestId() Adds a LEFT JOIN clause and with to the query using the ContactsRelatedByGuestId relation
 * @method     ChildBookingsQuery rightJoinWithContactsRelatedByGuestId() Adds a RIGHT JOIN clause and with to the query using the ContactsRelatedByGuestId relation
 * @method     ChildBookingsQuery innerJoinWithContactsRelatedByGuestId() Adds a INNER JOIN clause and with to the query using the ContactsRelatedByGuestId relation
 *
 * @method     ChildBookingsQuery leftJoinPackages($relationAlias = null) Adds a LEFT JOIN clause to the query using the Packages relation
 * @method     ChildBookingsQuery rightJoinPackages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Packages relation
 * @method     ChildBookingsQuery innerJoinPackages($relationAlias = null) Adds a INNER JOIN clause to the query using the Packages relation
 *
 * @method     ChildBookingsQuery joinWithPackages($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Packages relation
 *
 * @method     ChildBookingsQuery leftJoinWithPackages() Adds a LEFT JOIN clause and with to the query using the Packages relation
 * @method     ChildBookingsQuery rightJoinWithPackages() Adds a RIGHT JOIN clause and with to the query using the Packages relation
 * @method     ChildBookingsQuery innerJoinWithPackages() Adds a INNER JOIN clause and with to the query using the Packages relation
 *
 * @method     ChildBookingsQuery leftJoinItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the Items relation
 * @method     ChildBookingsQuery rightJoinItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Items relation
 * @method     ChildBookingsQuery innerJoinItems($relationAlias = null) Adds a INNER JOIN clause to the query using the Items relation
 *
 * @method     ChildBookingsQuery joinWithItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Items relation
 *
 * @method     ChildBookingsQuery leftJoinWithItems() Adds a LEFT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingsQuery rightJoinWithItems() Adds a RIGHT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingsQuery innerJoinWithItems() Adds a INNER JOIN clause and with to the query using the Items relation
 *
 * @method     ChildBookingsQuery leftJoinEventStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingsQuery rightJoinEventStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingsQuery innerJoinEventStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the EventStatus relation
 *
 * @method     ChildBookingsQuery joinWithEventStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingsQuery leftJoinWithEventStatus() Adds a LEFT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingsQuery rightJoinWithEventStatus() Adds a RIGHT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingsQuery innerJoinWithEventStatus() Adds a INNER JOIN clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingsQuery leftJoinBookingAttachments($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingAttachments relation
 * @method     ChildBookingsQuery rightJoinBookingAttachments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingAttachments relation
 * @method     ChildBookingsQuery innerJoinBookingAttachments($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingAttachments relation
 *
 * @method     ChildBookingsQuery joinWithBookingAttachments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingAttachments relation
 *
 * @method     ChildBookingsQuery leftJoinWithBookingAttachments() Adds a LEFT JOIN clause and with to the query using the BookingAttachments relation
 * @method     ChildBookingsQuery rightJoinWithBookingAttachments() Adds a RIGHT JOIN clause and with to the query using the BookingAttachments relation
 * @method     ChildBookingsQuery innerJoinWithBookingAttachments() Adds a INNER JOIN clause and with to the query using the BookingAttachments relation
 *
 * @method     ChildBookingsQuery leftJoinBookingItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingItems relation
 * @method     ChildBookingsQuery rightJoinBookingItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingItems relation
 * @method     ChildBookingsQuery innerJoinBookingItems($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingItems relation
 *
 * @method     ChildBookingsQuery joinWithBookingItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingItems relation
 *
 * @method     ChildBookingsQuery leftJoinWithBookingItems() Adds a LEFT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildBookingsQuery rightJoinWithBookingItems() Adds a RIGHT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildBookingsQuery innerJoinWithBookingItems() Adds a INNER JOIN clause and with to the query using the BookingItems relation
 *
 * @method     ChildBookingsQuery leftJoinFormEntries($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormEntries relation
 * @method     ChildBookingsQuery rightJoinFormEntries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormEntries relation
 * @method     ChildBookingsQuery innerJoinFormEntries($relationAlias = null) Adds a INNER JOIN clause to the query using the FormEntries relation
 *
 * @method     ChildBookingsQuery joinWithFormEntries($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormEntries relation
 *
 * @method     ChildBookingsQuery leftJoinWithFormEntries() Adds a LEFT JOIN clause and with to the query using the FormEntries relation
 * @method     ChildBookingsQuery rightJoinWithFormEntries() Adds a RIGHT JOIN clause and with to the query using the FormEntries relation
 * @method     ChildBookingsQuery innerJoinWithFormEntries() Adds a INNER JOIN clause and with to the query using the FormEntries relation
 *
 * @method     \TheFarm\Models\ContactsQuery|\TheFarm\Models\PackagesQuery|\TheFarm\Models\ItemsQuery|\TheFarm\Models\EventStatusQuery|\TheFarm\Models\BookingAttachmentsQuery|\TheFarm\Models\BookingItemsQuery|\TheFarm\Models\FormEntriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookings findOne(ConnectionInterface $con = null) Return the first ChildBookings matching the query
 * @method     ChildBookings findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookings matching the query, or a new ChildBookings object populated from the query conditions when no match is found
 *
 * @method     ChildBookings findOneByBookingId(int $booking_id) Return the first ChildBookings filtered by the booking_id column
 * @method     ChildBookings findOneByTitle(string $title) Return the first ChildBookings filtered by the title column
 * @method     ChildBookings findOneByPackageId(int $package_id) Return the first ChildBookings filtered by the package_id column
 * @method     ChildBookings findOneByStartDate(int $start_date) Return the first ChildBookings filtered by the start_date column
 * @method     ChildBookings findOneByEndDate(int $end_date) Return the first ChildBookings filtered by the end_date column
 * @method     ChildBookings findOneByNotes(string $notes) Return the first ChildBookings filtered by the notes column
 * @method     ChildBookings findOneByStatus(string $status) Return the first ChildBookings filtered by the status column
 * @method     ChildBookings findOneByGuestId(int $guest_id) Return the first ChildBookings filtered by the guest_id column
 * @method     ChildBookings findOneByFax(int $fax) Return the first ChildBookings filtered by the fax column
 * @method     ChildBookings findOneByAuthorId(int $author_id) Return the first ChildBookings filtered by the author_id column
 * @method     ChildBookings findOneByEntryDate(int $entry_date) Return the first ChildBookings filtered by the entry_date column
 * @method     ChildBookings findOneByEditDate(int $edit_date) Return the first ChildBookings filtered by the edit_date column
 * @method     ChildBookings findOneByPersonalized(int $personalized) Return the first ChildBookings filtered by the personalized column
 * @method     ChildBookings findOneByRoomId(int $room_id) Return the first ChildBookings filtered by the room_id column
 * @method     ChildBookings findOneByRestrictions(string $restrictions) Return the first ChildBookings filtered by the restrictions column
 * @method     ChildBookings findOneByPackageTypeId(int $package_type_id) Return the first ChildBookings filtered by the package_type_id column
 * @method     ChildBookings findOneByIsActive(boolean $is_active) Return the first ChildBookings filtered by the is_active column *

 * @method     ChildBookings requirePk($key, ConnectionInterface $con = null) Return the ChildBookings by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOne(ConnectionInterface $con = null) Return the first ChildBookings matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookings requireOneByBookingId(int $booking_id) Return the first ChildBookings filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByTitle(string $title) Return the first ChildBookings filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByPackageId(int $package_id) Return the first ChildBookings filtered by the package_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByStartDate(int $start_date) Return the first ChildBookings filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByEndDate(int $end_date) Return the first ChildBookings filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByNotes(string $notes) Return the first ChildBookings filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByStatus(string $status) Return the first ChildBookings filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByGuestId(int $guest_id) Return the first ChildBookings filtered by the guest_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByFax(int $fax) Return the first ChildBookings filtered by the fax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByAuthorId(int $author_id) Return the first ChildBookings filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByEntryDate(int $entry_date) Return the first ChildBookings filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByEditDate(int $edit_date) Return the first ChildBookings filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByPersonalized(int $personalized) Return the first ChildBookings filtered by the personalized column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByRoomId(int $room_id) Return the first ChildBookings filtered by the room_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByRestrictions(string $restrictions) Return the first ChildBookings filtered by the restrictions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByPackageTypeId(int $package_type_id) Return the first ChildBookings filtered by the package_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookings requireOneByIsActive(boolean $is_active) Return the first ChildBookings filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookings[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookings objects based on current ModelCriteria
 * @method     ChildBookings[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookings objects filtered by the booking_id column
 * @method     ChildBookings[]|ObjectCollection findByTitle(string $title) Return ChildBookings objects filtered by the title column
 * @method     ChildBookings[]|ObjectCollection findByPackageId(int $package_id) Return ChildBookings objects filtered by the package_id column
 * @method     ChildBookings[]|ObjectCollection findByStartDate(int $start_date) Return ChildBookings objects filtered by the start_date column
 * @method     ChildBookings[]|ObjectCollection findByEndDate(int $end_date) Return ChildBookings objects filtered by the end_date column
 * @method     ChildBookings[]|ObjectCollection findByNotes(string $notes) Return ChildBookings objects filtered by the notes column
 * @method     ChildBookings[]|ObjectCollection findByStatus(string $status) Return ChildBookings objects filtered by the status column
 * @method     ChildBookings[]|ObjectCollection findByGuestId(int $guest_id) Return ChildBookings objects filtered by the guest_id column
 * @method     ChildBookings[]|ObjectCollection findByFax(int $fax) Return ChildBookings objects filtered by the fax column
 * @method     ChildBookings[]|ObjectCollection findByAuthorId(int $author_id) Return ChildBookings objects filtered by the author_id column
 * @method     ChildBookings[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildBookings objects filtered by the entry_date column
 * @method     ChildBookings[]|ObjectCollection findByEditDate(int $edit_date) Return ChildBookings objects filtered by the edit_date column
 * @method     ChildBookings[]|ObjectCollection findByPersonalized(int $personalized) Return ChildBookings objects filtered by the personalized column
 * @method     ChildBookings[]|ObjectCollection findByRoomId(int $room_id) Return ChildBookings objects filtered by the room_id column
 * @method     ChildBookings[]|ObjectCollection findByRestrictions(string $restrictions) Return ChildBookings objects filtered by the restrictions column
 * @method     ChildBookings[]|ObjectCollection findByPackageTypeId(int $package_type_id) Return ChildBookings objects filtered by the package_type_id column
 * @method     ChildBookings[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildBookings objects filtered by the is_active column
 * @method     ChildBookings[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Bookings', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingsQuery) {
            return $criteria;
        }
        $query = new ChildBookingsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBookings|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookings A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT booking_id, title, package_id, start_date, end_date, notes, status, guest_id, fax, author_id, entry_date, edit_date, personalized, room_id, restrictions, package_type_id, is_active FROM tf_bookings WHERE booking_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBookings $obj */
            $obj = new ChildBookings();
            $obj->hydrate($row);
            BookingsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildBookings|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the booking_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingId(1234); // WHERE booking_id = 1234
     * $query->filterByBookingId(array(12, 34)); // WHERE booking_id IN (12, 34)
     * $query->filterByBookingId(array('min' => 12)); // WHERE booking_id > 12
     * </code>
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the package_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageId(1234); // WHERE package_id = 1234
     * $query->filterByPackageId(array(12, 34)); // WHERE package_id IN (12, 34)
     * $query->filterByPackageId(array('min' => 12)); // WHERE package_id > 12
     * </code>
     *
     * @see       filterByPackages()
     *
     * @param     mixed $packageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPackageId($packageId = null, $comparison = null)
    {
        if (is_array($packageId)) {
            $useMinMax = false;
            if (isset($packageId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_ID, $packageId, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate(1234); // WHERE start_date = 1234
     * $query->filterByStartDate(array(12, 34)); // WHERE start_date IN (12, 34)
     * $query->filterByStartDate(array('min' => 12)); // WHERE start_date > 12
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate(1234); // WHERE end_date = 1234
     * $query->filterByEndDate(array(12, 34)); // WHERE end_date IN (12, 34)
     * $query->filterByEndDate(array('min' => 12)); // WHERE end_date > 12
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the guest_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGuestId(1234); // WHERE guest_id = 1234
     * $query->filterByGuestId(array(12, 34)); // WHERE guest_id IN (12, 34)
     * $query->filterByGuestId(array('min' => 12)); // WHERE guest_id > 12
     * </code>
     *
     * @see       filterByContactsRelatedByGuestId()
     *
     * @param     mixed $guestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByGuestId($guestId = null, $comparison = null)
    {
        if (is_array($guestId)) {
            $useMinMax = false;
            if (isset($guestId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_GUEST_ID, $guestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($guestId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_GUEST_ID, $guestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_GUEST_ID, $guestId, $comparison);
    }

    /**
     * Filter the query on the fax column
     *
     * Example usage:
     * <code>
     * $query->filterByFax(1234); // WHERE fax = 1234
     * $query->filterByFax(array(12, 34)); // WHERE fax IN (12, 34)
     * $query->filterByFax(array('min' => 12)); // WHERE fax > 12
     * </code>
     *
     * @param     mixed $fax The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (is_array($fax)) {
            $useMinMax = false;
            if (isset($fax['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_FAX, $fax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fax['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_FAX, $fax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_FAX, $fax, $comparison);
    }

    /**
     * Filter the query on the author_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorId(1234); // WHERE author_id = 1234
     * $query->filterByAuthorId(array(12, 34)); // WHERE author_id IN (12, 34)
     * $query->filterByAuthorId(array('min' => 12)); // WHERE author_id > 12
     * </code>
     *
     * @see       filterByContactsRelatedByAuthorId()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_AUTHOR_ID, $authorId, $comparison);
    }

    /**
     * Filter the query on the entry_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryDate(1234); // WHERE entry_date = 1234
     * $query->filterByEntryDate(array(12, 34)); // WHERE entry_date IN (12, 34)
     * $query->filterByEntryDate(array('min' => 12)); // WHERE entry_date > 12
     * </code>
     *
     * @param     mixed $entryDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
    }

    /**
     * Filter the query on the edit_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEditDate(1234); // WHERE edit_date = 1234
     * $query->filterByEditDate(array(12, 34)); // WHERE edit_date IN (12, 34)
     * $query->filterByEditDate(array('min' => 12)); // WHERE edit_date > 12
     * </code>
     *
     * @param     mixed $editDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query on the personalized column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalized(1234); // WHERE personalized = 1234
     * $query->filterByPersonalized(array(12, 34)); // WHERE personalized IN (12, 34)
     * $query->filterByPersonalized(array('min' => 12)); // WHERE personalized > 12
     * </code>
     *
     * @param     mixed $personalized The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPersonalized($personalized = null, $comparison = null)
    {
        if (is_array($personalized)) {
            $useMinMax = false;
            if (isset($personalized['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PERSONALIZED, $personalized['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personalized['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PERSONALIZED, $personalized['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_PERSONALIZED, $personalized, $comparison);
    }

    /**
     * Filter the query on the room_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomId(1234); // WHERE room_id = 1234
     * $query->filterByRoomId(array(12, 34)); // WHERE room_id IN (12, 34)
     * $query->filterByRoomId(array('min' => 12)); // WHERE room_id > 12
     * </code>
     *
     * @see       filterByItems()
     *
     * @param     mixed $roomId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByRoomId($roomId = null, $comparison = null)
    {
        if (is_array($roomId)) {
            $useMinMax = false;
            if (isset($roomId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_ROOM_ID, $roomId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_ROOM_ID, $roomId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_ROOM_ID, $roomId, $comparison);
    }

    /**
     * Filter the query on the restrictions column
     *
     * Example usage:
     * <code>
     * $query->filterByRestrictions('fooValue');   // WHERE restrictions = 'fooValue'
     * $query->filterByRestrictions('%fooValue%', Criteria::LIKE); // WHERE restrictions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $restrictions The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByRestrictions($restrictions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($restrictions)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_RESTRICTIONS, $restrictions, $comparison);
    }

    /**
     * Filter the query on the package_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageTypeId(1234); // WHERE package_type_id = 1234
     * $query->filterByPackageTypeId(array(12, 34)); // WHERE package_type_id IN (12, 34)
     * $query->filterByPackageTypeId(array('min' => 12)); // WHERE package_type_id > 12
     * </code>
     *
     * @param     mixed $packageTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPackageTypeId($packageTypeId = null, $comparison = null)
    {
        if (is_array($packageTypeId)) {
            $useMinMax = false;
            if (isset($packageTypeId['min'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageTypeId['max'])) {
                $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingsTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     boolean|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingsTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contacts object
     *
     * @param \TheFarm\Models\Contacts|ObjectCollection $contacts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByContactsRelatedByAuthorId($contacts, $comparison = null)
    {
        if ($contacts instanceof \TheFarm\Models\Contacts) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_AUTHOR_ID, $contacts->getContactId(), $comparison);
        } elseif ($contacts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingsTableMap::COL_AUTHOR_ID, $contacts->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactsRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\Contacts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactsRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinContactsRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactsRelatedByAuthorId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ContactsRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the ContactsRelatedByAuthorId relation Contacts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactsQuery A secondary query class using the current class as primary query
     */
    public function useContactsRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactsRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactsRelatedByAuthorId', '\TheFarm\Models\ContactsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contacts object
     *
     * @param \TheFarm\Models\Contacts|ObjectCollection $contacts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByContactsRelatedByGuestId($contacts, $comparison = null)
    {
        if ($contacts instanceof \TheFarm\Models\Contacts) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_GUEST_ID, $contacts->getContactId(), $comparison);
        } elseif ($contacts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingsTableMap::COL_GUEST_ID, $contacts->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactsRelatedByGuestId() only accepts arguments of type \TheFarm\Models\Contacts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactsRelatedByGuestId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinContactsRelatedByGuestId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactsRelatedByGuestId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ContactsRelatedByGuestId');
        }

        return $this;
    }

    /**
     * Use the ContactsRelatedByGuestId relation Contacts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactsQuery A secondary query class using the current class as primary query
     */
    public function useContactsRelatedByGuestIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactsRelatedByGuestId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactsRelatedByGuestId', '\TheFarm\Models\ContactsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Packages object
     *
     * @param \TheFarm\Models\Packages|ObjectCollection $packages The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByPackages($packages, $comparison = null)
    {
        if ($packages instanceof \TheFarm\Models\Packages) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_PACKAGE_ID, $packages->getPackageId(), $comparison);
        } elseif ($packages instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingsTableMap::COL_PACKAGE_ID, $packages->toKeyValue('PrimaryKey', 'PackageId'), $comparison);
        } else {
            throw new PropelException('filterByPackages() only accepts arguments of type \TheFarm\Models\Packages or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Packages relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinPackages($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Packages');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Packages');
        }

        return $this;
    }

    /**
     * Use the Packages relation Packages object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PackagesQuery A secondary query class using the current class as primary query
     */
    public function usePackagesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPackages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Packages', '\TheFarm\Models\PackagesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Items object
     *
     * @param \TheFarm\Models\Items|ObjectCollection $items The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByItems($items, $comparison = null)
    {
        if ($items instanceof \TheFarm\Models\Items) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_ROOM_ID, $items->getItemId(), $comparison);
        } elseif ($items instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingsTableMap::COL_ROOM_ID, $items->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
        } else {
            throw new PropelException('filterByItems() only accepts arguments of type \TheFarm\Models\Items or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Items relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinItems($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Items');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Items');
        }

        return $this;
    }

    /**
     * Use the Items relation Items object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsQuery A secondary query class using the current class as primary query
     */
    public function useItemsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Items', '\TheFarm\Models\ItemsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\EventStatus object
     *
     * @param \TheFarm\Models\EventStatus|ObjectCollection $eventStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByEventStatus($eventStatus, $comparison = null)
    {
        if ($eventStatus instanceof \TheFarm\Models\EventStatus) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_STATUS, $eventStatus->getStatusCd(), $comparison);
        } elseif ($eventStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingsTableMap::COL_STATUS, $eventStatus->toKeyValue('PrimaryKey', 'StatusCd'), $comparison);
        } else {
            throw new PropelException('filterByEventStatus() only accepts arguments of type \TheFarm\Models\EventStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinEventStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventStatus');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EventStatus');
        }

        return $this;
    }

    /**
     * Use the EventStatus relation EventStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventStatusQuery A secondary query class using the current class as primary query
     */
    public function useEventStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventStatus', '\TheFarm\Models\EventStatusQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingAttachments object
     *
     * @param \TheFarm\Models\BookingAttachments|ObjectCollection $bookingAttachments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByBookingAttachments($bookingAttachments, $comparison = null)
    {
        if ($bookingAttachments instanceof \TheFarm\Models\BookingAttachments) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookingAttachments->getBookingId(), $comparison);
        } elseif ($bookingAttachments instanceof ObjectCollection) {
            return $this
                ->useBookingAttachmentsQuery()
                ->filterByPrimaryKeys($bookingAttachments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingAttachments() only accepts arguments of type \TheFarm\Models\BookingAttachments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingAttachments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinBookingAttachments($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingAttachments');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BookingAttachments');
        }

        return $this;
    }

    /**
     * Use the BookingAttachments relation BookingAttachments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingAttachmentsQuery A secondary query class using the current class as primary query
     */
    public function useBookingAttachmentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingAttachments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingAttachments', '\TheFarm\Models\BookingAttachmentsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingItems object
     *
     * @param \TheFarm\Models\BookingItems|ObjectCollection $bookingItems the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByBookingItems($bookingItems, $comparison = null)
    {
        if ($bookingItems instanceof \TheFarm\Models\BookingItems) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookingItems->getBookingId(), $comparison);
        } elseif ($bookingItems instanceof ObjectCollection) {
            return $this
                ->useBookingItemsQuery()
                ->filterByPrimaryKeys($bookingItems->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingItems() only accepts arguments of type \TheFarm\Models\BookingItems or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingItems relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinBookingItems($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingItems');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BookingItems');
        }

        return $this;
    }

    /**
     * Use the BookingItems relation BookingItems object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingItemsQuery A secondary query class using the current class as primary query
     */
    public function useBookingItemsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingItems', '\TheFarm\Models\BookingItemsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\FormEntries object
     *
     * @param \TheFarm\Models\FormEntries|ObjectCollection $formEntries the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingsQuery The current query, for fluid interface
     */
    public function filterByFormEntries($formEntries, $comparison = null)
    {
        if ($formEntries instanceof \TheFarm\Models\FormEntries) {
            return $this
                ->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $formEntries->getBookingId(), $comparison);
        } elseif ($formEntries instanceof ObjectCollection) {
            return $this
                ->useFormEntriesQuery()
                ->filterByPrimaryKeys($formEntries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFormEntries() only accepts arguments of type \TheFarm\Models\FormEntries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FormEntries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function joinFormEntries($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FormEntries');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FormEntries');
        }

        return $this;
    }

    /**
     * Use the FormEntries relation FormEntries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormEntriesQuery A secondary query class using the current class as primary query
     */
    public function useFormEntriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFormEntries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FormEntries', '\TheFarm\Models\FormEntriesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookings $bookings Object to remove from the list of results
     *
     * @return $this|ChildBookingsQuery The current query, for fluid interface
     */
    public function prune($bookings = null)
    {
        if ($bookings) {
            $this->addUsingAlias(BookingsTableMap::COL_BOOKING_ID, $bookings->getBookingId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_bookings table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingsTableMap::clearInstancePool();
            BookingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingsQuery
