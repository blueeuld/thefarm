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
use TheFarm\Models\BookingStatus as ChildBookingStatus;
use TheFarm\Models\BookingStatusQuery as ChildBookingStatusQuery;
use TheFarm\Models\Map\BookingStatusTableMap;

/**
 * Base class that represents a query for the 'tf_booking_status' table.
 *
 *
 *
 * @method     ChildBookingStatusQuery orderByStatusCd($order = Criteria::ASC) Order by the status_cd column
 * @method     ChildBookingStatusQuery orderByStatusValue($order = Criteria::ASC) Order by the status_value column
 *
 * @method     ChildBookingStatusQuery groupByStatusCd() Group by the status_cd column
 * @method     ChildBookingStatusQuery groupByStatusValue() Group by the status_value column
 *
 * @method     ChildBookingStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingStatus findOne(ConnectionInterface $con = null) Return the first ChildBookingStatus matching the query
 * @method     ChildBookingStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingStatus matching the query, or a new ChildBookingStatus object populated from the query conditions when no match is found
 *
 * @method     ChildBookingStatus findOneByStatusCd(string $status_cd) Return the first ChildBookingStatus filtered by the status_cd column
 * @method     ChildBookingStatus findOneByStatusValue(string $status_value) Return the first ChildBookingStatus filtered by the status_value column *

 * @method     ChildBookingStatus requirePk($key, ConnectionInterface $con = null) Return the ChildBookingStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingStatus requireOne(ConnectionInterface $con = null) Return the first ChildBookingStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingStatus requireOneByStatusCd(string $status_cd) Return the first ChildBookingStatus filtered by the status_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingStatus requireOneByStatusValue(string $status_value) Return the first ChildBookingStatus filtered by the status_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingStatus objects based on current ModelCriteria
 * @method     ChildBookingStatus[]|ObjectCollection findByStatusCd(string $status_cd) Return ChildBookingStatus objects filtered by the status_cd column
 * @method     ChildBookingStatus[]|ObjectCollection findByStatusValue(string $status_value) Return ChildBookingStatus objects filtered by the status_value column
 * @method     ChildBookingStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingStatusQuery) {
            return $criteria;
        }
        $query = new ChildBookingStatusQuery();
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
     * @return ChildBookingStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBookingStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT status_cd, status_value FROM tf_booking_status WHERE status_cd = :p0';
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
            /** @var ChildBookingStatus $obj */
            $obj = new ChildBookingStatus();
            $obj->hydrate($row);
            BookingStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBookingStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingStatusTableMap::COL_STATUS_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingStatusTableMap::COL_STATUS_CD, $keys, Criteria::IN);
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
     * @return $this|ChildBookingStatusQuery The current query, for fluid interface
     */
    public function filterByStatusCd($statusCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingStatusTableMap::COL_STATUS_CD, $statusCd, $comparison);
    }

    /**
     * Filter the query on the status_value column
     *
     * Example usage:
     * <code>
     * $query->filterByStatusValue('fooValue');   // WHERE status_value = 'fooValue'
     * $query->filterByStatusValue('%fooValue%', Criteria::LIKE); // WHERE status_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statusValue The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingStatusQuery The current query, for fluid interface
     */
    public function filterByStatusValue($statusValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingStatusTableMap::COL_STATUS_VALUE, $statusValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingStatus $bookingStatus Object to remove from the list of results
     *
     * @return $this|ChildBookingStatusQuery The current query, for fluid interface
     */
    public function prune($bookingStatus = null)
    {
        if ($bookingStatus) {
            $this->addUsingAlias(BookingStatusTableMap::COL_STATUS_CD, $bookingStatus->getStatusCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingStatusTableMap::clearInstancePool();
            BookingStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingStatusQuery
