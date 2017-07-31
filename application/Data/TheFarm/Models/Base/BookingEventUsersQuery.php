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
use TheFarm\Models\BookingEventUsers as ChildBookingEventUsers;
use TheFarm\Models\BookingEventUsersQuery as ChildBookingEventUsersQuery;
use TheFarm\Models\Map\BookingEventUsersTableMap;

/**
 * Base class that represents a query for the 'tf_booking_event_users' table.
 *
 *
 *
 * @method     ChildBookingEventUsersQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     ChildBookingEventUsersQuery orderByStaffId($order = Criteria::ASC) Order by the staff_id column
 *
 * @method     ChildBookingEventUsersQuery groupByEventId() Group by the event_id column
 * @method     ChildBookingEventUsersQuery groupByStaffId() Group by the staff_id column
 *
 * @method     ChildBookingEventUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingEventUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingEventUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingEventUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingEventUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingEventUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingEventUsersQuery leftJoinBookingEvents($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEvents relation
 * @method     ChildBookingEventUsersQuery rightJoinBookingEvents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEvents relation
 * @method     ChildBookingEventUsersQuery innerJoinBookingEvents($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEvents relation
 *
 * @method     ChildBookingEventUsersQuery joinWithBookingEvents($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEvents relation
 *
 * @method     ChildBookingEventUsersQuery leftJoinWithBookingEvents() Adds a LEFT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildBookingEventUsersQuery rightJoinWithBookingEvents() Adds a RIGHT JOIN clause and with to the query using the BookingEvents relation
 * @method     ChildBookingEventUsersQuery innerJoinWithBookingEvents() Adds a INNER JOIN clause and with to the query using the BookingEvents relation
 *
 * @method     ChildBookingEventUsersQuery leftJoinContacts($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contacts relation
 * @method     ChildBookingEventUsersQuery rightJoinContacts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contacts relation
 * @method     ChildBookingEventUsersQuery innerJoinContacts($relationAlias = null) Adds a INNER JOIN clause to the query using the Contacts relation
 *
 * @method     ChildBookingEventUsersQuery joinWithContacts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Contacts relation
 *
 * @method     ChildBookingEventUsersQuery leftJoinWithContacts() Adds a LEFT JOIN clause and with to the query using the Contacts relation
 * @method     ChildBookingEventUsersQuery rightJoinWithContacts() Adds a RIGHT JOIN clause and with to the query using the Contacts relation
 * @method     ChildBookingEventUsersQuery innerJoinWithContacts() Adds a INNER JOIN clause and with to the query using the Contacts relation
 *
 * @method     \TheFarm\Models\BookingEventsQuery|\TheFarm\Models\ContactsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingEventUsers findOne(ConnectionInterface $con = null) Return the first ChildBookingEventUsers matching the query
 * @method     ChildBookingEventUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingEventUsers matching the query, or a new ChildBookingEventUsers object populated from the query conditions when no match is found
 *
 * @method     ChildBookingEventUsers findOneByEventId(int $event_id) Return the first ChildBookingEventUsers filtered by the event_id column
 * @method     ChildBookingEventUsers findOneByStaffId(int $staff_id) Return the first ChildBookingEventUsers filtered by the staff_id column *

 * @method     ChildBookingEventUsers requirePk($key, ConnectionInterface $con = null) Return the ChildBookingEventUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEventUsers requireOne(ConnectionInterface $con = null) Return the first ChildBookingEventUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingEventUsers requireOneByEventId(int $event_id) Return the first ChildBookingEventUsers filtered by the event_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEventUsers requireOneByStaffId(int $staff_id) Return the first ChildBookingEventUsers filtered by the staff_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingEventUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingEventUsers objects based on current ModelCriteria
 * @method     ChildBookingEventUsers[]|ObjectCollection findByEventId(int $event_id) Return ChildBookingEventUsers objects filtered by the event_id column
 * @method     ChildBookingEventUsers[]|ObjectCollection findByStaffId(int $staff_id) Return ChildBookingEventUsers objects filtered by the staff_id column
 * @method     ChildBookingEventUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingEventUsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingEventUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingEventUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingEventUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingEventUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingEventUsersQuery) {
            return $criteria;
        }
        $query = new ChildBookingEventUsersQuery();
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
     * @param array[$event_id, $staff_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBookingEventUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingEventUsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingEventUsersTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBookingEventUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_id, staff_id FROM tf_booking_event_users WHERE event_id = :p0 AND staff_id = :p1';
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
            /** @var ChildBookingEventUsers $obj */
            $obj = new ChildBookingEventUsers();
            $obj->hydrate($row);
            BookingEventUsersTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBookingEventUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BookingEventUsersTableMap::COL_EVENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BookingEventUsersTableMap::COL_STAFF_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE event_id = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
     * </code>
     *
     * @see       filterByBookingEvents()
     *
     * @param     mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $eventId, $comparison);
    }

    /**
     * Filter the query on the staff_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStaffId(1234); // WHERE staff_id = 1234
     * $query->filterByStaffId(array(12, 34)); // WHERE staff_id IN (12, 34)
     * $query->filterByStaffId(array('min' => 12)); // WHERE staff_id > 12
     * </code>
     *
     * @see       filterByContacts()
     *
     * @param     mixed $staffId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByStaffId($staffId = null, $comparison = null)
    {
        if (is_array($staffId)) {
            $useMinMax = false;
            if (isset($staffId['min'])) {
                $this->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $staffId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($staffId['max'])) {
                $this->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $staffId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $staffId, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvents object
     *
     * @param \TheFarm\Models\BookingEvents|ObjectCollection $bookingEvents The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByBookingEvents($bookingEvents, $comparison = null)
    {
        if ($bookingEvents instanceof \TheFarm\Models\BookingEvents) {
            return $this
                ->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $bookingEvents->getEventId(), $comparison);
        } elseif ($bookingEvents instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventUsersTableMap::COL_EVENT_ID, $bookingEvents->toKeyValue('PrimaryKey', 'EventId'), $comparison);
        } else {
            throw new PropelException('filterByBookingEvents() only accepts arguments of type \TheFarm\Models\BookingEvents or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEvents relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function joinBookingEvents($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEvents');

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
            $this->addJoinObject($join, 'BookingEvents');
        }

        return $this;
    }

    /**
     * Use the BookingEvents relation BookingEvents object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventsQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingEvents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEvents', '\TheFarm\Models\BookingEventsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contacts object
     *
     * @param \TheFarm\Models\Contacts|ObjectCollection $contacts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function filterByContacts($contacts, $comparison = null)
    {
        if ($contacts instanceof \TheFarm\Models\Contacts) {
            return $this
                ->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $contacts->getContactId(), $comparison);
        } elseif ($contacts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventUsersTableMap::COL_STAFF_ID, $contacts->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContacts() only accepts arguments of type \TheFarm\Models\Contacts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Contacts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function joinContacts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Contacts');

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
            $this->addJoinObject($join, 'Contacts');
        }

        return $this;
    }

    /**
     * Use the Contacts relation Contacts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactsQuery A secondary query class using the current class as primary query
     */
    public function useContactsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContacts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Contacts', '\TheFarm\Models\ContactsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingEventUsers $bookingEventUsers Object to remove from the list of results
     *
     * @return $this|ChildBookingEventUsersQuery The current query, for fluid interface
     */
    public function prune($bookingEventUsers = null)
    {
        if ($bookingEventUsers) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BookingEventUsersTableMap::COL_EVENT_ID), $bookingEventUsers->getEventId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BookingEventUsersTableMap::COL_STAFF_ID), $bookingEventUsers->getStaffId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_event_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingEventUsersTableMap::clearInstancePool();
            BookingEventUsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingEventUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingEventUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingEventUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingEventUsersQuery
