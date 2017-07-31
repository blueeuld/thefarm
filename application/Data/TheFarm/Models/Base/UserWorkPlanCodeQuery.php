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
use TheFarm\Models\UserWorkPlanCode as ChildUserWorkPlanCode;
use TheFarm\Models\UserWorkPlanCodeQuery as ChildUserWorkPlanCodeQuery;
use TheFarm\Models\Map\UserWorkPlanCodeTableMap;

/**
 * Base class that represents a query for the 'tf_user_work_plan_code' table.
 *
 *
 *
 * @method     ChildUserWorkPlanCodeQuery orderByWorkPlanCd($order = Criteria::ASC) Order by the work_plan_cd column
 * @method     ChildUserWorkPlanCodeQuery orderByWorkPlanName($order = Criteria::ASC) Order by the work_plan_name column
 *
 * @method     ChildUserWorkPlanCodeQuery groupByWorkPlanCd() Group by the work_plan_cd column
 * @method     ChildUserWorkPlanCodeQuery groupByWorkPlanName() Group by the work_plan_name column
 *
 * @method     ChildUserWorkPlanCodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserWorkPlanCodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserWorkPlanCodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserWorkPlanCodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserWorkPlanCodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserWorkPlanCodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserWorkPlanCode findOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanCode matching the query
 * @method     ChildUserWorkPlanCode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserWorkPlanCode matching the query, or a new ChildUserWorkPlanCode object populated from the query conditions when no match is found
 *
 * @method     ChildUserWorkPlanCode findOneByWorkPlanCd(string $work_plan_cd) Return the first ChildUserWorkPlanCode filtered by the work_plan_cd column
 * @method     ChildUserWorkPlanCode findOneByWorkPlanName(string $work_plan_name) Return the first ChildUserWorkPlanCode filtered by the work_plan_name column *

 * @method     ChildUserWorkPlanCode requirePk($key, ConnectionInterface $con = null) Return the ChildUserWorkPlanCode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanCode requireOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanCode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanCode requireOneByWorkPlanCd(string $work_plan_cd) Return the first ChildUserWorkPlanCode filtered by the work_plan_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanCode requireOneByWorkPlanName(string $work_plan_name) Return the first ChildUserWorkPlanCode filtered by the work_plan_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanCode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserWorkPlanCode objects based on current ModelCriteria
 * @method     ChildUserWorkPlanCode[]|ObjectCollection findByWorkPlanCd(string $work_plan_cd) Return ChildUserWorkPlanCode objects filtered by the work_plan_cd column
 * @method     ChildUserWorkPlanCode[]|ObjectCollection findByWorkPlanName(string $work_plan_name) Return ChildUserWorkPlanCode objects filtered by the work_plan_name column
 * @method     ChildUserWorkPlanCode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserWorkPlanCodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\UserWorkPlanCodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\UserWorkPlanCode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserWorkPlanCodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserWorkPlanCodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserWorkPlanCodeQuery) {
            return $criteria;
        }
        $query = new ChildUserWorkPlanCodeQuery();
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
     * @return ChildUserWorkPlanCode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserWorkPlanCodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserWorkPlanCode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT work_plan_cd, work_plan_name FROM tf_user_work_plan_code WHERE work_plan_cd = :p0';
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
            /** @var ChildUserWorkPlanCode $obj */
            $obj = new ChildUserWorkPlanCode();
            $obj->hydrate($row);
            UserWorkPlanCodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserWorkPlanCode|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserWorkPlanCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserWorkPlanCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the work_plan_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkPlanCd('fooValue');   // WHERE work_plan_cd = 'fooValue'
     * $query->filterByWorkPlanCd('%fooValue%', Criteria::LIKE); // WHERE work_plan_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workPlanCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanCodeQuery The current query, for fluid interface
     */
    public function filterByWorkPlanCd($workPlanCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $workPlanCd, $comparison);
    }

    /**
     * Filter the query on the work_plan_name column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkPlanName('fooValue');   // WHERE work_plan_name = 'fooValue'
     * $query->filterByWorkPlanName('%fooValue%', Criteria::LIKE); // WHERE work_plan_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workPlanName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanCodeQuery The current query, for fluid interface
     */
    public function filterByWorkPlanName($workPlanName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanCodeTableMap::COL_WORK_PLAN_NAME, $workPlanName, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserWorkPlanCode $userWorkPlanCode Object to remove from the list of results
     *
     * @return $this|ChildUserWorkPlanCodeQuery The current query, for fluid interface
     */
    public function prune($userWorkPlanCode = null)
    {
        if ($userWorkPlanCode) {
            $this->addUsingAlias(UserWorkPlanCodeTableMap::COL_WORK_PLAN_CD, $userWorkPlanCode->getWorkPlanCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_user_work_plan_code table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserWorkPlanCodeTableMap::clearInstancePool();
            UserWorkPlanCodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanCodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserWorkPlanCodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserWorkPlanCodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserWorkPlanCodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserWorkPlanCodeQuery
