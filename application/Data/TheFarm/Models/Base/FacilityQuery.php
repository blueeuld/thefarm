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
use TheFarm\Models\Facility as ChildFacility;
use TheFarm\Models\FacilityQuery as ChildFacilityQuery;
use TheFarm\Models\Map\FacilityTableMap;

/**
 * Base class that represents a query for the 'tf_facilities' table.
 *
 *
 *
 * @method     ChildFacilityQuery orderByFacilityId($order = Criteria::ASC) Order by the facility_id column
 * @method     ChildFacilityQuery orderByFacilityName($order = Criteria::ASC) Order by the facility_name column
 * @method     ChildFacilityQuery orderByBgColor($order = Criteria::ASC) Order by the bg_color column
 * @method     ChildFacilityQuery orderByMaxAccomodation($order = Criteria::ASC) Order by the max_accomodation column
 * @method     ChildFacilityQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildFacilityQuery orderByAbbr($order = Criteria::ASC) Order by the abbr column
 * @method     ChildFacilityQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildFacilityQuery groupByFacilityId() Group by the facility_id column
 * @method     ChildFacilityQuery groupByFacilityName() Group by the facility_name column
 * @method     ChildFacilityQuery groupByBgColor() Group by the bg_color column
 * @method     ChildFacilityQuery groupByMaxAccomodation() Group by the max_accomodation column
 * @method     ChildFacilityQuery groupByLocationId() Group by the location_id column
 * @method     ChildFacilityQuery groupByAbbr() Group by the abbr column
 * @method     ChildFacilityQuery groupByStatus() Group by the status column
 *
 * @method     ChildFacilityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFacilityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFacilityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFacilityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFacilityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFacilityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFacilityQuery leftJoinLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Location relation
 * @method     ChildFacilityQuery rightJoinLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Location relation
 * @method     ChildFacilityQuery innerJoinLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Location relation
 *
 * @method     ChildFacilityQuery joinWithLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Location relation
 *
 * @method     ChildFacilityQuery leftJoinWithLocation() Adds a LEFT JOIN clause and with to the query using the Location relation
 * @method     ChildFacilityQuery rightJoinWithLocation() Adds a RIGHT JOIN clause and with to the query using the Location relation
 * @method     ChildFacilityQuery innerJoinWithLocation() Adds a INNER JOIN clause and with to the query using the Location relation
 *
 * @method     ChildFacilityQuery leftJoinBookingEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEvent relation
 * @method     ChildFacilityQuery rightJoinBookingEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEvent relation
 * @method     ChildFacilityQuery innerJoinBookingEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEvent relation
 *
 * @method     ChildFacilityQuery joinWithBookingEvent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEvent relation
 *
 * @method     ChildFacilityQuery leftJoinWithBookingEvent() Adds a LEFT JOIN clause and with to the query using the BookingEvent relation
 * @method     ChildFacilityQuery rightJoinWithBookingEvent() Adds a RIGHT JOIN clause and with to the query using the BookingEvent relation
 * @method     ChildFacilityQuery innerJoinWithBookingEvent() Adds a INNER JOIN clause and with to the query using the BookingEvent relation
 *
 * @method     \TheFarm\Models\LocationQuery|\TheFarm\Models\BookingEventQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFacility findOne(ConnectionInterface $con = null) Return the first ChildFacility matching the query
 * @method     ChildFacility findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFacility matching the query, or a new ChildFacility object populated from the query conditions when no match is found
 *
 * @method     ChildFacility findOneByFacilityId(int $facility_id) Return the first ChildFacility filtered by the facility_id column
 * @method     ChildFacility findOneByFacilityName(string $facility_name) Return the first ChildFacility filtered by the facility_name column
 * @method     ChildFacility findOneByBgColor(string $bg_color) Return the first ChildFacility filtered by the bg_color column
 * @method     ChildFacility findOneByMaxAccomodation(int $max_accomodation) Return the first ChildFacility filtered by the max_accomodation column
 * @method     ChildFacility findOneByLocationId(int $location_id) Return the first ChildFacility filtered by the location_id column
 * @method     ChildFacility findOneByAbbr(string $abbr) Return the first ChildFacility filtered by the abbr column
 * @method     ChildFacility findOneByStatus(int $status) Return the first ChildFacility filtered by the status column *

 * @method     ChildFacility requirePk($key, ConnectionInterface $con = null) Return the ChildFacility by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOne(ConnectionInterface $con = null) Return the first ChildFacility matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFacility requireOneByFacilityId(int $facility_id) Return the first ChildFacility filtered by the facility_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByFacilityName(string $facility_name) Return the first ChildFacility filtered by the facility_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByBgColor(string $bg_color) Return the first ChildFacility filtered by the bg_color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByMaxAccomodation(int $max_accomodation) Return the first ChildFacility filtered by the max_accomodation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByLocationId(int $location_id) Return the first ChildFacility filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByAbbr(string $abbr) Return the first ChildFacility filtered by the abbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFacility requireOneByStatus(int $status) Return the first ChildFacility filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFacility[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFacility objects based on current ModelCriteria
 * @method     ChildFacility[]|ObjectCollection findByFacilityId(int $facility_id) Return ChildFacility objects filtered by the facility_id column
 * @method     ChildFacility[]|ObjectCollection findByFacilityName(string $facility_name) Return ChildFacility objects filtered by the facility_name column
 * @method     ChildFacility[]|ObjectCollection findByBgColor(string $bg_color) Return ChildFacility objects filtered by the bg_color column
 * @method     ChildFacility[]|ObjectCollection findByMaxAccomodation(int $max_accomodation) Return ChildFacility objects filtered by the max_accomodation column
 * @method     ChildFacility[]|ObjectCollection findByLocationId(int $location_id) Return ChildFacility objects filtered by the location_id column
 * @method     ChildFacility[]|ObjectCollection findByAbbr(string $abbr) Return ChildFacility objects filtered by the abbr column
 * @method     ChildFacility[]|ObjectCollection findByStatus(int $status) Return ChildFacility objects filtered by the status column
 * @method     ChildFacility[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FacilityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FacilityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Facility', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFacilityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFacilityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFacilityQuery) {
            return $criteria;
        }
        $query = new ChildFacilityQuery();
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
     * @return ChildFacility|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FacilityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FacilityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFacility A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT facility_id, facility_name, bg_color, max_accomodation, location_id, abbr, status FROM tf_facilities WHERE facility_id = :p0';
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
            /** @var ChildFacility $obj */
            $obj = new ChildFacility();
            $obj->hydrate($row);
            FacilityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFacility|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the facility_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFacilityId(1234); // WHERE facility_id = 1234
     * $query->filterByFacilityId(array(12, 34)); // WHERE facility_id IN (12, 34)
     * $query->filterByFacilityId(array('min' => 12)); // WHERE facility_id > 12
     * </code>
     *
     * @param     mixed $facilityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByFacilityId($facilityId = null, $comparison = null)
    {
        if (is_array($facilityId)) {
            $useMinMax = false;
            if (isset($facilityId['min'])) {
                $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $facilityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($facilityId['max'])) {
                $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $facilityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $facilityId, $comparison);
    }

    /**
     * Filter the query on the facility_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFacilityName('fooValue');   // WHERE facility_name = 'fooValue'
     * $query->filterByFacilityName('%fooValue%', Criteria::LIKE); // WHERE facility_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $facilityName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByFacilityName($facilityName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($facilityName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_FACILITY_NAME, $facilityName, $comparison);
    }

    /**
     * Filter the query on the bg_color column
     *
     * Example usage:
     * <code>
     * $query->filterByBgColor('fooValue');   // WHERE bg_color = 'fooValue'
     * $query->filterByBgColor('%fooValue%', Criteria::LIKE); // WHERE bg_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bgColor The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByBgColor($bgColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bgColor)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_BG_COLOR, $bgColor, $comparison);
    }

    /**
     * Filter the query on the max_accomodation column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxAccomodation(1234); // WHERE max_accomodation = 1234
     * $query->filterByMaxAccomodation(array(12, 34)); // WHERE max_accomodation IN (12, 34)
     * $query->filterByMaxAccomodation(array('min' => 12)); // WHERE max_accomodation > 12
     * </code>
     *
     * @param     mixed $maxAccomodation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByMaxAccomodation($maxAccomodation = null, $comparison = null)
    {
        if (is_array($maxAccomodation)) {
            $useMinMax = false;
            if (isset($maxAccomodation['min'])) {
                $this->addUsingAlias(FacilityTableMap::COL_MAX_ACCOMODATION, $maxAccomodation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxAccomodation['max'])) {
                $this->addUsingAlias(FacilityTableMap::COL_MAX_ACCOMODATION, $maxAccomodation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_MAX_ACCOMODATION, $maxAccomodation, $comparison);
    }

    /**
     * Filter the query on the location_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationId(1234); // WHERE location_id = 1234
     * $query->filterByLocationId(array(12, 34)); // WHERE location_id IN (12, 34)
     * $query->filterByLocationId(array('min' => 12)); // WHERE location_id > 12
     * </code>
     *
     * @see       filterByLocation()
     *
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(FacilityTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(FacilityTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the abbr column
     *
     * Example usage:
     * <code>
     * $query->filterByAbbr('fooValue');   // WHERE abbr = 'fooValue'
     * $query->filterByAbbr('%fooValue%', Criteria::LIKE); // WHERE abbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $abbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByAbbr($abbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_ABBR, $abbr, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(FacilityTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(FacilityTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FacilityTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Location object
     *
     * @param \TheFarm\Models\Location|ObjectCollection $location The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = null)
    {
        if ($location instanceof \TheFarm\Models\Location) {
            return $this
                ->addUsingAlias(FacilityTableMap::COL_LOCATION_ID, $location->getLocationId(), $comparison);
        } elseif ($location instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FacilityTableMap::COL_LOCATION_ID, $location->toKeyValue('PrimaryKey', 'LocationId'), $comparison);
        } else {
            throw new PropelException('filterByLocation() only accepts arguments of type \TheFarm\Models\Location or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Location relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function joinLocation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Location');

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
            $this->addJoinObject($join, 'Location');
        }

        return $this;
    }

    /**
     * Use the Location relation Location object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\LocationQuery A secondary query class using the current class as primary query
     */
    public function useLocationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Location', '\TheFarm\Models\LocationQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEvent object
     *
     * @param \TheFarm\Models\BookingEvent|ObjectCollection $bookingEvent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFacilityQuery The current query, for fluid interface
     */
    public function filterByBookingEvent($bookingEvent, $comparison = null)
    {
        if ($bookingEvent instanceof \TheFarm\Models\BookingEvent) {
            return $this
                ->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $bookingEvent->getFacilityId(), $comparison);
        } elseif ($bookingEvent instanceof ObjectCollection) {
            return $this
                ->useBookingEventQuery()
                ->filterByPrimaryKeys($bookingEvent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEvent() only accepts arguments of type \TheFarm\Models\BookingEvent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEvent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function joinBookingEvent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEvent');

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
            $this->addJoinObject($join, 'BookingEvent');
        }

        return $this;
    }

    /**
     * Use the BookingEvent relation BookingEvent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEvent', '\TheFarm\Models\BookingEventQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFacility $facility Object to remove from the list of results
     *
     * @return $this|ChildFacilityQuery The current query, for fluid interface
     */
    public function prune($facility = null)
    {
        if ($facility) {
            $this->addUsingAlias(FacilityTableMap::COL_FACILITY_ID, $facility->getFacilityId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_facilities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FacilityTableMap::clearInstancePool();
            FacilityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FacilityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FacilityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FacilityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FacilityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FacilityQuery
