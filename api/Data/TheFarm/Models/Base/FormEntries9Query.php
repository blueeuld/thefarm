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
use TheFarm\Models\FormEntries9 as ChildFormEntries9;
use TheFarm\Models\FormEntries9Query as ChildFormEntries9Query;
use TheFarm\Models\Map\FormEntries9TableMap;

/**
 * Base class that represents a query for the 'tf_form_entries_9' table.
 *
 *
 *
 * @method     ChildFormEntries9Query orderByEntryId($order = Criteria::ASC) Order by the entry_id column
 * @method     ChildFormEntries9Query orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildFormEntries9Query orderByFieldId197($order = Criteria::ASC) Order by the field_id_197 column
 * @method     ChildFormEntries9Query orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildFormEntries9Query orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFormEntries9Query orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildFormEntries9Query orderByCompletedBy($order = Criteria::ASC) Order by the completed_by column
 * @method     ChildFormEntries9Query orderByCompletedDate($order = Criteria::ASC) Order by the completed_date column
 *
 * @method     ChildFormEntries9Query groupByEntryId() Group by the entry_id column
 * @method     ChildFormEntries9Query groupByBookingId() Group by the booking_id column
 * @method     ChildFormEntries9Query groupByFieldId197() Group by the field_id_197 column
 * @method     ChildFormEntries9Query groupByAuthorId() Group by the author_id column
 * @method     ChildFormEntries9Query groupByEntryDate() Group by the entry_date column
 * @method     ChildFormEntries9Query groupByEditDate() Group by the edit_date column
 * @method     ChildFormEntries9Query groupByCompletedBy() Group by the completed_by column
 * @method     ChildFormEntries9Query groupByCompletedDate() Group by the completed_date column
 *
 * @method     ChildFormEntries9Query leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormEntries9Query rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormEntries9Query innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormEntries9Query leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormEntries9Query rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormEntries9Query innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormEntries9 findOne(ConnectionInterface $con = null) Return the first ChildFormEntries9 matching the query
 * @method     ChildFormEntries9 findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormEntries9 matching the query, or a new ChildFormEntries9 object populated from the query conditions when no match is found
 *
 * @method     ChildFormEntries9 findOneByEntryId(int $entry_id) Return the first ChildFormEntries9 filtered by the entry_id column
 * @method     ChildFormEntries9 findOneByBookingId(int $booking_id) Return the first ChildFormEntries9 filtered by the booking_id column
 * @method     ChildFormEntries9 findOneByFieldId197(string $field_id_197) Return the first ChildFormEntries9 filtered by the field_id_197 column
 * @method     ChildFormEntries9 findOneByAuthorId(int $author_id) Return the first ChildFormEntries9 filtered by the author_id column
 * @method     ChildFormEntries9 findOneByEntryDate(int $entry_date) Return the first ChildFormEntries9 filtered by the entry_date column
 * @method     ChildFormEntries9 findOneByEditDate(int $edit_date) Return the first ChildFormEntries9 filtered by the edit_date column
 * @method     ChildFormEntries9 findOneByCompletedBy(int $completed_by) Return the first ChildFormEntries9 filtered by the completed_by column
 * @method     ChildFormEntries9 findOneByCompletedDate(int $completed_date) Return the first ChildFormEntries9 filtered by the completed_date column *

 * @method     ChildFormEntries9 requirePk($key, ConnectionInterface $con = null) Return the ChildFormEntries9 by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOne(ConnectionInterface $con = null) Return the first ChildFormEntries9 matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries9 requireOneByEntryId(int $entry_id) Return the first ChildFormEntries9 filtered by the entry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByBookingId(int $booking_id) Return the first ChildFormEntries9 filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByFieldId197(string $field_id_197) Return the first ChildFormEntries9 filtered by the field_id_197 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByAuthorId(int $author_id) Return the first ChildFormEntries9 filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByEntryDate(int $entry_date) Return the first ChildFormEntries9 filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByEditDate(int $edit_date) Return the first ChildFormEntries9 filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByCompletedBy(int $completed_by) Return the first ChildFormEntries9 filtered by the completed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries9 requireOneByCompletedDate(int $completed_date) Return the first ChildFormEntries9 filtered by the completed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries9[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormEntries9 objects based on current ModelCriteria
 * @method     ChildFormEntries9[]|ObjectCollection findByEntryId(int $entry_id) Return ChildFormEntries9 objects filtered by the entry_id column
 * @method     ChildFormEntries9[]|ObjectCollection findByBookingId(int $booking_id) Return ChildFormEntries9 objects filtered by the booking_id column
 * @method     ChildFormEntries9[]|ObjectCollection findByFieldId197(string $field_id_197) Return ChildFormEntries9 objects filtered by the field_id_197 column
 * @method     ChildFormEntries9[]|ObjectCollection findByAuthorId(int $author_id) Return ChildFormEntries9 objects filtered by the author_id column
 * @method     ChildFormEntries9[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildFormEntries9 objects filtered by the entry_date column
 * @method     ChildFormEntries9[]|ObjectCollection findByEditDate(int $edit_date) Return ChildFormEntries9 objects filtered by the edit_date column
 * @method     ChildFormEntries9[]|ObjectCollection findByCompletedBy(int $completed_by) Return ChildFormEntries9 objects filtered by the completed_by column
 * @method     ChildFormEntries9[]|ObjectCollection findByCompletedDate(int $completed_date) Return ChildFormEntries9 objects filtered by the completed_date column
 * @method     ChildFormEntries9[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormEntries9Query extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormEntries9Query object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormEntries9', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormEntries9Query object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormEntries9Query
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormEntries9Query) {
            return $criteria;
        }
        $query = new ChildFormEntries9Query();
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
     * @return ChildFormEntries9|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormEntries9TableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormEntries9TableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormEntries9 A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entry_id, booking_id, field_id_197, author_id, entry_date, edit_date, completed_by, completed_date FROM tf_form_entries_9 WHERE entry_id = :p0';
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
            /** @var ChildFormEntries9 $obj */
            $obj = new ChildFormEntries9();
            $obj->hydrate($row);
            FormEntries9TableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormEntries9|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the entry_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryId(1234); // WHERE entry_id = 1234
     * $query->filterByEntryId(array(12, 34)); // WHERE entry_id IN (12, 34)
     * $query->filterByEntryId(array('min' => 12)); // WHERE entry_id > 12
     * </code>
     *
     * @param     mixed $entryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByEntryId($entryId = null, $comparison = null)
    {
        if (is_array($entryId)) {
            $useMinMax = false;
            if (isset($entryId['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $entryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryId['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $entryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $entryId, $comparison);
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the field_id_197 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId197('fooValue');   // WHERE field_id_197 = 'fooValue'
     * $query->filterByFieldId197('%fooValue%', Criteria::LIKE); // WHERE field_id_197 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId197 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByFieldId197($fieldId197 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId197)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_FIELD_ID_197, $fieldId197, $comparison);
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
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_EDIT_DATE, $editDate, $comparison);
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByCompletedBy($completedBy = null, $comparison = null)
    {
        if (is_array($completedBy)) {
            $useMinMax = false;
            if (isset($completedBy['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_BY, $completedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedBy['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_BY, $completedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_BY, $completedBy, $comparison);
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
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function filterByCompletedDate($completedDate = null, $comparison = null)
    {
        if (is_array($completedDate)) {
            $useMinMax = false;
            if (isset($completedDate['min'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_DATE, $completedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedDate['max'])) {
                $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_DATE, $completedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries9TableMap::COL_COMPLETED_DATE, $completedDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormEntries9 $formEntries9 Object to remove from the list of results
     *
     * @return $this|ChildFormEntries9Query The current query, for fluid interface
     */
    public function prune($formEntries9 = null)
    {
        if ($formEntries9) {
            $this->addUsingAlias(FormEntries9TableMap::COL_ENTRY_ID, $formEntries9->getEntryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_entries_9 table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries9TableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormEntries9TableMap::clearInstancePool();
            FormEntries9TableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries9TableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormEntries9TableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormEntries9TableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormEntries9TableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormEntries9Query
