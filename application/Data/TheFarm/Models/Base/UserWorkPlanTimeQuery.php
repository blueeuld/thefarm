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
use TheFarm\Models\UserWorkPlanTime as ChildUserWorkPlanTime;
use TheFarm\Models\UserWorkPlanTimeQuery as ChildUserWorkPlanTimeQuery;
use TheFarm\Models\Map\UserWorkPlanTimeTableMap;

/**
 * Base class that represents a query for the 'tf_user_work_plan_time' table.
 *
 *
 *
 * @method     ChildUserWorkPlanTimeQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildUserWorkPlanTimeQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildUserWorkPlanTimeQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildUserWorkPlanTimeQuery orderByIsWorking($order = Criteria::ASC) Order by the is_working column
 *
 * @method     ChildUserWorkPlanTimeQuery groupByContactId() Group by the contact_id column
 * @method     ChildUserWorkPlanTimeQuery groupByStartDate() Group by the start_date column
 * @method     ChildUserWorkPlanTimeQuery groupByEndDate() Group by the end_date column
 * @method     ChildUserWorkPlanTimeQuery groupByIsWorking() Group by the is_working column
 *
 * @method     ChildUserWorkPlanTimeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserWorkPlanTimeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserWorkPlanTimeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserWorkPlanTimeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserWorkPlanTimeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserWorkPlanTimeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserWorkPlanTimeQuery leftJoinContact($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contact relation
 * @method     ChildUserWorkPlanTimeQuery rightJoinContact($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contact relation
 * @method     ChildUserWorkPlanTimeQuery innerJoinContact($relationAlias = null) Adds a INNER JOIN clause to the query using the Contact relation
 *
 * @method     ChildUserWorkPlanTimeQuery joinWithContact($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Contact relation
 *
 * @method     ChildUserWorkPlanTimeQuery leftJoinWithContact() Adds a LEFT JOIN clause and with to the query using the Contact relation
 * @method     ChildUserWorkPlanTimeQuery rightJoinWithContact() Adds a RIGHT JOIN clause and with to the query using the Contact relation
 * @method     ChildUserWorkPlanTimeQuery innerJoinWithContact() Adds a INNER JOIN clause and with to the query using the Contact relation
 *
 * @method     \TheFarm\Models\ContactQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserWorkPlanTime findOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanTime matching the query
 * @method     ChildUserWorkPlanTime findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserWorkPlanTime matching the query, or a new ChildUserWorkPlanTime object populated from the query conditions when no match is found
 *
 * @method     ChildUserWorkPlanTime findOneByContactId(int $contact_id) Return the first ChildUserWorkPlanTime filtered by the contact_id column
 * @method     ChildUserWorkPlanTime findOneByStartDate(string $start_date) Return the first ChildUserWorkPlanTime filtered by the start_date column
 * @method     ChildUserWorkPlanTime findOneByEndDate(string $end_date) Return the first ChildUserWorkPlanTime filtered by the end_date column
 * @method     ChildUserWorkPlanTime findOneByIsWorking(boolean $is_working) Return the first ChildUserWorkPlanTime filtered by the is_working column *

 * @method     ChildUserWorkPlanTime requirePk($key, ConnectionInterface $con = null) Return the ChildUserWorkPlanTime by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanTime requireOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanTime matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanTime requireOneByContactId(int $contact_id) Return the first ChildUserWorkPlanTime filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanTime requireOneByStartDate(string $start_date) Return the first ChildUserWorkPlanTime filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanTime requireOneByEndDate(string $end_date) Return the first ChildUserWorkPlanTime filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanTime requireOneByIsWorking(boolean $is_working) Return the first ChildUserWorkPlanTime filtered by the is_working column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanTime[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserWorkPlanTime objects based on current ModelCriteria
 * @method     ChildUserWorkPlanTime[]|ObjectCollection findByContactId(int $contact_id) Return ChildUserWorkPlanTime objects filtered by the contact_id column
 * @method     ChildUserWorkPlanTime[]|ObjectCollection findByStartDate(string $start_date) Return ChildUserWorkPlanTime objects filtered by the start_date column
 * @method     ChildUserWorkPlanTime[]|ObjectCollection findByEndDate(string $end_date) Return ChildUserWorkPlanTime objects filtered by the end_date column
 * @method     ChildUserWorkPlanTime[]|ObjectCollection findByIsWorking(boolean $is_working) Return ChildUserWorkPlanTime objects filtered by the is_working column
 * @method     ChildUserWorkPlanTime[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserWorkPlanTimeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\UserWorkPlanTimeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\UserWorkPlanTime', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserWorkPlanTimeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserWorkPlanTimeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserWorkPlanTimeQuery) {
            return $criteria;
        }
        $query = new ChildUserWorkPlanTimeQuery();
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
     * $obj = $c->findPk(array(12, 34, 56, 78), $con);
     * </code>
     *
     * @param array[$contact_id, $start_date, $end_date, $is_working] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserWorkPlanTime|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserWorkPlanTimeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserWorkPlanTimeTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]))))) {
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
     * @return ChildUserWorkPlanTime A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT contact_id, start_date, end_date, is_working FROM tf_user_work_plan_time WHERE contact_id = :p0 AND start_date = :p1 AND end_date = :p2 AND is_working = :p3';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1] ? $key[1]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2] ? $key[2]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->bindValue(':p3', (int) $key[3], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUserWorkPlanTime $obj */
            $obj = new ChildUserWorkPlanTime();
            $obj->hydrate($row);
            UserWorkPlanTimeTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2]), (null === $key[3] || is_scalar($key[3]) || is_callable([$key[3], '__toString']) ? (string) $key[3] : $key[3])]));
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
     * @return ChildUserWorkPlanTime|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_START_DATE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_END_DATE, $key[2], Criteria::EQUAL);
        $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_IS_WORKING, $key[3], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UserWorkPlanTimeTableMap::COL_START_DATE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(UserWorkPlanTimeTableMap::COL_END_DATE, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $cton3 = $this->getNewCriterion(UserWorkPlanTimeTableMap::COL_IS_WORKING, $key[3], Criteria::EQUAL);
            $cton0->addAnd($cton3);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the contact_id column
     *
     * Example usage:
     * <code>
     * $query->filterByContactId(1234); // WHERE contact_id = 1234
     * $query->filterByContactId(array(12, 34)); // WHERE contact_id IN (12, 34)
     * $query->filterByContactId(array('min' => 12)); // WHERE contact_id > 12
     * </code>
     *
     * @see       filterByContact()
     *
     * @param     mixed $contactId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $contactId, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('2011-03-14'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate('now'); // WHERE start_date = '2011-03-14'
     * $query->filterByStartDate(array('max' => 'yesterday')); // WHERE start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('2011-03-14'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate('now'); // WHERE end_date = '2011-03-14'
     * $query->filterByEndDate(array('max' => 'yesterday')); // WHERE end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_END_DATE, $endDate, $comparison);
    }

    /**
     * Filter the query on the is_working column
     *
     * Example usage:
     * <code>
     * $query->filterByIsWorking(true); // WHERE is_working = true
     * $query->filterByIsWorking('yes'); // WHERE is_working = true
     * </code>
     *
     * @param     boolean|string $isWorking The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByIsWorking($isWorking = null, $comparison = null)
    {
        if (is_string($isWorking)) {
            $isWorking = in_array(strtolower($isWorking), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserWorkPlanTimeTableMap::COL_IS_WORKING, $isWorking, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserWorkPlanTimeTableMap::COL_CONTACT_ID, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContact() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Contact relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function joinContact($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Contact');

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
            $this->addJoinObject($join, 'Contact');
        }

        return $this;
    }

    /**
     * Use the Contact relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContact($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Contact', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserWorkPlanTime $userWorkPlanTime Object to remove from the list of results
     *
     * @return $this|ChildUserWorkPlanTimeQuery The current query, for fluid interface
     */
    public function prune($userWorkPlanTime = null)
    {
        if ($userWorkPlanTime) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UserWorkPlanTimeTableMap::COL_CONTACT_ID), $userWorkPlanTime->getContactId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UserWorkPlanTimeTableMap::COL_START_DATE), $userWorkPlanTime->getStartDate(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(UserWorkPlanTimeTableMap::COL_END_DATE), $userWorkPlanTime->getEndDate(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond3', $this->getAliasedColName(UserWorkPlanTimeTableMap::COL_IS_WORKING), $userWorkPlanTime->getIsWorking(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2', 'pruneCond3'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_user_work_plan_time table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanTimeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserWorkPlanTimeTableMap::clearInstancePool();
            UserWorkPlanTimeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserWorkPlanTimeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserWorkPlanTimeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserWorkPlanTimeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserWorkPlanTimeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserWorkPlanTimeQuery
