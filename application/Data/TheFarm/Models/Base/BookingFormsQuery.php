<?php

namespace TheFarm\Models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\BookingForms as ChildBookingForms;
use TheFarm\Models\BookingFormsQuery as ChildBookingFormsQuery;
use TheFarm\Models\Map\BookingFormsTableMap;

/**
 * Base class that represents a query for the 'tf_booking_forms' table.
 *
 *
 *
 * @method     ChildBookingFormsQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingFormsQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildBookingFormsQuery orderByRequired($order = Criteria::ASC) Order by the required column
 * @method     ChildBookingFormsQuery orderBySubmitted($order = Criteria::ASC) Order by the submitted column
 * @method     ChildBookingFormsQuery orderByNotifyUserOnSubmit($order = Criteria::ASC) Order by the notify_user_on_submit column
 * @method     ChildBookingFormsQuery orderBySubmittedDate($order = Criteria::ASC) Order by the submitted_date column
 * @method     ChildBookingFormsQuery orderByCompletedBy($order = Criteria::ASC) Order by the completed_by column
 * @method     ChildBookingFormsQuery orderByCompletedDate($order = Criteria::ASC) Order by the completed_date column
 *
 * @method     ChildBookingFormsQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingFormsQuery groupByFormId() Group by the form_id column
 * @method     ChildBookingFormsQuery groupByRequired() Group by the required column
 * @method     ChildBookingFormsQuery groupBySubmitted() Group by the submitted column
 * @method     ChildBookingFormsQuery groupByNotifyUserOnSubmit() Group by the notify_user_on_submit column
 * @method     ChildBookingFormsQuery groupBySubmittedDate() Group by the submitted_date column
 * @method     ChildBookingFormsQuery groupByCompletedBy() Group by the completed_by column
 * @method     ChildBookingFormsQuery groupByCompletedDate() Group by the completed_date column
 *
 * @method     ChildBookingFormsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingFormsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingFormsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingFormsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingFormsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingFormsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingForms findOne(ConnectionInterface $con = null) Return the first ChildBookingForms matching the query
 * @method     ChildBookingForms findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingForms matching the query, or a new ChildBookingForms object populated from the query conditions when no match is found
 *
 * @method     ChildBookingForms findOneByBookingId(int $booking_id) Return the first ChildBookingForms filtered by the booking_id column
 * @method     ChildBookingForms findOneByFormId(int $form_id) Return the first ChildBookingForms filtered by the form_id column
 * @method     ChildBookingForms findOneByRequired(string $required) Return the first ChildBookingForms filtered by the required column
 * @method     ChildBookingForms findOneBySubmitted(string $submitted) Return the first ChildBookingForms filtered by the submitted column
 * @method     ChildBookingForms findOneByNotifyUserOnSubmit(string $notify_user_on_submit) Return the first ChildBookingForms filtered by the notify_user_on_submit column
 * @method     ChildBookingForms findOneBySubmittedDate(int $submitted_date) Return the first ChildBookingForms filtered by the submitted_date column
 * @method     ChildBookingForms findOneByCompletedBy(int $completed_by) Return the first ChildBookingForms filtered by the completed_by column
 * @method     ChildBookingForms findOneByCompletedDate(int $completed_date) Return the first ChildBookingForms filtered by the completed_date column *

 * @method     ChildBookingForms requirePk($key, ConnectionInterface $con = null) Return the ChildBookingForms by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOne(ConnectionInterface $con = null) Return the first ChildBookingForms matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingForms requireOneByBookingId(int $booking_id) Return the first ChildBookingForms filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneByFormId(int $form_id) Return the first ChildBookingForms filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneByRequired(string $required) Return the first ChildBookingForms filtered by the required column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneBySubmitted(string $submitted) Return the first ChildBookingForms filtered by the submitted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneByNotifyUserOnSubmit(string $notify_user_on_submit) Return the first ChildBookingForms filtered by the notify_user_on_submit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneBySubmittedDate(int $submitted_date) Return the first ChildBookingForms filtered by the submitted_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneByCompletedBy(int $completed_by) Return the first ChildBookingForms filtered by the completed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingForms requireOneByCompletedDate(int $completed_date) Return the first ChildBookingForms filtered by the completed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingForms[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingForms objects based on current ModelCriteria
 * @method     ChildBookingForms[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookingForms objects filtered by the booking_id column
 * @method     ChildBookingForms[]|ObjectCollection findByFormId(int $form_id) Return ChildBookingForms objects filtered by the form_id column
 * @method     ChildBookingForms[]|ObjectCollection findByRequired(string $required) Return ChildBookingForms objects filtered by the required column
 * @method     ChildBookingForms[]|ObjectCollection findBySubmitted(string $submitted) Return ChildBookingForms objects filtered by the submitted column
 * @method     ChildBookingForms[]|ObjectCollection findByNotifyUserOnSubmit(string $notify_user_on_submit) Return ChildBookingForms objects filtered by the notify_user_on_submit column
 * @method     ChildBookingForms[]|ObjectCollection findBySubmittedDate(int $submitted_date) Return ChildBookingForms objects filtered by the submitted_date column
 * @method     ChildBookingForms[]|ObjectCollection findByCompletedBy(int $completed_by) Return ChildBookingForms objects filtered by the completed_by column
 * @method     ChildBookingForms[]|ObjectCollection findByCompletedDate(int $completed_date) Return ChildBookingForms objects filtered by the completed_date column
 * @method     ChildBookingForms[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingFormsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingFormsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingForms', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingFormsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingFormsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingFormsQuery) {
            return $criteria;
        }
        $query = new ChildBookingFormsQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$booking_id, $form_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBookingForms|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingFormsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingFormsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBookingForms A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT booking_id, form_id, required, submitted, notify_user_on_submit, submitted_date, completed_by, completed_date FROM tf_booking_forms WHERE booking_id = :p0 AND form_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBookingForms $obj */
            $obj = new ChildBookingForms();
            $obj->hydrate($row);
            BookingFormsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBookingForms|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BookingFormsTableMap::COL_BOOKING_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BookingFormsTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BookingFormsTableMap::COL_BOOKING_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BookingFormsTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the required column
     *
     * Example usage:
     * <code>
     * $query->filterByRequired('fooValue');   // WHERE required = 'fooValue'
     * $query->filterByRequired('%fooValue%', Criteria::LIKE); // WHERE required LIKE '%fooValue%'
     * </code>
     *
     * @param     string $required The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByRequired($required = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($required)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_REQUIRED, $required, $comparison);
    }

    /**
     * Filter the query on the submitted column
     *
     * Example usage:
     * <code>
     * $query->filterBySubmitted('fooValue');   // WHERE submitted = 'fooValue'
     * $query->filterBySubmitted('%fooValue%', Criteria::LIKE); // WHERE submitted LIKE '%fooValue%'
     * </code>
     *
     * @param     string $submitted The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterBySubmitted($submitted = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($submitted)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_SUBMITTED, $submitted, $comparison);
    }

    /**
     * Filter the query on the notify_user_on_submit column
     *
     * Example usage:
     * <code>
     * $query->filterByNotifyUserOnSubmit('fooValue');   // WHERE notify_user_on_submit = 'fooValue'
     * $query->filterByNotifyUserOnSubmit('%fooValue%', Criteria::LIKE); // WHERE notify_user_on_submit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notifyUserOnSubmit The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByNotifyUserOnSubmit($notifyUserOnSubmit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notifyUserOnSubmit)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_NOTIFY_USER_ON_SUBMIT, $notifyUserOnSubmit, $comparison);
    }

    /**
     * Filter the query on the submitted_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySubmittedDate(1234); // WHERE submitted_date = 1234
     * $query->filterBySubmittedDate(array(12, 34)); // WHERE submitted_date IN (12, 34)
     * $query->filterBySubmittedDate(array('min' => 12)); // WHERE submitted_date > 12
     * </code>
     *
     * @param     mixed $submittedDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterBySubmittedDate($submittedDate = null, $comparison = null)
    {
        if (is_array($submittedDate)) {
            $useMinMax = false;
            if (isset($submittedDate['min'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_SUBMITTED_DATE, $submittedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($submittedDate['max'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_SUBMITTED_DATE, $submittedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_SUBMITTED_DATE, $submittedDate, $comparison);
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
     * @param     mixed $completedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByCompletedBy($completedBy = null, $comparison = null)
    {
        if (is_array($completedBy)) {
            $useMinMax = false;
            if (isset($completedBy['min'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_BY, $completedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedBy['max'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_BY, $completedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_BY, $completedBy, $comparison);
    }

    /**
     * Filter the query on the completed_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletedDate(1234); // WHERE completed_date = 1234
     * $query->filterByCompletedDate(array(12, 34)); // WHERE completed_date IN (12, 34)
     * $query->filterByCompletedDate(array('min' => 12)); // WHERE completed_date > 12
     * </code>
     *
     * @param     mixed $completedDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function filterByCompletedDate($completedDate = null, $comparison = null)
    {
        if (is_array($completedDate)) {
            $useMinMax = false;
            if (isset($completedDate['min'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_DATE, $completedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedDate['max'])) {
                $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_DATE, $completedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormsTableMap::COL_COMPLETED_DATE, $completedDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingForms $bookingForms Object to remove from the list of results
     *
     * @return $this|ChildBookingFormsQuery The current query, for fluid interface
     */
    public function prune($bookingForms = null)
    {
        if ($bookingForms) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BookingFormsTableMap::COL_BOOKING_ID), $bookingForms->getBookingId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BookingFormsTableMap::COL_FORM_ID), $bookingForms->getFormId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_forms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingFormsTableMap::clearInstancePool();
            BookingFormsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingFormsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingFormsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingFormsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingFormsQuery
