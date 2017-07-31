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
use TheFarm\Models\FormFields as ChildFormFields;
use TheFarm\Models\FormFieldsQuery as ChildFormFieldsQuery;
use TheFarm\Models\Map\FormFieldsTableMap;

/**
 * Base class that represents a query for the 'tf_form_fields' table.
 *
 *
 *
 * @method     ChildFormFieldsQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFormFieldsQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildFormFieldsQuery orderByGuestOnly($order = Criteria::ASC) Order by the guest_only column
 *
 * @method     ChildFormFieldsQuery groupByFieldId() Group by the field_id column
 * @method     ChildFormFieldsQuery groupByFormId() Group by the form_id column
 * @method     ChildFormFieldsQuery groupByGuestOnly() Group by the guest_only column
 *
 * @method     ChildFormFieldsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormFieldsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormFieldsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormFieldsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormFieldsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormFieldsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormFields findOne(ConnectionInterface $con = null) Return the first ChildFormFields matching the query
 * @method     ChildFormFields findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormFields matching the query, or a new ChildFormFields object populated from the query conditions when no match is found
 *
 * @method     ChildFormFields findOneByFieldId(int $field_id) Return the first ChildFormFields filtered by the field_id column
 * @method     ChildFormFields findOneByFormId(int $form_id) Return the first ChildFormFields filtered by the form_id column
 * @method     ChildFormFields findOneByGuestOnly(string $guest_only) Return the first ChildFormFields filtered by the guest_only column *

 * @method     ChildFormFields requirePk($key, ConnectionInterface $con = null) Return the ChildFormFields by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormFields requireOne(ConnectionInterface $con = null) Return the first ChildFormFields matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormFields requireOneByFieldId(int $field_id) Return the first ChildFormFields filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormFields requireOneByFormId(int $form_id) Return the first ChildFormFields filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormFields requireOneByGuestOnly(string $guest_only) Return the first ChildFormFields filtered by the guest_only column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormFields[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormFields objects based on current ModelCriteria
 * @method     ChildFormFields[]|ObjectCollection findByFieldId(int $field_id) Return ChildFormFields objects filtered by the field_id column
 * @method     ChildFormFields[]|ObjectCollection findByFormId(int $form_id) Return ChildFormFields objects filtered by the form_id column
 * @method     ChildFormFields[]|ObjectCollection findByGuestOnly(string $guest_only) Return ChildFormFields objects filtered by the guest_only column
 * @method     ChildFormFields[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormFieldsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormFieldsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormFields', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormFieldsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormFieldsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormFieldsQuery) {
            return $criteria;
        }
        $query = new ChildFormFieldsQuery();
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
     * @param array[$field_id, $form_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFormFields|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormFieldsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormFieldsTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildFormFields A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT field_id, form_id, guest_only FROM tf_form_fields WHERE field_id = :p0 AND form_id = :p1';
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
            /** @var ChildFormFields $obj */
            $obj = new ChildFormFields();
            $obj->hydrate($row);
            FormFieldsTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildFormFields|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(FormFieldsTableMap::COL_FIELD_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(FormFieldsTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(FormFieldsTableMap::COL_FIELD_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(FormFieldsTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the field_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId(1234); // WHERE field_id = 1234
     * $query->filterByFieldId(array(12, 34)); // WHERE field_id IN (12, 34)
     * $query->filterByFieldId(array('min' => 12)); // WHERE field_id > 12
     * </code>
     *
     * @param     mixed $fieldId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FormFieldsTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FormFieldsTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldsTableMap::COL_FIELD_ID, $fieldId, $comparison);
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
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(FormFieldsTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(FormFieldsTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldsTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the guest_only column
     *
     * Example usage:
     * <code>
     * $query->filterByGuestOnly('fooValue');   // WHERE guest_only = 'fooValue'
     * $query->filterByGuestOnly('%fooValue%', Criteria::LIKE); // WHERE guest_only LIKE '%fooValue%'
     * </code>
     *
     * @param     string $guestOnly The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function filterByGuestOnly($guestOnly = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($guestOnly)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldsTableMap::COL_GUEST_ONLY, $guestOnly, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormFields $formFields Object to remove from the list of results
     *
     * @return $this|ChildFormFieldsQuery The current query, for fluid interface
     */
    public function prune($formFields = null)
    {
        if ($formFields) {
            $this->addCond('pruneCond0', $this->getAliasedColName(FormFieldsTableMap::COL_FIELD_ID), $formFields->getFieldId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(FormFieldsTableMap::COL_FORM_ID), $formFields->getFormId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_fields table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormFieldsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormFieldsTableMap::clearInstancePool();
            FormFieldsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormFieldsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormFieldsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormFieldsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormFieldsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormFieldsQuery
