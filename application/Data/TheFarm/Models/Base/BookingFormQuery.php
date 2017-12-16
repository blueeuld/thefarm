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
use TheFarm\Models\BookingForm as ChildBookingForm;
use TheFarm\Models\BookingFormQuery as ChildBookingFormQuery;
use TheFarm\Models\Map\BookingFormTableMap;

/**
 * Base class that represents a query for the 'tf_booking_form' table.
 *
 *
 *
 * @method     ChildBookingFormQuery orderByBookingFormId($order = Criteria::ASC) Order by the booking_form_id column
 * @method     ChildBookingFormQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingFormQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildBookingFormQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildBookingFormQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildBookingFormQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildBookingFormQuery orderByCompletedBy($order = Criteria::ASC) Order by the completed_by column
 * @method     ChildBookingFormQuery orderByCompletedDate($order = Criteria::ASC) Order by the completed_date column
 *
 * @method     ChildBookingFormQuery groupByBookingFormId() Group by the booking_form_id column
 * @method     ChildBookingFormQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingFormQuery groupByFormId() Group by the form_id column
 * @method     ChildBookingFormQuery groupByAuthorId() Group by the author_id column
 * @method     ChildBookingFormQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildBookingFormQuery groupByEditDate() Group by the edit_date column
 * @method     ChildBookingFormQuery groupByCompletedBy() Group by the completed_by column
 * @method     ChildBookingFormQuery groupByCompletedDate() Group by the completed_date column
 *
 * @method     ChildBookingFormQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingFormQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingFormQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingFormQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingFormQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingFormQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingFormQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildBookingFormQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildBookingFormQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildBookingFormQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildBookingFormQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingFormQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingFormQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildBookingFormQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildBookingFormQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildBookingFormQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildBookingFormQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildBookingFormQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildBookingFormQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildBookingFormQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     ChildBookingFormQuery leftJoinUserRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByAuthorId relation
 * @method     ChildBookingFormQuery rightJoinUserRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByAuthorId relation
 * @method     ChildBookingFormQuery innerJoinUserRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildBookingFormQuery joinWithUserRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildBookingFormQuery leftJoinWithUserRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the UserRelatedByAuthorId relation
 * @method     ChildBookingFormQuery rightJoinWithUserRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByAuthorId relation
 * @method     ChildBookingFormQuery innerJoinWithUserRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the UserRelatedByAuthorId relation
 *
 * @method     ChildBookingFormQuery leftJoinUserRelatedByCompletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCompletedBy relation
 * @method     ChildBookingFormQuery rightJoinUserRelatedByCompletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCompletedBy relation
 * @method     ChildBookingFormQuery innerJoinUserRelatedByCompletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCompletedBy relation
 *
 * @method     ChildBookingFormQuery joinWithUserRelatedByCompletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRelatedByCompletedBy relation
 *
 * @method     ChildBookingFormQuery leftJoinWithUserRelatedByCompletedBy() Adds a LEFT JOIN clause and with to the query using the UserRelatedByCompletedBy relation
 * @method     ChildBookingFormQuery rightJoinWithUserRelatedByCompletedBy() Adds a RIGHT JOIN clause and with to the query using the UserRelatedByCompletedBy relation
 * @method     ChildBookingFormQuery innerJoinWithUserRelatedByCompletedBy() Adds a INNER JOIN clause and with to the query using the UserRelatedByCompletedBy relation
 *
 * @method     ChildBookingFormQuery leftJoinBookingFormEntry($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingFormEntry relation
 * @method     ChildBookingFormQuery rightJoinBookingFormEntry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingFormEntry relation
 * @method     ChildBookingFormQuery innerJoinBookingFormEntry($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingFormEntry relation
 *
 * @method     ChildBookingFormQuery joinWithBookingFormEntry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingFormEntry relation
 *
 * @method     ChildBookingFormQuery leftJoinWithBookingFormEntry() Adds a LEFT JOIN clause and with to the query using the BookingFormEntry relation
 * @method     ChildBookingFormQuery rightJoinWithBookingFormEntry() Adds a RIGHT JOIN clause and with to the query using the BookingFormEntry relation
 * @method     ChildBookingFormQuery innerJoinWithBookingFormEntry() Adds a INNER JOIN clause and with to the query using the BookingFormEntry relation
 *
 * @method     \TheFarm\Models\BookingQuery|\TheFarm\Models\FormQuery|\TheFarm\Models\UserQuery|\TheFarm\Models\BookingFormEntryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingForm findOne(ConnectionInterface $con = null) Return the first ChildBookingForm matching the query
 * @method     ChildBookingForm findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingForm matching the query, or a new ChildBookingForm object populated from the query conditions when no match is found
 *
 * @method     ChildBookingForm findOneByBookingFormId(int $booking_form_id) Return the first ChildBookingForm filtered by the booking_form_id column
 * @method     ChildBookingForm findOneByBookingId(int $booking_id) Return the first ChildBookingForm filtered by the booking_id column
 * @method     ChildBookingForm findOneByFormId(int $form_id) Return the first ChildBookingForm filtered by the form_id column
 * @method     ChildBookingForm findOneByAuthorId(int $author_id) Return the first ChildBookingForm filtered by the author_id column
 * @method     ChildBookingForm findOneByEntryDate(string $entry_date) Return the first ChildBookingForm filtered by the entry_date column
 * @method     ChildBookingForm findOneByEditDate(string $edit_date) Return the first ChildBookingForm filtered by the edit_date column
 * @method     ChildBookingForm findOneByCompletedBy(int $completed_by) Return the first ChildBookingForm filtered by the completed_by column
 * @method     ChildBookingForm findOneByCompletedDate(string $completed_date) Return the first ChildBookingForm filtered by the completed_date column *

 * @method     ChildBookingForm requirePk($key, ConnectionInterface $con = null) Return the ChildBookingForm by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOne(ConnectionInterface $con = null) Return the first ChildBookingForm matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingForm requireOneByBookingFormId(int $booking_form_id) Return the first ChildBookingForm filtered by the booking_form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByBookingId(int $booking_id) Return the first ChildBookingForm filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByFormId(int $form_id) Return the first ChildBookingForm filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByAuthorId(int $author_id) Return the first ChildBookingForm filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByEntryDate(string $entry_date) Return the first ChildBookingForm filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByEditDate(string $edit_date) Return the first ChildBookingForm filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByCompletedBy(int $completed_by) Return the first ChildBookingForm filtered by the completed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForm requireOneByCompletedDate(string $completed_date) Return the first ChildBookingForm filtered by the completed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingForm[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingForm objects based on current ModelCriteria
 * @method     ChildBookingForm[]|ObjectCollection findByBookingFormId(int $booking_form_id) Return ChildBookingForm objects filtered by the booking_form_id column
 * @method     ChildBookingForm[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookingForm objects filtered by the booking_id column
 * @method     ChildBookingForm[]|ObjectCollection findByFormId(int $form_id) Return ChildBookingForm objects filtered by the form_id column
 * @method     ChildBookingForm[]|ObjectCollection findByAuthorId(int $author_id) Return ChildBookingForm objects filtered by the author_id column
 * @method     ChildBookingForm[]|ObjectCollection findByEntryDate(string $entry_date) Return ChildBookingForm objects filtered by the entry_date column
 * @method     ChildBookingForm[]|ObjectCollection findByEditDate(string $edit_date) Return ChildBookingForm objects filtered by the edit_date column
 * @method     ChildBookingForm[]|ObjectCollection findByCompletedBy(int $completed_by) Return ChildBookingForm objects filtered by the completed_by column
 * @method     ChildBookingForm[]|ObjectCollection findByCompletedDate(string $completed_date) Return ChildBookingForm objects filtered by the completed_date column
 * @method     ChildBookingForm[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingFormQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingFormQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingForm', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingFormQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingFormQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingFormQuery) {
            return $criteria;
        }
        $query = new ChildBookingFormQuery();
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
     * @return ChildBookingForm|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingFormTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingFormTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBookingForm A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT booking_form_id, booking_id, form_id, author_id, entry_date, edit_date, completed_by, completed_date FROM tf_booking_form WHERE booking_form_id = :p0';
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
            /** @var ChildBookingForm $obj */
            $obj = new ChildBookingForm();
            $obj->hydrate($row);
            BookingFormTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBookingForm|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the booking_form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingFormId(1234); // WHERE booking_form_id = 1234
     * $query->filterByBookingFormId(array(12, 34)); // WHERE booking_form_id IN (12, 34)
     * $query->filterByBookingFormId(array('min' => 12)); // WHERE booking_form_id > 12
     * </code>
     *
     * @param     mixed $bookingFormId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByBookingFormId($bookingFormId = null, $comparison = null)
    {
        if (is_array($bookingFormId)) {
            $useMinMax = false;
            if (isset($bookingFormId['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $bookingFormId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingFormId['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $bookingFormId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $bookingFormId, $comparison);
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
     * @see       filterByBooking()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormId(1234); // WHERE form_id = 1234
     * $query->filterByFormId(array(12, 34)); // WHERE form_id IN (12, 34)
     * $query->filterByFormId(array('min' => 12)); // WHERE form_id > 12
     * </code>
     *
     * @see       filterByForm()
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_FORM_ID, $formId, $comparison);
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
     * @see       filterByUserRelatedByAuthorId()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_AUTHOR_ID, $authorId, $comparison);
    }

    /**
     * Filter the query on the entry_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryDate('2011-03-14'); // WHERE entry_date = '2011-03-14'
     * $query->filterByEntryDate('now'); // WHERE entry_date = '2011-03-14'
     * $query->filterByEntryDate(array('max' => 'yesterday')); // WHERE entry_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $entryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
    }

    /**
     * Filter the query on the edit_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEditDate('2011-03-14'); // WHERE edit_date = '2011-03-14'
     * $query->filterByEditDate('now'); // WHERE edit_date = '2011-03-14'
     * $query->filterByEditDate(array('max' => 'yesterday')); // WHERE edit_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $editDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query on the completed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletedBy(1234); // WHERE completed_by = 1234
     * $query->filterByCompletedBy(array(12, 34)); // WHERE completed_by IN (12, 34)
     * $query->filterByCompletedBy(array('min' => 12)); // WHERE completed_by > 12
     * </code>
     *
     * @see       filterByUserRelatedByCompletedBy()
     *
     * @param     mixed $completedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByCompletedBy($completedBy = null, $comparison = null)
    {
        if (is_array($completedBy)) {
            $useMinMax = false;
            if (isset($completedBy['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_BY, $completedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedBy['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_BY, $completedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_BY, $completedBy, $comparison);
    }

    /**
     * Filter the query on the completed_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletedDate('2011-03-14'); // WHERE completed_date = '2011-03-14'
     * $query->filterByCompletedDate('now'); // WHERE completed_date = '2011-03-14'
     * $query->filterByCompletedDate(array('max' => 'yesterday')); // WHERE completed_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $completedDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByCompletedDate($completedDate = null, $comparison = null)
    {
        if (is_array($completedDate)) {
            $useMinMax = false;
            if (isset($completedDate['min'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_DATE, $completedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedDate['max'])) {
                $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_DATE, $completedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormTableMap::COL_COMPLETED_DATE, $completedDate, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(BookingFormTableMap::COL_BOOKING_ID, $booking->getBookingId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormTableMap::COL_BOOKING_ID, $booking->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
        } else {
            throw new PropelException('filterByBooking() only accepts arguments of type \TheFarm\Models\Booking or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Booking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Booking');

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
            $this->addJoinObject($join, 'Booking');
        }

        return $this;
    }

    /**
     * Use the Booking relation Booking object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingQuery A secondary query class using the current class as primary query
     */
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Form object
     *
     * @param \TheFarm\Models\Form|ObjectCollection $form The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \TheFarm\Models\Form) {
            return $this
                ->addUsingAlias(BookingFormTableMap::COL_FORM_ID, $form->getFormId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormTableMap::COL_FORM_ID, $form->toKeyValue('PrimaryKey', 'FormId'), $comparison);
        } else {
            throw new PropelException('filterByForm() only accepts arguments of type \TheFarm\Models\Form or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Form relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function joinForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Form');

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
            $this->addJoinObject($join, 'Form');
        }

        return $this;
    }

    /**
     * Use the Form relation Form object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormQuery A secondary query class using the current class as primary query
     */
    public function useFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Form', '\TheFarm\Models\FormQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByAuthorId($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(BookingFormTableMap::COL_AUTHOR_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormTableMap::COL_AUTHOR_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function joinUserRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByAuthorId');

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
            $this->addJoinObject($join, 'UserRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByAuthorId relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByAuthorId', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByCompletedBy($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(BookingFormTableMap::COL_COMPLETED_BY, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormTableMap::COL_COMPLETED_BY, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByCompletedBy() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByCompletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function joinUserRelatedByCompletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByCompletedBy');

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
            $this->addJoinObject($join, 'UserRelatedByCompletedBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByCompletedBy relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByCompletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByCompletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByCompletedBy', '\TheFarm\Models\UserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingFormEntry object
     *
     * @param \TheFarm\Models\BookingFormEntry|ObjectCollection $bookingFormEntry the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingFormQuery The current query, for fluid interface
     */
    public function filterByBookingFormEntry($bookingFormEntry, $comparison = null)
    {
        if ($bookingFormEntry instanceof \TheFarm\Models\BookingFormEntry) {
            return $this
                ->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $bookingFormEntry->getBookingFormId(), $comparison);
        } elseif ($bookingFormEntry instanceof ObjectCollection) {
            return $this
                ->useBookingFormEntryQuery()
                ->filterByPrimaryKeys($bookingFormEntry->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingFormEntry() only accepts arguments of type \TheFarm\Models\BookingFormEntry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingFormEntry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function joinBookingFormEntry($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingFormEntry');

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
            $this->addJoinObject($join, 'BookingFormEntry');
        }

        return $this;
    }

    /**
     * Use the BookingFormEntry relation BookingFormEntry object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingFormEntryQuery A secondary query class using the current class as primary query
     */
    public function useBookingFormEntryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingFormEntry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingFormEntry', '\TheFarm\Models\BookingFormEntryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingForm $bookingForm Object to remove from the list of results
     *
     * @return $this|ChildBookingFormQuery The current query, for fluid interface
     */
    public function prune($bookingForm = null)
    {
        if ($bookingForm) {
            $this->addUsingAlias(BookingFormTableMap::COL_BOOKING_FORM_ID, $bookingForm->getBookingFormId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_form table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingFormTableMap::clearInstancePool();
            BookingFormTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingFormTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingFormTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingFormTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingFormQuery
