<?php

namespace TheFarm\Models\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
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
 * @method     ChildUserWorkPlanDayQuery orderByContactId($order = Criteria::ASC) Order by the contact_id column
 * @method     ChildUserWorkPlanDayQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildUserWorkPlanDayQuery orderByWorkCode($order = Criteria::ASC) Order by the work_code column
 *
 * @method     ChildUserWorkPlanDayQuery groupByContactId() Group by the contact_id column
 * @method     ChildUserWorkPlanDayQuery groupByDate() Group by the date column
 * @method     ChildUserWorkPlanDayQuery groupByWorkCode() Group by the work_code column
 *
 * @method     ChildUserWorkPlanDayQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserWorkPlanDayQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserWorkPlanDayQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserWorkPlanDayQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserWorkPlanDayQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserWorkPlanDayQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserWorkPlanDay findOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query
 * @method     ChildUserWorkPlanDay findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query, or a new ChildUserWorkPlanDay object populated from the query conditions when no match is found
 *
 * @method     ChildUserWorkPlanDay findOneByContactId(int $contact_id) Return the first ChildUserWorkPlanDay filtered by the contact_id column
 * @method     ChildUserWorkPlanDay findOneByDate(string $date) Return the first ChildUserWorkPlanDay filtered by the date column
 * @method     ChildUserWorkPlanDay findOneByWorkCode(string $work_code) Return the first ChildUserWorkPlanDay filtered by the work_code column *

 * @method     ChildUserWorkPlanDay requirePk($key, ConnectionInterface $con = null) Return the ChildUserWorkPlanDay by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOne(ConnectionInterface $con = null) Return the first ChildUserWorkPlanDay matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanDay requireOneByContactId(int $contact_id) Return the first ChildUserWorkPlanDay filtered by the contact_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOneByDate(string $date) Return the first ChildUserWorkPlanDay filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserWorkPlanDay requireOneByWorkCode(string $work_code) Return the first ChildUserWorkPlanDay filtered by the work_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserWorkPlanDay[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserWorkPlanDay objects based on current ModelCriteria
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByContactId(int $contact_id) Return ChildUserWorkPlanDay objects filtered by the contact_id column
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByDate(string $date) Return ChildUserWorkPlanDay objects filtered by the date column
 * @method     ChildUserWorkPlanDay[]|ObjectCollection findByWorkCode(string $work_code) Return ChildUserWorkPlanDay objects filtered by the work_code column
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
     * Filter the query on the contact_id column
     *
     * Example usage:
     * <code>
     * $query->filterByContactId(1234); // WHERE contact_id = 1234
     * $query->filterByContactId(array(12, 34)); // WHERE contact_id IN (12, 34)
     * $query->filterByContactId(array('min' => 12)); // WHERE contact_id > 12
     * </code>
     *
     * @param     mixed $contactId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByContactId($contactId = null, $comparison = null)
    {
        if (is_array($contactId)) {
            $useMinMax = false;
            if (isset($contactId['min'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_CONTACT_ID, $contactId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contactId['max'])) {
                $this->addUsingAlias(UserWorkPlanDayTableMap::COL_CONTACT_ID, $contactId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanDayTableMap::COL_CONTACT_ID, $contactId, $comparison);
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
     * Filter the query on the work_code column
     *
     * Example usage:
     * <code>
     * $query->filterByWorkCode('fooValue');   // WHERE work_code = 'fooValue'
     * $query->filterByWorkCode('%fooValue%', Criteria::LIKE); // WHERE work_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $workCode The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserWorkPlanDayQuery The current query, for fluid interface
     */
    public function filterByWorkCode($workCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($workCode)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserWorkPlanDayTableMap::COL_WORK_CODE, $workCode, $comparison);
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
