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
use TheFarm\Models\Files as ChildFiles;
use TheFarm\Models\FilesQuery as ChildFilesQuery;
use TheFarm\Models\Map\FilesTableMap;

/**
 * Base class that represents a query for the 'tf_files' table.
 *
 *
 *
 * @method     ChildFilesQuery orderByFileId($order = Criteria::ASC) Order by the file_id column
 * @method     ChildFilesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildFilesQuery orderByFileName($order = Criteria::ASC) Order by the file_name column
 * @method     ChildFilesQuery orderByFileSize($order = Criteria::ASC) Order by the file_size column
 * @method     ChildFilesQuery orderByUploadId($order = Criteria::ASC) Order by the upload_id column
 * @method     ChildFilesQuery orderByUploadDate($order = Criteria::ASC) Order by the upload_date column
 * @method     ChildFilesQuery orderByLocationId($order = Criteria::ASC) Order by the location_id column
 * @method     ChildFilesQuery orderByLastViewed($order = Criteria::ASC) Order by the last_viewed column
 * @method     ChildFilesQuery orderByViewedBy($order = Criteria::ASC) Order by the viewed_by column
 *
 * @method     ChildFilesQuery groupByFileId() Group by the file_id column
 * @method     ChildFilesQuery groupByTitle() Group by the title column
 * @method     ChildFilesQuery groupByFileName() Group by the file_name column
 * @method     ChildFilesQuery groupByFileSize() Group by the file_size column
 * @method     ChildFilesQuery groupByUploadId() Group by the upload_id column
 * @method     ChildFilesQuery groupByUploadDate() Group by the upload_date column
 * @method     ChildFilesQuery groupByLocationId() Group by the location_id column
 * @method     ChildFilesQuery groupByLastViewed() Group by the last_viewed column
 * @method     ChildFilesQuery groupByViewedBy() Group by the viewed_by column
 *
 * @method     ChildFilesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFilesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFilesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFilesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFilesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFilesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFilesQuery leftJoinBookingAttachments($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingAttachments relation
 * @method     ChildFilesQuery rightJoinBookingAttachments($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingAttachments relation
 * @method     ChildFilesQuery innerJoinBookingAttachments($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingAttachments relation
 *
 * @method     ChildFilesQuery joinWithBookingAttachments($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingAttachments relation
 *
 * @method     ChildFilesQuery leftJoinWithBookingAttachments() Adds a LEFT JOIN clause and with to the query using the BookingAttachments relation
 * @method     ChildFilesQuery rightJoinWithBookingAttachments() Adds a RIGHT JOIN clause and with to the query using the BookingAttachments relation
 * @method     ChildFilesQuery innerJoinWithBookingAttachments() Adds a INNER JOIN clause and with to the query using the BookingAttachments relation
 *
 * @method     ChildFilesQuery leftJoinCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categories relation
 * @method     ChildFilesQuery rightJoinCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categories relation
 * @method     ChildFilesQuery innerJoinCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the Categories relation
 *
 * @method     ChildFilesQuery joinWithCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categories relation
 *
 * @method     ChildFilesQuery leftJoinWithCategories() Adds a LEFT JOIN clause and with to the query using the Categories relation
 * @method     ChildFilesQuery rightJoinWithCategories() Adds a RIGHT JOIN clause and with to the query using the Categories relation
 * @method     ChildFilesQuery innerJoinWithCategories() Adds a INNER JOIN clause and with to the query using the Categories relation
 *
 * @method     ChildFilesQuery leftJoinItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the Items relation
 * @method     ChildFilesQuery rightJoinItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Items relation
 * @method     ChildFilesQuery innerJoinItems($relationAlias = null) Adds a INNER JOIN clause to the query using the Items relation
 *
 * @method     ChildFilesQuery joinWithItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Items relation
 *
 * @method     ChildFilesQuery leftJoinWithItems() Adds a LEFT JOIN clause and with to the query using the Items relation
 * @method     ChildFilesQuery rightJoinWithItems() Adds a RIGHT JOIN clause and with to the query using the Items relation
 * @method     ChildFilesQuery innerJoinWithItems() Adds a INNER JOIN clause and with to the query using the Items relation
 *
 * @method     \TheFarm\Models\BookingAttachmentsQuery|\TheFarm\Models\CategoriesQuery|\TheFarm\Models\ItemsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFiles findOne(ConnectionInterface $con = null) Return the first ChildFiles matching the query
 * @method     ChildFiles findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFiles matching the query, or a new ChildFiles object populated from the query conditions when no match is found
 *
 * @method     ChildFiles findOneByFileId(int $file_id) Return the first ChildFiles filtered by the file_id column
 * @method     ChildFiles findOneByTitle(string $title) Return the first ChildFiles filtered by the title column
 * @method     ChildFiles findOneByFileName(string $file_name) Return the first ChildFiles filtered by the file_name column
 * @method     ChildFiles findOneByFileSize(int $file_size) Return the first ChildFiles filtered by the file_size column
 * @method     ChildFiles findOneByUploadId(int $upload_id) Return the first ChildFiles filtered by the upload_id column
 * @method     ChildFiles findOneByUploadDate(int $upload_date) Return the first ChildFiles filtered by the upload_date column
 * @method     ChildFiles findOneByLocationId(int $location_id) Return the first ChildFiles filtered by the location_id column
 * @method     ChildFiles findOneByLastViewed(int $last_viewed) Return the first ChildFiles filtered by the last_viewed column
 * @method     ChildFiles findOneByViewedBy(int $viewed_by) Return the first ChildFiles filtered by the viewed_by column *

 * @method     ChildFiles requirePk($key, ConnectionInterface $con = null) Return the ChildFiles by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOne(ConnectionInterface $con = null) Return the first ChildFiles matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFiles requireOneByFileId(int $file_id) Return the first ChildFiles filtered by the file_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByTitle(string $title) Return the first ChildFiles filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByFileName(string $file_name) Return the first ChildFiles filtered by the file_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByFileSize(int $file_size) Return the first ChildFiles filtered by the file_size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByUploadId(int $upload_id) Return the first ChildFiles filtered by the upload_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByUploadDate(int $upload_date) Return the first ChildFiles filtered by the upload_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByLocationId(int $location_id) Return the first ChildFiles filtered by the location_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByLastViewed(int $last_viewed) Return the first ChildFiles filtered by the last_viewed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFiles requireOneByViewedBy(int $viewed_by) Return the first ChildFiles filtered by the viewed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFiles[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFiles objects based on current ModelCriteria
 * @method     ChildFiles[]|ObjectCollection findByFileId(int $file_id) Return ChildFiles objects filtered by the file_id column
 * @method     ChildFiles[]|ObjectCollection findByTitle(string $title) Return ChildFiles objects filtered by the title column
 * @method     ChildFiles[]|ObjectCollection findByFileName(string $file_name) Return ChildFiles objects filtered by the file_name column
 * @method     ChildFiles[]|ObjectCollection findByFileSize(int $file_size) Return ChildFiles objects filtered by the file_size column
 * @method     ChildFiles[]|ObjectCollection findByUploadId(int $upload_id) Return ChildFiles objects filtered by the upload_id column
 * @method     ChildFiles[]|ObjectCollection findByUploadDate(int $upload_date) Return ChildFiles objects filtered by the upload_date column
 * @method     ChildFiles[]|ObjectCollection findByLocationId(int $location_id) Return ChildFiles objects filtered by the location_id column
 * @method     ChildFiles[]|ObjectCollection findByLastViewed(int $last_viewed) Return ChildFiles objects filtered by the last_viewed column
 * @method     ChildFiles[]|ObjectCollection findByViewedBy(int $viewed_by) Return ChildFiles objects filtered by the viewed_by column
 * @method     ChildFiles[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FilesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FilesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Files', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFilesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFilesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFilesQuery) {
            return $criteria;
        }
        $query = new ChildFilesQuery();
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
     * @return ChildFiles|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FilesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FilesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFiles A model object, or null if the key is not found
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
            /** @var ChildFiles $obj */
            $obj = new ChildFiles();
            $obj->hydrate($row);
            FilesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFiles|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByFileId($fileId = null, $comparison = null)
    {
        if (is_array($fileId)) {
            $useMinMax = false;
            if (isset($fileId['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $fileId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileId['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $fileId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $fileId, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByFileName($fileName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fileName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_FILE_NAME, $fileName, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByFileSize($fileSize = null, $comparison = null)
    {
        if (is_array($fileSize)) {
            $useMinMax = false;
            if (isset($fileSize['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_FILE_SIZE, $fileSize['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fileSize['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_FILE_SIZE, $fileSize['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_FILE_SIZE, $fileSize, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByUploadId($uploadId = null, $comparison = null)
    {
        if (is_array($uploadId)) {
            $useMinMax = false;
            if (isset($uploadId['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_UPLOAD_ID, $uploadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploadId['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_UPLOAD_ID, $uploadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_UPLOAD_ID, $uploadId, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByUploadDate($uploadDate = null, $comparison = null)
    {
        if (is_array($uploadDate)) {
            $useMinMax = false;
            if (isset($uploadDate['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_UPLOAD_DATE, $uploadDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uploadDate['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_UPLOAD_DATE, $uploadDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_UPLOAD_DATE, $uploadDate, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByLocationId($locationId = null, $comparison = null)
    {
        if (is_array($locationId)) {
            $useMinMax = false;
            if (isset($locationId['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_LOCATION_ID, $locationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationId['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_LOCATION_ID, $locationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_LOCATION_ID, $locationId, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByLastViewed($lastViewed = null, $comparison = null)
    {
        if (is_array($lastViewed)) {
            $useMinMax = false;
            if (isset($lastViewed['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_LAST_VIEWED, $lastViewed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastViewed['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_LAST_VIEWED, $lastViewed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_LAST_VIEWED, $lastViewed, $comparison);
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
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function filterByViewedBy($viewedBy = null, $comparison = null)
    {
        if (is_array($viewedBy)) {
            $useMinMax = false;
            if (isset($viewedBy['min'])) {
                $this->addUsingAlias(FilesTableMap::COL_VIEWED_BY, $viewedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($viewedBy['max'])) {
                $this->addUsingAlias(FilesTableMap::COL_VIEWED_BY, $viewedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FilesTableMap::COL_VIEWED_BY, $viewedBy, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingAttachments object
     *
     * @param \TheFarm\Models\BookingAttachments|ObjectCollection $bookingAttachments the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFilesQuery The current query, for fluid interface
     */
    public function filterByBookingAttachments($bookingAttachments, $comparison = null)
    {
        if ($bookingAttachments instanceof \TheFarm\Models\BookingAttachments) {
            return $this
                ->addUsingAlias(FilesTableMap::COL_FILE_ID, $bookingAttachments->getFileId(), $comparison);
        } elseif ($bookingAttachments instanceof ObjectCollection) {
            return $this
                ->useBookingAttachmentsQuery()
                ->filterByPrimaryKeys($bookingAttachments->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingAttachments() only accepts arguments of type \TheFarm\Models\BookingAttachments or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingAttachments relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function joinBookingAttachments($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingAttachments');

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
            $this->addJoinObject($join, 'BookingAttachments');
        }

        return $this;
    }

    /**
     * Use the BookingAttachments relation BookingAttachments object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingAttachmentsQuery A secondary query class using the current class as primary query
     */
    public function useBookingAttachmentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingAttachments($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingAttachments', '\TheFarm\Models\BookingAttachmentsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Categories object
     *
     * @param \TheFarm\Models\Categories|ObjectCollection $categories the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFilesQuery The current query, for fluid interface
     */
    public function filterByCategories($categories, $comparison = null)
    {
        if ($categories instanceof \TheFarm\Models\Categories) {
            return $this
                ->addUsingAlias(FilesTableMap::COL_FILE_ID, $categories->getCatImage(), $comparison);
        } elseif ($categories instanceof ObjectCollection) {
            return $this
                ->useCategoriesQuery()
                ->filterByPrimaryKeys($categories->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategories() only accepts arguments of type \TheFarm\Models\Categories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function joinCategories($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categories');

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
            $this->addJoinObject($join, 'Categories');
        }

        return $this;
    }

    /**
     * Use the Categories relation Categories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\CategoriesQuery A secondary query class using the current class as primary query
     */
    public function useCategoriesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categories', '\TheFarm\Models\CategoriesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Items object
     *
     * @param \TheFarm\Models\Items|ObjectCollection $items the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFilesQuery The current query, for fluid interface
     */
    public function filterByItems($items, $comparison = null)
    {
        if ($items instanceof \TheFarm\Models\Items) {
            return $this
                ->addUsingAlias(FilesTableMap::COL_FILE_ID, $items->getItemImage(), $comparison);
        } elseif ($items instanceof ObjectCollection) {
            return $this
                ->useItemsQuery()
                ->filterByPrimaryKeys($items->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByItems() only accepts arguments of type \TheFarm\Models\Items or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Items relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function joinItems($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Items');

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
            $this->addJoinObject($join, 'Items');
        }

        return $this;
    }

    /**
     * Use the Items relation Items object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ItemsQuery A secondary query class using the current class as primary query
     */
    public function useItemsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Items', '\TheFarm\Models\ItemsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFiles $files Object to remove from the list of results
     *
     * @return $this|ChildFilesQuery The current query, for fluid interface
     */
    public function prune($files = null)
    {
        if ($files) {
            $this->addUsingAlias(FilesTableMap::COL_FILE_ID, $files->getFileId(), Criteria::NOT_EQUAL);
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
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FilesTableMap::clearInstancePool();
            FilesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FilesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FilesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FilesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FilesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FilesQuery
