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
use TheFarm\Models\Booking as ChildBooking;
use TheFarm\Models\BookingQuery as ChildBookingQuery;
use TheFarm\Models\Map\BookingTableMap;

/**
 * Base class that represents a query for the 'tf_bookings' table.
 *
 *
 *
 * @method     ChildBookingQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildBookingQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ChildBookingQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildBookingQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildBookingQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildBookingQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBookingQuery orderByGuestId($order = Criteria::ASC) Order by the guest_id column
 * @method     ChildBookingQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ChildBookingQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildBookingQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildBookingQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildBookingQuery orderByPersonalized($order = Criteria::ASC) Order by the personalized column
 * @method     ChildBookingQuery orderByRoomId($order = Criteria::ASC) Order by the room_id column
 * @method     ChildBookingQuery orderByRestrictions($order = Criteria::ASC) Order by the restrictions column
 * @method     ChildBookingQuery orderByPackageTypeId($order = Criteria::ASC) Order by the package_type_id column
 * @method     ChildBookingQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 *
 * @method     ChildBookingQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingQuery groupByTitle() Group by the title column
 * @method     ChildBookingQuery groupByPackageId() Group by the package_id column
 * @method     ChildBookingQuery groupByStartDate() Group by the start_date column
 * @method     ChildBookingQuery groupByEndDate() Group by the end_date column
 * @method     ChildBookingQuery groupByNotes() Group by the notes column
 * @method     ChildBookingQuery groupByStatus() Group by the status column
 * @method     ChildBookingQuery groupByGuestId() Group by the guest_id column
 * @method     ChildBookingQuery groupByFax() Group by the fax column
 * @method     ChildBookingQuery groupByAuthorId() Group by the author_id column
 * @method     ChildBookingQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildBookingQuery groupByEditDate() Group by the edit_date column
 * @method     ChildBookingQuery groupByPersonalized() Group by the personalized column
 * @method     ChildBookingQuery groupByRoomId() Group by the room_id column
 * @method     ChildBookingQuery groupByRestrictions() Group by the restrictions column
 * @method     ChildBookingQuery groupByPackageTypeId() Group by the package_type_id column
 * @method     ChildBookingQuery groupByIsActive() Group by the is_active column
 *
 * @method     ChildBookingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildBookingQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildBookingQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildBookingQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildBookingQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildBookingQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildBookingQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildBookingQuery leftJoinContact($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contact relation
 * @method     ChildBookingQuery rightJoinContact($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contact relation
 * @method     ChildBookingQuery innerJoinContact($relationAlias = null) Adds a INNER JOIN clause to the query using the Contact relation
 *
 * @method     ChildBookingQuery joinWithContact($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Contact relation
 *
 * @method     ChildBookingQuery leftJoinWithContact() Adds a LEFT JOIN clause and with to the query using the Contact relation
 * @method     ChildBookingQuery rightJoinWithContact() Adds a RIGHT JOIN clause and with to the query using the Contact relation
 * @method     ChildBookingQuery innerJoinWithContact() Adds a INNER JOIN clause and with to the query using the Contact relation
 *
 * @method     ChildBookingQuery leftJoinPackage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Package relation
 * @method     ChildBookingQuery rightJoinPackage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Package relation
 * @method     ChildBookingQuery innerJoinPackage($relationAlias = null) Adds a INNER JOIN clause to the query using the Package relation
 *
 * @method     ChildBookingQuery joinWithPackage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Package relation
 *
 * @method     ChildBookingQuery leftJoinWithPackage() Adds a LEFT JOIN clause and with to the query using the Package relation
 * @method     ChildBookingQuery rightJoinWithPackage() Adds a RIGHT JOIN clause and with to the query using the Package relation
 * @method     ChildBookingQuery innerJoinWithPackage() Adds a INNER JOIN clause and with to the query using the Package relation
 *
 * @method     ChildBookingQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method     ChildBookingQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method     ChildBookingQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method     ChildBookingQuery joinWithRoom($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Room relation
 *
 * @method     ChildBookingQuery leftJoinWithRoom() Adds a LEFT JOIN clause and with to the query using the Room relation
 * @method     ChildBookingQuery rightJoinWithRoom() Adds a RIGHT JOIN clause and with to the query using the Room relation
 * @method     ChildBookingQuery innerJoinWithRoom() Adds a INNER JOIN clause and with to the query using the Room relation
 *
 * @method     ChildBookingQuery leftJoinEventStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingQuery rightJoinEventStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingQuery innerJoinEventStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the EventStatus relation
 *
 * @method     ChildBookingQuery joinWithEventStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingQuery leftJoinWithEventStatus() Adds a LEFT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingQuery rightJoinWithEventStatus() Adds a RIGHT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingQuery innerJoinWithEventStatus() Adds a INNER JOIN clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingQuery leftJoinBookingAttachment($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingAttachment relation
 * @method     ChildBookingQuery rightJoinBookingAttachment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingAttachment relation
 * @method     ChildBookingQuery innerJoinBookingAttachment($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingAttachment relation
 *
 * @method     ChildBookingQuery joinWithBookingAttachment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingAttachment relation
 *
 * @method     ChildBookingQuery leftJoinWithBookingAttachment() Adds a LEFT JOIN clause and with to the query using the BookingAttachment relation
 * @method     ChildBookingQuery rightJoinWithBookingAttachment() Adds a RIGHT JOIN clause and with to the query using the BookingAttachment relation
 * @method     ChildBookingQuery innerJoinWithBookingAttachment() Adds a INNER JOIN clause and with to the query using the BookingAttachment relation
 *
 * @method     ChildBookingQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     ChildBookingQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     ChildBookingQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     ChildBookingQuery joinWithEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Event relation
 *
 * @method     ChildBookingQuery leftJoinWithEvent() Adds a LEFT JOIN clause and with to the query using the Event relation
 * @method     ChildBookingQuery rightJoinWithEvent() Adds a RIGHT JOIN clause and with to the query using the Event relation
 * @method     ChildBookingQuery innerJoinWithEvent() Adds a INNER JOIN clause and with to the query using the Event relation
 *
 * @method     ChildBookingQuery leftJoinBookingItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingItem relation
 * @method     ChildBookingQuery rightJoinBookingItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingItem relation
 * @method     ChildBookingQuery innerJoinBookingItem($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingItem relation
 *
 * @method     ChildBookingQuery joinWithBookingItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingItem relation
 *
 * @method     ChildBookingQuery leftJoinWithBookingItem() Adds a LEFT JOIN clause and with to the query using the BookingItem relation
 * @method     ChildBookingQuery rightJoinWithBookingItem() Adds a RIGHT JOIN clause and with to the query using the BookingItem relation
 * @method     ChildBookingQuery innerJoinWithBookingItem() Adds a INNER JOIN clause and with to the query using the BookingItem relation
 *
 * @method     ChildBookingQuery leftJoinBookingForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingForm relation
 * @method     ChildBookingQuery rightJoinBookingForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingForm relation
 * @method     ChildBookingQuery innerJoinBookingForm($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingForm relation
 *
 * @method     ChildBookingQuery joinWithBookingForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingForm relation
 *
 * @method     ChildBookingQuery leftJoinWithBookingForm() Adds a LEFT JOIN clause and with to the query using the BookingForm relation
 * @method     ChildBookingQuery rightJoinWithBookingForm() Adds a RIGHT JOIN clause and with to the query using the BookingForm relation
 * @method     ChildBookingQuery innerJoinWithBookingForm() Adds a INNER JOIN clause and with to the query using the BookingForm relation
 *
 * @method     \TheFarm\Models\UserQuery|\TheFarm\Models\ContactQuery|\TheFarm\Models\PackageQuery|\TheFarm\Models\ItemQuery|\TheFarm\Models\EventStatusQuery|\TheFarm\Models\BookingAttachmentQuery|\TheFarm\Models\EventQuery|\TheFarm\Models\BookingItemQuery|\TheFarm\Models\BookingFormQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooking findOne(ConnectionInterface $con = null) Return the first ChildBooking matching the query
 * @method     ChildBooking findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooking matching the query, or a new ChildBooking object populated from the query conditions when no match is found
 *
 * @method     ChildBooking findOneByBookingId(int $booking_id) Return the first ChildBooking filtered by the booking_id column
 * @method     ChildBooking findOneByTitle(string $title) Return the first ChildBooking filtered by the title column
 * @method     ChildBooking findOneByPackageId(int $package_id) Return the first ChildBooking filtered by the package_id column
 * @method     ChildBooking findOneByStartDate(int $start_date) Return the first ChildBooking filtered by the start_date column
 * @method     ChildBooking findOneByEndDate(int $end_date) Return the first ChildBooking filtered by the end_date column
 * @method     ChildBooking findOneByNotes(string $notes) Return the first ChildBooking filtered by the notes column
 * @method     ChildBooking findOneByStatus(string $status) Return the first ChildBooking filtered by the status column
 * @method     ChildBooking findOneByGuestId(int $guest_id) Return the first ChildBooking filtered by the guest_id column
 * @method     ChildBooking findOneByFax(int $fax) Return the first ChildBooking filtered by the fax column
 * @method     ChildBooking findOneByAuthorId(int $author_id) Return the first ChildBooking filtered by the author_id column
 * @method     ChildBooking findOneByEntryDate(int $entry_date) Return the first ChildBooking filtered by the entry_date column
 * @method     ChildBooking findOneByEditDate(int $edit_date) Return the first ChildBooking filtered by the edit_date column
 * @method     ChildBooking findOneByPersonalized(int $personalized) Return the first ChildBooking filtered by the personalized column
 * @method     ChildBooking findOneByRoomId(int $room_id) Return the first ChildBooking filtered by the room_id column
 * @method     ChildBooking findOneByRestrictions(string $restrictions) Return the first ChildBooking filtered by the restrictions column
 * @method     ChildBooking findOneByPackageTypeId(int $package_type_id) Return the first ChildBooking filtered by the package_type_id column
 * @method     ChildBooking findOneByIsActive(boolean $is_active) Return the first ChildBooking filtered by the is_active column *

 * @method     ChildBooking requirePk($key, ConnectionInterface $con = null) Return the ChildBooking by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOne(ConnectionInterface $con = null) Return the first ChildBooking matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooking requireOneByBookingId(int $booking_id) Return the first ChildBooking filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByTitle(string $title) Return the first ChildBooking filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByPackageId(int $package_id) Return the first ChildBooking filtered by the package_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByStartDate(int $start_date) Return the first ChildBooking filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByEndDate(int $end_date) Return the first ChildBooking filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByNotes(string $notes) Return the first ChildBooking filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByStatus(string $status) Return the first ChildBooking filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByGuestId(int $guest_id) Return the first ChildBooking filtered by the guest_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByFax(int $fax) Return the first ChildBooking filtered by the fax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByAuthorId(int $author_id) Return the first ChildBooking filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByEntryDate(int $entry_date) Return the first ChildBooking filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByEditDate(int $edit_date) Return the first ChildBooking filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByPersonalized(int $personalized) Return the first ChildBooking filtered by the personalized column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByRoomId(int $room_id) Return the first ChildBooking filtered by the room_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByRestrictions(string $restrictions) Return the first ChildBooking filtered by the restrictions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByPackageTypeId(int $package_type_id) Return the first ChildBooking filtered by the package_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooking requireOneByIsActive(boolean $is_active) Return the first ChildBooking filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooking[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooking objects based on current ModelCriteria
 * @method     ChildBooking[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBooking objects filtered by the booking_id column
 * @method     ChildBooking[]|ObjectCollection findByTitle(string $title) Return ChildBooking objects filtered by the title column
 * @method     ChildBooking[]|ObjectCollection findByPackageId(int $package_id) Return ChildBooking objects filtered by the package_id column
 * @method     ChildBooking[]|ObjectCollection findByStartDate(int $start_date) Return ChildBooking objects filtered by the start_date column
 * @method     ChildBooking[]|ObjectCollection findByEndDate(int $end_date) Return ChildBooking objects filtered by the end_date column
 * @method     ChildBooking[]|ObjectCollection findByNotes(string $notes) Return ChildBooking objects filtered by the notes column
 * @method     ChildBooking[]|ObjectCollection findByStatus(string $status) Return ChildBooking objects filtered by the status column
 * @method     ChildBooking[]|ObjectCollection findByGuestId(int $guest_id) Return ChildBooking objects filtered by the guest_id column
 * @method     ChildBooking[]|ObjectCollection findByFax(int $fax) Return ChildBooking objects filtered by the fax column
 * @method     ChildBooking[]|ObjectCollection findByAuthorId(int $author_id) Return ChildBooking objects filtered by the author_id column
 * @method     ChildBooking[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildBooking objects filtered by the entry_date column
 * @method     ChildBooking[]|ObjectCollection findByEditDate(int $edit_date) Return ChildBooking objects filtered by the edit_date column
 * @method     ChildBooking[]|ObjectCollection findByPersonalized(int $personalized) Return ChildBooking objects filtered by the personalized column
 * @method     ChildBooking[]|ObjectCollection findByRoomId(int $room_id) Return ChildBooking objects filtered by the room_id column
 * @method     ChildBooking[]|ObjectCollection findByRestrictions(string $restrictions) Return ChildBooking objects filtered by the restrictions column
 * @method     ChildBooking[]|ObjectCollection findByPackageTypeId(int $package_type_id) Return ChildBooking objects filtered by the package_type_id column
 * @method     ChildBooking[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildBooking objects filtered by the is_active column
 * @method     ChildBooking[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Booking', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingQuery) {
            return $criteria;
        }
        $query = new ChildBookingQuery();
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
     * @return ChildBooking|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBooking A model object, or null if the key is not found
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
            /** @var ChildBooking $obj */
            $obj = new ChildBooking();
            $obj->hydrate($row);
            BookingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBooking|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_TITLE, $title, $comparison);
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
     * @see       filterByPackage()
     *
     * @param     mixed $packageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPackageId($packageId = null, $comparison = null)
    {
        if (is_array($packageId)) {
            $useMinMax = false;
            if (isset($packageId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_PACKAGE_ID, $packageId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_START_DATE, $startDate, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_END_DATE, $endDate, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_NOTES, $notes, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_STATUS, $status, $comparison);
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
     * @see       filterByContact()
     *
     * @param     mixed $guestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByGuestId($guestId = null, $comparison = null)
    {
        if (is_array($guestId)) {
            $useMinMax = false;
            if (isset($guestId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_GUEST_ID, $guestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($guestId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_GUEST_ID, $guestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_GUEST_ID, $guestId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (is_array($fax)) {
            $useMinMax = false;
            if (isset($fax['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_FAX, $fax['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fax['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_FAX, $fax['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_FAX, $fax, $comparison);
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
     * @see       filterByUser()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_EDIT_DATE, $editDate, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPersonalized($personalized = null, $comparison = null)
    {
        if (is_array($personalized)) {
            $useMinMax = false;
            if (isset($personalized['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_PERSONALIZED, $personalized['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personalized['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_PERSONALIZED, $personalized['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_PERSONALIZED, $personalized, $comparison);
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
     * @see       filterByRoom()
     *
     * @param     mixed $roomId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByRoomId($roomId = null, $comparison = null)
    {
        if (is_array($roomId)) {
            $useMinMax = false;
            if (isset($roomId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_ROOM_ID, $roomId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_ROOM_ID, $roomId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_ROOM_ID, $roomId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByRestrictions($restrictions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($restrictions)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_RESTRICTIONS, $restrictions, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPackageTypeId($packageTypeId = null, $comparison = null)
    {
        if (is_array($packageTypeId)) {
            $useMinMax = false;
            if (isset($packageTypeId['min'])) {
                $this->addUsingAlias(BookingTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageTypeId['max'])) {
                $this->addUsingAlias(BookingTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId, $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BookingTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_AUTHOR_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingTableMap::COL_AUTHOR_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_GUEST_ID, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingTableMap::COL_GUEST_ID, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContact() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Contact relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinContact($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Contact');

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
            $this->addJoinObject($join, 'Contact');
        }

        return $this;
    }

    /**
     * Use the Contact relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContact($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Contact', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Package object
     *
     * @param \TheFarm\Models\Package|ObjectCollection $package The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByPackage($package, $comparison = null)
    {
        if ($package instanceof \TheFarm\Models\Package) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_PACKAGE_ID, $package->getPackageId(), $comparison);
        } elseif ($package instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingTableMap::COL_PACKAGE_ID, $package->toKeyValue('PrimaryKey', 'PackageId'), $comparison);
        } else {
            throw new PropelException('filterByPackage() only accepts arguments of type \TheFarm\Models\Package or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Package relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinPackage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Package');

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
            $this->addJoinObject($join, 'Package');
        }

        return $this;
    }

    /**
     * Use the Package relation Package object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PackageQuery A secondary query class using the current class as primary query
     */
    public function usePackageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPackage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Package', '\TheFarm\Models\PackageQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Item object
     *
     * @param \TheFarm\Models\Item|ObjectCollection $item The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByRoom($item, $comparison = null)
    {
        if ($item instanceof \TheFarm\Models\Item) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_ROOM_ID, $item->getItemId(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingTableMap::COL_ROOM_ID, $item->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
        } else {
            throw new PropelException('filterByRoom() only accepts arguments of type \TheFarm\Models\Item or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Room relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinRoom($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Room');

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
            $this->addJoinObject($join, 'Room');
        }

        return $this;
    }

    /**
     * Use the Room relation Item object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemQuery A secondary query class using the current class as primary query
     */
    public function useRoomQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Room', '\TheFarm\Models\ItemQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\EventStatus object
     *
     * @param \TheFarm\Models\EventStatus|ObjectCollection $eventStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByEventStatus($eventStatus, $comparison = null)
    {
        if ($eventStatus instanceof \TheFarm\Models\EventStatus) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_STATUS, $eventStatus->getStatusCd(), $comparison);
        } elseif ($eventStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingTableMap::COL_STATUS, $eventStatus->toKeyValue('PrimaryKey', 'StatusCd'), $comparison);
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
     * @return $this|ChildBookingQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\BookingAttachment object
     *
     * @param \TheFarm\Models\BookingAttachment|ObjectCollection $bookingAttachment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByBookingAttachment($bookingAttachment, $comparison = null)
    {
        if ($bookingAttachment instanceof \TheFarm\Models\BookingAttachment) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingAttachment->getBookingId(), $comparison);
        } elseif ($bookingAttachment instanceof ObjectCollection) {
            return $this
                ->useBookingAttachmentQuery()
                ->filterByPrimaryKeys($bookingAttachment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingAttachment() only accepts arguments of type \TheFarm\Models\BookingAttachment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingAttachment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinBookingAttachment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingAttachment');

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
            $this->addJoinObject($join, 'BookingAttachment');
        }

        return $this;
    }

    /**
     * Use the BookingAttachment relation BookingAttachment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingAttachmentQuery A secondary query class using the current class as primary query
     */
    public function useBookingAttachmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingAttachment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingAttachment', '\TheFarm\Models\BookingAttachmentQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByEvent($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $event->getBookingId(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEvent() only accepts arguments of type \TheFarm\Models\Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Event relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinEvent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Event');

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
            $this->addJoinObject($join, 'Event');
        }

        return $this;
    }

    /**
     * Use the Event relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventQuery A secondary query class using the current class as primary query
     */
    public function useEventQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Event', '\TheFarm\Models\EventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingItem object
     *
     * @param \TheFarm\Models\BookingItem|ObjectCollection $bookingItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByBookingItem($bookingItem, $comparison = null)
    {
        if ($bookingItem instanceof \TheFarm\Models\BookingItem) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingItem->getBookingId(), $comparison);
        } elseif ($bookingItem instanceof ObjectCollection) {
            return $this
                ->useBookingItemQuery()
                ->filterByPrimaryKeys($bookingItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingItem() only accepts arguments of type \TheFarm\Models\BookingItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinBookingItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingItem');

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
            $this->addJoinObject($join, 'BookingItem');
        }

        return $this;
    }

    /**
     * Use the BookingItem relation BookingItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingItemQuery A secondary query class using the current class as primary query
     */
    public function useBookingItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingItem', '\TheFarm\Models\BookingItemQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingForm object
     *
     * @param \TheFarm\Models\BookingForm|ObjectCollection $bookingForm the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingQuery The current query, for fluid interface
     */
    public function filterByBookingForm($bookingForm, $comparison = null)
    {
        if ($bookingForm instanceof \TheFarm\Models\BookingForm) {
            return $this
                ->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $bookingForm->getBookingId(), $comparison);
        } elseif ($bookingForm instanceof ObjectCollection) {
            return $this
                ->useBookingFormQuery()
                ->filterByPrimaryKeys($bookingForm->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingForm() only accepts arguments of type \TheFarm\Models\BookingForm or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingForm relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function joinBookingForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingForm');

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
            $this->addJoinObject($join, 'BookingForm');
        }

        return $this;
    }

    /**
     * Use the BookingForm relation BookingForm object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingFormQuery A secondary query class using the current class as primary query
     */
    public function useBookingFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingForm', '\TheFarm\Models\BookingFormQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooking $booking Object to remove from the list of results
     *
     * @return $this|ChildBookingQuery The current query, for fluid interface
     */
    public function prune($booking = null)
    {
        if ($booking) {
            $this->addUsingAlias(BookingTableMap::COL_BOOKING_ID, $booking->getBookingId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingTableMap::clearInstancePool();
            BookingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingQuery
