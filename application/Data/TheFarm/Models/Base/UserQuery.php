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
 * Base class that represents a query for the 'tf_user' table.
 *
 *
 *
 * @method     ChildUserQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUserQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildUserQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUserQuery orderByWorkPlan($order = Criteria::ASC) Order by the work_plan column
 * @method     ChildUserQuery orderByWorkPlanCode($order = Criteria::ASC) Order by the work_plan_code column
 * @method     ChildUserQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildUserQuery orderByFacebookId($order = Criteria::ASC) Order by the facebook_id column
 * @method     ChildUserQuery orderByUserOrder($order = Criteria::ASC) Order by the user_order column
 * @method     ChildUserQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildUserQuery orderByVerificationKey($order = Criteria::ASC) Order by the verification_key column
 * @method     ChildUserQuery orderByIsVerified($order = Criteria::ASC) Order by the is_verified column
 * @method     ChildUserQuery orderByIsApproved($order = Criteria::ASC) Order by the is_approved column
 * @method     ChildUserQuery orderByActivationCode($order = Criteria::ASC) Order by the activation_code column
 *
 * @method     ChildUserQuery groupByUserId() Group by the user_id column
 * @method     ChildUserQuery groupByUsername() Group by the username column
 * @method     ChildUserQuery groupByGroupId() Group by the group_id column
 * @method     ChildUserQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUserQuery groupByPassword() Group by the password column
 * @method     ChildUserQuery groupByWorkPlan() Group by the work_plan column
 * @method     ChildUserQuery groupByWorkPlanCode() Group by the work_plan_code column
 * @method     ChildUserQuery groupByLocationId() Group by the location_id column
 * @method     ChildUserQuery groupByFacebookId() Group by the facebook_id column
 * @method     ChildUserQuery groupByUserOrder() Group by the user_order column
 * @method     ChildUserQuery groupByIsActive() Group by the is_active column
 * @method     ChildUserQuery groupByVerificationKey() Group by the verification_key column
 * @method     ChildUserQuery groupByIsVerified() Group by the is_verified column
 * @method     ChildUserQuery groupByIsApproved() Group by the is_approved column
 * @method     ChildUserQuery groupByActivationCode() Group by the activation_code column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
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
 * @method     ChildUserQuery leftJoinEventUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventUser relation
 * @method     ChildUserQuery rightJoinEventUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventUser relation
 * @method     ChildUserQuery innerJoinEventUser($relationAlias = null) Adds a INNER JOIN clause to the query using the EventUser relation
 *
 * @method     ChildUserQuery joinWithEventUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventUser relation
 *
 * @method     ChildUserQuery leftJoinWithEventUser() Adds a LEFT JOIN clause and with to the query using the EventUser relation
 * @method     ChildUserQuery rightJoinWithEventUser() Adds a RIGHT JOIN clause and with to the query using the EventUser relation
 * @method     ChildUserQuery innerJoinWithEventUser() Adds a INNER JOIN clause and with to the query using the EventUser relation
 *
 * @method     ChildUserQuery leftJoinEventRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventRelatedByAuthorId relation
 * @method     ChildUserQuery rightJoinEventRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventRelatedByAuthorId relation
 * @method     ChildUserQuery innerJoinEventRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the EventRelatedByAuthorId relation
 *
 * @method     ChildUserQuery joinWithEventRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventRelatedByAuthorId relation
 *
 * @method     ChildUserQuery leftJoinWithEventRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the EventRelatedByAuthorId relation
 * @method     ChildUserQuery rightJoinWithEventRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the EventRelatedByAuthorId relation
 * @method     ChildUserQuery innerJoinWithEventRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the EventRelatedByAuthorId relation
 *
 * @method     ChildUserQuery leftJoinEventRelatedByCalledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventRelatedByCalledBy relation
 * @method     ChildUserQuery rightJoinEventRelatedByCalledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventRelatedByCalledBy relation
 * @method     ChildUserQuery innerJoinEventRelatedByCalledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the EventRelatedByCalledBy relation
 *
 * @method     ChildUserQuery joinWithEventRelatedByCalledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventRelatedByCalledBy relation
 *
 * @method     ChildUserQuery leftJoinWithEventRelatedByCalledBy() Adds a LEFT JOIN clause and with to the query using the EventRelatedByCalledBy relation
 * @method     ChildUserQuery rightJoinWithEventRelatedByCalledBy() Adds a RIGHT JOIN clause and with to the query using the EventRelatedByCalledBy relation
 * @method     ChildUserQuery innerJoinWithEventRelatedByCalledBy() Adds a INNER JOIN clause and with to the query using the EventRelatedByCalledBy relation
 *
 * @method     ChildUserQuery leftJoinEventRelatedByCancelledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventRelatedByCancelledBy relation
 * @method     ChildUserQuery rightJoinEventRelatedByCancelledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventRelatedByCancelledBy relation
 * @method     ChildUserQuery innerJoinEventRelatedByCancelledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the EventRelatedByCancelledBy relation
 *
 * @method     ChildUserQuery joinWithEventRelatedByCancelledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventRelatedByCancelledBy relation
 *
 * @method     ChildUserQuery leftJoinWithEventRelatedByCancelledBy() Adds a LEFT JOIN clause and with to the query using the EventRelatedByCancelledBy relation
 * @method     ChildUserQuery rightJoinWithEventRelatedByCancelledBy() Adds a RIGHT JOIN clause and with to the query using the EventRelatedByCancelledBy relation
 * @method     ChildUserQuery innerJoinWithEventRelatedByCancelledBy() Adds a INNER JOIN clause and with to the query using the EventRelatedByCancelledBy relation
 *
 * @method     ChildUserQuery leftJoinEventRelatedByDeletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventRelatedByDeletedBy relation
 * @method     ChildUserQuery rightJoinEventRelatedByDeletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventRelatedByDeletedBy relation
 * @method     ChildUserQuery innerJoinEventRelatedByDeletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the EventRelatedByDeletedBy relation
 *
 * @method     ChildUserQuery joinWithEventRelatedByDeletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventRelatedByDeletedBy relation
 *
 * @method     ChildUserQuery leftJoinWithEventRelatedByDeletedBy() Adds a LEFT JOIN clause and with to the query using the EventRelatedByDeletedBy relation
 * @method     ChildUserQuery rightJoinWithEventRelatedByDeletedBy() Adds a RIGHT JOIN clause and with to the query using the EventRelatedByDeletedBy relation
 * @method     ChildUserQuery innerJoinWithEventRelatedByDeletedBy() Adds a INNER JOIN clause and with to the query using the EventRelatedByDeletedBy relation
 *
 * @method     ChildUserQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildUserQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildUserQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildUserQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildUserQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildUserQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildUserQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildUserQuery leftJoinBookingFormRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingFormRelatedByAuthorId relation
 * @method     ChildUserQuery rightJoinBookingFormRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingFormRelatedByAuthorId relation
 * @method     ChildUserQuery innerJoinBookingFormRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingFormRelatedByAuthorId relation
 *
 * @method     ChildUserQuery joinWithBookingFormRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingFormRelatedByAuthorId relation
 *
 * @method     ChildUserQuery leftJoinWithBookingFormRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the BookingFormRelatedByAuthorId relation
 * @method     ChildUserQuery rightJoinWithBookingFormRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the BookingFormRelatedByAuthorId relation
 * @method     ChildUserQuery innerJoinWithBookingFormRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the BookingFormRelatedByAuthorId relation
 *
 * @method     ChildUserQuery leftJoinBookingFormRelatedByCompletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingFormRelatedByCompletedBy relation
 * @method     ChildUserQuery rightJoinBookingFormRelatedByCompletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingFormRelatedByCompletedBy relation
 * @method     ChildUserQuery innerJoinBookingFormRelatedByCompletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingFormRelatedByCompletedBy relation
 *
 * @method     ChildUserQuery joinWithBookingFormRelatedByCompletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingFormRelatedByCompletedBy relation
 *
 * @method     ChildUserQuery leftJoinWithBookingFormRelatedByCompletedBy() Adds a LEFT JOIN clause and with to the query using the BookingFormRelatedByCompletedBy relation
 * @method     ChildUserQuery rightJoinWithBookingFormRelatedByCompletedBy() Adds a RIGHT JOIN clause and with to the query using the BookingFormRelatedByCompletedBy relation
 * @method     ChildUserQuery innerJoinWithBookingFormRelatedByCompletedBy() Adds a INNER JOIN clause and with to the query using the BookingFormRelatedByCompletedBy relation
 *
 * @method     ChildUserQuery leftJoinItemsRelatedUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemsRelatedUser relation
 * @method     ChildUserQuery rightJoinItemsRelatedUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemsRelatedUser relation
 * @method     ChildUserQuery innerJoinItemsRelatedUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemsRelatedUser relation
 *
 * @method     ChildUserQuery joinWithItemsRelatedUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ItemsRelatedUser relation
 *
 * @method     ChildUserQuery leftJoinWithItemsRelatedUser() Adds a LEFT JOIN clause and with to the query using the ItemsRelatedUser relation
 * @method     ChildUserQuery rightJoinWithItemsRelatedUser() Adds a RIGHT JOIN clause and with to the query using the ItemsRelatedUser relation
 * @method     ChildUserQuery innerJoinWithItemsRelatedUser() Adds a INNER JOIN clause and with to the query using the ItemsRelatedUser relation
 *
 * @method     ChildUserQuery leftJoinUserWorkPlanDay($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserWorkPlanDay relation
 * @method     ChildUserQuery rightJoinUserWorkPlanDay($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserWorkPlanDay relation
 * @method     ChildUserQuery innerJoinUserWorkPlanDay($relationAlias = null) Adds a INNER JOIN clause to the query using the UserWorkPlanDay relation
 *
 * @method     ChildUserQuery joinWithUserWorkPlanDay($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserWorkPlanDay relation
 *
 * @method     ChildUserQuery leftJoinWithUserWorkPlanDay() Adds a LEFT JOIN clause and with to the query using the UserWorkPlanDay relation
 * @method     ChildUserQuery rightJoinWithUserWorkPlanDay() Adds a RIGHT JOIN clause and with to the query using the UserWorkPlanDay relation
 * @method     ChildUserQuery innerJoinWithUserWorkPlanDay() Adds a INNER JOIN clause and with to the query using the UserWorkPlanDay relation
 *
 * @method     ChildUserQuery leftJoinProviderSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProviderSchedule relation
 * @method     ChildUserQuery rightJoinProviderSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProviderSchedule relation
 * @method     ChildUserQuery innerJoinProviderSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the ProviderSchedule relation
 *
 * @method     ChildUserQuery joinWithProviderSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProviderSchedule relation
 *
 * @method     ChildUserQuery leftJoinWithProviderSchedule() Adds a LEFT JOIN clause and with to the query using the ProviderSchedule relation
 * @method     ChildUserQuery rightJoinWithProviderSchedule() Adds a RIGHT JOIN clause and with to the query using the ProviderSchedule relation
 * @method     ChildUserQuery innerJoinWithProviderSchedule() Adds a INNER JOIN clause and with to the query using the ProviderSchedule relation
 *
 * @method     \TheFarm\Models\GroupQuery|\TheFarm\Models\LocationQuery|\TheFarm\Models\EventUserQuery|\TheFarm\Models\EventQuery|\TheFarm\Models\BookingQuery|\TheFarm\Models\BookingFormQuery|\TheFarm\Models\ItemsRelatedUserQuery|\TheFarm\Models\UserWorkPlanDayQuery|\TheFarm\Models\ProviderScheduleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column
 * @method     ChildUser findOneByUsername(string $username) Return the first ChildUser filtered by the username column
 * @method     ChildUser findOneByGroupId(int $group_id) Return the first ChildUser filtered by the group_id column
 * @method     ChildUser findOneByLastLogin(int $last_login) Return the first ChildUser filtered by the last_login column
 * @method     ChildUser findOneByPassword(string $password) Return the first ChildUser filtered by the password column
 * @method     ChildUser findOneByWorkPlan(string $work_plan) Return the first ChildUser filtered by the work_plan column
 * @method     ChildUser findOneByWorkPlanCode(string $work_plan_code) Return the first ChildUser filtered by the work_plan_code column
 * @method     ChildUser findOneByLocationId(int $location_id) Return the first ChildUser filtered by the location_id column
 * @method     ChildUser findOneByFacebookId(string $facebook_id) Return the first ChildUser filtered by the facebook_id column
 * @method     ChildUser findOneByUserOrder(int $user_order) Return the first ChildUser filtered by the user_order column
 * @method     ChildUser findOneByIsActive(boolean $is_active) Return the first ChildUser filtered by the is_active column
 * @method     ChildUser findOneByVerificationKey(string $verification_key) Return the first ChildUser filtered by the verification_key column
 * @method     ChildUser findOneByIsVerified(boolean $is_verified) Return the first ChildUser filtered by the is_verified column
 * @method     ChildUser findOneByIsApproved(boolean $is_approved) Return the first ChildUser filtered by the is_approved column
 * @method     ChildUser findOneByActivationCode(int $activation_code) Return the first ChildUser filtered by the activation_code column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneByUserId(int $user_id) Return the first ChildUser filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUsername(string $username) Return the first ChildUser filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByGroupId(int $group_id) Return the first ChildUser filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLastLogin(int $last_login) Return the first ChildUser filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPassword(string $password) Return the first ChildUser filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWorkPlan(string $work_plan) Return the first ChildUser filtered by the work_plan column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByWorkPlanCode(string $work_plan_code) Return the first ChildUser filtered by the work_plan_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByLocationId(int $location_id) Return the first ChildUser filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByFacebookId(string $facebook_id) Return the first ChildUser filtered by the facebook_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUserOrder(int $user_order) Return the first ChildUser filtered by the user_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIsActive(boolean $is_active) Return the first ChildUser filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByVerificationKey(string $verification_key) Return the first ChildUser filtered by the verification_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIsVerified(boolean $is_verified) Return the first ChildUser filtered by the is_verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByIsApproved(boolean $is_approved) Return the first ChildUser filtered by the is_approved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByActivationCode(int $activation_code) Return the first ChildUser filtered by the activation_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findByUserId(int $user_id) Return ChildUser objects filtered by the user_id column
 * @method     ChildUser[]|ObjectCollection findByUsername(string $username) Return ChildUser objects filtered by the username column
 * @method     ChildUser[]|ObjectCollection findByGroupId(int $group_id) Return ChildUser objects filtered by the group_id column
 * @method     ChildUser[]|ObjectCollection findByLastLogin(int $last_login) Return ChildUser objects filtered by the last_login column
 * @method     ChildUser[]|ObjectCollection findByPassword(string $password) Return ChildUser objects filtered by the password column
 * @method     ChildUser[]|ObjectCollection findByWorkPlan(string $work_plan) Return ChildUser objects filtered by the work_plan column
 * @method     ChildUser[]|ObjectCollection findByWorkPlanCode(string $work_plan_code) Return ChildUser objects filtered by the work_plan_code column
 * @method     ChildUser[]|ObjectCollection findByLocationId(int $location_id) Return ChildUser objects filtered by the location_id column
 * @method     ChildUser[]|ObjectCollection findByFacebookId(string $facebook_id) Return ChildUser objects filtered by the facebook_id column
 * @method     ChildUser[]|ObjectCollection findByUserOrder(int $user_order) Return ChildUser objects filtered by the user_order column
 * @method     ChildUser[]|ObjectCollection findByIsActive(boolean $is_active) Return ChildUser objects filtered by the is_active column
 * @method     ChildUser[]|ObjectCollection findByVerificationKey(string $verification_key) Return ChildUser objects filtered by the verification_key column
 * @method     ChildUser[]|ObjectCollection findByIsVerified(boolean $is_verified) Return ChildUser objects filtered by the is_verified column
 * @method     ChildUser[]|ObjectCollection findByIsApproved(boolean $is_approved) Return ChildUser objects filtered by the is_approved column
 * @method     ChildUser[]|ObjectCollection findByActivationCode(int $activation_code) Return ChildUser objects filtered by the activation_code column
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
        $sql = 'SELECT user_id, username, group_id, last_login, password, work_plan, work_plan_code, location_id, facebook_id, user_order, is_active, verification_key, is_verified, is_approved, activation_code FROM tf_user WHERE user_id = :p0';
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

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $key, Criteria::EQUAL);
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

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $keys, Criteria::IN);
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
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_ID, $userId, $comparison);
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
     * Filter the query on the user_order column
     *
     * Example usage:
     * <code>
     * $query->filterByUserOrder(1234); // WHERE user_order = 1234
     * $query->filterByUserOrder(array(12, 34)); // WHERE user_order IN (12, 34)
     * $query->filterByUserOrder(array('min' => 12)); // WHERE user_order > 12
     * </code>
     *
     * @param     mixed $userOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserOrder($userOrder = null, $comparison = null)
    {
        if (is_array($userOrder)) {
            $useMinMax = false;
            if (isset($userOrder['min'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ORDER, $userOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userOrder['max'])) {
                $this->addUsingAlias(UserTableMap::COL_USER_ORDER, $userOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USER_ORDER, $userOrder, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     boolean|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query on the verification_key column
     *
     * Example usage:
     * <code>
     * $query->filterByVerificationKey('fooValue');   // WHERE verification_key = 'fooValue'
     * $query->filterByVerificationKey('%fooValue%', Criteria::LIKE); // WHERE verification_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $verificationKey The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByVerificationKey($verificationKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($verificationKey)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_VERIFICATION_KEY, $verificationKey, $comparison);
    }

    /**
     * Filter the query on the is_verified column
     *
     * Example usage:
     * <code>
     * $query->filterByIsVerified(true); // WHERE is_verified = true
     * $query->filterByIsVerified('yes'); // WHERE is_verified = true
     * </code>
     *
     * @param     boolean|string $isVerified The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIsVerified($isVerified = null, $comparison = null)
    {
        if (is_string($isVerified)) {
            $isVerified = in_array(strtolower($isVerified), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_IS_VERIFIED, $isVerified, $comparison);
    }

    /**
     * Filter the query on the is_approved column
     *
     * Example usage:
     * <code>
     * $query->filterByIsApproved(true); // WHERE is_approved = true
     * $query->filterByIsApproved('yes'); // WHERE is_approved = true
     * </code>
     *
     * @param     boolean|string $isApproved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByIsApproved($isApproved = null, $comparison = null)
    {
        if (is_string($isApproved)) {
            $isApproved = in_array(strtolower($isApproved), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_IS_APPROVED, $isApproved, $comparison);
    }

    /**
     * Filter the query on the activation_code column
     *
     * Example usage:
     * <code>
     * $query->filterByActivationCode(1234); // WHERE activation_code = 1234
     * $query->filterByActivationCode(array(12, 34)); // WHERE activation_code IN (12, 34)
     * $query->filterByActivationCode(array('min' => 12)); // WHERE activation_code > 12
     * </code>
     *
     * @param     mixed $activationCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByActivationCode($activationCode = null, $comparison = null)
    {
        if (is_array($activationCode)) {
            $useMinMax = false;
            if (isset($activationCode['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ACTIVATION_CODE, $activationCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activationCode['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ACTIVATION_CODE, $activationCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ACTIVATION_CODE, $activationCode, $comparison);
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
     * Filter the query by a related \TheFarm\Models\EventUser object
     *
     * @param \TheFarm\Models\EventUser|ObjectCollection $eventUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEventUser($eventUser, $comparison = null)
    {
        if ($eventUser instanceof \TheFarm\Models\EventUser) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $eventUser->getUserId(), $comparison);
        } elseif ($eventUser instanceof ObjectCollection) {
            return $this
                ->useEventUserQuery()
                ->filterByPrimaryKeys($eventUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventUser() only accepts arguments of type \TheFarm\Models\EventUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEventUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventUser');

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
            $this->addJoinObject($join, 'EventUser');
        }

        return $this;
    }

    /**
     * Use the EventUser relation EventUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventUserQuery A secondary query class using the current class as primary query
     */
    public function useEventUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEventUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventUser', '\TheFarm\Models\EventUserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEventRelatedByAuthorId($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $event->getAuthorId(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventRelatedByAuthorIdQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEventRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventRelatedByAuthorId');

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
            $this->addJoinObject($join, 'EventRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the EventRelatedByAuthorId relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventQuery A secondary query class using the current class as primary query
     */
    public function useEventRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventRelatedByAuthorId', '\TheFarm\Models\EventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEventRelatedByCalledBy($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $event->getCalledBy(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventRelatedByCalledByQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventRelatedByCalledBy() only accepts arguments of type \TheFarm\Models\Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventRelatedByCalledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEventRelatedByCalledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventRelatedByCalledBy');

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
            $this->addJoinObject($join, 'EventRelatedByCalledBy');
        }

        return $this;
    }

    /**
     * Use the EventRelatedByCalledBy relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventQuery A secondary query class using the current class as primary query
     */
    public function useEventRelatedByCalledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventRelatedByCalledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventRelatedByCalledBy', '\TheFarm\Models\EventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEventRelatedByCancelledBy($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $event->getCancelledBy(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventRelatedByCancelledByQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventRelatedByCancelledBy() only accepts arguments of type \TheFarm\Models\Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventRelatedByCancelledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEventRelatedByCancelledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventRelatedByCancelledBy');

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
            $this->addJoinObject($join, 'EventRelatedByCancelledBy');
        }

        return $this;
    }

    /**
     * Use the EventRelatedByCancelledBy relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventQuery A secondary query class using the current class as primary query
     */
    public function useEventRelatedByCancelledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventRelatedByCancelledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventRelatedByCancelledBy', '\TheFarm\Models\EventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Event object
     *
     * @param \TheFarm\Models\Event|ObjectCollection $event the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByEventRelatedByDeletedBy($event, $comparison = null)
    {
        if ($event instanceof \TheFarm\Models\Event) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $event->getDeletedBy(), $comparison);
        } elseif ($event instanceof ObjectCollection) {
            return $this
                ->useEventRelatedByDeletedByQuery()
                ->filterByPrimaryKeys($event->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEventRelatedByDeletedBy() only accepts arguments of type \TheFarm\Models\Event or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventRelatedByDeletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinEventRelatedByDeletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventRelatedByDeletedBy');

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
            $this->addJoinObject($join, 'EventRelatedByDeletedBy');
        }

        return $this;
    }

    /**
     * Use the EventRelatedByDeletedBy relation Event object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventQuery A secondary query class using the current class as primary query
     */
    public function useEventRelatedByDeletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventRelatedByDeletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventRelatedByDeletedBy', '\TheFarm\Models\EventQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $booking->getAuthorId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\BookingForm object
     *
     * @param \TheFarm\Models\BookingForm|ObjectCollection $bookingForm the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByBookingFormRelatedByAuthorId($bookingForm, $comparison = null)
    {
        if ($bookingForm instanceof \TheFarm\Models\BookingForm) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $bookingForm->getAuthorId(), $comparison);
        } elseif ($bookingForm instanceof ObjectCollection) {
            return $this
                ->useBookingFormRelatedByAuthorIdQuery()
                ->filterByPrimaryKeys($bookingForm->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingFormRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\BookingForm or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingFormRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinBookingFormRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingFormRelatedByAuthorId');

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
            $this->addJoinObject($join, 'BookingFormRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the BookingFormRelatedByAuthorId relation BookingForm object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingFormQuery A secondary query class using the current class as primary query
     */
    public function useBookingFormRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingFormRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingFormRelatedByAuthorId', '\TheFarm\Models\BookingFormQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingForm object
     *
     * @param \TheFarm\Models\BookingForm|ObjectCollection $bookingForm the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByBookingFormRelatedByCompletedBy($bookingForm, $comparison = null)
    {
        if ($bookingForm instanceof \TheFarm\Models\BookingForm) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $bookingForm->getCompletedBy(), $comparison);
        } elseif ($bookingForm instanceof ObjectCollection) {
            return $this
                ->useBookingFormRelatedByCompletedByQuery()
                ->filterByPrimaryKeys($bookingForm->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingFormRelatedByCompletedBy() only accepts arguments of type \TheFarm\Models\BookingForm or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingFormRelatedByCompletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinBookingFormRelatedByCompletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingFormRelatedByCompletedBy');

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
            $this->addJoinObject($join, 'BookingFormRelatedByCompletedBy');
        }

        return $this;
    }

    /**
     * Use the BookingFormRelatedByCompletedBy relation BookingForm object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingFormQuery A secondary query class using the current class as primary query
     */
    public function useBookingFormRelatedByCompletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingFormRelatedByCompletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingFormRelatedByCompletedBy', '\TheFarm\Models\BookingFormQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\ItemsRelatedUser object
     *
     * @param \TheFarm\Models\ItemsRelatedUser|ObjectCollection $itemsRelatedUser the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByItemsRelatedUser($itemsRelatedUser, $comparison = null)
    {
        if ($itemsRelatedUser instanceof \TheFarm\Models\ItemsRelatedUser) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $itemsRelatedUser->getContactId(), $comparison);
        } elseif ($itemsRelatedUser instanceof ObjectCollection) {
            return $this
                ->useItemsRelatedUserQuery()
                ->filterByPrimaryKeys($itemsRelatedUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItemsRelatedUser() only accepts arguments of type \TheFarm\Models\ItemsRelatedUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ItemsRelatedUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinItemsRelatedUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ItemsRelatedUser');

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
            $this->addJoinObject($join, 'ItemsRelatedUser');
        }

        return $this;
    }

    /**
     * Use the ItemsRelatedUser relation ItemsRelatedUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsRelatedUserQuery A secondary query class using the current class as primary query
     */
    public function useItemsRelatedUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinItemsRelatedUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ItemsRelatedUser', '\TheFarm\Models\ItemsRelatedUserQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\UserWorkPlanDay object
     *
     * @param \TheFarm\Models\UserWorkPlanDay|ObjectCollection $userWorkPlanDay the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserWorkPlanDay($userWorkPlanDay, $comparison = null)
    {
        if ($userWorkPlanDay instanceof \TheFarm\Models\UserWorkPlanDay) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $userWorkPlanDay->getUserId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByProviderSchedule($providerSchedule, $comparison = null)
    {
        if ($providerSchedule instanceof \TheFarm\Models\ProviderSchedule) {
            return $this
                ->addUsingAlias(UserTableMap::COL_USER_ID, $providerSchedule->getUserId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinProviderSchedule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useProviderScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProviderSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProviderSchedule', '\TheFarm\Models\ProviderScheduleQuery');
    }

    /**
     * Filter the query by a related Item object
     * using the tf_items_related_users table as cross reference
     *
     * @param Item $item the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useItemsRelatedUserQuery()
            ->filterByItem($item, $comparison)
            ->endUse();
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
            $this->addUsingAlias(UserTableMap::COL_USER_ID, $user->getUserId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_user table.
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
