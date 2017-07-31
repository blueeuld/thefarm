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
use TheFarm\Models\Users;
use TheFarm\Models\UsersQuery;


/**
 * This class defines the structure of the 'tf_users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.Users';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the contact_id field
     */
    const COL_CONTACT_ID = 'tf_users.contact_id';

    /**
     * the column name for the username field
     */
    const COL_USERNAME = 'tf_users.username';

    /**
     * the column name for the group_id field
     */
    const COL_GROUP_ID = 'tf_users.group_id';

    /**
     * the column name for the last_login field
     */
    const COL_LAST_LOGIN = 'tf_users.last_login';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'tf_users.password';

    /**
     * the column name for the work_plan field
     */
    const COL_WORK_PLAN = 'tf_users.work_plan';

    /**
     * the column name for the work_plan_code field
     */
    const COL_WORK_PLAN_CODE = 'tf_users.work_plan_code';

    /**
     * the column name for the location_id field
     */
    const COL_LOCATION_ID = 'tf_users.location_id';

    /**
     * the column name for the facebook_id field
     */
    const COL_FACEBOOK_ID = 'tf_users.facebook_id';

    /**
     * the column name for the order field
     */
    const COL_ORDER = 'tf_users.order';

    /**
     * the column name for the calendar_view_positions field
     */
    const COL_CALENDAR_VIEW_POSITIONS = 'tf_users.calendar_view_positions';

    /**
     * the column name for the calendar_view_status field
     */
    const COL_CALENDAR_VIEW_STATUS = 'tf_users.calendar_view_status';

    /**
     * the column name for the calendar_show_my_schedule_only field
     */
    const COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY = 'tf_users.calendar_show_my_schedule_only';

    /**
     * the column name for the calendar_view_locations field
     */
    const COL_CALENDAR_VIEW_LOCATIONS = 'tf_users.calendar_view_locations';

    /**
     * the column name for the preferences field
     */
    const COL_PREFERENCES = 'tf_users.preferences';

    /**
     * the column name for the calendar_show_no_schedule field
     */
    const COL_CALENDAR_SHOW_NO_SCHEDULE = 'tf_users.calendar_show_no_schedule';

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
        self::TYPE_PHPNAME       => array('ContactId', 'Username', 'GroupId', 'LastLogin', 'Password', 'WorkPlan', 'WorkPlanCode', 'LocationId', 'FacebookId', 'Order', 'CalendarViewPositions', 'CalendarViewStatus', 'CalendarShowMyScheduleOnly', 'CalendarViewLocations', 'Preferences', 'CalendarShowNoSchedule', ),
        self::TYPE_CAMELNAME     => array('contactId', 'username', 'groupId', 'lastLogin', 'password', 'workPlan', 'workPlanCode', 'locationId', 'facebookId', 'order', 'calendarViewPositions', 'calendarViewStatus', 'calendarShowMyScheduleOnly', 'calendarViewLocations', 'preferences', 'calendarShowNoSchedule', ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_CONTACT_ID, UsersTableMap::COL_USERNAME, UsersTableMap::COL_GROUP_ID, UsersTableMap::COL_LAST_LOGIN, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_WORK_PLAN, UsersTableMap::COL_WORK_PLAN_CODE, UsersTableMap::COL_LOCATION_ID, UsersTableMap::COL_FACEBOOK_ID, UsersTableMap::COL_ORDER, UsersTableMap::COL_CALENDAR_VIEW_POSITIONS, UsersTableMap::COL_CALENDAR_VIEW_STATUS, UsersTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY, UsersTableMap::COL_CALENDAR_VIEW_LOCATIONS, UsersTableMap::COL_PREFERENCES, UsersTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE, ),
        self::TYPE_FIELDNAME     => array('contact_id', 'username', 'group_id', 'last_login', 'password', 'work_plan', 'work_plan_code', 'location_id', 'facebook_id', 'order', 'calendar_view_positions', 'calendar_view_status', 'calendar_show_my_schedule_only', 'calendar_view_locations', 'preferences', 'calendar_show_no_schedule', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ContactId' => 0, 'Username' => 1, 'GroupId' => 2, 'LastLogin' => 3, 'Password' => 4, 'WorkPlan' => 5, 'WorkPlanCode' => 6, 'LocationId' => 7, 'FacebookId' => 8, 'Order' => 9, 'CalendarViewPositions' => 10, 'CalendarViewStatus' => 11, 'CalendarShowMyScheduleOnly' => 12, 'CalendarViewLocations' => 13, 'Preferences' => 14, 'CalendarShowNoSchedule' => 15, ),
        self::TYPE_CAMELNAME     => array('contactId' => 0, 'username' => 1, 'groupId' => 2, 'lastLogin' => 3, 'password' => 4, 'workPlan' => 5, 'workPlanCode' => 6, 'locationId' => 7, 'facebookId' => 8, 'order' => 9, 'calendarViewPositions' => 10, 'calendarViewStatus' => 11, 'calendarShowMyScheduleOnly' => 12, 'calendarViewLocations' => 13, 'preferences' => 14, 'calendarShowNoSchedule' => 15, ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_CONTACT_ID => 0, UsersTableMap::COL_USERNAME => 1, UsersTableMap::COL_GROUP_ID => 2, UsersTableMap::COL_LAST_LOGIN => 3, UsersTableMap::COL_PASSWORD => 4, UsersTableMap::COL_WORK_PLAN => 5, UsersTableMap::COL_WORK_PLAN_CODE => 6, UsersTableMap::COL_LOCATION_ID => 7, UsersTableMap::COL_FACEBOOK_ID => 8, UsersTableMap::COL_ORDER => 9, UsersTableMap::COL_CALENDAR_VIEW_POSITIONS => 10, UsersTableMap::COL_CALENDAR_VIEW_STATUS => 11, UsersTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY => 12, UsersTableMap::COL_CALENDAR_VIEW_LOCATIONS => 13, UsersTableMap::COL_PREFERENCES => 14, UsersTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE => 15, ),
        self::TYPE_FIELDNAME     => array('contact_id' => 0, 'username' => 1, 'group_id' => 2, 'last_login' => 3, 'password' => 4, 'work_plan' => 5, 'work_plan_code' => 6, 'location_id' => 7, 'facebook_id' => 8, 'order' => 9, 'calendar_view_positions' => 10, 'calendar_view_status' => 11, 'calendar_show_my_schedule_only' => 12, 'calendar_view_locations' => 13, 'preferences' => 14, 'calendar_show_no_schedule' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('tf_users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\Users');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('contact_id', 'ContactId', 'INTEGER' , 'tf_contacts', 'contact_id', true, null, 0);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 100, null);
        $this->addForeignKey('group_id', 'GroupId', 'INTEGER', 'tf_groups', 'group_id', false, null, null);
        $this->addColumn('last_login', 'LastLogin', 'INTEGER', true, 10, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 100, null);
        $this->addColumn('work_plan', 'WorkPlan', 'LONGVARCHAR', true, null, null);
        $this->addColumn('work_plan_code', 'WorkPlanCode', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('location_id', 'LocationId', 'INTEGER', 'tf_locations', 'location_id', false, null, null);
        $this->addColumn('facebook_id', 'FacebookId', 'VARCHAR', true, 50, null);
        $this->addColumn('order', 'Order', 'INTEGER', true, 5, 0);
        $this->addColumn('calendar_view_positions', 'CalendarViewPositions', 'VARCHAR', false, 100, '');
        $this->addColumn('calendar_view_status', 'CalendarViewStatus', 'VARCHAR', false, 255, null);
        $this->addColumn('calendar_show_my_schedule_only', 'CalendarShowMyScheduleOnly', 'VARCHAR', false, 1, 'y');
        $this->addColumn('calendar_view_locations', 'CalendarViewLocations', 'VARCHAR', false, 100, '');
        $this->addColumn('preferences', 'Preferences', 'LONGVARCHAR', false, null, null);
        $this->addColumn('calendar_show_no_schedule', 'CalendarShowNoSchedule', 'VARCHAR', false, 1, 'y');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Contacts', '\\TheFarm\\Models\\Contacts', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':contact_id',
    1 => ':contact_id',
  ),
), null, null, null, false);
        $this->addRelation('Groups', '\\TheFarm\\Models\\Groups', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':group_id',
    1 => ':group_id',
  ),
), null, null, null, false);
        $this->addRelation('Locations', '\\TheFarm\\Models\\Locations', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':location_id',
    1 => ':location_id',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ContactId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array           (Users object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_CONTACT_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_USERNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_GROUP_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_LAST_LOGIN);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_WORK_PLAN);
            $criteria->addSelectColumn(UsersTableMap::COL_WORK_PLAN_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_LOCATION_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_FACEBOOK_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_ORDER);
            $criteria->addSelectColumn(UsersTableMap::COL_CALENDAR_VIEW_POSITIONS);
            $criteria->addSelectColumn(UsersTableMap::COL_CALENDAR_VIEW_STATUS);
            $criteria->addSelectColumn(UsersTableMap::COL_CALENDAR_SHOW_MY_SCHEDULE_ONLY);
            $criteria->addSelectColumn(UsersTableMap::COL_CALENDAR_VIEW_LOCATIONS);
            $criteria->addSelectColumn(UsersTableMap::COL_PREFERENCES);
            $criteria->addSelectColumn(UsersTableMap::COL_CALENDAR_SHOW_NO_SCHEDULE);
        } else {
            $criteria->addSelectColumn($alias . '.contact_id');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.group_id');
            $criteria->addSelectColumn($alias . '.last_login');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.work_plan');
            $criteria->addSelectColumn($alias . '.work_plan_code');
            $criteria->addSelectColumn($alias . '.location_id');
            $criteria->addSelectColumn($alias . '.facebook_id');
            $criteria->addSelectColumn($alias . '.order');
            $criteria->addSelectColumn($alias . '.calendar_view_positions');
            $criteria->addSelectColumn($alias . '.calendar_view_status');
            $criteria->addSelectColumn($alias . '.calendar_show_my_schedule_only');
            $criteria->addSelectColumn($alias . '.calendar_view_locations');
            $criteria->addSelectColumn($alias . '.preferences');
            $criteria->addSelectColumn($alias . '.calendar_show_no_schedule');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_CONTACT_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed               $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsersTableMap::buildTableMap();
