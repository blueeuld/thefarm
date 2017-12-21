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
use TheFarm\Models\FormEntries6 as ChildFormEntries6;
use TheFarm\Models\FormEntries6Query as ChildFormEntries6Query;
use TheFarm\Models\Map\FormEntries6TableMap;

/**
 * Base class that represents a query for the 'tf_form_entries_6' table.
 *
 *
 *
 * @method     ChildFormEntries6Query orderByEntryId($order = Criteria::ASC) Order by the entry_id column
 * @method     ChildFormEntries6Query orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildFormEntries6Query orderByFieldId18($order = Criteria::ASC) Order by the field_id_18 column
 * @method     ChildFormEntries6Query orderByFieldId17($order = Criteria::ASC) Order by the field_id_17 column
 * @method     ChildFormEntries6Query orderByFieldId5($order = Criteria::ASC) Order by the field_id_5 column
 * @method     ChildFormEntries6Query orderByFieldId4($order = Criteria::ASC) Order by the field_id_4 column
 * @method     ChildFormEntries6Query orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildFormEntries6Query orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFormEntries6Query orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildFormEntries6Query orderByCompletedBy($order = Criteria::ASC) Order by the completed_by column
 * @method     ChildFormEntries6Query orderByCompletedDate($order = Criteria::ASC) Order by the completed_date column
 *
 * @method     ChildFormEntries6Query groupByEntryId() Group by the entry_id column
 * @method     ChildFormEntries6Query groupByBookingId() Group by the booking_id column
 * @method     ChildFormEntries6Query groupByFieldId18() Group by the field_id_18 column
 * @method     ChildFormEntries6Query groupByFieldId17() Group by the field_id_17 column
 * @method     ChildFormEntries6Query groupByFieldId5() Group by the field_id_5 column
 * @method     ChildFormEntries6Query groupByFieldId4() Group by the field_id_4 column
 * @method     ChildFormEntries6Query groupByAuthorId() Group by the author_id column
 * @method     ChildFormEntries6Query groupByEntryDate() Group by the entry_date column
 * @method     ChildFormEntries6Query groupByEditDate() Group by the edit_date column
 * @method     ChildFormEntries6Query groupByCompletedBy() Group by the completed_by column
 * @method     ChildFormEntries6Query groupByCompletedDate() Group by the completed_date column
 *
 * @method     ChildFormEntries6Query leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormEntries6Query rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormEntries6Query innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormEntries6Query leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormEntries6Query rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormEntries6Query innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormEntries6 findOne(ConnectionInterface $con = null) Return the first ChildFormEntries6 matching the query
 * @method     ChildFormEntries6 findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormEntries6 matching the query, or a new ChildFormEntries6 object populated from the query conditions when no match is found
 *
 * @method     ChildFormEntries6 findOneByEntryId(int $entry_id) Return the first ChildFormEntries6 filtered by the entry_id column
 * @method     ChildFormEntries6 findOneByBookingId(int $booking_id) Return the first ChildFormEntries6 filtered by the booking_id column
 * @method     ChildFormEntries6 findOneByFieldId18(string $field_id_18) Return the first ChildFormEntries6 filtered by the field_id_18 column
 * @method     ChildFormEntries6 findOneByFieldId17(string $field_id_17) Return the first ChildFormEntries6 filtered by the field_id_17 column
 * @method     ChildFormEntries6 findOneByFieldId5(string $field_id_5) Return the first ChildFormEntries6 filtered by the field_id_5 column
 * @method     ChildFormEntries6 findOneByFieldId4(string $field_id_4) Return the first ChildFormEntries6 filtered by the field_id_4 column
 * @method     ChildFormEntries6 findOneByAuthorId(int $author_id) Return the first ChildFormEntries6 filtered by the author_id column
 * @method     ChildFormEntries6 findOneByEntryDate(int $entry_date) Return the first ChildFormEntries6 filtered by the entry_date column
 * @method     ChildFormEntries6 findOneByEditDate(int $edit_date) Return the first ChildFormEntries6 filtered by the edit_date column
 * @method     ChildFormEntries6 findOneByCompletedBy(int $completed_by) Return the first ChildFormEntries6 filtered by the completed_by column
 * @method     ChildFormEntries6 findOneByCompletedDate(int $completed_date) Return the first ChildFormEntries6 filtered by the completed_date column *

 * @method     ChildFormEntries6 requirePk($key, ConnectionInterface $con = null) Return the ChildFormEntries6 by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOne(ConnectionInterface $con = null) Return the first ChildFormEntries6 matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries6 requireOneByEntryId(int $entry_id) Return the first ChildFormEntries6 filtered by the entry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByBookingId(int $booking_id) Return the first ChildFormEntries6 filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByFieldId18(string $field_id_18) Return the first ChildFormEntries6 filtered by the field_id_18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByFieldId17(string $field_id_17) Return the first ChildFormEntries6 filtered by the field_id_17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByFieldId5(string $field_id_5) Return the first ChildFormEntries6 filtered by the field_id_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByFieldId4(string $field_id_4) Return the first ChildFormEntries6 filtered by the field_id_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByAuthorId(int $author_id) Return the first ChildFormEntries6 filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByEntryDate(int $entry_date) Return the first ChildFormEntries6 filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByEditDate(int $edit_date) Return the first ChildFormEntries6 filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByCompletedBy(int $completed_by) Return the first ChildFormEntries6 filtered by the completed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries6 requireOneByCompletedDate(int $completed_date) Return the first ChildFormEntries6 filtered by the completed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries6[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormEntries6 objects based on current ModelCriteria
 * @method     ChildFormEntries6[]|ObjectCollection findByEntryId(int $entry_id) Return ChildFormEntries6 objects filtered by the entry_id column
 * @method     ChildFormEntries6[]|ObjectCollection findByBookingId(int $booking_id) Return ChildFormEntries6 objects filtered by the booking_id column
 * @method     ChildFormEntries6[]|ObjectCollection findByFieldId18(string $field_id_18) Return ChildFormEntries6 objects filtered by the field_id_18 column
 * @method     ChildFormEntries6[]|ObjectCollection findByFieldId17(string $field_id_17) Return ChildFormEntries6 objects filtered by the field_id_17 column
 * @method     ChildFormEntries6[]|ObjectCollection findByFieldId5(string $field_id_5) Return ChildFormEntries6 objects filtered by the field_id_5 column
 * @method     ChildFormEntries6[]|ObjectCollection findByFieldId4(string $field_id_4) Return ChildFormEntries6 objects filtered by the field_id_4 column
 * @method     ChildFormEntries6[]|ObjectCollection findByAuthorId(int $author_id) Return ChildFormEntries6 objects filtered by the author_id column
 * @method     ChildFormEntries6[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildFormEntries6 objects filtered by the entry_date column
 * @method     ChildFormEntries6[]|ObjectCollection findByEditDate(int $edit_date) Return ChildFormEntries6 objects filtered by the edit_date column
 * @method     ChildFormEntries6[]|ObjectCollection findByCompletedBy(int $completed_by) Return ChildFormEntries6 objects filtered by the completed_by column
 * @method     ChildFormEntries6[]|ObjectCollection findByCompletedDate(int $completed_date) Return ChildFormEntries6 objects filtered by the completed_date column
 * @method     ChildFormEntries6[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormEntries6Query extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormEntries6Query object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormEntries6', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormEntries6Query object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormEntries6Query
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormEntries6Query) {
            return $criteria;
        }
        $query = new ChildFormEntries6Query();
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
     * @return ChildFormEntries6|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormEntries6TableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormEntries6TableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormEntries6 A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entry_id, booking_id, field_id_18, field_id_17, field_id_5, field_id_4, author_id, entry_date, edit_date, completed_by, completed_date FROM tf_form_entries_6 WHERE entry_id = :p0';
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
            /** @var ChildFormEntries6 $obj */
            $obj = new ChildFormEntries6();
            $obj->hydrate($row);
            FormEntries6TableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormEntries6|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByEntryId($entryId = null, $comparison = null)
    {
        if (is_array($entryId)) {
            $useMinMax = false;
            if (isset($entryId['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $entryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryId['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $entryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $entryId, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the field_id_18 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId18('fooValue');   // WHERE field_id_18 = 'fooValue'
     * $query->filterByFieldId18('%fooValue%', Criteria::LIKE); // WHERE field_id_18 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId18 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByFieldId18($fieldId18 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId18)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_FIELD_ID_18, $fieldId18, $comparison);
    }

    /**
     * Filter the query on the field_id_17 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId17('fooValue');   // WHERE field_id_17 = 'fooValue'
     * $query->filterByFieldId17('%fooValue%', Criteria::LIKE); // WHERE field_id_17 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId17 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByFieldId17($fieldId17 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId17)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_FIELD_ID_17, $fieldId17, $comparison);
    }

    /**
     * Filter the query on the field_id_5 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId5('fooValue');   // WHERE field_id_5 = 'fooValue'
     * $query->filterByFieldId5('%fooValue%', Criteria::LIKE); // WHERE field_id_5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId5 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByFieldId5($fieldId5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_FIELD_ID_5, $fieldId5, $comparison);
    }

    /**
     * Filter the query on the field_id_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId4('fooValue');   // WHERE field_id_4 = 'fooValue'
     * $query->filterByFieldId4('%fooValue%', Criteria::LIKE); // WHERE field_id_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId4 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByFieldId4($fieldId4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_FIELD_ID_4, $fieldId4, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_EDIT_DATE, $editDate, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByCompletedBy($completedBy = null, $comparison = null)
    {
        if (is_array($completedBy)) {
            $useMinMax = false;
            if (isset($completedBy['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_BY, $completedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedBy['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_BY, $completedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_BY, $completedBy, $comparison);
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
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function filterByCompletedDate($completedDate = null, $comparison = null)
    {
        if (is_array($completedDate)) {
            $useMinMax = false;
            if (isset($completedDate['min'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_DATE, $completedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedDate['max'])) {
                $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_DATE, $completedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries6TableMap::COL_COMPLETED_DATE, $completedDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormEntries6 $formEntries6 Object to remove from the list of results
     *
     * @return $this|ChildFormEntries6Query The current query, for fluid interface
     */
    public function prune($formEntries6 = null)
    {
        if ($formEntries6) {
            $this->addUsingAlias(FormEntries6TableMap::COL_ENTRY_ID, $formEntries6->getEntryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_entries_6 table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries6TableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormEntries6TableMap::clearInstancePool();
            FormEntries6TableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries6TableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormEntries6TableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormEntries6TableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormEntries6TableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormEntries6Query
