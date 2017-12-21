<?php

namespace TheFarm\Models\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use TheFarm\Models\BookingFormEntry as ChildBookingFormEntry;
use TheFarm\Models\BookingFormEntryQuery as ChildBookingFormEntryQuery;
use TheFarm\Models\Map\BookingFormEntryTableMap;

/**
 * Base class that represents a query for the 'tf_booking_form_entry' table.
 *
 *
 *
 * @method     ChildBookingFormEntryQuery orderByBookingFormId($order = Criteria::ASC) Order by the booking_form_id column
 * @method     ChildBookingFormEntryQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildBookingFormEntryQuery orderByFieldValue($order = Criteria::ASC) Order by the field_value column
 *
 * @method     ChildBookingFormEntryQuery groupByBookingFormId() Group by the booking_form_id column
 * @method     ChildBookingFormEntryQuery groupByFieldId() Group by the field_id column
 * @method     ChildBookingFormEntryQuery groupByFieldValue() Group by the field_value column
 *
 * @method     ChildBookingFormEntryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingFormEntryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingFormEntryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingFormEntryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingFormEntryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingFormEntryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingFormEntryQuery leftJoinBookingForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingForm relation
 * @method     ChildBookingFormEntryQuery rightJoinBookingForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingForm relation
 * @method     ChildBookingFormEntryQuery innerJoinBookingForm($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingForm relation
 *
 * @method     ChildBookingFormEntryQuery joinWithBookingForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingForm relation
 *
 * @method     ChildBookingFormEntryQuery leftJoinWithBookingForm() Adds a LEFT JOIN clause and with to the query using the BookingForm relation
 * @method     ChildBookingFormEntryQuery rightJoinWithBookingForm() Adds a RIGHT JOIN clause and with to the query using the BookingForm relation
 * @method     ChildBookingFormEntryQuery innerJoinWithBookingForm() Adds a INNER JOIN clause and with to the query using the BookingForm relation
 *
 * @method     ChildBookingFormEntryQuery leftJoinField($relationAlias = null) Adds a LEFT JOIN clause to the query using the Field relation
 * @method     ChildBookingFormEntryQuery rightJoinField($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Field relation
 * @method     ChildBookingFormEntryQuery innerJoinField($relationAlias = null) Adds a INNER JOIN clause to the query using the Field relation
 *
 * @method     ChildBookingFormEntryQuery joinWithField($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Field relation
 *
 * @method     ChildBookingFormEntryQuery leftJoinWithField() Adds a LEFT JOIN clause and with to the query using the Field relation
 * @method     ChildBookingFormEntryQuery rightJoinWithField() Adds a RIGHT JOIN clause and with to the query using the Field relation
 * @method     ChildBookingFormEntryQuery innerJoinWithField() Adds a INNER JOIN clause and with to the query using the Field relation
 *
 * @method     \TheFarm\Models\BookingFormQuery|\TheFarm\Models\FieldQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingFormEntry findOne(ConnectionInterface $con = null) Return the first ChildBookingFormEntry matching the query
 * @method     ChildBookingFormEntry findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingFormEntry matching the query, or a new ChildBookingFormEntry object populated from the query conditions when no match is found
 *
 * @method     ChildBookingFormEntry findOneByBookingFormId(int $booking_form_id) Return the first ChildBookingFormEntry filtered by the booking_form_id column
 * @method     ChildBookingFormEntry findOneByFieldId(int $field_id) Return the first ChildBookingFormEntry filtered by the field_id column
 * @method     ChildBookingFormEntry findOneByFieldValue(string $field_value) Return the first ChildBookingFormEntry filtered by the field_value column *

 * @method     ChildBookingFormEntry requirePk($key, ConnectionInterface $con = null) Return the ChildBookingFormEntry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingFormEntry requireOne(ConnectionInterface $con = null) Return the first ChildBookingFormEntry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingFormEntry requireOneByBookingFormId(int $booking_form_id) Return the first ChildBookingFormEntry filtered by the booking_form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingFormEntry requireOneByFieldId(int $field_id) Return the first ChildBookingFormEntry filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingFormEntry requireOneByFieldValue(string $field_value) Return the first ChildBookingFormEntry filtered by the field_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingFormEntry[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingFormEntry objects based on current ModelCriteria
 * @method     ChildBookingFormEntry[]|ObjectCollection findByBookingFormId(int $booking_form_id) Return ChildBookingFormEntry objects filtered by the booking_form_id column
 * @method     ChildBookingFormEntry[]|ObjectCollection findByFieldId(int $field_id) Return ChildBookingFormEntry objects filtered by the field_id column
 * @method     ChildBookingFormEntry[]|ObjectCollection findByFieldValue(string $field_value) Return ChildBookingFormEntry objects filtered by the field_value column
 * @method     ChildBookingFormEntry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingFormEntryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingFormEntryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingFormEntry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingFormEntryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingFormEntryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingFormEntryQuery) {
            return $criteria;
        }
        $query = new ChildBookingFormEntryQuery();
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
     * @return ChildBookingFormEntry|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The BookingFormEntry object has no primary key');
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
        throw new LogicException('The BookingFormEntry object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The BookingFormEntry object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The BookingFormEntry object has no primary key');
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
     * @see       filterByBookingForm()
     *
     * @param     mixed $bookingFormId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByBookingFormId($bookingFormId = null, $comparison = null)
    {
        if (is_array($bookingFormId)) {
            $useMinMax = false;
            if (isset($bookingFormId['min'])) {
                $this->addUsingAlias(BookingFormEntryTableMap::COL_BOOKING_FORM_ID, $bookingFormId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingFormId['max'])) {
                $this->addUsingAlias(BookingFormEntryTableMap::COL_BOOKING_FORM_ID, $bookingFormId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormEntryTableMap::COL_BOOKING_FORM_ID, $bookingFormId, $comparison);
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
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_ID, $fieldId, $comparison);
    }

    /**
     * Filter the query on the field_value column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldValue('fooValue');   // WHERE field_value = 'fooValue'
     * $query->filterByFieldValue('%fooValue%', Criteria::LIKE); // WHERE field_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByFieldValue($fieldValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_VALUE, $fieldValue, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingForm object
     *
     * @param \TheFarm\Models\BookingForm|ObjectCollection $bookingForm The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByBookingForm($bookingForm, $comparison = null)
    {
        if ($bookingForm instanceof \TheFarm\Models\BookingForm) {
            return $this
                ->addUsingAlias(BookingFormEntryTableMap::COL_BOOKING_FORM_ID, $bookingForm->getBookingFormId(), $comparison);
        } elseif ($bookingForm instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormEntryTableMap::COL_BOOKING_FORM_ID, $bookingForm->toKeyValue('PrimaryKey', 'BookingFormId'), $comparison);
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
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function joinBookingForm($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useBookingFormQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingForm', '\TheFarm\Models\BookingFormQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Field object
     *
     * @param \TheFarm\Models\Field|ObjectCollection $field The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function filterByField($field, $comparison = null)
    {
        if ($field instanceof \TheFarm\Models\Field) {
            return $this
                ->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_ID, $field->getFieldId(), $comparison);
        } elseif ($field instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingFormEntryTableMap::COL_FIELD_ID, $field->toKeyValue('PrimaryKey', 'FieldId'), $comparison);
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
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildBookingFormEntry $bookingFormEntry Object to remove from the list of results
     *
     * @return $this|ChildBookingFormEntryQuery The current query, for fluid interface
     */
    public function prune($bookingFormEntry = null)
    {
        if ($bookingFormEntry) {
            throw new LogicException('BookingFormEntry object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_form_entry table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormEntryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingFormEntryTableMap::clearInstancePool();
            BookingFormEntryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingFormEntryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingFormEntryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingFormEntryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingFormEntryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingFormEntryQuery
