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
use TheFarm\Models\UserWorkPlanDay as ChildUserWorkPlanDay;
use TheFarm\Models\UserWorkPlanDayQuery as ChildUserWorkPlanDayQuery;
use TheFarm\Models\Map\UserWorkPlanDayTableMap;

/**
 * Base class that represents a query for the 'tf_user_work_plan_day' table.
 *
 *
 *
 * @method     ChildUserWorkPlanDayQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserWorkPlanDayQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildUserWorkPlanDayQuery orderByWorkCodeCd($order = Criteria::ASC) Order by the work_plan_cd column
 *
 * @method     ChildUserWorkPlanDayQuery groupByUserId() Group by the user_id column
 * @method     ChildUserWorkPlanDayQuery groupByDate() Group by the date column
 * @method     ChildUserWorkPlanDayQuery groupByWorkCodeCd() Group by the work_plan_cd column
 *
 * @method     ChildUserWorkPlanDayQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserWorkPlanDayQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserWorkPlanDayQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserWorkPlanDayQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserWorkPlanDayQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinWorkPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkPlan relation
 * @method     ChildUserWorkPlanDayQuery rightJoinWorkPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkPlan relation
 * @method     ChildUserWorkPlanDayQuery innerJoinWorkPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkPlan relation
 *
 * @method     ChildUserWorkPlanDayQuery joinWithWorkPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkPlan relation
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinWithWorkPlan() Adds a LEFT JOIN clause and with to the query using the WorkPlan relation
 * @method     ChildUserWorkPlanDayQuery rightJoinWithWorkPlan() Adds a RIGHT JOIN clause and with to the query using the WorkPlan relation
 * @method     ChildUserWorkPlanDayQuery innerJoinWithWorkPlan() Adds a INNER JOIN clause and with to the query using the WorkPlan relation
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserWorkPlanDayQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserWorkPlanDayQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserWorkPlanDayQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserWorkPlanDayQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserWorkPlanDayQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \TheFarm\Models\WorkPlanQuery|\TheFarm\Models\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserWorkPlanDay findOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query
 * @method     ChildUserWorkPlanDay findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query, or a new ChildUserWorkPlanDay object populated from the query conditions when no match is found
 *
 * @method     ChildUserWorkPlanDay findOneByUserId(int $user_id) Return the first ChildUserWorkPlanDay filtered by the user_id column
 * @method     ChildUserWorkPlanDay findOneByDate(string $date) Return the first ChildUserWorkPlanDay filtered by the date column
 * @method     ChildUserWorkPlanDay findOneByWorkCodeCd(string $work_plan_cd) Return the first ChildUserWorkPlanDay filtered by the work_plan_cd column *

 * @method     ChildUserWorkPlanDay requirePk($key, ConnectionInterface $con = null) Return the ChildUserWorkPlanDay by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanDay requireOneByUserId(int $user_id) Return the first ChildUserWorkPlanDay filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOneByDate(string $date) Return the first ChildUserWorkPlanDay filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOneByWorkCodeCd(string $work_plan_cd) Return the first ChildUserWorkPlanDay filtered by the work_plan_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanDay[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserWorkPlanDay objects based on current ModelCriteria
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByUserId(int $user_id) Return ChildUserWorkPlanDay objects filtered by the user_id column
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByDate(string $date) Return ChildUserWorkPlanDay objects filtered by the date column
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByWorkCodeCd(string $work_plan_cd) Return ChildUserWorkPlanDay objects filtered by the work_plan_cd column
 * @method     ChildUserWorkPlanDay[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserWorkPlanDayQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\UserWorkPlanDayQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\UserWorkPlanDay', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserWorkPlanDayQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserWorkPlanDayQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserWorkPlanDayQuery) {
            return $criteria;
        }
        $query = new ChildUserWorkPlanDayQuery();
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
     * @return ChildUserWorkPlanDay|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The UserWorkPlanDay object has no primary key');
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
        throw new LogicException('The UserWorkPlanDay object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The UserWorkPlanDay object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The UserWorkPlanDay object has no primary key');
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanDayTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanDayTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the work_plan_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkCodeCd('fooValue');   // WHERE work_plan_cd = 'fooValue'
     * $query->filterByWorkCodeCd('%fooValue%', Criteria::LIKE); // WHERE work_plan_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workCodeCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByWorkCodeCd($workCodeCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workCodeCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanDayTableMap::COL_WORK_PLAN_CD, $workCodeCd, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\WorkPlan object
     *
     * @param \TheFarm\Models\WorkPlan|ObjectCollection $workPlan The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByWorkPlan($workPlan, $comparison = null)
    {
        if ($workPlan instanceof \TheFarm\Models\WorkPlan) {
            return $this
                ->addUsingAlias(UserWorkPlanDayTableMap::COL_WORK_PLAN_CD, $workPlan->getWorkPlanCd(), $comparison);
        } elseif ($workPlan instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserWorkPlanDayTableMap::COL_WORK_PLAN_CD, $workPlan->toKeyValue('PrimaryKey', 'WorkPlanCd'), $comparison);
        } else {
            throw new PropelException('filterByWorkPlan() only accepts arguments of type \TheFarm\Models\WorkPlan or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function joinWorkPlan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('WorkPlan');

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
            $this->addJoinObject($join, 'WorkPlan');
        }

        return $this;
    }

    /**
     * Use the WorkPlan relation WorkPlan object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\WorkPlanQuery A secondary query class using the current class as primary query
     */
    public function useWorkPlanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinWorkPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkPlan', '\TheFarm\Models\WorkPlanQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\User object
     *
     * @param \TheFarm\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \TheFarm\Models\User) {
            return $this
                ->addUsingAlias(UserWorkPlanDayTableMap::COL_USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserWorkPlanDayTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \TheFarm\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\TheFarm\Models\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserWorkPlanDay $userWorkPlanDay Object to remove from the list of results
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function prune($userWorkPlanDay = null)
    {
        if ($userWorkPlanDay) {
            throw new LogicException('UserWorkPlanDay object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_user_work_plan_day table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanDayTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserWorkPlanDayTableMap::clearInstancePool();
            UserWorkPlanDayTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanDayTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserWorkPlanDayTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserWorkPlanDayTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserWorkPlanDayTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserWorkPlanDayQuery
