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
use TheFarm\Models\FormEntries as ChildFormEntries;
use TheFarm\Models\FormEntriesQuery as ChildFormEntriesQuery;
use TheFarm\Models\Map\FormEntriesTableMap;

/**
 * Base class that represents a query for the 'tf_form_entries' table.
 *
 *
 *
 * @method     ChildFormEntriesQuery orderByEntryId($order = Criteria::ASC) Order by the entry_id column
 * @method     ChildFormEntriesQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildFormEntriesQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildFormEntriesQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFormEntriesQuery orderByFieldTextValue($order = Criteria::ASC) Order by the field_text_value column
 * @method     ChildFormEntriesQuery orderByFieldDropdownValue($order = Criteria::ASC) Order by the field_dropdown_value column
 * @method     ChildFormEntriesQuery orderByFieldCheckboxesValue($order = Criteria::ASC) Order by the field_checkboxes_value column
 *
 * @method     ChildFormEntriesQuery groupByEntryId() Group by the entry_id column
 * @method     ChildFormEntriesQuery groupByBookingId() Group by the booking_id column
 * @method     ChildFormEntriesQuery groupByFormId() Group by the form_id column
 * @method     ChildFormEntriesQuery groupByFieldId() Group by the field_id column
 * @method     ChildFormEntriesQuery groupByFieldTextValue() Group by the field_text_value column
 * @method     ChildFormEntriesQuery groupByFieldDropdownValue() Group by the field_dropdown_value column
 * @method     ChildFormEntriesQuery groupByFieldCheckboxesValue() Group by the field_checkboxes_value column
 *
 * @method     ChildFormEntriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormEntriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormEntriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormEntriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormEntriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormEntriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormEntriesQuery leftJoinBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookings relation
 * @method     ChildFormEntriesQuery rightJoinBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookings relation
 * @method     ChildFormEntriesQuery innerJoinBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookings relation
 *
 * @method     ChildFormEntriesQuery joinWithBookings($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookings relation
 *
 * @method     ChildFormEntriesQuery leftJoinWithBookings() Adds a LEFT JOIN clause and with to the query using the Bookings relation
 * @method     ChildFormEntriesQuery rightJoinWithBookings() Adds a RIGHT JOIN clause and with to the query using the Bookings relation
 * @method     ChildFormEntriesQuery innerJoinWithBookings() Adds a INNER JOIN clause and with to the query using the Bookings relation
 *
 * @method     ChildFormEntriesQuery leftJoinFields($relationAlias = null) Adds a LEFT JOIN clause to the query using the Fields relation
 * @method     ChildFormEntriesQuery rightJoinFields($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Fields relation
 * @method     ChildFormEntriesQuery innerJoinFields($relationAlias = null) Adds a INNER JOIN clause to the query using the Fields relation
 *
 * @method     ChildFormEntriesQuery joinWithFields($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Fields relation
 *
 * @method     ChildFormEntriesQuery leftJoinWithFields() Adds a LEFT JOIN clause and with to the query using the Fields relation
 * @method     ChildFormEntriesQuery rightJoinWithFields() Adds a RIGHT JOIN clause and with to the query using the Fields relation
 * @method     ChildFormEntriesQuery innerJoinWithFields() Adds a INNER JOIN clause and with to the query using the Fields relation
 *
 * @method     ChildFormEntriesQuery leftJoinForms($relationAlias = null) Adds a LEFT JOIN clause to the query using the Forms relation
 * @method     ChildFormEntriesQuery rightJoinForms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Forms relation
 * @method     ChildFormEntriesQuery innerJoinForms($relationAlias = null) Adds a INNER JOIN clause to the query using the Forms relation
 *
 * @method     ChildFormEntriesQuery joinWithForms($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Forms relation
 *
 * @method     ChildFormEntriesQuery leftJoinWithForms() Adds a LEFT JOIN clause and with to the query using the Forms relation
 * @method     ChildFormEntriesQuery rightJoinWithForms() Adds a RIGHT JOIN clause and with to the query using the Forms relation
 * @method     ChildFormEntriesQuery innerJoinWithForms() Adds a INNER JOIN clause and with to the query using the Forms relation
 *
 * @method     \TheFarm\Models\BookingsQuery|\TheFarm\Models\FieldsQuery|\TheFarm\Models\FormsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFormEntries findOne(ConnectionInterface $con = null) Return the first ChildFormEntries matching the query
 * @method     ChildFormEntries findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormEntries matching the query, or a new ChildFormEntries object populated from the query conditions when no match is found
 *
 * @method     ChildFormEntries findOneByEntryId(int $entry_id) Return the first ChildFormEntries filtered by the entry_id column
 * @method     ChildFormEntries findOneByBookingId(int $booking_id) Return the first ChildFormEntries filtered by the booking_id column
 * @method     ChildFormEntries findOneByFormId(int $form_id) Return the first ChildFormEntries filtered by the form_id column
 * @method     ChildFormEntries findOneByFieldId(int $field_id) Return the first ChildFormEntries filtered by the field_id column
 * @method     ChildFormEntries findOneByFieldTextValue(string $field_text_value) Return the first ChildFormEntries filtered by the field_text_value column
 * @method     ChildFormEntries findOneByFieldDropdownValue(string $field_dropdown_value) Return the first ChildFormEntries filtered by the field_dropdown_value column
 * @method     ChildFormEntries findOneByFieldCheckboxesValue(string $field_checkboxes_value) Return the first ChildFormEntries filtered by the field_checkboxes_value column *

 * @method     ChildFormEntries requirePk($key, ConnectionInterface $con = null) Return the ChildFormEntries by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOne(ConnectionInterface $con = null) Return the first ChildFormEntries matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries requireOneByEntryId(int $entry_id) Return the first ChildFormEntries filtered by the entry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByBookingId(int $booking_id) Return the first ChildFormEntries filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByFormId(int $form_id) Return the first ChildFormEntries filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByFieldId(int $field_id) Return the first ChildFormEntries filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByFieldTextValue(string $field_text_value) Return the first ChildFormEntries filtered by the field_text_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByFieldDropdownValue(string $field_dropdown_value) Return the first ChildFormEntries filtered by the field_dropdown_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries requireOneByFieldCheckboxesValue(string $field_checkboxes_value) Return the first ChildFormEntries filtered by the field_checkboxes_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormEntries objects based on current ModelCriteria
 * @method     ChildFormEntries[]|ObjectCollection findByEntryId(int $entry_id) Return ChildFormEntries objects filtered by the entry_id column
 * @method     ChildFormEntries[]|ObjectCollection findByBookingId(int $booking_id) Return ChildFormEntries objects filtered by the booking_id column
 * @method     ChildFormEntries[]|ObjectCollection findByFormId(int $form_id) Return ChildFormEntries objects filtered by the form_id column
 * @method     ChildFormEntries[]|ObjectCollection findByFieldId(int $field_id) Return ChildFormEntries objects filtered by the field_id column
 * @method     ChildFormEntries[]|ObjectCollection findByFieldTextValue(string $field_text_value) Return ChildFormEntries objects filtered by the field_text_value column
 * @method     ChildFormEntries[]|ObjectCollection findByFieldDropdownValue(string $field_dropdown_value) Return ChildFormEntries objects filtered by the field_dropdown_value column
 * @method     ChildFormEntries[]|ObjectCollection findByFieldCheckboxesValue(string $field_checkboxes_value) Return ChildFormEntries objects filtered by the field_checkboxes_value column
 * @method     ChildFormEntries[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormEntriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormEntriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormEntries', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormEntriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormEntriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormEntriesQuery) {
            return $criteria;
        }
        $query = new ChildFormEntriesQuery();
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
     * @return ChildFormEntries|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormEntriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormEntriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormEntries A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entry_id, booking_id, form_id, field_id, field_text_value, field_dropdown_value, field_checkboxes_value FROM tf_form_entries WHERE entry_id = :p0';
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
            /** @var ChildFormEntries $obj */
            $obj = new ChildFormEntries();
            $obj->hydrate($row);
            FormEntriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormEntries|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByEntryId($entryId = null, $comparison = null)
    {
        if (is_array($entryId)) {
            $useMinMax = false;
            if (isset($entryId['min'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $entryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryId['max'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $entryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $entryId, $comparison);
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
     * @see       filterByBookings()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @see       filterByForms()
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the field_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId(1234); // WHERE field_id = 1234
     * $query->filterByFieldId(array(12, 34)); // WHERE field_id IN (12, 34)
     * $query->filterByFieldId(array('min' => 12)); // WHERE field_id > 12
     * </code>
     *
     * @see       filterByFields()
     *
     * @param     mixed $fieldId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_ID, $fieldId, $comparison);
    }

    /**
     * Filter the query on the field_text_value column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldTextValue('fooValue');   // WHERE field_text_value = 'fooValue'
     * $query->filterByFieldTextValue('%fooValue%', Criteria::LIKE); // WHERE field_text_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldTextValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFieldTextValue($fieldTextValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldTextValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_TEXT_VALUE, $fieldTextValue, $comparison);
    }

    /**
     * Filter the query on the field_dropdown_value column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldDropdownValue('fooValue');   // WHERE field_dropdown_value = 'fooValue'
     * $query->filterByFieldDropdownValue('%fooValue%', Criteria::LIKE); // WHERE field_dropdown_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldDropdownValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFieldDropdownValue($fieldDropdownValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldDropdownValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_DROPDOWN_VALUE, $fieldDropdownValue, $comparison);
    }

    /**
     * Filter the query on the field_checkboxes_value column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldCheckboxesValue('fooValue');   // WHERE field_checkboxes_value = 'fooValue'
     * $query->filterByFieldCheckboxesValue('%fooValue%', Criteria::LIKE); // WHERE field_checkboxes_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldCheckboxesValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFieldCheckboxesValue($fieldCheckboxesValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldCheckboxesValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntriesTableMap::COL_FIELD_CHECKBOXES_VALUE, $fieldCheckboxesValue, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByBookings($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_BOOKING_ID, $bookings->getBookingId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_BOOKING_ID, $bookings->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
        } else {
            throw new PropelException('filterByBookings() only accepts arguments of type \TheFarm\Models\Bookings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bookings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function joinBookings($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bookings');

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
            $this->addJoinObject($join, 'Bookings');
        }

        return $this;
    }

    /**
     * Use the Bookings relation Bookings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingsQuery A secondary query class using the current class as primary query
     */
    public function useBookingsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bookings', '\TheFarm\Models\BookingsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Fields object
     *
     * @param \TheFarm\Models\Fields|ObjectCollection $fields The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByFields($fields, $comparison = null)
    {
        if ($fields instanceof \TheFarm\Models\Fields) {
            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_FIELD_ID, $fields->getFieldId(), $comparison);
        } elseif ($fields instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_FIELD_ID, $fields->toKeyValue('PrimaryKey', 'FieldId'), $comparison);
        } else {
            throw new PropelException('filterByFields() only accepts arguments of type \TheFarm\Models\Fields or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Fields relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function joinFields($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Fields');

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
            $this->addJoinObject($join, 'Fields');
        }

        return $this;
    }

    /**
     * Use the Fields relation Fields object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FieldsQuery A secondary query class using the current class as primary query
     */
    public function useFieldsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFields($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Fields', '\TheFarm\Models\FieldsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Forms object
     *
     * @param \TheFarm\Models\Forms|ObjectCollection $forms The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntriesQuery The current query, for fluid interface
     */
    public function filterByForms($forms, $comparison = null)
    {
        if ($forms instanceof \TheFarm\Models\Forms) {
            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_FORM_ID, $forms->getFormId(), $comparison);
        } elseif ($forms instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntriesTableMap::COL_FORM_ID, $forms->toKeyValue('PrimaryKey', 'FormId'), $comparison);
        } else {
            throw new PropelException('filterByForms() only accepts arguments of type \TheFarm\Models\Forms or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Forms relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function joinForms($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Forms');

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
            $this->addJoinObject($join, 'Forms');
        }

        return $this;
    }

    /**
     * Use the Forms relation Forms object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormsQuery A secondary query class using the current class as primary query
     */
    public function useFormsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForms($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Forms', '\TheFarm\Models\FormsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormEntries $formEntries Object to remove from the list of results
     *
     * @return $this|ChildFormEntriesQuery The current query, for fluid interface
     */
    public function prune($formEntries = null)
    {
        if ($formEntries) {
            $this->addUsingAlias(FormEntriesTableMap::COL_ENTRY_ID, $formEntries->getEntryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_entries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormEntriesTableMap::clearInstancePool();
            FormEntriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormEntriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormEntriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormEntriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormEntriesQuery
