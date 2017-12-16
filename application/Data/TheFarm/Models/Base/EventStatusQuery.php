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
use TheFarm\Models\EventStatus as ChildEventStatus;
use TheFarm\Models\EventStatusQuery as ChildEventStatusQuery;
use TheFarm\Models\Map\EventStatusTableMap;

/**
 * Base class that represents a query for the 'tf_event_status' table.
 *
 *
 *
 * @method     ChildEventStatusQuery orderByStatusCd($order = Criteria::ASC) Order by the status_cd column
 * @method     ChildEventStatusQuery orderByStatusValue($order = Criteria::ASC) Order by the status_value column
 * @method     ChildEventStatusQuery orderByStatusOrder($order = Criteria::ASC) Order by the status_order column
 * @method     ChildEventStatusQuery orderByStatusStyle($order = Criteria::ASC) Order by the status_style column
 * @method     ChildEventStatusQuery orderByIncludeInSales($order = Criteria::ASC) Order by the include_in_sales column
 * @method     ChildEventStatusQuery orderByIncludeInDuplicateChecking($order = Criteria::ASC) Order by the include_in_duplicate_checking column
 *
 * @method     ChildEventStatusQuery groupByStatusCd() Group by the status_cd column
 * @method     ChildEventStatusQuery groupByStatusValue() Group by the status_value column
 * @method     ChildEventStatusQuery groupByStatusOrder() Group by the status_order column
 * @method     ChildEventStatusQuery groupByStatusStyle() Group by the status_style column
 * @method     ChildEventStatusQuery groupByIncludeInSales() Group by the include_in_sales column
 * @method     ChildEventStatusQuery groupByIncludeInDuplicateChecking() Group by the include_in_duplicate_checking column
 *
 * @method     ChildEventStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEventStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEventStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEventStatusQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     ChildEventStatusQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     ChildEventStatusQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     ChildEventStatusQuery joinWithEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Event relation
 *
 * @method     ChildEventStatusQuery leftJoinWithEvent() Adds a LEFT JOIN clause and with to the query using the Event relation
 * @method     ChildEventStatusQuery rightJoinWithEvent() Adds a RIGHT JOIN clause and with to the query using the Event relation
 * @method     ChildEventStatusQuery innerJoinWithEvent() Adds a INNER JOIN clause and with to the query using the Event relation
 *
 * @method     ChildEventStatusQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildEventStatusQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildEventStatusQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildEventStatusQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildEventStatusQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildEventStatusQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildEventStatusQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     \TheFarm\Models\EventQuery|\TheFarm\Models\BookingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEventStatus findOne(ConnectionInterface $con = null) Return the first ChildEventStatus matching the query
 * @method     ChildEventStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEventStatus matching the query, or a new ChildEventStatus object populated from the query conditions when no match is found
 *
 * @method     ChildEventStatus findOneByStatusCd(string $status_cd) Return the first ChildEventStatus filtered by the status_cd column
 * @method     ChildEventStatus findOneByStatusValue(string $status_value) Return the first ChildEventStatus filtered by the status_value column
 * @method     ChildEventStatus findOneByStatusOrder(int $status_order) Return the first ChildEventStatus filtered by the status_order column
 * @method     ChildEventStatus findOneByStatusStyle(string $status_style) Return the first ChildEventStatus filtered by the status_style column
 * @method     ChildEventStatus findOneByIncludeInSales(string $include_in_sales) Return the first ChildEventStatus filtered by the include_in_sales column
 * @method     ChildEventStatus findOneByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return the first ChildEventStatus filtered by the include_in_duplicate_checking column *

 * @method     ChildEventStatus requirePk($key, ConnectionInterface $con = null) Return the ChildEventStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOne(ConnectionInterface $con = null) Return the first ChildEventStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEventStatus requireOneByStatusCd(string $status_cd) Return the first ChildEventStatus filtered by the status_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOneByStatusValue(string $status_value) Return the first ChildEventStatus filtered by the status_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOneByStatusOrder(int $status_order) Return the first ChildEventStatus filtered by the status_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOneByStatusStyle(string $status_style) Return the first ChildEventStatus filtered by the status_style column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOneByIncludeInSales(string $include_in_sales) Return the first ChildEventStatus filtered by the include_in_sales column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEventStatus requireOneByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return the first ChildEventStatus filtered by the include_in_duplicate_checking column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEventStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEventStatus objects based on current ModelCriteria
 * @method     ChildEventStatus[]|ObjectCollection findByStatusCd(string $status_cd) Return ChildEventStatus objects filtered by the status_cd column
 * @method     ChildEventStatus[]|ObjectCollection findByStatusValue(string $status_value) Return ChildEventStatus objects filtered by the status_value column
 * @method     ChildEventStatus[]|ObjectCollection findByStatusOrder(int $status_order) Return ChildEventStatus objects filtered by the status_order column
 * @method     ChildEventStatus[]|ObjectCollection findByStatusStyle(string $status_style) Return ChildEventStatus objects filtered by the status_style column
 * @method     ChildEventStatus[]|ObjectCollection findByIncludeInSales(string $include_in_sales) Return ChildEventStatus objects filtered by the include_in_sales column
 * @method     ChildEventStatus[]|ObjectCollection findByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return ChildEventStatus objects filtered by the include_in_duplicate_checking column
 * @method     ChildEventStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\EventStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\EventStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventStatusQuery) {
            return $criteria;
        }
        $query = new ChildEventStatusQuery();
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
     * @return ChildEventStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EventStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEventStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT status_cd, status_value, status_order, status_style, include_in_sales, include_in_duplicate_checking FROM tf_event_status WHERE status_cd = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEventStatus $obj */
            $obj = new ChildEventStatus();
            $obj->hydrate($row);
            EventStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEventStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the status_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusCd('fooValue');   // WHERE status_cd = 'fooValue'
     * $query->filterByStatusCd('%fooValue%', Criteria::LIKE); // WHERE status_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByStatusCd($statusCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $statusCd, $comparison);
    }

    /**
     * Filter the query on the status_value column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusValue('fooValue');   // WHERE status_value = 'fooValue'
     * $query->filterByStatusValue('%fooValue%', Criteria::LIKE); // WHERE status_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByStatusValue($statusValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_VALUE, $statusValue, $comparison);
    }

    /**
     * Filter the query on the status_order column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusOrder(1234); // WHERE status_order = 1234
     * $query->filterByStatusOrder(array(12, 34)); // WHERE status_order IN (12, 34)
     * $query->filterByStatusOrder(array('min' => 12)); // WHERE status_order > 12
     * </code>
     *
     * @param     mixed $statusOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByStatusOrder($statusOrder = null, $comparison = null)
    {
        if (is_array($statusOrder)) {
            $useMinMax = false;
            if (isset($statusOrder['min'])) {
                $this->addUsingAlias(EventStatusTableMap::COL_STATUS_ORDER, $statusOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusOrder['max'])) {
                $this->addUsingAlias(EventStatusTableMap::COL_STATUS_ORDER, $statusOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_ORDER, $statusOrder, $comparison);
    }

    /**
     * Filter the query on the status_style column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusStyle('fooValue');   // WHERE status_style = 'fooValue'
     * $query->filterByStatusStyle('%fooValue%', Criteria::LIKE); // WHERE status_style LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusStyle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByStatusStyle($statusStyle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusStyle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_STATUS_STYLE, $statusStyle, $comparison);
    }

    /**
     * Filter the query on the include_in_sales column
     *
     * Example usage:
     * <code>
     * $query->filterByIncludeInSales('fooValue');   // WHERE include_in_sales = 'fooValue'
     * $query->filterByIncludeInSales('%fooValue%', Criteria::LIKE); // WHERE include_in_sales LIKE '%fooValue%'
     * </code>
     *
     * @param     string $includeInSales The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByIncludeInSales($includeInSales = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInSales)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_INCLUDE_IN_SALES, $includeInSales, $comparison);
    }

    /**
     * Filter the query on the include_in_duplicate_checking column
     *
     * Example usage:
     * <code>
     * $query->filterByIncludeInDuplicateChecking('fooValue');   // WHERE include_in_duplicate_checking = 'fooValue'
     * $query->filterByIncludeInDuplicateChecking('%fooValue%', Criteria::LIKE); // WHERE include_in_duplicate_checking LIKE '%fooValue%'
     * </code>
     *
     * @param     string $includeInDuplicateChecking The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByIncludeInDuplicateChecking($includeInDuplicateChecking = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInDuplicateChecking)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventStatusTableMap::COL_INCLUDE_IN_DUPLICATE_CHECKING, $includeInDuplicateChecking, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByEvent($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $event->getStatus(), $comparison);
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
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEventStatusQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $booking->getStatus(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            return $this
                ->useBookingQuery()
                ->filterByPrimaryKeys($booking->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildEventStatus $eventStatus Object to remove from the list of results
     *
     * @return $this|ChildEventStatusQuery The current query, for fluid interface
     */
    public function prune($eventStatus = null)
    {
        if ($eventStatus) {
            $this->addUsingAlias(EventStatusTableMap::COL_STATUS_CD, $eventStatus->getStatusCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_event_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventStatusTableMap::clearInstancePool();
            EventStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EventStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventStatusQuery
