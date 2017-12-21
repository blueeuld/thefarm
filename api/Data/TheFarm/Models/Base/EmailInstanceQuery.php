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
use TheFarm\Models\EmailInstance as ChildEmailInstance;
use TheFarm\Models\EmailInstanceQuery as ChildEmailInstanceQuery;
use TheFarm\Models\Map\EmailInstanceTableMap;

/**
 * Base class that represents a query for the 'tf_email_instance' table.
 *
 *
 *
 * @method     ChildEmailInstanceQuery orderByEmailInstanceId($order = Criteria::ASC) Order by the email_instance_id column
 * @method     ChildEmailInstanceQuery orderByEmailSubject($order = Criteria::ASC) Order by the email_subject column
 * @method     ChildEmailInstanceQuery orderByEmailBody($order = Criteria::ASC) Order by the email_body column
 * @method     ChildEmailInstanceQuery orderByFromEmailAddress($order = Criteria::ASC) Order by the from_email_address column
 * @method     ChildEmailInstanceQuery orderByToEmailAddress($order = Criteria::ASC) Order by the to_email_address column
 * @method     ChildEmailInstanceQuery orderByEmailStatusCd($order = Criteria::ASC) Order by the email_status_cd column
 *
 * @method     ChildEmailInstanceQuery groupByEmailInstanceId() Group by the email_instance_id column
 * @method     ChildEmailInstanceQuery groupByEmailSubject() Group by the email_subject column
 * @method     ChildEmailInstanceQuery groupByEmailBody() Group by the email_body column
 * @method     ChildEmailInstanceQuery groupByFromEmailAddress() Group by the from_email_address column
 * @method     ChildEmailInstanceQuery groupByToEmailAddress() Group by the to_email_address column
 * @method     ChildEmailInstanceQuery groupByEmailStatusCd() Group by the email_status_cd column
 *
 * @method     ChildEmailInstanceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmailInstanceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmailInstanceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmailInstanceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmailInstanceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmailInstanceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmailInstance findOne(ConnectionInterface $con = null) Return the first ChildEmailInstance matching the query
 * @method     ChildEmailInstance findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmailInstance matching the query, or a new ChildEmailInstance object populated from the query conditions when no match is found
 *
 * @method     ChildEmailInstance findOneByEmailInstanceId(int $email_instance_id) Return the first ChildEmailInstance filtered by the email_instance_id column
 * @method     ChildEmailInstance findOneByEmailSubject(string $email_subject) Return the first ChildEmailInstance filtered by the email_subject column
 * @method     ChildEmailInstance findOneByEmailBody(string $email_body) Return the first ChildEmailInstance filtered by the email_body column
 * @method     ChildEmailInstance findOneByFromEmailAddress(string $from_email_address) Return the first ChildEmailInstance filtered by the from_email_address column
 * @method     ChildEmailInstance findOneByToEmailAddress(string $to_email_address) Return the first ChildEmailInstance filtered by the to_email_address column
 * @method     ChildEmailInstance findOneByEmailStatusCd(string $email_status_cd) Return the first ChildEmailInstance filtered by the email_status_cd column *

 * @method     ChildEmailInstance requirePk($key, ConnectionInterface $con = null) Return the ChildEmailInstance by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOne(ConnectionInterface $con = null) Return the first ChildEmailInstance matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailInstance requireOneByEmailInstanceId(int $email_instance_id) Return the first ChildEmailInstance filtered by the email_instance_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOneByEmailSubject(string $email_subject) Return the first ChildEmailInstance filtered by the email_subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOneByEmailBody(string $email_body) Return the first ChildEmailInstance filtered by the email_body column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOneByFromEmailAddress(string $from_email_address) Return the first ChildEmailInstance filtered by the from_email_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOneByToEmailAddress(string $to_email_address) Return the first ChildEmailInstance filtered by the to_email_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmailInstance requireOneByEmailStatusCd(string $email_status_cd) Return the first ChildEmailInstance filtered by the email_status_cd column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmailInstance[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmailInstance objects based on current ModelCriteria
 * @method     ChildEmailInstance[]|ObjectCollection findByEmailInstanceId(int $email_instance_id) Return ChildEmailInstance objects filtered by the email_instance_id column
 * @method     ChildEmailInstance[]|ObjectCollection findByEmailSubject(string $email_subject) Return ChildEmailInstance objects filtered by the email_subject column
 * @method     ChildEmailInstance[]|ObjectCollection findByEmailBody(string $email_body) Return ChildEmailInstance objects filtered by the email_body column
 * @method     ChildEmailInstance[]|ObjectCollection findByFromEmailAddress(string $from_email_address) Return ChildEmailInstance objects filtered by the from_email_address column
 * @method     ChildEmailInstance[]|ObjectCollection findByToEmailAddress(string $to_email_address) Return ChildEmailInstance objects filtered by the to_email_address column
 * @method     ChildEmailInstance[]|ObjectCollection findByEmailStatusCd(string $email_status_cd) Return ChildEmailInstance objects filtered by the email_status_cd column
 * @method     ChildEmailInstance[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmailInstanceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\EmailInstanceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\EmailInstance', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmailInstanceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmailInstanceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmailInstanceQuery) {
            return $criteria;
        }
        $query = new ChildEmailInstanceQuery();
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
     * @return ChildEmailInstance|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmailInstanceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmailInstanceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEmailInstance A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT email_instance_id, email_subject, email_body, from_email_address, to_email_address, email_status_cd FROM tf_email_instance WHERE email_instance_id = :p0';
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
            /** @var ChildEmailInstance $obj */
            $obj = new ChildEmailInstance();
            $obj->hydrate($row);
            EmailInstanceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmailInstance|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the email_instance_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailInstanceId(1234); // WHERE email_instance_id = 1234
     * $query->filterByEmailInstanceId(array(12, 34)); // WHERE email_instance_id IN (12, 34)
     * $query->filterByEmailInstanceId(array('min' => 12)); // WHERE email_instance_id > 12
     * </code>
     *
     * @param     mixed $emailInstanceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByEmailInstanceId($emailInstanceId = null, $comparison = null)
    {
        if (is_array($emailInstanceId)) {
            $useMinMax = false;
            if (isset($emailInstanceId['min'])) {
                $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $emailInstanceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($emailInstanceId['max'])) {
                $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $emailInstanceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $emailInstanceId, $comparison);
    }

    /**
     * Filter the query on the email_subject column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailSubject('fooValue');   // WHERE email_subject = 'fooValue'
     * $query->filterByEmailSubject('%fooValue%', Criteria::LIKE); // WHERE email_subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailSubject The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByEmailSubject($emailSubject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailSubject)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_SUBJECT, $emailSubject, $comparison);
    }

    /**
     * Filter the query on the email_body column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailBody('fooValue');   // WHERE email_body = 'fooValue'
     * $query->filterByEmailBody('%fooValue%', Criteria::LIKE); // WHERE email_body LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailBody The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByEmailBody($emailBody = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailBody)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_BODY, $emailBody, $comparison);
    }

    /**
     * Filter the query on the from_email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByFromEmailAddress('fooValue');   // WHERE from_email_address = 'fooValue'
     * $query->filterByFromEmailAddress('%fooValue%', Criteria::LIKE); // WHERE from_email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromEmailAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByFromEmailAddress($fromEmailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromEmailAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_FROM_EMAIL_ADDRESS, $fromEmailAddress, $comparison);
    }

    /**
     * Filter the query on the to_email_address column
     *
     * Example usage:
     * <code>
     * $query->filterByToEmailAddress('fooValue');   // WHERE to_email_address = 'fooValue'
     * $query->filterByToEmailAddress('%fooValue%', Criteria::LIKE); // WHERE to_email_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $toEmailAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByToEmailAddress($toEmailAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($toEmailAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_TO_EMAIL_ADDRESS, $toEmailAddress, $comparison);
    }

    /**
     * Filter the query on the email_status_cd column
     *
     * Example usage:
     * <code>
     * $query->filterByEmailStatusCd('fooValue');   // WHERE email_status_cd = 'fooValue'
     * $query->filterByEmailStatusCd('%fooValue%', Criteria::LIKE); // WHERE email_status_cd LIKE '%fooValue%'
     * </code>
     *
     * @param     string $emailStatusCd The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function filterByEmailStatusCd($emailStatusCd = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($emailStatusCd)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_STATUS_CD, $emailStatusCd, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmailInstance $emailInstance Object to remove from the list of results
     *
     * @return $this|ChildEmailInstanceQuery The current query, for fluid interface
     */
    public function prune($emailInstance = null)
    {
        if ($emailInstance) {
            $this->addUsingAlias(EmailInstanceTableMap::COL_EMAIL_INSTANCE_ID, $emailInstance->getEmailInstanceId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_email_instance table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmailInstanceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmailInstanceTableMap::clearInstancePool();
            EmailInstanceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmailInstanceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmailInstanceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmailInstanceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmailInstanceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmailInstanceQuery
