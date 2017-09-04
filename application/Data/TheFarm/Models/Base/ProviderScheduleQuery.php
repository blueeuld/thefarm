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
use TheFarm\Models\ProviderSchedule as ChildProviderSchedule;
use TheFarm\Models\ProviderScheduleQuery as ChildProviderScheduleQuery;
use TheFarm\Models\Map\ProviderScheduleTableMap;

/**
 * Base class that represents a query for the 'tf_user_work_plan_time' table.
 *
 *
 *
 * @method     ChildProviderScheduleQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildProviderScheduleQuery orderByWorkPlanCd($order = Criteria::ASC) Order by the work_plan_cd column
 * @method     ChildProviderScheduleQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method     ChildProviderScheduleQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method     ChildProviderScheduleQuery orderByIsWorking($order = Criteria::ASC) Order by the is_working column
 *
 * @method     ChildProviderScheduleQuery groupByContactId() Group by the contact_id column
 * @method     ChildProviderScheduleQuery groupByWorkPlanCd() Group by the work_plan_cd column
 * @method     ChildProviderScheduleQuery groupByStartDate() Group by the start_date column
 * @method     ChildProviderScheduleQuery groupByEndDate() Group by the end_date column
 * @method     ChildProviderScheduleQuery groupByIsWorking() Group by the is_working column
 *
 * @method     ChildProviderScheduleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProviderScheduleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProviderScheduleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProviderScheduleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProviderScheduleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProviderScheduleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProviderScheduleQuery leftJoinContact($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contact relation
 * @method     ChildProviderScheduleQuery rightJoinContact($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contact relation
 * @method     ChildProviderScheduleQuery innerJoinContact($relationAlias = null) Adds a INNER JOIN clause to the query using the Contact relation
 *
 * @method     ChildProviderScheduleQuery joinWithContact($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Contact relation
 *
 * @method     ChildProviderScheduleQuery leftJoinWithContact() Adds a LEFT JOIN clause and with to the query using the Contact relation
 * @method     ChildProviderScheduleQuery rightJoinWithContact() Adds a RIGHT JOIN clause and with to the query using the Contact relation
 * @method     ChildProviderScheduleQuery innerJoinWithContact() Adds a INNER JOIN clause and with to the query using the Contact relation
 *
 * @method     ChildProviderScheduleQuery leftJoinWorkPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the WorkPlan relation
 * @method     ChildProviderScheduleQuery rightJoinWorkPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WorkPlan relation
 * @method     ChildProviderScheduleQuery innerJoinWorkPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the WorkPlan relation
 *
 * @method     ChildProviderScheduleQuery joinWithWorkPlan($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the WorkPlan relation
 *
 * @method     ChildProviderScheduleQuery leftJoinWithWorkPlan() Adds a LEFT JOIN clause and with to the query using the WorkPlan relation
 * @method     ChildProviderScheduleQuery rightJoinWithWorkPlan() Adds a RIGHT JOIN clause and with to the query using the WorkPlan relation
 * @method     ChildProviderScheduleQuery innerJoinWithWorkPlan() Adds a INNER JOIN clause and with to the query using the WorkPlan relation
 *
 * @method     \TheFarm\Models\ContactQuery|\TheFarm\Models\UserWorkPlanCodeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProviderSchedule findOne(ConnectionInterface $con = null) Return the first ChildProviderSchedule matching the query
 * @method     ChildProviderSchedule findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProviderSchedule matching the query, or a new ChildProviderSchedule object populated from the query conditions when no match is found
 *
 * @method     ChildProviderSchedule findOneByContactId(int $contact_id) Return the first ChildProviderSchedule filtered by the contact_id column
 * @method     ChildProviderSchedule findOneByWorkPlanCd(string $work_plan_cd) Return the first ChildProviderSchedule filtered by the work_plan_cd column
 * @method     ChildProviderSchedule findOneByStartDate(string $start_date) Return the first ChildProviderSchedule filtered by the start_date column
 * @method     ChildProviderSchedule findOneByEndDate(string $end_date) Return the first ChildProviderSchedule filtered by the end_date column
 * @method     ChildProviderSchedule findOneByIsWorking(boolean $is_working) Return the first ChildProviderSchedule filtered by the is_working column *

 * @method     ChildProviderSchedule requirePk($key, ConnectionInterface $con = null) Return the ChildProviderSchedule by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProviderSchedule requireOne(ConnectionInterface $con = null) Return the first ChildProviderSchedule matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProviderSchedule requireOneByContactId(int $contact_id) Return the first ChildProviderSchedule filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProviderSchedule requireOneByWorkPlanCd(string $work_plan_cd) Return the first ChildProviderSchedule filtered by the work_plan_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProviderSchedule requireOneByStartDate(string $start_date) Return the first ChildProviderSchedule filtered by the start_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProviderSchedule requireOneByEndDate(string $end_date) Return the first ChildProviderSchedule filtered by the end_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProviderSchedule requireOneByIsWorking(boolean $is_working) Return the first ChildProviderSchedule filtered by the is_working column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProviderSchedule[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProviderSchedule objects based on current ModelCriteria
 * @method     ChildProviderSchedule[]|ObjectCollection findByContactId(int $contact_id) Return ChildProviderSchedule objects filtered by the contact_id column
 * @method     ChildProviderSchedule[]|ObjectCollection findByWorkPlanCd(string $work_plan_cd) Return ChildProviderSchedule objects filtered by the work_plan_cd column
 * @method     ChildProviderSchedule[]|ObjectCollection findByStartDate(string $start_date) Return ChildProviderSchedule objects filtered by the start_date column
 * @method     ChildProviderSchedule[]|ObjectCollection findByEndDate(string $end_date) Return ChildProviderSchedule objects filtered by the end_date column
 * @method     ChildProviderSchedule[]|ObjectCollection findByIsWorking(boolean $is_working) Return ChildProviderSchedule objects filtered by the is_working column
 * @method     ChildProviderSchedule[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProviderScheduleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ProviderScheduleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\ProviderSchedule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProviderScheduleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProviderScheduleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProviderScheduleQuery) {
            return $criteria;
        }
        $query = new ChildProviderScheduleQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$contact_id, $start_date, $end_date] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProviderSchedule|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProviderScheduleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProviderScheduleTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildProviderSchedule A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT contact_id, work_plan_cd, start_date, end_date, is_working FROM tf_user_work_plan_time WHERE contact_id = :p0 AND start_date = :p1 AND end_date = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1] ? $key[1]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2] ? $key[2]->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProviderSchedule $obj */
            $obj = new ChildProviderSchedule();
            $obj->hydrate($row);
            ProviderScheduleTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildProviderSchedule|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ProviderScheduleTableMap::COL_START_DATE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(ProviderScheduleTableMap::COL_END_DATE, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ProviderScheduleTableMap::COL_CONTACT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ProviderScheduleTableMap::COL_START_DATE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(ProviderScheduleTableMap::COL_END_DATE, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $contactId, $comparison);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByWorkPlanCd($workPlanCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderScheduleTableMap::COL_WORK_PLAN_CD, $workPlanCd, $comparison);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (is_array($startDate)) {
            $useMinMax = false;
            if (isset($startDate['min'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_START_DATE, $startDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDate['max'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_START_DATE, $startDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderScheduleTableMap::COL_START_DATE, $startDate, $comparison);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (is_array($endDate)) {
            $useMinMax = false;
            if (isset($endDate['min'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_END_DATE, $endDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDate['max'])) {
                $this->addUsingAlias(ProviderScheduleTableMap::COL_END_DATE, $endDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProviderScheduleTableMap::COL_END_DATE, $endDate, $comparison);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByIsWorking($isWorking = null, $comparison = null)
    {
        if (is_string($isWorking)) {
            $isWorking = in_array(strtolower($isWorking), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProviderScheduleTableMap::COL_IS_WORKING, $isWorking, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProviderScheduleTableMap::COL_CONTACT_ID, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
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
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\UserWorkPlanCode object
     *
     * @param \TheFarm\Models\UserWorkPlanCode|ObjectCollection $userWorkPlanCode The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function filterByWorkPlan($userWorkPlanCode, $comparison = null)
    {
        if ($userWorkPlanCode instanceof \TheFarm\Models\UserWorkPlanCode) {
            return $this
                ->addUsingAlias(ProviderScheduleTableMap::COL_WORK_PLAN_CD, $userWorkPlanCode->getWorkPlanCd(), $comparison);
        } elseif ($userWorkPlanCode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProviderScheduleTableMap::COL_WORK_PLAN_CD, $userWorkPlanCode->toKeyValue('PrimaryKey', 'WorkPlanCd'), $comparison);
        } else {
            throw new PropelException('filterByWorkPlan() only accepts arguments of type \TheFarm\Models\UserWorkPlanCode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the WorkPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function joinWorkPlan($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
     * Use the WorkPlan relation UserWorkPlanCode object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\UserWorkPlanCodeQuery A secondary query class using the current class as primary query
     */
    public function useWorkPlanQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinWorkPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'WorkPlan', '\TheFarm\Models\UserWorkPlanCodeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProviderSchedule $providerSchedule Object to remove from the list of results
     *
     * @return $this|ChildProviderScheduleQuery The current query, for fluid interface
     */
    public function prune($providerSchedule = null)
    {
        if ($providerSchedule) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ProviderScheduleTableMap::COL_CONTACT_ID), $providerSchedule->getContactId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ProviderScheduleTableMap::COL_START_DATE), $providerSchedule->getStartDate(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(ProviderScheduleTableMap::COL_END_DATE), $providerSchedule->getEndDate(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderScheduleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProviderScheduleTableMap::clearInstancePool();
            ProviderScheduleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProviderScheduleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProviderScheduleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProviderScheduleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProviderScheduleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProviderScheduleQuery
