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
use TheFarm\Models\FormEntry as ChildFormEntry;
use TheFarm\Models\FormEntryQuery as ChildFormEntryQuery;
use TheFarm\Models\Map\FormEntryTableMap;

/**
 * Base class that represents a query for the 'tf_form_entries' table.
 *
 *
 *
 * @method     ChildFormEntryQuery orderByEntryId($order = Criteria::ASC) Order by the entry_id column
 * @method     ChildFormEntryQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildFormEntryQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildFormEntryQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFormEntryQuery orderByFieldTextValue($order = Criteria::ASC) Order by the field_text_value column
 * @method     ChildFormEntryQuery orderByFieldDropdownValue($order = Criteria::ASC) Order by the field_dropdown_value column
 * @method     ChildFormEntryQuery orderByFieldCheckboxesValue($order = Criteria::ASC) Order by the field_checkboxes_value column
 *
 * @method     ChildFormEntryQuery groupByEntryId() Group by the entry_id column
 * @method     ChildFormEntryQuery groupByBookingId() Group by the booking_id column
 * @method     ChildFormEntryQuery groupByFormId() Group by the form_id column
 * @method     ChildFormEntryQuery groupByFieldId() Group by the field_id column
 * @method     ChildFormEntryQuery groupByFieldTextValue() Group by the field_text_value column
 * @method     ChildFormEntryQuery groupByFieldDropdownValue() Group by the field_dropdown_value column
 * @method     ChildFormEntryQuery groupByFieldCheckboxesValue() Group by the field_checkboxes_value column
 *
 * @method     ChildFormEntryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormEntryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormEntryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormEntryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormEntryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormEntryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormEntryQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildFormEntryQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildFormEntryQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildFormEntryQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildFormEntryQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildFormEntryQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildFormEntryQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildFormEntryQuery leftJoinField($relationAlias = null) Adds a LEFT JOIN clause to the query using the Field relation
 * @method     ChildFormEntryQuery rightJoinField($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Field relation
 * @method     ChildFormEntryQuery innerJoinField($relationAlias = null) Adds a INNER JOIN clause to the query using the Field relation
 *
 * @method     ChildFormEntryQuery joinWithField($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Field relation
 *
 * @method     ChildFormEntryQuery leftJoinWithField() Adds a LEFT JOIN clause and with to the query using the Field relation
 * @method     ChildFormEntryQuery rightJoinWithField() Adds a RIGHT JOIN clause and with to the query using the Field relation
 * @method     ChildFormEntryQuery innerJoinWithField() Adds a INNER JOIN clause and with to the query using the Field relation
 *
 * @method     ChildFormEntryQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildFormEntryQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildFormEntryQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildFormEntryQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildFormEntryQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildFormEntryQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildFormEntryQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     \TheFarm\Models\BookingQuery|\TheFarm\Models\FieldQuery|\TheFarm\Models\FormQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFormEntry findOne(ConnectionInterface $con = null) Return the first ChildFormEntry matching the query
 * @method     ChildFormEntry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormEntry matching the query, or a new ChildFormEntry object populated from the query conditions when no match is found
 *
 * @method     ChildFormEntry findOneByEntryId(int $entry_id) Return the first ChildFormEntry filtered by the entry_id column
 * @method     ChildFormEntry findOneByBookingId(int $booking_id) Return the first ChildFormEntry filtered by the booking_id column
 * @method     ChildFormEntry findOneByFormId(int $form_id) Return the first ChildFormEntry filtered by the form_id column
 * @method     ChildFormEntry findOneByFieldId(int $field_id) Return the first ChildFormEntry filtered by the field_id column
 * @method     ChildFormEntry findOneByFieldTextValue(string $field_text_value) Return the first ChildFormEntry filtered by the field_text_value column
 * @method     ChildFormEntry findOneByFieldDropdownValue(string $field_dropdown_value) Return the first ChildFormEntry filtered by the field_dropdown_value column
 * @method     ChildFormEntry findOneByFieldCheckboxesValue(string $field_checkboxes_value) Return the first ChildFormEntry filtered by the field_checkboxes_value column *

 * @method     ChildFormEntry requirePk($key, ConnectionInterface $con = null) Return the ChildFormEntry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOne(ConnectionInterface $con = null) Return the first ChildFormEntry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntry requireOneByEntryId(int $entry_id) Return the first ChildFormEntry filtered by the entry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByBookingId(int $booking_id) Return the first ChildFormEntry filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByFormId(int $form_id) Return the first ChildFormEntry filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByFieldId(int $field_id) Return the first ChildFormEntry filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByFieldTextValue(string $field_text_value) Return the first ChildFormEntry filtered by the field_text_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByFieldDropdownValue(string $field_dropdown_value) Return the first ChildFormEntry filtered by the field_dropdown_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntry requireOneByFieldCheckboxesValue(string $field_checkboxes_value) Return the first ChildFormEntry filtered by the field_checkboxes_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormEntry objects based on current ModelCriteria
 * @method     ChildFormEntry[]|ObjectCollection findByEntryId(int $entry_id) Return ChildFormEntry objects filtered by the entry_id column
 * @method     ChildFormEntry[]|ObjectCollection findByBookingId(int $booking_id) Return ChildFormEntry objects filtered by the booking_id column
 * @method     ChildFormEntry[]|ObjectCollection findByFormId(int $form_id) Return ChildFormEntry objects filtered by the form_id column
 * @method     ChildFormEntry[]|ObjectCollection findByFieldId(int $field_id) Return ChildFormEntry objects filtered by the field_id column
 * @method     ChildFormEntry[]|ObjectCollection findByFieldTextValue(string $field_text_value) Return ChildFormEntry objects filtered by the field_text_value column
 * @method     ChildFormEntry[]|ObjectCollection findByFieldDropdownValue(string $field_dropdown_value) Return ChildFormEntry objects filtered by the field_dropdown_value column
 * @method     ChildFormEntry[]|ObjectCollection findByFieldCheckboxesValue(string $field_checkboxes_value) Return ChildFormEntry objects filtered by the field_checkboxes_value column
 * @method     ChildFormEntry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormEntryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormEntryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormEntry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormEntryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormEntryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormEntryQuery) {
            return $criteria;
        }
        $query = new ChildFormEntryQuery();
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
     * @return ChildFormEntry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormEntryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormEntryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormEntry A model object, or null if the key is not found
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
            /** @var ChildFormEntry $obj */
            $obj = new ChildFormEntry();
            $obj->hydrate($row);
            FormEntryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormEntry|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByEntryId($entryId = null, $comparison = null)
    {
        if (is_array($entryId)) {
            $useMinMax = false;
            if (isset($entryId['min'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $entryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryId['max'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $entryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $entryId, $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_BOOKING_ID, $bookingId, $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_FORM_ID, $formId, $comparison);
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
     * @see       filterByField()
     *
     * @param     mixed $fieldId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FormEntryTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_FIELD_ID, $fieldId, $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldTextValue($fieldTextValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldTextValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_FIELD_TEXT_VALUE, $fieldTextValue, $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldDropdownValue($fieldDropdownValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldDropdownValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_FIELD_DROPDOWN_VALUE, $fieldDropdownValue, $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldCheckboxesValue($fieldCheckboxesValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldCheckboxesValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntryTableMap::COL_FIELD_CHECKBOXES_VALUE, $fieldCheckboxesValue, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(FormEntryTableMap::COL_BOOKING_ID, $booking->getBookingId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntryTableMap::COL_BOOKING_ID, $booking->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Field object
     *
     * @param \TheFarm\Models\Field|ObjectCollection $field The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByField($field, $comparison = null)
    {
        if ($field instanceof \TheFarm\Models\Field) {
            return $this
                ->addUsingAlias(FormEntryTableMap::COL_FIELD_ID, $field->getFieldId(), $comparison);
        } elseif ($field instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntryTableMap::COL_FIELD_ID, $field->toKeyValue('PrimaryKey', 'FieldId'), $comparison);
        } else {
            throw new PropelException('filterByField() only accepts arguments of type \TheFarm\Models\Field or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Field relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function joinField($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Field');

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
            $this->addJoinObject($join, 'Field');
        }

        return $this;
    }

    /**
     * Use the Field relation Field object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FieldQuery A secondary query class using the current class as primary query
     */
    public function useFieldQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinField($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Field', '\TheFarm\Models\FieldQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Form object
     *
     * @param \TheFarm\Models\Form|ObjectCollection $form The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormEntryQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \TheFarm\Models\Form) {
            return $this
                ->addUsingAlias(FormEntryTableMap::COL_FORM_ID, $form->getFormId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormEntryTableMap::COL_FORM_ID, $form->toKeyValue('PrimaryKey', 'FormId'), $comparison);
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
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildFormEntry $formEntry Object to remove from the list of results
     *
     * @return $this|ChildFormEntryQuery The current query, for fluid interface
     */
    public function prune($formEntry = null)
    {
        if ($formEntry) {
            $this->addUsingAlias(FormEntryTableMap::COL_ENTRY_ID, $formEntry->getEntryId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormEntryTableMap::clearInstancePool();
            FormEntryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormEntryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormEntryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormEntryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormEntryQuery
