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
use TheFarm\Models\File as ChildFile;
use TheFarm\Models\FileQuery as ChildFileQuery;
use TheFarm\Models\Map\FileTableMap;

/**
 * Base class that represents a query for the 'tf_files' table.
 *
 *
 *
 * @method     ChildFileQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 * @method     ChildFileQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildFileQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ChildFileQuery orderByFileSize($order = Criteria::ASC) Order by the file_size column
 * @method     ChildFileQuery orderByUploadId($order = Criteria::ASC) Order by the upload_id column
 * @method     ChildFileQuery orderByUploadDate($order = Criteria::ASC) Order by the upload_date column
 * @method     ChildFileQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildFileQuery orderByLastViewed($order = Criteria::ASC) Order by the last_viewed column
 * @method     ChildFileQuery orderByViewedBy($order = Criteria::ASC) Order by the viewed_by column
 *
 * @method     ChildFileQuery groupByFileId() Group by the file_id column
 * @method     ChildFileQuery groupByTitle() Group by the title column
 * @method     ChildFileQuery groupByFileName() Group by the file_name column
 * @method     ChildFileQuery groupByFileSize() Group by the file_size column
 * @method     ChildFileQuery groupByUploadId() Group by the upload_id column
 * @method     ChildFileQuery groupByUploadDate() Group by the upload_date column
 * @method     ChildFileQuery groupByLocationId() Group by the location_id column
 * @method     ChildFileQuery groupByLastViewed() Group by the last_viewed column
 * @method     ChildFileQuery groupByViewedBy() Group by the viewed_by column
 *
 * @method     ChildFileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFileQuery leftJoinBookingAttachment($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingAttachment relation
 * @method     ChildFileQuery rightJoinBookingAttachment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingAttachment relation
 * @method     ChildFileQuery innerJoinBookingAttachment($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingAttachment relation
 *
 * @method     ChildFileQuery joinWithBookingAttachment($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingAttachment relation
 *
 * @method     ChildFileQuery leftJoinWithBookingAttachment() Adds a LEFT JOIN clause and with to the query using the BookingAttachment relation
 * @method     ChildFileQuery rightJoinWithBookingAttachment() Adds a RIGHT JOIN clause and with to the query using the BookingAttachment relation
 * @method     ChildFileQuery innerJoinWithBookingAttachment() Adds a INNER JOIN clause and with to the query using the BookingAttachment relation
 *
 * @method     ChildFileQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildFileQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildFileQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildFileQuery joinWithCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Category relation
 *
 * @method     ChildFileQuery leftJoinWithCategory() Adds a LEFT JOIN clause and with to the query using the Category relation
 * @method     ChildFileQuery rightJoinWithCategory() Adds a RIGHT JOIN clause and with to the query using the Category relation
 * @method     ChildFileQuery innerJoinWithCategory() Adds a INNER JOIN clause and with to the query using the Category relation
 *
 * @method     ChildFileQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     ChildFileQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     ChildFileQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     ChildFileQuery joinWithItem($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Item relation
 *
 * @method     ChildFileQuery leftJoinWithItem() Adds a LEFT JOIN clause and with to the query using the Item relation
 * @method     ChildFileQuery rightJoinWithItem() Adds a RIGHT JOIN clause and with to the query using the Item relation
 * @method     ChildFileQuery innerJoinWithItem() Adds a INNER JOIN clause and with to the query using the Item relation
 *
 * @method     \TheFarm\Models\BookingAttachmentQuery|\TheFarm\Models\CategoryQuery|\TheFarm\Models\ItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFile findOne(ConnectionInterface $con = null) Return the first ChildFile matching the query
 * @method     ChildFile findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFile matching the query, or a new ChildFile object populated from the query conditions when no match is found
 *
 * @method     ChildFile findOneByFileId(int $file_id) Return the first ChildFile filtered by the file_id column
 * @method     ChildFile findOneByTitle(string $title) Return the first ChildFile filtered by the title column
 * @method     ChildFile findOneByFileName(string $file_name) Return the first ChildFile filtered by the file_name column
 * @method     ChildFile findOneByFileSize(int $file_size) Return the first ChildFile filtered by the file_size column
 * @method     ChildFile findOneByUploadId(int $upload_id) Return the first ChildFile filtered by the upload_id column
 * @method     ChildFile findOneByUploadDate(int $upload_date) Return the first ChildFile filtered by the upload_date column
 * @method     ChildFile findOneByLocationId(int $location_id) Return the first ChildFile filtered by the location_id column
 * @method     ChildFile findOneByLastViewed(int $last_viewed) Return the first ChildFile filtered by the last_viewed column
 * @method     ChildFile findOneByViewedBy(int $viewed_by) Return the first ChildFile filtered by the viewed_by column *

 * @method     ChildFile requirePk($key, ConnectionInterface $con = null) Return the ChildFile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOne(ConnectionInterface $con = null) Return the first ChildFile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFile requireOneByFileId(int $file_id) Return the first ChildFile filtered by the file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByTitle(string $title) Return the first ChildFile filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByFileName(string $file_name) Return the first ChildFile filtered by the file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByFileSize(int $file_size) Return the first ChildFile filtered by the file_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByUploadId(int $upload_id) Return the first ChildFile filtered by the upload_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByUploadDate(int $upload_date) Return the first ChildFile filtered by the upload_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByLocationId(int $location_id) Return the first ChildFile filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByLastViewed(int $last_viewed) Return the first ChildFile filtered by the last_viewed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByViewedBy(int $viewed_by) Return the first ChildFile filtered by the viewed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFile[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFile objects based on current ModelCriteria
 * @method     ChildFile[]|ObjectCollection findByFileId(int $file_id) Return ChildFile objects filtered by the file_id column
 * @method     ChildFile[]|ObjectCollection findByTitle(string $title) Return ChildFile objects filtered by the title column
 * @method     ChildFile[]|ObjectCollection findByFileName(string $file_name) Return ChildFile objects filtered by the file_name column
 * @method     ChildFile[]|ObjectCollection findByFileSize(int $file_size) Return ChildFile objects filtered by the file_size column
 * @method     ChildFile[]|ObjectCollection findByUploadId(int $upload_id) Return ChildFile objects filtered by the upload_id column
 * @method     ChildFile[]|ObjectCollection findByUploadDate(int $upload_date) Return ChildFile objects filtered by the upload_date column
 * @method     ChildFile[]|ObjectCollection findByLocationId(int $location_id) Return ChildFile objects filtered by the location_id column
 * @method     ChildFile[]|ObjectCollection findByLastViewed(int $last_viewed) Return ChildFile objects filtered by the last_viewed column
 * @method     ChildFile[]|ObjectCollection findByViewedBy(int $viewed_by) Return ChildFile objects filtered by the viewed_by column
 * @method     ChildFile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FileQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FileQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\File', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFileQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFileQuery) {
            return $criteria;
        }
        $query = new ChildFileQuery();
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
     * @return ChildFile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FileTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT file_id, title, file_name, file_size, upload_id, upload_date, location_id, last_viewed, viewed_by FROM tf_files WHERE file_id = :p0';
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
            /** @var ChildFile $obj */
            $obj = new ChildFile();
            $obj->hydrate($row);
            FileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFile|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FileTableMap::COL_FILE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FileTableMap::COL_FILE_ID, $keys, Criteria::IN);
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
     * @param     mixed $fileId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByFileId($fileId = null, $comparison = null)
    {
        if (is_array($fileId)) {
            $useMinMax = false;
            if (isset($fileId['min'])) {
                $this->addUsingAlias(FileTableMap::COL_FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileId['max'])) {
                $this->addUsingAlias(FileTableMap::COL_FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_FILE_ID, $fileId, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%', Criteria::LIKE); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the file_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFileName('fooValue');   // WHERE file_name = 'fooValue'
     * $query->filterByFileName('%fooValue%', Criteria::LIKE); // WHERE file_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fileName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByFileName($fileName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_FILE_NAME, $fileName, $comparison);
    }

    /**
     * Filter the query on the file_size column
     *
     * Example usage:
     * <code>
     * $query->filterByFileSize(1234); // WHERE file_size = 1234
     * $query->filterByFileSize(array(12, 34)); // WHERE file_size IN (12, 34)
     * $query->filterByFileSize(array('min' => 12)); // WHERE file_size > 12
     * </code>
     *
     * @param     mixed $fileSize The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByFileSize($fileSize = null, $comparison = null)
    {
        if (is_array($fileSize)) {
            $useMinMax = false;
            if (isset($fileSize['min'])) {
                $this->addUsingAlias(FileTableMap::COL_FILE_SIZE, $fileSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileSize['max'])) {
                $this->addUsingAlias(FileTableMap::COL_FILE_SIZE, $fileSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_FILE_SIZE, $fileSize, $comparison);
    }

    /**
     * Filter the query on the upload_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUploadId(1234); // WHERE upload_id = 1234
     * $query->filterByUploadId(array(12, 34)); // WHERE upload_id IN (12, 34)
     * $query->filterByUploadId(array('min' => 12)); // WHERE upload_id > 12
     * </code>
     *
     * @param     mixed $uploadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByUploadId($uploadId = null, $comparison = null)
    {
        if (is_array($uploadId)) {
            $useMinMax = false;
            if (isset($uploadId['min'])) {
                $this->addUsingAlias(FileTableMap::COL_UPLOAD_ID, $uploadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploadId['max'])) {
                $this->addUsingAlias(FileTableMap::COL_UPLOAD_ID, $uploadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_UPLOAD_ID, $uploadId, $comparison);
    }

    /**
     * Filter the query on the upload_date column
     *
     * Example usage:
     * <code>
     * $query->filterByUploadDate(1234); // WHERE upload_date = 1234
     * $query->filterByUploadDate(array(12, 34)); // WHERE upload_date IN (12, 34)
     * $query->filterByUploadDate(array('min' => 12)); // WHERE upload_date > 12
     * </code>
     *
     * @param     mixed $uploadDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByUploadDate($uploadDate = null, $comparison = null)
    {
        if (is_array($uploadDate)) {
            $useMinMax = false;
            if (isset($uploadDate['min'])) {
                $this->addUsingAlias(FileTableMap::COL_UPLOAD_DATE, $uploadDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploadDate['max'])) {
                $this->addUsingAlias(FileTableMap::COL_UPLOAD_DATE, $uploadDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_UPLOAD_DATE, $uploadDate, $comparison);
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
     * @param     mixed $locationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(FileTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(FileTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_LOCATION_ID, $locationId, $comparison);
    }

    /**
     * Filter the query on the last_viewed column
     *
     * Example usage:
     * <code>
     * $query->filterByLastViewed(1234); // WHERE last_viewed = 1234
     * $query->filterByLastViewed(array(12, 34)); // WHERE last_viewed IN (12, 34)
     * $query->filterByLastViewed(array('min' => 12)); // WHERE last_viewed > 12
     * </code>
     *
     * @param     mixed $lastViewed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByLastViewed($lastViewed = null, $comparison = null)
    {
        if (is_array($lastViewed)) {
            $useMinMax = false;
            if (isset($lastViewed['min'])) {
                $this->addUsingAlias(FileTableMap::COL_LAST_VIEWED, $lastViewed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastViewed['max'])) {
                $this->addUsingAlias(FileTableMap::COL_LAST_VIEWED, $lastViewed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_LAST_VIEWED, $lastViewed, $comparison);
    }

    /**
     * Filter the query on the viewed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByViewedBy(1234); // WHERE viewed_by = 1234
     * $query->filterByViewedBy(array(12, 34)); // WHERE viewed_by IN (12, 34)
     * $query->filterByViewedBy(array('min' => 12)); // WHERE viewed_by > 12
     * </code>
     *
     * @param     mixed $viewedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByViewedBy($viewedBy = null, $comparison = null)
    {
        if (is_array($viewedBy)) {
            $useMinMax = false;
            if (isset($viewedBy['min'])) {
                $this->addUsingAlias(FileTableMap::COL_VIEWED_BY, $viewedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($viewedBy['max'])) {
                $this->addUsingAlias(FileTableMap::COL_VIEWED_BY, $viewedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_VIEWED_BY, $viewedBy, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingAttachment object
     *
     * @param \TheFarm\Models\BookingAttachment|ObjectCollection $bookingAttachment the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileQuery The current query, for fluid interface
     */
    public function filterByBookingAttachment($bookingAttachment, $comparison = null)
    {
        if ($bookingAttachment instanceof \TheFarm\Models\BookingAttachment) {
            return $this
                ->addUsingAlias(FileTableMap::COL_FILE_ID, $bookingAttachment->getFileId(), $comparison);
        } elseif ($bookingAttachment instanceof ObjectCollection) {
            return $this
                ->useBookingAttachmentQuery()
                ->filterByPrimaryKeys($bookingAttachment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingAttachment() only accepts arguments of type \TheFarm\Models\BookingAttachment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingAttachment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function joinBookingAttachment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingAttachment');

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
            $this->addJoinObject($join, 'BookingAttachment');
        }

        return $this;
    }

    /**
     * Use the BookingAttachment relation BookingAttachment object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingAttachmentQuery A secondary query class using the current class as primary query
     */
    public function useBookingAttachmentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingAttachment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingAttachment', '\TheFarm\Models\BookingAttachmentQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Category object
     *
     * @param \TheFarm\Models\Category|ObjectCollection $category the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \TheFarm\Models\Category) {
            return $this
                ->addUsingAlias(FileTableMap::COL_FILE_ID, $category->getCatImage(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            return $this
                ->useCategoryQuery()
                ->filterByPrimaryKeys($category->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \TheFarm\Models\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\TheFarm\Models\CategoryQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Item object
     *
     * @param \TheFarm\Models\Item|ObjectCollection $item the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileQuery The current query, for fluid interface
     */
    public function filterByItem($item, $comparison = null)
    {
        if ($item instanceof \TheFarm\Models\Item) {
            return $this
                ->addUsingAlias(FileTableMap::COL_FILE_ID, $item->getItemImage(), $comparison);
        } elseif ($item instanceof ObjectCollection) {
            return $this
                ->useItemQuery()
                ->filterByPrimaryKeys($item->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItem() only accepts arguments of type \TheFarm\Models\Item or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Item relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function joinItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Item');

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
            $this->addJoinObject($join, 'Item');
        }

        return $this;
    }

    /**
     * Use the Item relation Item object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemQuery A secondary query class using the current class as primary query
     */
    public function useItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Item', '\TheFarm\Models\ItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFile $file Object to remove from the list of results
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function prune($file = null)
    {
        if ($file) {
            $this->addUsingAlias(FileTableMap::COL_FILE_ID, $file->getFileId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_files table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FileTableMap::clearInstancePool();
            FileTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FileQuery
