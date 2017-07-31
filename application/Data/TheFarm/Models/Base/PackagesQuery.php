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
use TheFarm\Models\Packages as ChildPackages;
use TheFarm\Models\PackagesQuery as ChildPackagesQuery;
use TheFarm\Models\Map\PackagesTableMap;

/**
 * Base class that represents a query for the 'tf_packages' table.
 *
 *
 *
 * @method     ChildPackagesQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ChildPackagesQuery orderByPackageName($order = Criteria::ASC) Order by the package_name column
 * @method     ChildPackagesQuery orderByPackageType($order = Criteria::ASC) Order by the package_type column
 * @method     ChildPackagesQuery orderByDuration($order = Criteria::ASC) Order by the duration column
 * @method     ChildPackagesQuery orderByPackageTypeId($order = Criteria::ASC) Order by the package_type_id column
 * @method     ChildPackagesQuery orderByPersonalized($order = Criteria::ASC) Order by the personalized column
 *
 * @method     ChildPackagesQuery groupByPackageId() Group by the package_id column
 * @method     ChildPackagesQuery groupByPackageName() Group by the package_name column
 * @method     ChildPackagesQuery groupByPackageType() Group by the package_type column
 * @method     ChildPackagesQuery groupByDuration() Group by the duration column
 * @method     ChildPackagesQuery groupByPackageTypeId() Group by the package_type_id column
 * @method     ChildPackagesQuery groupByPersonalized() Group by the personalized column
 *
 * @method     ChildPackagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPackagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPackagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPackagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPackagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPackagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPackagesQuery leftJoinBookings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookings relation
 * @method     ChildPackagesQuery rightJoinBookings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookings relation
 * @method     ChildPackagesQuery innerJoinBookings($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookings relation
 *
 * @method     ChildPackagesQuery joinWithBookings($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookings relation
 *
 * @method     ChildPackagesQuery leftJoinWithBookings() Adds a LEFT JOIN clause and with to the query using the Bookings relation
 * @method     ChildPackagesQuery rightJoinWithBookings() Adds a RIGHT JOIN clause and with to the query using the Bookings relation
 * @method     ChildPackagesQuery innerJoinWithBookings() Adds a INNER JOIN clause and with to the query using the Bookings relation
 *
 * @method     ChildPackagesQuery leftJoinPackageItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackageItems relation
 * @method     ChildPackagesQuery rightJoinPackageItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackageItems relation
 * @method     ChildPackagesQuery innerJoinPackageItems($relationAlias = null) Adds a INNER JOIN clause to the query using the PackageItems relation
 *
 * @method     ChildPackagesQuery joinWithPackageItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackageItems relation
 *
 * @method     ChildPackagesQuery leftJoinWithPackageItems() Adds a LEFT JOIN clause and with to the query using the PackageItems relation
 * @method     ChildPackagesQuery rightJoinWithPackageItems() Adds a RIGHT JOIN clause and with to the query using the PackageItems relation
 * @method     ChildPackagesQuery innerJoinWithPackageItems() Adds a INNER JOIN clause and with to the query using the PackageItems relation
 *
 * @method     \TheFarm\Models\BookingsQuery|\TheFarm\Models\PackageItemsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPackages findOne(ConnectionInterface $con = null) Return the first ChildPackages matching the query
 * @method     ChildPackages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPackages matching the query, or a new ChildPackages object populated from the query conditions when no match is found
 *
 * @method     ChildPackages findOneByPackageId(int $package_id) Return the first ChildPackages filtered by the package_id column
 * @method     ChildPackages findOneByPackageName(string $package_name) Return the first ChildPackages filtered by the package_name column
 * @method     ChildPackages findOneByPackageType(string $package_type) Return the first ChildPackages filtered by the package_type column
 * @method     ChildPackages findOneByDuration(int $duration) Return the first ChildPackages filtered by the duration column
 * @method     ChildPackages findOneByPackageTypeId(int $package_type_id) Return the first ChildPackages filtered by the package_type_id column
 * @method     ChildPackages findOneByPersonalized(int $personalized) Return the first ChildPackages filtered by the personalized column *

 * @method     ChildPackages requirePk($key, ConnectionInterface $con = null) Return the ChildPackages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOne(ConnectionInterface $con = null) Return the first ChildPackages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackages requireOneByPackageId(int $package_id) Return the first ChildPackages filtered by the package_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOneByPackageName(string $package_name) Return the first ChildPackages filtered by the package_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOneByPackageType(string $package_type) Return the first ChildPackages filtered by the package_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOneByDuration(int $duration) Return the first ChildPackages filtered by the duration column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOneByPackageTypeId(int $package_type_id) Return the first ChildPackages filtered by the package_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackages requireOneByPersonalized(int $personalized) Return the first ChildPackages filtered by the personalized column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPackages objects based on current ModelCriteria
 * @method     ChildPackages[]|ObjectCollection findByPackageId(int $package_id) Return ChildPackages objects filtered by the package_id column
 * @method     ChildPackages[]|ObjectCollection findByPackageName(string $package_name) Return ChildPackages objects filtered by the package_name column
 * @method     ChildPackages[]|ObjectCollection findByPackageType(string $package_type) Return ChildPackages objects filtered by the package_type column
 * @method     ChildPackages[]|ObjectCollection findByDuration(int $duration) Return ChildPackages objects filtered by the duration column
 * @method     ChildPackages[]|ObjectCollection findByPackageTypeId(int $package_type_id) Return ChildPackages objects filtered by the package_type_id column
 * @method     ChildPackages[]|ObjectCollection findByPersonalized(int $personalized) Return ChildPackages objects filtered by the personalized column
 * @method     ChildPackages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PackagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\PackagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Packages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPackagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPackagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPackagesQuery) {
            return $criteria;
        }
        $query = new ChildPackagesQuery();
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
     * @return ChildPackages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PackagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PackagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPackages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT package_id, package_name, package_type, duration, package_type_id, personalized FROM tf_packages WHERE package_id = :p0';
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
            /** @var ChildPackages $obj */
            $obj = new ChildPackages();
            $obj->hydrate($row);
            PackagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPackages|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the package_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageId(1234); // WHERE package_id = 1234
     * $query->filterByPackageId(array(12, 34)); // WHERE package_id IN (12, 34)
     * $query->filterByPackageId(array('min' => 12)); // WHERE package_id > 12
     * </code>
     *
     * @param     mixed $packageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPackageId($packageId = null, $comparison = null)
    {
        if (is_array($packageId)) {
            $useMinMax = false;
            if (isset($packageId['min'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageId['max'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $packageId, $comparison);
    }

    /**
     * Filter the query on the package_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageName('fooValue');   // WHERE package_name = 'fooValue'
     * $query->filterByPackageName('%fooValue%', Criteria::LIKE); // WHERE package_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $packageName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPackageName($packageName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($packageName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_NAME, $packageName, $comparison);
    }

    /**
     * Filter the query on the package_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageType('fooValue');   // WHERE package_type = 'fooValue'
     * $query->filterByPackageType('%fooValue%', Criteria::LIKE); // WHERE package_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $packageType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPackageType($packageType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($packageType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_TYPE, $packageType, $comparison);
    }

    /**
     * Filter the query on the duration column
     *
     * Example usage:
     * <code>
     * $query->filterByDuration(1234); // WHERE duration = 1234
     * $query->filterByDuration(array(12, 34)); // WHERE duration IN (12, 34)
     * $query->filterByDuration(array('min' => 12)); // WHERE duration > 12
     * </code>
     *
     * @param     mixed $duration The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByDuration($duration = null, $comparison = null)
    {
        if (is_array($duration)) {
            $useMinMax = false;
            if (isset($duration['min'])) {
                $this->addUsingAlias(PackagesTableMap::COL_DURATION, $duration['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($duration['max'])) {
                $this->addUsingAlias(PackagesTableMap::COL_DURATION, $duration['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_DURATION, $duration, $comparison);
    }

    /**
     * Filter the query on the package_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackageTypeId(1234); // WHERE package_type_id = 1234
     * $query->filterByPackageTypeId(array(12, 34)); // WHERE package_type_id IN (12, 34)
     * $query->filterByPackageTypeId(array('min' => 12)); // WHERE package_type_id > 12
     * </code>
     *
     * @param     mixed $packageTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPackageTypeId($packageTypeId = null, $comparison = null)
    {
        if (is_array($packageTypeId)) {
            $useMinMax = false;
            if (isset($packageTypeId['min'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packageTypeId['max'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_TYPE_ID, $packageTypeId, $comparison);
    }

    /**
     * Filter the query on the personalized column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalized(1234); // WHERE personalized = 1234
     * $query->filterByPersonalized(array(12, 34)); // WHERE personalized IN (12, 34)
     * $query->filterByPersonalized(array('min' => 12)); // WHERE personalized > 12
     * </code>
     *
     * @param     mixed $personalized The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPersonalized($personalized = null, $comparison = null)
    {
        if (is_array($personalized)) {
            $useMinMax = false;
            if (isset($personalized['min'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PERSONALIZED, $personalized['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($personalized['max'])) {
                $this->addUsingAlias(PackagesTableMap::COL_PERSONALIZED, $personalized['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackagesTableMap::COL_PERSONALIZED, $personalized, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Bookings object
     *
     * @param \TheFarm\Models\Bookings|ObjectCollection $bookings the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByBookings($bookings, $comparison = null)
    {
        if ($bookings instanceof \TheFarm\Models\Bookings) {
            return $this
                ->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $bookings->getPackageId(), $comparison);
        } elseif ($bookings instanceof ObjectCollection) {
            return $this
                ->useBookingsQuery()
                ->filterByPrimaryKeys($bookings->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildPackagesQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\PackageItems object
     *
     * @param \TheFarm\Models\PackageItems|ObjectCollection $packageItems the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPackagesQuery The current query, for fluid interface
     */
    public function filterByPackageItems($packageItems, $comparison = null)
    {
        if ($packageItems instanceof \TheFarm\Models\PackageItems) {
            return $this
                ->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $packageItems->getPackageId(), $comparison);
        } elseif ($packageItems instanceof ObjectCollection) {
            return $this
                ->usePackageItemsQuery()
                ->filterByPrimaryKeys($packageItems->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackageItems() only accepts arguments of type \TheFarm\Models\PackageItems or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackageItems relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function joinPackageItems($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackageItems');

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
            $this->addJoinObject($join, 'PackageItems');
        }

        return $this;
    }

    /**
     * Use the PackageItems relation PackageItems object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\PackageItemsQuery A secondary query class using the current class as primary query
     */
    public function usePackageItemsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackageItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackageItems', '\TheFarm\Models\PackageItemsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPackages $packages Object to remove from the list of results
     *
     * @return $this|ChildPackagesQuery The current query, for fluid interface
     */
    public function prune($packages = null)
    {
        if ($packages) {
            $this->addUsingAlias(PackagesTableMap::COL_PACKAGE_ID, $packages->getPackageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_packages table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PackagesTableMap::clearInstancePool();
            PackagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PackagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PackagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PackagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PackagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PackagesQuery
