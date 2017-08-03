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
use TheFarm\Models\BookingAttachment as ChildBookingAttachment;
use TheFarm\Models\BookingAttachmentQuery as ChildBookingAttachmentQuery;
use TheFarm\Models\Map\BookingAttachmentTableMap;

/**
 * Base class that represents a query for the 'tf_booking_attachments' table.
 *
 *
 *
 * @method     ChildBookingAttachmentQuery orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildBookingAttachmentQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 *
 * @method     ChildBookingAttachmentQuery groupByBookingId() Group by the booking_id column
 * @method     ChildBookingAttachmentQuery groupByFileId() Group by the file_id column
 *
 * @method     ChildBookingAttachmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingAttachmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingAttachmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingAttachmentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingAttachmentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingAttachmentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingAttachmentQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method     ChildBookingAttachmentQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method     ChildBookingAttachmentQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method     ChildBookingAttachmentQuery joinWithBooking($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booking relation
 *
 * @method     ChildBookingAttachmentQuery leftJoinWithBooking() Adds a LEFT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingAttachmentQuery rightJoinWithBooking() Adds a RIGHT JOIN clause and with to the query using the Booking relation
 * @method     ChildBookingAttachmentQuery innerJoinWithBooking() Adds a INNER JOIN clause and with to the query using the Booking relation
 *
 * @method     ChildBookingAttachmentQuery leftJoinFiles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Files relation
 * @method     ChildBookingAttachmentQuery rightJoinFiles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Files relation
 * @method     ChildBookingAttachmentQuery innerJoinFiles($relationAlias = null) Adds a INNER JOIN clause to the query using the Files relation
 *
 * @method     ChildBookingAttachmentQuery joinWithFiles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Files relation
 *
 * @method     ChildBookingAttachmentQuery leftJoinWithFiles() Adds a LEFT JOIN clause and with to the query using the Files relation
 * @method     ChildBookingAttachmentQuery rightJoinWithFiles() Adds a RIGHT JOIN clause and with to the query using the Files relation
 * @method     ChildBookingAttachmentQuery innerJoinWithFiles() Adds a INNER JOIN clause and with to the query using the Files relation
 *
 * @method     \TheFarm\Models\BookingQuery|\TheFarm\Models\FilesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingAttachment findOne(ConnectionInterface $con = null) Return the first ChildBookingAttachment matching the query
 * @method     ChildBookingAttachment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingAttachment matching the query, or a new ChildBookingAttachment object populated from the query conditions when no match is found
 *
 * @method     ChildBookingAttachment findOneByBookingId(int $booking_id) Return the first ChildBookingAttachment filtered by the booking_id column
 * @method     ChildBookingAttachment findOneByFileId(int $file_id) Return the first ChildBookingAttachment filtered by the file_id column *

 * @method     ChildBookingAttachment requirePk($key, ConnectionInterface $con = null) Return the ChildBookingAttachment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingAttachment requireOne(ConnectionInterface $con = null) Return the first ChildBookingAttachment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingAttachment requireOneByBookingId(int $booking_id) Return the first ChildBookingAttachment filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingAttachment requireOneByFileId(int $file_id) Return the first ChildBookingAttachment filtered by the file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingAttachment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingAttachment objects based on current ModelCriteria
 * @method     ChildBookingAttachment[]|ObjectCollection findByBookingId(int $booking_id) Return ChildBookingAttachment objects filtered by the booking_id column
 * @method     ChildBookingAttachment[]|ObjectCollection findByFileId(int $file_id) Return ChildBookingAttachment objects filtered by the file_id column
 * @method     ChildBookingAttachment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingAttachmentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingAttachmentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingAttachment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingAttachmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingAttachmentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingAttachmentQuery) {
            return $criteria;
        }
        $query = new ChildBookingAttachmentQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$booking_id, $file_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBookingAttachment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingAttachmentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingAttachmentTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBookingAttachment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT booking_id, file_id FROM tf_booking_attachments WHERE booking_id = :p0 AND file_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBookingAttachment $obj */
            $obj = new ChildBookingAttachment();
            $obj->hydrate($row);
            BookingAttachmentTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBookingAttachment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BookingAttachmentTableMap::COL_BOOKING_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BookingAttachmentTableMap::COL_FILE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the booking_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingId(1234); // WHERE booking_id = 1234
     * $query->filterByBookingId(array(12, 34)); // WHERE booking_id IN (12, 34)
     * $query->filterByBookingId(array('min' => 12)); // WHERE booking_id > 12
     * </code>
     *
     * @see       filterByBooking()
     *
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the file_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFileId(1234); // WHERE file_id = 1234
     * $query->filterByFileId(array(12, 34)); // WHERE file_id IN (12, 34)
     * $query->filterByFileId(array('min' => 12)); // WHERE file_id > 12
     * </code>
     *
     * @see       filterByFiles()
     *
     * @param     mixed $fileId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByFileId($fileId = null, $comparison = null)
    {
        if (is_array($fileId)) {
            $useMinMax = false;
            if (isset($fileId['min'])) {
                $this->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileId['max'])) {
                $this->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $fileId, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Booking object
     *
     * @param \TheFarm\Models\Booking|ObjectCollection $booking The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof \TheFarm\Models\Booking) {
            return $this
                ->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $booking->getBookingId(), $comparison);
        } elseif ($booking instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingAttachmentTableMap::COL_BOOKING_ID, $booking->toKeyValue('PrimaryKey', 'BookingId'), $comparison);
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
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\TheFarm\Models\BookingQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Files object
     *
     * @param \TheFarm\Models\Files|ObjectCollection $files The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function filterByFiles($files, $comparison = null)
    {
        if ($files instanceof \TheFarm\Models\Files) {
            return $this
                ->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $files->getFileId(), $comparison);
        } elseif ($files instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingAttachmentTableMap::COL_FILE_ID, $files->toKeyValue('PrimaryKey', 'FileId'), $comparison);
        } else {
            throw new PropelException('filterByFiles() only accepts arguments of type \TheFarm\Models\Files or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Files relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function joinFiles($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Files');

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
            $this->addJoinObject($join, 'Files');
        }

        return $this;
    }

    /**
     * Use the Files relation Files object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FilesQuery A secondary query class using the current class as primary query
     */
    public function useFilesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFiles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Files', '\TheFarm\Models\FilesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingAttachment $bookingAttachment Object to remove from the list of results
     *
     * @return $this|ChildBookingAttachmentQuery The current query, for fluid interface
     */
    public function prune($bookingAttachment = null)
    {
        if ($bookingAttachment) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BookingAttachmentTableMap::COL_BOOKING_ID), $bookingAttachment->getBookingId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BookingAttachmentTableMap::COL_FILE_ID), $bookingAttachment->getFileId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_attachments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingAttachmentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingAttachmentTableMap::clearInstancePool();
            BookingAttachmentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingAttachmentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingAttachmentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingAttachmentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingAttachmentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingAttachmentQuery
