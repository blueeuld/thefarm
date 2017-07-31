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
use TheFarm\Models\ContactStatus as ChildContactStatus;
use TheFarm\Models\ContactStatusQuery as ChildContactStatusQuery;
use TheFarm\Models\Map\ContactStatusTableMap;

/**
 * Base class that represents a query for the 'tf_contact_status' table.
 *
 *
 *
 * @method     ChildContactStatusQuery orderByStatusCd($order = Criteria::ASC) Order by the status_cd column
 * @method     ChildContactStatusQuery orderByStatusValue($order = Criteria::ASC) Order by the status_value column
 *
 * @method     ChildContactStatusQuery groupByStatusCd() Group by the status_cd column
 * @method     ChildContactStatusQuery groupByStatusValue() Group by the status_value column
 *
 * @method     ChildContactStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContactStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContactStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContactStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildContactStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildContactStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildContactStatus findOne(ConnectionInterface $con = null) Return the first ChildContactStatus matching the query
 * @method     ChildContactStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContactStatus matching the query, or a new ChildContactStatus object populated from the query conditions when no match is found
 *
 * @method     ChildContactStatus findOneByStatusCd(string $status_cd) Return the first ChildContactStatus filtered by the status_cd column
 * @method     ChildContactStatus findOneByStatusValue(string $status_value) Return the first ChildContactStatus filtered by the status_value column *

 * @method     ChildContactStatus requirePk($key, ConnectionInterface $con = null) Return the ChildContactStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContactStatus requireOne(ConnectionInterface $con = null) Return the first ChildContactStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContactStatus requireOneByStatusCd(string $status_cd) Return the first ChildContactStatus filtered by the status_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContactStatus requireOneByStatusValue(string $status_value) Return the first ChildContactStatus filtered by the status_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContactStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContactStatus objects based on current ModelCriteria
 * @method     ChildContactStatus[]|ObjectCollection findByStatusCd(string $status_cd) Return ChildContactStatus objects filtered by the status_cd column
 * @method     ChildContactStatus[]|ObjectCollection findByStatusValue(string $status_value) Return ChildContactStatus objects filtered by the status_value column
 * @method     ChildContactStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContactStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\ContactStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\ContactStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContactStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContactStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContactStatusQuery) {
            return $criteria;
        }
        $query = new ChildContactStatusQuery();
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
     * @return ChildContactStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContactStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ContactStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildContactStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT status_cd, status_value FROM tf_contact_status WHERE status_cd = :p0';
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
            /** @var ChildContactStatus $obj */
            $obj = new ChildContactStatus();
            $obj->hydrate($row);
            ContactStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildContactStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildContactStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContactStatusTableMap::COL_STATUS_CD, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContactStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContactStatusTableMap::COL_STATUS_CD, $keys, Criteria::IN);
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
     * @return $this|ChildContactStatusQuery The current query, for fluid interface
     */
    public function filterByStatusCd($statusCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactStatusTableMap::COL_STATUS_CD, $statusCd, $comparison);
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
     * @return $this|ChildContactStatusQuery The current query, for fluid interface
     */
    public function filterByStatusValue($statusValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statusValue)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContactStatusTableMap::COL_STATUS_VALUE, $statusValue, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContactStatus $contactStatus Object to remove from the list of results
     *
     * @return $this|ChildContactStatusQuery The current query, for fluid interface
     */
    public function prune($contactStatus = null)
    {
        if ($contactStatus) {
            $this->addUsingAlias(ContactStatusTableMap::COL_STATUS_CD, $contactStatus->getStatusCd(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_contact_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContactStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContactStatusTableMap::clearInstancePool();
            ContactStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ContactStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContactStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ContactStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContactStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContactStatusQuery
