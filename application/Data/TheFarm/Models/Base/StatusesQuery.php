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
use TheFarm\Models\Statuses as ChildStatuses;
use TheFarm\Models\StatusesQuery as ChildStatusesQuery;
use TheFarm\Models\Map\StatusesTableMap;

/**
 * Base class that represents a query for the 'tf_statuses' table.
 *
 *
 *
 * @method     ChildStatusesQuery orderByStatusId($order = Criteria::ASC) Order by the status_id column
 * @method     ChildStatusesQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildStatusesQuery orderByStatusCd($order = Criteria::ASC) Order by the status_cd column
 * @method     ChildStatusesQuery orderByStatusName($order = Criteria::ASC) Order by the status_name column
 * @method     ChildStatusesQuery orderByStatusOrder($order = Criteria::ASC) Order by the status_order column
 * @method     ChildStatusesQuery orderByStatusStyle($order = Criteria::ASC) Order by the status_style column
 * @method     ChildStatusesQuery orderByIncludeInSales($order = Criteria::ASC) Order by the include_in_sales column
 * @method     ChildStatusesQuery orderByIncludeInDuplicateChecking($order = Criteria::ASC) Order by the include_in_duplicate_checking column
 *
 * @method     ChildStatusesQuery groupByStatusId() Group by the status_id column
 * @method     ChildStatusesQuery groupByGroupId() Group by the group_id column
 * @method     ChildStatusesQuery groupByStatusCd() Group by the status_cd column
 * @method     ChildStatusesQuery groupByStatusName() Group by the status_name column
 * @method     ChildStatusesQuery groupByStatusOrder() Group by the status_order column
 * @method     ChildStatusesQuery groupByStatusStyle() Group by the status_style column
 * @method     ChildStatusesQuery groupByIncludeInSales() Group by the include_in_sales column
 * @method     ChildStatusesQuery groupByIncludeInDuplicateChecking() Group by the include_in_duplicate_checking column
 *
 * @method     ChildStatusesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStatusesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStatusesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStatusesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStatusesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStatusesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStatuses findOne(ConnectionInterface $con = null) Return the first ChildStatuses matching the query
 * @method     ChildStatuses findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStatuses matching the query, or a new ChildStatuses object populated from the query conditions when no match is found
 *
 * @method     ChildStatuses findOneByStatusId(int $status_id) Return the first ChildStatuses filtered by the status_id column
 * @method     ChildStatuses findOneByGroupId(int $group_id) Return the first ChildStatuses filtered by the group_id column
 * @method     ChildStatuses findOneByStatusCd(string $status_cd) Return the first ChildStatuses filtered by the status_cd column
 * @method     ChildStatuses findOneByStatusName(string $status_name) Return the first ChildStatuses filtered by the status_name column
 * @method     ChildStatuses findOneByStatusOrder(int $status_order) Return the first ChildStatuses filtered by the status_order column
 * @method     ChildStatuses findOneByStatusStyle(string $status_style) Return the first ChildStatuses filtered by the status_style column
 * @method     ChildStatuses findOneByIncludeInSales(string $include_in_sales) Return the first ChildStatuses filtered by the include_in_sales column
 * @method     ChildStatuses findOneByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return the first ChildStatuses filtered by the include_in_duplicate_checking column *

 * @method     ChildStatuses requirePk($key, ConnectionInterface $con = null) Return the ChildStatuses by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOne(ConnectionInterface $con = null) Return the first ChildStatuses matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStatuses requireOneByStatusId(int $status_id) Return the first ChildStatuses filtered by the status_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByGroupId(int $group_id) Return the first ChildStatuses filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByStatusCd(string $status_cd) Return the first ChildStatuses filtered by the status_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByStatusName(string $status_name) Return the first ChildStatuses filtered by the status_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByStatusOrder(int $status_order) Return the first ChildStatuses filtered by the status_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByStatusStyle(string $status_style) Return the first ChildStatuses filtered by the status_style column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByIncludeInSales(string $include_in_sales) Return the first ChildStatuses filtered by the include_in_sales column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStatuses requireOneByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return the first ChildStatuses filtered by the include_in_duplicate_checking column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStatuses[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStatuses objects based on current ModelCriteria
 * @method     ChildStatuses[]|ObjectCollection findByStatusId(int $status_id) Return ChildStatuses objects filtered by the status_id column
 * @method     ChildStatuses[]|ObjectCollection findByGroupId(int $group_id) Return ChildStatuses objects filtered by the group_id column
 * @method     ChildStatuses[]|ObjectCollection findByStatusCd(string $status_cd) Return ChildStatuses objects filtered by the status_cd column
 * @method     ChildStatuses[]|ObjectCollection findByStatusName(string $status_name) Return ChildStatuses objects filtered by the status_name column
 * @method     ChildStatuses[]|ObjectCollection findByStatusOrder(int $status_order) Return ChildStatuses objects filtered by the status_order column
 * @method     ChildStatuses[]|ObjectCollection findByStatusStyle(string $status_style) Return ChildStatuses objects filtered by the status_style column
 * @method     ChildStatuses[]|ObjectCollection findByIncludeInSales(string $include_in_sales) Return ChildStatuses objects filtered by the include_in_sales column
 * @method     ChildStatuses[]|ObjectCollection findByIncludeInDuplicateChecking(string $include_in_duplicate_checking) Return ChildStatuses objects filtered by the include_in_duplicate_checking column
 * @method     ChildStatuses[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StatusesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\StatusesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Statuses', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStatusesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStatusesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStatusesQuery) {
            return $criteria;
        }
        $query = new ChildStatusesQuery();
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
     * @return ChildStatuses|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StatusesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StatusesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStatuses A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT status_id, group_id, status_cd, status_name, status_order, status_style, include_in_sales, include_in_duplicate_checking FROM tf_statuses WHERE status_id = :p0';
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
            /** @var ChildStatuses $obj */
            $obj = new ChildStatuses();
            $obj->hydrate($row);
            StatusesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStatuses|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the status_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusId(1234); // WHERE status_id = 1234
     * $query->filterByStatusId(array(12, 34)); // WHERE status_id IN (12, 34)
     * $query->filterByStatusId(array('min' => 12)); // WHERE status_id > 12
     * </code>
     *
     * @param     mixed $statusId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByStatusId($statusId = null, $comparison = null)
    {
        if (is_array($statusId)) {
            $useMinMax = false;
            if (isset($statusId['min'])) {
                $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $statusId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusId['max'])) {
                $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $statusId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $statusId, $comparison);
    }

    /**
     * Filter the query on the group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE group_id = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
     * </code>
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(StatusesTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(StatusesTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_GROUP_ID, $groupId, $comparison);
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByStatusCd($statusCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_CD, $statusCd, $comparison);
    }

    /**
     * Filter the query on the status_name column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusName('fooValue');   // WHERE status_name = 'fooValue'
     * $query->filterByStatusName('%fooValue%', Criteria::LIKE); // WHERE status_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByStatusName($statusName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_NAME, $statusName, $comparison);
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByStatusOrder($statusOrder = null, $comparison = null)
    {
        if (is_array($statusOrder)) {
            $useMinMax = false;
            if (isset($statusOrder['min'])) {
                $this->addUsingAlias(StatusesTableMap::COL_STATUS_ORDER, $statusOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($statusOrder['max'])) {
                $this->addUsingAlias(StatusesTableMap::COL_STATUS_ORDER, $statusOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_ORDER, $statusOrder, $comparison);
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByStatusStyle($statusStyle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusStyle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_STATUS_STYLE, $statusStyle, $comparison);
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByIncludeInSales($includeInSales = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInSales)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_INCLUDE_IN_SALES, $includeInSales, $comparison);
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
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function filterByIncludeInDuplicateChecking($includeInDuplicateChecking = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($includeInDuplicateChecking)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatusesTableMap::COL_INCLUDE_IN_DUPLICATE_CHECKING, $includeInDuplicateChecking, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStatuses $statuses Object to remove from the list of results
     *
     * @return $this|ChildStatusesQuery The current query, for fluid interface
     */
    public function prune($statuses = null)
    {
        if ($statuses) {
            $this->addUsingAlias(StatusesTableMap::COL_STATUS_ID, $statuses->getStatusId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_statuses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StatusesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StatusesTableMap::clearInstancePool();
            StatusesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StatusesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StatusesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StatusesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StatusesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StatusesQuery
