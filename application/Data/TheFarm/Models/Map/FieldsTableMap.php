<?php

namespace TheFarm\Models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use TheFarm\Models\Fields;
use TheFarm\Models\FieldsQuery;


/**
 * This class defines the structure of the 'tf_fields' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FieldsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.FieldsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_fields';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Fields';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Fields';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the field_id field
     */
    const COL_FIELD_ID = 'tf_fields.field_id';

    /**
     * the column name for the field_name field
     */
    const COL_FIELD_NAME = 'tf_fields.field_name';

    /**
     * the column name for the field_label field
     */
    const COL_FIELD_LABEL = 'tf_fields.field_label';

    /**
     * the column name for the field_type field
     */
    const COL_FIELD_TYPE = 'tf_fields.field_type';

    /**
     * the column name for the settings field
     */
    const COL_SETTINGS = 'tf_fields.settings';

    /**
     * the column name for the required field
     */
    const COL_REQUIRED = 'tf_fields.required';

    /**
     * the column name for the entry_date field
     */
    const COL_ENTRY_DATE = 'tf_fields.entry_date';

    /**
     * the column name for the edit_date field
     */
    const COL_EDIT_DATE = 'tf_fields.edit_date';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('FieldId', 'FieldName', 'FieldLabel', 'FieldType', 'Settings', 'Required', 'EntryDate', 'EditDate', ),
        self::TYPE_CAMELNAME     => array('fieldId', 'fieldName', 'fieldLabel', 'fieldType', 'settings', 'required', 'entryDate', 'editDate', ),
        self::TYPE_COLNAME       => array(FieldsTableMap::COL_FIELD_ID, FieldsTableMap::COL_FIELD_NAME, FieldsTableMap::COL_FIELD_LABEL, FieldsTableMap::COL_FIELD_TYPE, FieldsTableMap::COL_SETTINGS, FieldsTableMap::COL_REQUIRED, FieldsTableMap::COL_ENTRY_DATE, FieldsTableMap::COL_EDIT_DATE, ),
        self::TYPE_FIELDNAME     => array('field_id', 'field_name', 'field_label', 'field_type', 'settings', 'required', 'entry_date', 'edit_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('FieldId' => 0, 'FieldName' => 1, 'FieldLabel' => 2, 'FieldType' => 3, 'Settings' => 4, 'Required' => 5, 'EntryDate' => 6, 'EditDate' => 7, ),
        self::TYPE_CAMELNAME     => array('fieldId' => 0, 'fieldName' => 1, 'fieldLabel' => 2, 'fieldType' => 3, 'settings' => 4, 'required' => 5, 'entryDate' => 6, 'editDate' => 7, ),
        self::TYPE_COLNAME       => array(FieldsTableMap::COL_FIELD_ID => 0, FieldsTableMap::COL_FIELD_NAME => 1, FieldsTableMap::COL_FIELD_LABEL => 2, FieldsTableMap::COL_FIELD_TYPE => 3, FieldsTableMap::COL_SETTINGS => 4, FieldsTableMap::COL_REQUIRED => 5, FieldsTableMap::COL_ENTRY_DATE => 6, FieldsTableMap::COL_EDIT_DATE => 7, ),
        self::TYPE_FIELDNAME     => array('field_id' => 0, 'field_name' => 1, 'field_label' => 2, 'field_type' => 3, 'settings' => 4, 'required' => 5, 'entry_date' => 6, 'edit_date' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tf_fields');
        $this->setPhpName('Fields');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Fields');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('field_id', 'FieldId', 'INTEGER', true, null, null);
        $this->addColumn('field_name', 'FieldName', 'VARCHAR', true, 100, null);
        $this->addColumn('field_label', 'FieldLabel', 'VARCHAR', true, 255, null);
        $this->addColumn('field_type', 'FieldType', 'VARCHAR', true, 32, null);
        $this->addColumn('settings', 'Settings', 'LONGVARCHAR', true, null, null);
        $this->addColumn('required', 'Required', 'CHAR', true, null, null);
        $this->addColumn('entry_date', 'EntryDate', 'INTEGER', true, 10, null);
        $this->addColumn('edit_date', 'EditDate', 'INTEGER', true, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('FormEntries', '\\TheFarm\\Models\\FormEntries', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':field_id',
    1 => ':field_id',
  ),
), null, null, 'FormEntriess', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('FieldId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FieldsTableMap::CLASS_DEFAULT : FieldsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Fields object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FieldsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FieldsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FieldsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FieldsTableMap::OM_CLASS;
            /** @var Fields $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FieldsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FieldsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FieldsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Fields $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FieldsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FieldsTableMap::COL_FIELD_ID);
            $criteria->addSelectColumn(FieldsTableMap::COL_FIELD_NAME);
            $criteria->addSelectColumn(FieldsTableMap::COL_FIELD_LABEL);
            $criteria->addSelectColumn(FieldsTableMap::COL_FIELD_TYPE);
            $criteria->addSelectColumn(FieldsTableMap::COL_SETTINGS);
            $criteria->addSelectColumn(FieldsTableMap::COL_REQUIRED);
            $criteria->addSelectColumn(FieldsTableMap::COL_ENTRY_DATE);
            $criteria->addSelectColumn(FieldsTableMap::COL_EDIT_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.field_id');
            $criteria->addSelectColumn($alias . '.field_name');
            $criteria->addSelectColumn($alias . '.field_label');
            $criteria->addSelectColumn($alias . '.field_type');
            $criteria->addSelectColumn($alias . '.settings');
            $criteria->addSelectColumn($alias . '.required');
            $criteria->addSelectColumn($alias . '.entry_date');
            $criteria->addSelectColumn($alias . '.edit_date');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FieldsTableMap::DATABASE_NAME)->getTable(FieldsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FieldsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FieldsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FieldsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Fields or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Fields object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FieldsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Fields) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FieldsTableMap::DATABASE_NAME);
            $criteria->add(FieldsTableMap::COL_FIELD_ID, (array) $values, Criteria::IN);
        }

        $query = FieldsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FieldsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FieldsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_fields table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FieldsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Fields or Criteria object.
     *
     * @param mixed               $criteria Criteria or Fields object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FieldsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Fields object
        }

        if ($criteria->containsKey(FieldsTableMap::COL_FIELD_ID) && $criteria->keyContainsValue(FieldsTableMap::COL_FIELD_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FieldsTableMap::COL_FIELD_ID.')');
        }


        // Set the correct dbName
        $query = FieldsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FieldsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FieldsTableMap::buildTableMap();
