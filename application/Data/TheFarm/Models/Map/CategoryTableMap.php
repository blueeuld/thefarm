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
use TheFarm\Models\Category;
use TheFarm\Models\CategoryQuery;


/**
 * This class defines the structure of the 'tf_categories' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CategoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.CategoryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_categories';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Category';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Category';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the cat_id field
     */
    const COL_CAT_ID = 'tf_categories.cat_id';

    /**
     * the column name for the cat_name field
     */
    const COL_CAT_NAME = 'tf_categories.cat_name';

    /**
     * the column name for the cat_image field
     */
    const COL_CAT_IMAGE = 'tf_categories.cat_image';

    /**
     * the column name for the cat_body field
     */
    const COL_CAT_BODY = 'tf_categories.cat_body';

    /**
     * the column name for the parent_id field
     */
    const COL_PARENT_ID = 'tf_categories.parent_id';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_categories.location_id';

    /**
     * the column name for the cat_bg_color field
     */
    const COL_CAT_BG_COLOR = 'tf_categories.cat_bg_color';

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
        self::TYPE_PHPNAME       => array('CatId', 'CatName', 'CatImage', 'CatBody', 'ParentId', 'LocationId', 'CatBgColor', ),
        self::TYPE_CAMELNAME     => array('catId', 'catName', 'catImage', 'catBody', 'parentId', 'locationId', 'catBgColor', ),
        self::TYPE_COLNAME       => array(CategoryTableMap::COL_CAT_ID, CategoryTableMap::COL_CAT_NAME, CategoryTableMap::COL_CAT_IMAGE, CategoryTableMap::COL_CAT_BODY, CategoryTableMap::COL_PARENT_ID, CategoryTableMap::COL_LOCATION_ID, CategoryTableMap::COL_CAT_BG_COLOR, ),
        self::TYPE_FIELDNAME     => array('cat_id', 'cat_name', 'cat_image', 'cat_body', 'parent_id', 'location_id', 'cat_bg_color', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CatId' => 0, 'CatName' => 1, 'CatImage' => 2, 'CatBody' => 3, 'ParentId' => 4, 'LocationId' => 5, 'CatBgColor' => 6, ),
        self::TYPE_CAMELNAME     => array('catId' => 0, 'catName' => 1, 'catImage' => 2, 'catBody' => 3, 'parentId' => 4, 'locationId' => 5, 'catBgColor' => 6, ),
        self::TYPE_COLNAME       => array(CategoryTableMap::COL_CAT_ID => 0, CategoryTableMap::COL_CAT_NAME => 1, CategoryTableMap::COL_CAT_IMAGE => 2, CategoryTableMap::COL_CAT_BODY => 3, CategoryTableMap::COL_PARENT_ID => 4, CategoryTableMap::COL_LOCATION_ID => 5, CategoryTableMap::COL_CAT_BG_COLOR => 6, ),
        self::TYPE_FIELDNAME     => array('cat_id' => 0, 'cat_name' => 1, 'cat_image' => 2, 'cat_body' => 3, 'parent_id' => 4, 'location_id' => 5, 'cat_bg_color' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('tf_categories');
        $this->setPhpName('Category');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Category');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('cat_id', 'CatId', 'INTEGER', true, null, null);
        $this->addColumn('cat_name', 'CatName', 'VARCHAR', true, 255, null);
        $this->addForeignKey('cat_image', 'CatImage', 'INTEGER', 'tf_files', 'file_id', false, null, null);
        $this->addColumn('cat_body', 'CatBody', 'LONGVARCHAR', true, null, null);
        $this->addForeignKey('parent_id', 'ParentId', 'INTEGER', 'tf_categories', 'cat_id', true, null, null);
        $this->addForeignKey('location_id', 'LocationId', 'INTEGER', 'tf_locations', 'location_id', true, null, null);
        $this->addColumn('cat_bg_color', 'CatBgColor', 'VARCHAR', false, 1, '');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Files', '\\TheFarm\\Models\\Files', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cat_image',
    1 => ':file_id',
  ),
), null, null, null, false);
        $this->addRelation('Location', '\\TheFarm\\Models\\Location', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':location_id',
    1 => ':location_id',
  ),
), null, null, null, false);
        $this->addRelation('CategoryRelatedByParentId', '\\TheFarm\\Models\\Category', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':cat_id',
  ),
), null, null, null, false);
        $this->addRelation('CategoryRelatedByCatId', '\\TheFarm\\Models\\Category', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':cat_id',
  ),
), null, null, 'CategoriesRelatedByCatId', false);
        $this->addRelation('ItemCategory', '\\TheFarm\\Models\\ItemCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':category_id',
    1 => ':cat_id',
  ),
), null, null, 'ItemCategories', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CatId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CategoryTableMap::CLASS_DEFAULT : CategoryTableMap::OM_CLASS;
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
     * @return array           (Category object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CategoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CategoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CategoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CategoryTableMap::OM_CLASS;
            /** @var Category $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CategoryTableMap::addInstanceToPool($obj, $key);
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
            $key = CategoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CategoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Category $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CategoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CategoryTableMap::COL_CAT_ID);
            $criteria->addSelectColumn(CategoryTableMap::COL_CAT_NAME);
            $criteria->addSelectColumn(CategoryTableMap::COL_CAT_IMAGE);
            $criteria->addSelectColumn(CategoryTableMap::COL_CAT_BODY);
            $criteria->addSelectColumn(CategoryTableMap::COL_PARENT_ID);
            $criteria->addSelectColumn(CategoryTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(CategoryTableMap::COL_CAT_BG_COLOR);
        } else {
            $criteria->addSelectColumn($alias . '.cat_id');
            $criteria->addSelectColumn($alias . '.cat_name');
            $criteria->addSelectColumn($alias . '.cat_image');
            $criteria->addSelectColumn($alias . '.cat_body');
            $criteria->addSelectColumn($alias . '.parent_id');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.cat_bg_color');
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
        return Propel::getServiceContainer()->getDatabaseMap(CategoryTableMap::DATABASE_NAME)->getTable(CategoryTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CategoryTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CategoryTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CategoryTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Category or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Category object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Category) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CategoryTableMap::DATABASE_NAME);
            $criteria->add(CategoryTableMap::COL_CAT_ID, (array) $values, Criteria::IN);
        }

        $query = CategoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CategoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CategoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CategoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Category or Criteria object.
     *
     * @param mixed               $criteria Criteria or Category object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Category object
        }

        if ($criteria->containsKey(CategoryTableMap::COL_CAT_ID) && $criteria->keyContainsValue(CategoryTableMap::COL_CAT_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategoryTableMap::COL_CAT_ID.')');
        }


        // Set the correct dbName
        $query = CategoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CategoryTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CategoryTableMap::buildTableMap();
