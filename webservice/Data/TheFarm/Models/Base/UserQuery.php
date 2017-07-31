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
use TheFarm\Models\User as ChildUser;
use TheFarm\Models\UserQuery as ChildUserQuery;
use TheFarm\Models\Map\UserTableMap;

/**
 * Base class that represents a query for the 'tf_users' table.
 *
 *
 *
 * @method     ChildUserQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUserQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildUserQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUserQuery orderByWorkPlan($order = Criteria::ASC) Order by the work_plan column
 * @method     ChildUserQuery orderByWorkPlanCode($order = Criteria::ASC) Order by the work_plan_code column
 * @method     ChildUserQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildUserQuery orderByFacebookId($order = Criteria::ASC) Order by the facebook_id column
 * @method     ChildUserQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method     ChildUserQuery orderByCalendarViewPositions($order = Criteria::ASC) Order by the calendar_view_positions column
 * @method     ChildUserQuery orderByCalendarViewStatus($order = Criteria::ASC) Order by the calendar_view_status column
 * @method     ChildUserQuery orderByCalendarShowMyScheduleOnly($order = Criteria::ASC) Order by the calendar_show_my_schedule_only column
 * @method     ChildUserQuery orderByCalendarViewLocations($order = Criteria::ASC) Order by the calendar_view_locations column
 * @method     ChildUserQuery orderByPreferences($order = Criteria::ASC) Order by the preferences column
 * @method     ChildUserQuery orderByCalendarShowNoSchedule($order = Criteria::ASC) Order by the calendar_show_no_schedule column
 *
 * @method     ChildUserQuery groupByContactId() Group by the contact_id column
 * @method     ChildUserQuery groupByUsername() Group by the username column
 * @method     ChildUserQuery groupByGroupId() Group by the group_id column
 * @method     ChildUserQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUserQuery groupByPassword() Group by the password column
 * @method     ChildUserQuery groupByWorkPlan() Group by the work_plan column
 * @method     ChildUserQuery groupByWorkPlanCode() Group by the work_plan_code column
 * @method     ChildUserQuery groupByLocationId() Group by the location_id column
 * @method     ChildUserQuery groupByFacebookId() Group by the facebook_id column
 * @method     ChildUserQuery groupByOrder() Group by the order column
 * @method     ChildUserQuery groupByCalendarViewPositions() Group by the calendar_view_positions column
 * @method     ChildUserQuery groupByCalendarViewStatus() Group by the calendar_view_status column
 * @method     ChildUserQuery groupByCalendarShowMyScheduleOnly() Group by the calendar_show_my_schedule_only column
 * @method     ChildUserQuery groupByCalendarViewLocations() Group by the calendar_view_locations column
 * @method     ChildUserQuery groupByPreferences() Group by the preferences column
 * @method     ChildUserQuery groupByCalendarShowNoSchedule() Group by the calendar_show_no_schedule column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserQuery leftJoinContact($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contact relation
 * @method     ChildUserQuery rightJoinContact($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contact relation
 * @method     ChildUserQuery innerJoinContact($relationAlias = null) Adds a INNER JOIN clause to the query using the Contact relation
 *
 * @method     ChildUserQuery joinWithContact($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Contact relation
 *
 * @method     ChildUserQuery leftJoinWithContact() Adds a LEFT JOIN clause and with to the query using the Contact relation
 * @method     ChildUserQuery rightJoinWithContact() Adds a RIGHT JOIN clause and with to the query using the Contact relation
 * @method     ChildUserQuery innerJoinWithContact() Adds a INNER JOIN clause and with to the query using the Contact relation
 *
 * @method     ChildUserQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     ChildUserQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     ChildUserQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     ChildUserQuery joinWithGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Group relation
 *
 * @method     ChildUserQuery leftJoinWithGroup() Adds a LEFT JOIN clause and with to the query using the Group relation
 * @method     ChildUserQuery rightJoinWithGroup() Adds a RIGHT JOIN clause and with to the query using the Group relation
 * @method     ChildUserQuery innerJoinWithGroup() Adds a INNER JOIN clause and with to the query using the Group relation
 *
 * @method     ChildUserQuery leftJoinLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Location relation
 * @method     ChildUserQuery rightJoinLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Location relation
 * @method     ChildUserQuery innerJoinLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Location relation
 *
 * @method     ChildUserQuery joinWithLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Location relation
 *
 * @method     ChildUserQuery leftJoinWithLocation() Adds a LEFT JOIN clause and with to the query using the Location relation
 * @method     ChildUserQuery rightJoinWithLocation() Adds a RIGHT JOIN clause and with to the query using the Location relation
 * @method     ChildUserQuery innerJoinWithLocation() Adds a INNER JOIN clause and with to the query using the Location relation
 *
 * @method     \TheFarm\Models\ContactQuery|\TheFarm\Models\GroupQuery|\TheFarm\Models\LocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByContactId(int $contact_id) Return the first ChildUser filtered by the contact_id column
 * @method     ChildUser findOneByUsername(string $username) Return the first ChildUser filtered by the username column
 * @method     ChildUser findOneByGroupId(int $group_id) Return the first ChildUser filtered by the group_id column
 * @method     ChildUser findOneByLastLogin(int $last_login) Return the first ChildUser filtered by the last_login column
 * @method     ChildUser findOneByPassword(string $password) Return the first ChildUser filtered by the password column
 * @method     ChildUser findOneByWorkPlan(string $work_plan) Return the first ChildUser filtered by the work_plan column
 * @method     ChildUser findOneByWorkPlanCode(string $work_plan_code) Return the first ChildUser filtered by the work_plan_code column
 * @method     ChildUser findOneByLocationId(int $location_id) Return the first ChildUser filtered by the location_id column
 * @method     ChildUser findOneByFacebookId(string $facebook_id) Return the first ChildUser filtered by the facebook_id column
 * @method     ChildUser findOneByOrder(int $order) Return the first ChildUser filtered by the order column
 * @method     ChildUser findOneByCalendarViewPositions(string $calendar_view_positions) Return the first ChildUser filtered by the calendar_view_positions column
 * @method     ChildUser findOneByCalendarViewStatus(string $calendar_view_status) Return the first ChildUser filtered by the calendar_view_status column
 * @method     ChildUser findOneByCalendarShowMyScheduleOnly(string $calendar_show_my_schedule_only) Return the first ChildUser filtered by the calendar_show_my_schedule_only column
 * @method     ChildUser findOneByCalendarViewLocations(string $calendar_view_locations) Return the first ChildUser filtered by the calendar_view_locations column
 * @method     ChildUser findOneByPreferences(string $preferences) Return the first ChildUser filtered by the preferences column
 * @method     ChildUser findOneByCalendarShowNoSchedule(string $calendar_show_no_schedule) Return the first ChildUser filtered by the calendar_show_no_schedule column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByContactId(int $contact_id) Return the first ChildUser filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUsername(string $username) Return the first ChildUser filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByGroupId(int $group_id) Return the first ChildUser filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLastLogin(int $last_login) Return the first ChildUser filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPassword(string $password) Return the first ChildUser filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWorkPlan(string $work_plan) Return the first ChildUser filtered by the work_plan column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWorkPlanCode(string $work_plan_code) Return the first ChildUser filtered by the work_plan_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLocationId(int $location_id) Return the first ChildUser filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFacebookId(string $facebook_id) Return the first ChildUser filtered by the facebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByOrder(int $order) Return the first ChildUser filtered by the order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCalendarViewPositions(string $calendar_view_positions) Return the first ChildUser filtered by the calendar_view_positions column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCalendarViewStatus(string $calendar_view_status) Return the first ChildUser filtered by the calendar_view_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCalendarShowMyScheduleOnly(string $calendar_show_my_schedule_only) Return the first ChildUser filtered by the calendar_show_my_schedule_only column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCalendarViewLocations(string $calendar_view_locations) Return the first ChildUser filtered by the calendar_view_locations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPreferences(string $preferences) Return the first ChildUser filtered by the preferences column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByCalendarShowNoSchedule(string $calendar_show_no_schedule) Return the first ChildUser filtered by the calendar_show_no_schedule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByContactId(int $contact_id) Return ChildUser objects filtered by the contact_id column
 * @method     ChildUser[]|ObjectCollection findByUsername(string $username) Return ChildUser objects filtered by the username column
 * @method     ChildUser[]|ObjectCollection findByGroupId(int $group_id) Return ChildUser objects filtered by the group_id column
 * @method     ChildUser[]|ObjectCollection findByLastLogin(int $last_login) Return ChildUser objects filtered by the last_login column
 * @method     ChildUser[]|ObjectCollection findByPassword(string $password) Return ChildUser objects filtered by the password column
 * @method     ChildUser[]|ObjectCollection findByWorkPlan(string $work_plan) Return ChildUser objects filtered by the work_plan column
 * @method     ChildUser[]|ObjectCollection findByWorkPlanCode(string $work_plan_code) Return ChildUser objects filtered by the work_plan_code column
 * @method     ChildUser[]|ObjectCollection findByLocationId(int $location_id) Return ChildUser objects filtered by the location_id column
 * @method     ChildUser[]|ObjectCollection findByFacebookId(string $facebook_id) Return ChildUser objects filtered by the facebook_id column
 * @method     ChildUser[]|ObjectCollection findByOrder(int $order) Return ChildUser objects filtered by the order column
 * @method     ChildUser[]|ObjectCollection findByCalendarViewPositions(string $calendar_view_positions) Return ChildUser objects filtered by the calendar_view_positions column
 * @method     ChildUser[]|ObjectCollection findByCalendarViewStatus(string $calendar_view_status) Return ChildUser objects filtered by the calendar_view_status column
 * @method     ChildUser[]|ObjectCollection findByCalendarShowMyScheduleOnly(string $calendar_show_my_schedule_only) Return ChildUser objects filtered by the calendar_show_my_schedule_only column
 * @method     ChildUser[]|ObjectCollection findByCalendarViewLocations(string $calendar_view_locations) Return ChildUser objects filtered by the calendar_view_locations column
 * @method     ChildUser[]|ObjectCollection findByPreferences(string $preferences) Return ChildUser objects filtered by the preferences column
 * @method     ChildUser[]|ObjectCollection findByCalendarShowNoSchedule(string $calendar_show_no_schedule) Return ChildUser objects filtered by the calendar_show_no_schedule column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT contact_id, username, group_id, last_login, password, work_plan, work_plan_code, location_id, facebook_id, order, calendar_view_positions, calendar_view_status, calendar_show_my_schedule_only, calendar_view_locations, preferences, calendar_show_no_schedule FROM tf_users WHERE contact_id = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $contactId, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USERNAME, $username, $comparison);
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
     * @see       filterByGroup()
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_GROUP_ID, $groupId, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param     mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UserTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UserTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the work_plan column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkPlan('fooValue');   // WHERE work_plan = 'fooValue'
     * $query->filterByWorkPlan('%fooValue%', Criteria::LIKE); // WHERE work_plan LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workPlan The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByWorkPlan($workPlan = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlan)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_WORK_PLAN, $workPlan, $comparison);
    }

    /**
     * Filter the query on the work_plan_code column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkPlanCode('fooValue');   // WHERE work_plan_code = 'fooValue'
     * $query->filterByWorkPlanCode('%fooValue%', Criteria::LIKE); // WHERE work_plan_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workPlanCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByWorkPlanCode($workPlanCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workPlanCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_WORK_PLAN_CODE, $workPlanCode, $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the facebook_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFacebookId('fooValue');   // WHERE facebook_id = 'fooValue'
     * $query->filterByFacebookId('%fooValue%', Criteria::LIKE); // WHERE facebook_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $facebookId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByFacebookId($facebookId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($facebookId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_FACEBOOK_ID, $facebookId, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ORDER, $order, $comparison);
    }

    /**
     * Filter the query on the calendar_view_positions column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarViewPositions('fooValue');   // WHERE calendar_view_positions = 'fooValue'
     * $query->filterByCalendarViewPositions('%fooValue%', Criteria::LIKE); // WHERE calendar_view_positions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarViewPositions The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCalendarViewPositions($calendarViewPositions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarViewPositions)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CALENDAR_VIEW_POSITIONS, $calendarViewPositions, $comparison);
    }

    /**
     * Filter the query on the calendar_view_status column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarViewStatus('fooValue');   // WHERE calendar_view_status = 'fooValue'
     * $query->filterByCalendarViewStatus('%fooValue%', Criteria::LIKE); // WHERE calendar_view_status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarViewStatus The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCalendarViewStatus($calendarViewStatus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarViewStatus)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CALENDAR_VIEW_STATUS, $calendarViewStatus, $comparison);
    }

    /**
     * Filter the query on the calendar_show_my_schedule_only column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarShowMyScheduleOnly('fooValue');   // WHERE calendar_show_my_schedule_only = 'fooValue'
     * $query->filterByCalendarShowMyScheduleOnly('%fooValue%', Criteria::LIKE); // WHERE calendar_show_my_schedule_only LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarShowMyScheduleOnly The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCalendarShowMyScheduleOnly($calendarShowMyScheduleOnly = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarShowMyScheduleOnly)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY, $calendarShowMyScheduleOnly, $comparison);
    }

    /**
     * Filter the query on the calendar_view_locations column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarViewLocations('fooValue');   // WHERE calendar_view_locations = 'fooValue'
     * $query->filterByCalendarViewLocations('%fooValue%', Criteria::LIKE); // WHERE calendar_view_locations LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarViewLocations The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCalendarViewLocations($calendarViewLocations = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarViewLocations)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CALENDAR_VIEW_LOCATIONS, $calendarViewLocations, $comparison);
    }

    /**
     * Filter the query on the preferences column
     *
     * Example usage:
     * <code>
     * $query->filterByPreferences('fooValue');   // WHERE preferences = 'fooValue'
     * $query->filterByPreferences('%fooValue%', Criteria::LIKE); // WHERE preferences LIKE '%fooValue%'
     * </code>
     *
     * @param     string $preferences The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPreferences($preferences = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($preferences)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PREFERENCES, $preferences, $comparison);
    }

    /**
     * Filter the query on the calendar_show_no_schedule column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendarShowNoSchedule('fooValue');   // WHERE calendar_show_no_schedule = 'fooValue'
     * $query->filterByCalendarShowNoSchedule('%fooValue%', Criteria::LIKE); // WHERE calendar_show_no_schedule LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calendarShowNoSchedule The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByCalendarShowNoSchedule($calendarShowNoSchedule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calendarShowNoSchedule)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE, $calendarShowNoSchedule, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByContact($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(UserTableMap::COL_CONTACT_ID, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_CONTACT_ID, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\Group object
     *
     * @param \TheFarm\Models\Group|ObjectCollection $group The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = null)
    {
        if ($group instanceof \TheFarm\Models\Group) {
            return $this
                ->addUsingAlias(UserTableMap::COL_GROUP_ID, $group->getGroupId(), $comparison);
        } elseif ($group instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_GROUP_ID, $group->toKeyValue('PrimaryKey', 'GroupId'), $comparison);
        } else {
            throw new PropelException('filterByGroup() only accepts arguments of type \TheFarm\Models\Group or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Group relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Group');

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
            $this->addJoinObject($join, 'Group');
        }

        return $this;
    }

    /**
     * Use the Group relation Group object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\GroupQuery A secondary query class using the current class as primary query
     */
    public function useGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Group', '\TheFarm\Models\GroupQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Location object
     *
     * @param \TheFarm\Models\Location|ObjectCollection $location The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = null)
    {
        if ($location instanceof \TheFarm\Models\Location) {
            return $this
                ->addUsingAlias(UserTableMap::COL_LOCATION_ID, $location->getLocationId(), $comparison);
        } elseif ($location instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserTableMap::COL_LOCATION_ID, $location->toKeyValue('PrimaryKey', 'LocationId'), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_CONTACT_ID, $user->getContactId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserQuery
