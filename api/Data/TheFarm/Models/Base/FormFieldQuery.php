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
use TheFarm\Models\FormField as ChildFormField;
use TheFarm\Models\FormFieldQuery as ChildFormFieldQuery;
use TheFarm\Models\Map\FormFieldTableMap;

/**
 * Base class that represents a query for the 'tf_form_field' table.
 *
 *
 *
 * @method     ChildFormFieldQuery orderByFieldId($order = Criteria::ASC) Order by the field_id column
 * @method     ChildFormFieldQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 * @method     ChildFormFieldQuery orderByFormFieldOrder($order = Criteria::ASC) Order by the form_field_order column
 *
 * @method     ChildFormFieldQuery groupByFieldId() Group by the field_id column
 * @method     ChildFormFieldQuery groupByFormId() Group by the form_id column
 * @method     ChildFormFieldQuery groupByFormFieldOrder() Group by the form_field_order column
 *
 * @method     ChildFormFieldQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormFieldQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormFieldQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormFieldQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormFieldQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormFieldQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormFieldQuery leftJoinField($relationAlias = null) Adds a LEFT JOIN clause to the query using the Field relation
 * @method     ChildFormFieldQuery rightJoinField($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Field relation
 * @method     ChildFormFieldQuery innerJoinField($relationAlias = null) Adds a INNER JOIN clause to the query using the Field relation
 *
 * @method     ChildFormFieldQuery joinWithField($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Field relation
 *
 * @method     ChildFormFieldQuery leftJoinWithField() Adds a LEFT JOIN clause and with to the query using the Field relation
 * @method     ChildFormFieldQuery rightJoinWithField() Adds a RIGHT JOIN clause and with to the query using the Field relation
 * @method     ChildFormFieldQuery innerJoinWithField() Adds a INNER JOIN clause and with to the query using the Field relation
 *
 * @method     ChildFormFieldQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildFormFieldQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildFormFieldQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildFormFieldQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildFormFieldQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildFormFieldQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildFormFieldQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     \TheFarm\Models\FieldQuery|\TheFarm\Models\FormQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFormField findOne(ConnectionInterface $con = null) Return the first ChildFormField matching the query
 * @method     ChildFormField findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormField matching the query, or a new ChildFormField object populated from the query conditions when no match is found
 *
 * @method     ChildFormField findOneByFieldId(int $field_id) Return the first ChildFormField filtered by the field_id column
 * @method     ChildFormField findOneByFormId(int $form_id) Return the first ChildFormField filtered by the form_id column
 * @method     ChildFormField findOneByFormFieldOrder(int $form_field_order) Return the first ChildFormField filtered by the form_field_order column *

 * @method     ChildFormField requirePk($key, ConnectionInterface $con = null) Return the ChildFormField by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormField requireOne(ConnectionInterface $con = null) Return the first ChildFormField matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormField requireOneByFieldId(int $field_id) Return the first ChildFormField filtered by the field_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormField requireOneByFormId(int $form_id) Return the first ChildFormField filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormField requireOneByFormFieldOrder(int $form_field_order) Return the first ChildFormField filtered by the form_field_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormField[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormField objects based on current ModelCriteria
 * @method     ChildFormField[]|ObjectCollection findByFieldId(int $field_id) Return ChildFormField objects filtered by the field_id column
 * @method     ChildFormField[]|ObjectCollection findByFormId(int $form_id) Return ChildFormField objects filtered by the form_id column
 * @method     ChildFormField[]|ObjectCollection findByFormFieldOrder(int $form_field_order) Return ChildFormField objects filtered by the form_field_order column
 * @method     ChildFormField[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormFieldQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormFieldQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormField', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormFieldQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormFieldQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormFieldQuery) {
            return $criteria;
        }
        $query = new ChildFormFieldQuery();
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
     * @return ChildFormField|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormFieldTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormFieldTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildFormField A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT field_id, form_id, form_field_order FROM tf_form_field WHERE field_id = :p0 AND form_id = :p1';
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
            /** @var ChildFormField $obj */
            $obj = new ChildFormField();
            $obj->hydrate($row);
            FormFieldTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildFormField|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(FormFieldTableMap::COL_FIELD_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(FormFieldTableMap::COL_FORM_ID, $key[1], Criteria::EQUAL);
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
     * @see       filterByField()
     *
     * @param     mixed $fieldId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByFieldId($fieldId = null, $comparison = null)
    {
        if (is_array($fieldId)) {
            $useMinMax = false;
            if (isset($fieldId['min'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $fieldId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fieldId['max'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $fieldId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $fieldId, $comparison);
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
     * @see       filterByForm()
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query on the form_field_order column
     *
     * Example usage:
     * <code>
     * $query->filterByFormFieldOrder(1234); // WHERE form_field_order = 1234
     * $query->filterByFormFieldOrder(array(12, 34)); // WHERE form_field_order IN (12, 34)
     * $query->filterByFormFieldOrder(array('min' => 12)); // WHERE form_field_order > 12
     * </code>
     *
     * @param     mixed $formFieldOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByFormFieldOrder($formFieldOrder = null, $comparison = null)
    {
        if (is_array($formFieldOrder)) {
            $useMinMax = false;
            if (isset($formFieldOrder['min'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FORM_FIELD_ORDER, $formFieldOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formFieldOrder['max'])) {
                $this->addUsingAlias(FormFieldTableMap::COL_FORM_FIELD_ORDER, $formFieldOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormFieldTableMap::COL_FORM_FIELD_ORDER, $formFieldOrder, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Field object
     *
     * @param \TheFarm\Models\Field|ObjectCollection $field The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByField($field, $comparison = null)
    {
        if ($field instanceof \TheFarm\Models\Field) {
            return $this
                ->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $field->getFieldId(), $comparison);
        } elseif ($field instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormFieldTableMap::COL_FIELD_ID, $field->toKeyValue('PrimaryKey', 'FieldId'), $comparison);
        } else {
            throw new PropelException('filterByField() only accepts arguments of type \TheFarm\Models\Field or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Field relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function joinField($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Field');

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
            $this->addJoinObject($join, 'Field');
        }

        return $this;
    }

    /**
     * Use the Field relation Field object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FieldQuery A secondary query class using the current class as primary query
     */
    public function useFieldQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinField($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Field', '\TheFarm\Models\FieldQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Form object
     *
     * @param \TheFarm\Models\Form|ObjectCollection $form The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormFieldQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \TheFarm\Models\Form) {
            return $this
                ->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $form->getFormId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormFieldTableMap::COL_FORM_ID, $form->toKeyValue('PrimaryKey', 'FormId'), $comparison);
        } else {
            throw new PropelException('filterByForm() only accepts arguments of type \TheFarm\Models\Form or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Form relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function joinForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Form');

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
            $this->addJoinObject($join, 'Form');
        }

        return $this;
    }

    /**
     * Use the Form relation Form object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FormQuery A secondary query class using the current class as primary query
     */
    public function useFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Form', '\TheFarm\Models\FormQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormField $formField Object to remove from the list of results
     *
     * @return $this|ChildFormFieldQuery The current query, for fluid interface
     */
    public function prune($formField = null)
    {
        if ($formField) {
            $this->addCond('pruneCond0', $this->getAliasedColName(FormFieldTableMap::COL_FIELD_ID), $formField->getFieldId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(FormFieldTableMap::COL_FORM_ID), $formField->getFormId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_field table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormFieldTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormFieldTableMap::clearInstancePool();
            FormFieldTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormFieldTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormFieldTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormFieldTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormFieldTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormFieldQuery
