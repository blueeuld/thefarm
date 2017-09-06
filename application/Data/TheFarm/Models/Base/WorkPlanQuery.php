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
use TheFarm\Models\WorkPlan as ChildWorkPlan;
use TheFarm\Models\WorkPlanQuery as ChildWorkPlanQuery;
use TheFarm\Models\Map\WorkPlanTableMap;

/**
 * Base class that represents a query for the 'tf_work_plan' table.
 *
 *
 *
 * @method     ChildWorkPlanQuery orderByWorkPlanCd($order = Criteria::ASC) Order by the work_plan_cd column
 * @method     ChildWorkPlanQuery orderByWorkPlanName($order = Criteria::ASC) Order by the work_plan_name column
 *
 * @method     ChildWorkPlanQuery groupByWorkPlanCd() Group by the work_plan_cd column
 * @method     ChildWorkPlanQuery groupByWorkPlanName() Group by the work_plan_name column
 *
 * @method     ChildWorkPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWorkPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWorkPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWorkPlanQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWorkPlanQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWorkPlanQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWorkPlanQuery leftJoinUserWorkPlanDay($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserWorkPlanDay relation
 * @method     ChildWorkPlanQuery rightJoinUserWorkPlanDay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserWorkPlanDay relation
 * @method     ChildWorkPlanQuery innerJoinUserWorkPlanDay($relationAlias = null) Adds a INNER JOIN clause to the query using the UserWorkPlanDay relation
 *
 * @method     ChildWorkPlanQuery joinWithUserWorkPlanDay($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserWorkPlanDay relation
 *
 * @method     ChildWorkPlanQuery leftJoinWithUserWorkPlanDay() Adds a LEFT JOIN clause and with to the query using the UserWorkPlanDay relation
 * @method     ChildWorkPlanQuery rightJoinWithUserWorkPlanDay() Adds a RIGHT JOIN clause and with to the query using the UserWorkPlanDay relation
 * @method     ChildWorkPlanQuery innerJoinWithUserWorkPlanDay() Adds a INNER JOIN clause and with to the query using the UserWorkPlanDay relation
 *
 * @method     ChildWorkPlanQuery leftJoinProviderSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProviderSchedule relation
 * @method     ChildWorkPlanQuery rightJoinProviderSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProviderSchedule relation
 * @method     ChildWorkPlanQuery innerJoinProviderSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the ProviderSchedule relation
 *
 * @method     ChildWorkPlanQuery joinWithProviderSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProviderSchedule relation
 *
 * @method     ChildWorkPlanQuery leftJoinWithProviderSchedule() Adds a LEFT JOIN clause and with to the query using the ProviderSchedule relation
 * @method     ChildWorkPlanQuery rightJoinWithProviderSchedule() Adds a RIGHT JOIN clause and with to the query using the ProviderSchedule relation
 * @method     ChildWorkPlanQuery innerJoinWithProviderSchedule() Adds a INNER JOIN clause and with to the query using the ProviderSchedule relation
 *
 * @method     \TheFarm\Models\UserWorkPlanDayQuery|\TheFarm\Models\ProviderScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildWorkPlan findOne(ConnectionInterface $con = null) Return the first ChildWorkPlan matching the query
 * @method     ChildWorkPlan findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWorkPlan matching the query, or a new ChildWorkPlan object populated from the query conditions when no match is found
 *
 * @method     ChildWorkPlan findOneByWorkPlanCd(string $work_plan_cd) Return the first ChildWorkPlan filtered by the work_plan_cd column
 * @method     ChildWorkPlan findOneByWorkPlanName(string $work_plan_name) Return the first ChildWorkPlan filtered by the work_plan_name column *

 * @method     ChildWorkPlan requirePk($key, ConnectionInterface $con = null) Return the ChildWorkPlan by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkPlan requireOne(ConnectionInterface $con = null) Return the first ChildWorkPlan matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkPlan requireOneByWorkPlanCd(string $work_plan_cd) Return the first ChildWorkPlan filtered by the work_plan_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWorkPlan requireOneByWorkPlanName(string $work_plan_name) Return the first ChildWorkPlan filtered by the work_plan_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWorkPlan[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWorkPlan objects based on current ModelCriteria
 * @method     ChildWorkPlan[]|ObjectCollection findByWorkPlanCd(string $work_plan_cd) Return ChildWorkPlan objects filtered by the work_plan_cd column
 * @method     ChildWorkPlan[]|ObjectCollection findByWorkPlanName(string $work_plan_name) Return ChildWorkPlan objects filtered by the work_plan_name column
 * @method     ChildWorkPlan[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WorkPlanQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\WorkPlanQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\WorkPlan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWorkPlanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWorkPlanQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWorkPlanQuery) {
            return $criteria;
        }
        $query = new ChildWorkPlanQuery();
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
     * @return ChildWorkPlan|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WorkPlanTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WorkPlanTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWorkPlan A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT work_plan_cd, work_plan_name FROM tf_work_plan WHERE work_plan_cd = :p0';
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
            /** @var ChildWorkPlan $obj */
            $obj = new ChildWorkPlan();
            $obj->hydrate($row);
            WorkPlanTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWorkPlan|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $keys, Criteria::IN);
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
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByWorkPlanCd($workPlanCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $workPlanCd, $comparison);
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
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByWorkPlanName($workPlanName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_NAME, $workPlanName, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\UserWorkPlanDay object
     *
     * @param \TheFarm\Models\UserWorkPlanDay|ObjectCollection $userWorkPlanDay the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByUserWorkPlanDay($userWorkPlanDay, $comparison = null)
    {
        if ($userWorkPlanDay instanceof \TheFarm\Models\UserWorkPlanDay) {
            return $this
                ->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $userWorkPlanDay->getWorkCodeCd(), $comparison);
        } elseif ($userWorkPlanDay instanceof ObjectCollection) {
            return $this
                ->useUserWorkPlanDayQuery()
                ->filterByPrimaryKeys($userWorkPlanDay->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserWorkPlanDay() only accepts arguments of type \TheFarm\Models\UserWorkPlanDay or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserWorkPlanDay relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function joinUserWorkPlanDay($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserWorkPlanDay');

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
            $this->addJoinObject($join, 'UserWorkPlanDay');
        }

        return $this;
    }

    /**
     * Use the UserWorkPlanDay relation UserWorkPlanDay object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserWorkPlanDayQuery A secondary query class using the current class as primary query
     */
    public function useUserWorkPlanDayQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserWorkPlanDay($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserWorkPlanDay', '\TheFarm\Models\UserWorkPlanDayQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ProviderSchedule object
     *
     * @param \TheFarm\Models\ProviderSchedule|ObjectCollection $providerSchedule the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByProviderSchedule($providerSchedule, $comparison = null)
    {
        if ($providerSchedule instanceof \TheFarm\Models\ProviderSchedule) {
            return $this
                ->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $providerSchedule->getWorkPlanCd(), $comparison);
        } elseif ($providerSchedule instanceof ObjectCollection) {
            return $this
                ->useProviderScheduleQuery()
                ->filterByPrimaryKeys($providerSchedule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProviderSchedule() only accepts arguments of type \TheFarm\Models\ProviderSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProviderSchedule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function joinProviderSchedule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProviderSchedule');

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
            $this->addJoinObject($join, 'ProviderSchedule');
        }

        return $this;
    }

    /**
     * Use the ProviderSchedule relation ProviderSchedule object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ProviderScheduleQuery A secondary query class using the current class as primary query
     */
    public function useProviderScheduleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProviderSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProviderSchedule', '\TheFarm\Models\ProviderScheduleQuery');
    }

    /**
     * Filter the query by a related Contact object
     * using the tf_user_work_plan_time table as cross reference
     *
     * @param Contact $contact the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildWorkPlanQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useProviderScheduleQuery()
            ->filterByContact($contact, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWorkPlan $workPlan Object to remove from the list of results
     *
     * @return $this|ChildWorkPlanQuery The current query, for fluid interface
     */
    public function prune($workPlan = null)
    {
        if ($workPlan) {
            $this->addUsingAlias(WorkPlanTableMap::COL_WORK_PLAN_CD, $workPlan->getWorkPlanCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_work_plan table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WorkPlanTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WorkPlanTableMap::clearInstancePool();
            WorkPlanTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WorkPlanTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WorkPlanTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WorkPlanTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WorkPlanTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WorkPlanQuery
