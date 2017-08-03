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
use TheFarm\Models\Form as ChildForm;
use TheFarm\Models\FormQuery as ChildFormQuery;
use TheFarm\Models\Map\FormTableMap;

/**
 * Base class that represents a query for the 'tf_forms' table.
 *
 *
 *
 * @method     ChildFormQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildFormQuery orderByFormName($order = Criteria::ASC) Order by the form_name column
 * @method     ChildFormQuery orderByFormHtml($order = Criteria::ASC) Order by the form_html column
 * @method     ChildFormQuery orderByFieldIds($order = Criteria::ASC) Order by the field_ids column
 * @method     ChildFormQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildFormQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFormQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 *
 * @method     ChildFormQuery groupByFormId() Group by the form_id column
 * @method     ChildFormQuery groupByFormName() Group by the form_name column
 * @method     ChildFormQuery groupByFormHtml() Group by the form_html column
 * @method     ChildFormQuery groupByFieldIds() Group by the field_ids column
 * @method     ChildFormQuery groupByAuthorId() Group by the author_id column
 * @method     ChildFormQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildFormQuery groupByEditDate() Group by the edit_date column
 *
 * @method     ChildFormQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormQuery leftJoinFormEntry($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormEntry relation
 * @method     ChildFormQuery rightJoinFormEntry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormEntry relation
 * @method     ChildFormQuery innerJoinFormEntry($relationAlias = null) Adds a INNER JOIN clause to the query using the FormEntry relation
 *
 * @method     ChildFormQuery joinWithFormEntry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FormEntry relation
 *
 * @method     ChildFormQuery leftJoinWithFormEntry() Adds a LEFT JOIN clause and with to the query using the FormEntry relation
 * @method     ChildFormQuery rightJoinWithFormEntry() Adds a RIGHT JOIN clause and with to the query using the FormEntry relation
 * @method     ChildFormQuery innerJoinWithFormEntry() Adds a INNER JOIN clause and with to the query using the FormEntry relation
 *
 * @method     \TheFarm\Models\FormEntryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildForm findOne(ConnectionInterface $con = null) Return the first ChildForm matching the query
 * @method     ChildForm findOneOrCreate(ConnectionInterface $con = null) Return the first ChildForm matching the query, or a new ChildForm object populated from the query conditions when no match is found
 *
 * @method     ChildForm findOneByFormId(int $form_id) Return the first ChildForm filtered by the form_id column
 * @method     ChildForm findOneByFormName(string $form_name) Return the first ChildForm filtered by the form_name column
 * @method     ChildForm findOneByFormHtml(string $form_html) Return the first ChildForm filtered by the form_html column
 * @method     ChildForm findOneByFieldIds(string $field_ids) Return the first ChildForm filtered by the field_ids column
 * @method     ChildForm findOneByAuthorId(int $author_id) Return the first ChildForm filtered by the author_id column
 * @method     ChildForm findOneByEntryDate(int $entry_date) Return the first ChildForm filtered by the entry_date column
 * @method     ChildForm findOneByEditDate(int $edit_date) Return the first ChildForm filtered by the edit_date column *

 * @method     ChildForm requirePk($key, ConnectionInterface $con = null) Return the ChildForm by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOne(ConnectionInterface $con = null) Return the first ChildForm matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForm requireOneByFormId(int $form_id) Return the first ChildForm filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByFormName(string $form_name) Return the first ChildForm filtered by the form_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByFormHtml(string $form_html) Return the first ChildForm filtered by the form_html column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByFieldIds(string $field_ids) Return the first ChildForm filtered by the field_ids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByAuthorId(int $author_id) Return the first ChildForm filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByEntryDate(int $entry_date) Return the first ChildForm filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildForm requireOneByEditDate(int $edit_date) Return the first ChildForm filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildForm[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildForm objects based on current ModelCriteria
 * @method     ChildForm[]|ObjectCollection findByFormId(int $form_id) Return ChildForm objects filtered by the form_id column
 * @method     ChildForm[]|ObjectCollection findByFormName(string $form_name) Return ChildForm objects filtered by the form_name column
 * @method     ChildForm[]|ObjectCollection findByFormHtml(string $form_html) Return ChildForm objects filtered by the form_html column
 * @method     ChildForm[]|ObjectCollection findByFieldIds(string $field_ids) Return ChildForm objects filtered by the field_ids column
 * @method     ChildForm[]|ObjectCollection findByAuthorId(int $author_id) Return ChildForm objects filtered by the author_id column
 * @method     ChildForm[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildForm objects filtered by the entry_date column
 * @method     ChildForm[]|ObjectCollection findByEditDate(int $edit_date) Return ChildForm objects filtered by the edit_date column
 * @method     ChildForm[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\Form', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormQuery) {
            return $criteria;
        }
        $query = new ChildFormQuery();
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
     * @return ChildForm|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildForm A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT form_id, form_name, form_html, field_ids, author_id, entry_date, edit_date FROM tf_forms WHERE form_id = :p0';
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
            /** @var ChildForm $obj */
            $obj = new ChildForm();
            $obj->hydrate($row);
            FormTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildForm|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormTableMap::COL_FORM_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormTableMap::COL_FORM_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormId(1234); // WHERE form_id = 1234
     * $query->filterByFormId(array(12, 34)); // WHERE form_id IN (12, 34)
     * $query->filterByFormId(array('min' => 12)); // WHERE form_id > 12
     * </code>
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(FormTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(FormTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the form_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFormName('fooValue');   // WHERE form_name = 'fooValue'
     * $query->filterByFormName('%fooValue%', Criteria::LIKE); // WHERE form_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByFormName($formName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_FORM_NAME, $formName, $comparison);
    }

    /**
     * Filter the query on the form_html column
     *
     * Example usage:
     * <code>
     * $query->filterByFormHtml('fooValue');   // WHERE form_html = 'fooValue'
     * $query->filterByFormHtml('%fooValue%', Criteria::LIKE); // WHERE form_html LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formHtml The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByFormHtml($formHtml = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formHtml)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_FORM_HTML, $formHtml, $comparison);
    }

    /**
     * Filter the query on the field_ids column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldIds('fooValue');   // WHERE field_ids = 'fooValue'
     * $query->filterByFieldIds('%fooValue%', Criteria::LIKE); // WHERE field_ids LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldIds The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByFieldIds($fieldIds = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldIds)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_FIELD_IDS, $fieldIds, $comparison);
    }

    /**
     * Filter the query on the author_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorId(1234); // WHERE author_id = 1234
     * $query->filterByAuthorId(array(12, 34)); // WHERE author_id IN (12, 34)
     * $query->filterByAuthorId(array('min' => 12)); // WHERE author_id > 12
     * </code>
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(FormTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(FormTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_AUTHOR_ID, $authorId, $comparison);
    }

    /**
     * Filter the query on the entry_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryDate(1234); // WHERE entry_date = 1234
     * $query->filterByEntryDate(array(12, 34)); // WHERE entry_date IN (12, 34)
     * $query->filterByEntryDate(array('min' => 12)); // WHERE entry_date > 12
     * </code>
     *
     * @param     mixed $entryDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FormTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FormTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
    }

    /**
     * Filter the query on the edit_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEditDate(1234); // WHERE edit_date = 1234
     * $query->filterByEditDate(array(12, 34)); // WHERE edit_date IN (12, 34)
     * $query->filterByEditDate(array('min' => 12)); // WHERE edit_date > 12
     * </code>
     *
     * @param     mixed $editDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FormTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FormTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\FormEntry object
     *
     * @param \TheFarm\Models\FormEntry|ObjectCollection $formEntry the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFormQuery The current query, for fluid interface
     */
    public function filterByFormEntry($formEntry, $comparison = null)
    {
        if ($formEntry instanceof \TheFarm\Models\FormEntry) {
            return $this
                ->addUsingAlias(FormTableMap::COL_FORM_ID, $formEntry->getFormId(), $comparison);
        } elseif ($formEntry instanceof ObjectCollection) {
            return $this
                ->useFormEntryQuery()
                ->filterByPrimaryKeys($formEntry->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFormEntry() only accepts arguments of type \TheFarm\Models\FormEntry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FormEntry relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function joinFormEntry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FormEntry');

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
            $this->addJoinObject($join, 'FormEntry');
        }

        return $this;
    }

    /**
     * Use the FormEntry relation FormEntry object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormEntryQuery A secondary query class using the current class as primary query
     */
    public function useFormEntryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFormEntry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FormEntry', '\TheFarm\Models\FormEntryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildForm $form Object to remove from the list of results
     *
     * @return $this|ChildFormQuery The current query, for fluid interface
     */
    public function prune($form = null)
    {
        if ($form) {
            $this->addUsingAlias(FormTableMap::COL_FORM_ID, $form->getFormId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_forms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormTableMap::clearInstancePool();
            FormTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormQuery
