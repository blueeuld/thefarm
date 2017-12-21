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
use TheFarm\Models\FormEntries1;
use TheFarm\Models\FormEntries1Query;


/**
 * This class defines the structure of the 'tf_form_entries_1' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FormEntries1TableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'TheFarm.Models.Map.FormEntries1TableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tf_form_entries_1';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\TheFarm\\Models\\FormEntries1';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'TheFarm.Models.FormEntries1';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 44;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 44;

    /**
     * the column name for the entry_id field
     */
    const COL_ENTRY_ID = 'tf_form_entries_1.entry_id';

    /**
     * the column name for the booking_id field
     */
    const COL_BOOKING_ID = 'tf_form_entries_1.booking_id';

    /**
     * the column name for the field_id_29 field
     */
    const COL_FIELD_ID_29 = 'tf_form_entries_1.field_id_29';

    /**
     * the column name for the field_id_52 field
     */
    const COL_FIELD_ID_52 = 'tf_form_entries_1.field_id_52';

    /**
     * the column name for the field_id_54 field
     */
    const COL_FIELD_ID_54 = 'tf_form_entries_1.field_id_54';

    /**
     * the column name for the field_id_53 field
     */
    const COL_FIELD_ID_53 = 'tf_form_entries_1.field_id_53';

    /**
     * the column name for the field_id_55 field
     */
    const COL_FIELD_ID_55 = 'tf_form_entries_1.field_id_55';

    /**
     * the column name for the field_id_58 field
     */
    const COL_FIELD_ID_58 = 'tf_form_entries_1.field_id_58';

    /**
     * the column name for the field_id_57 field
     */
    const COL_FIELD_ID_57 = 'tf_form_entries_1.field_id_57';

    /**
     * the column name for the field_id_56 field
     */
    const COL_FIELD_ID_56 = 'tf_form_entries_1.field_id_56';

    /**
     * the column name for the field_id_51 field
     */
    const COL_FIELD_ID_51 = 'tf_form_entries_1.field_id_51';

    /**
     * the column name for the field_id_50 field
     */
    const COL_FIELD_ID_50 = 'tf_form_entries_1.field_id_50';

    /**
     * the column name for the field_id_49 field
     */
    const COL_FIELD_ID_49 = 'tf_form_entries_1.field_id_49';

    /**
     * the column name for the field_id_48 field
     */
    const COL_FIELD_ID_48 = 'tf_form_entries_1.field_id_48';

    /**
     * the column name for the field_id_47 field
     */
    const COL_FIELD_ID_47 = 'tf_form_entries_1.field_id_47';

    /**
     * the column name for the field_id_46 field
     */
    const COL_FIELD_ID_46 = 'tf_form_entries_1.field_id_46';

    /**
     * the column name for the field_id_45 field
     */
    const COL_FIELD_ID_45 = 'tf_form_entries_1.field_id_45';

    /**
     * the column name for the field_id_44 field
     */
    const COL_FIELD_ID_44 = 'tf_form_entries_1.field_id_44';

    /**
     * the column name for the field_id_43 field
     */
    const COL_FIELD_ID_43 = 'tf_form_entries_1.field_id_43';

    /**
     * the column name for the field_id_42 field
     */
    const COL_FIELD_ID_42 = 'tf_form_entries_1.field_id_42';

    /**
     * the column name for the field_id_41 field
     */
    const COL_FIELD_ID_41 = 'tf_form_entries_1.field_id_41';

    /**
     * the column name for the field_id_40 field
     */
    const COL_FIELD_ID_40 = 'tf_form_entries_1.field_id_40';

    /**
     * the column name for the field_id_37 field
     */
    const COL_FIELD_ID_37 = 'tf_form_entries_1.field_id_37';

    /**
     * the column name for the field_id_35 field
     */
    const COL_FIELD_ID_35 = 'tf_form_entries_1.field_id_35';

    /**
     * the column name for the field_id_33 field
     */
    const COL_FIELD_ID_33 = 'tf_form_entries_1.field_id_33';

    /**
     * the column name for the field_id_32 field
     */
    const COL_FIELD_ID_32 = 'tf_form_entries_1.field_id_32';

    /**
     * the column name for the field_id_31 field
     */
    const COL_FIELD_ID_31 = 'tf_form_entries_1.field_id_31';

    /**
     * the column name for the field_id_30 field
     */
    const COL_FIELD_ID_30 = 'tf_form_entries_1.field_id_30';

    /**
     * the column name for the field_id_28 field
     */
    const COL_FIELD_ID_28 = 'tf_form_entries_1.field_id_28';

    /**
     * the column name for the field_id_26 field
     */
    const COL_FIELD_ID_26 = 'tf_form_entries_1.field_id_26';

    /**
     * the column name for the field_id_25 field
     */
    const COL_FIELD_ID_25 = 'tf_form_entries_1.field_id_25';

    /**
     * the column name for the field_id_19 field
     */
    const COL_FIELD_ID_19 = 'tf_form_entries_1.field_id_19';

    /**
     * the column name for the field_id_18 field
     */
    const COL_FIELD_ID_18 = 'tf_form_entries_1.field_id_18';

    /**
     * the column name for the field_id_17 field
     */
    const COL_FIELD_ID_17 = 'tf_form_entries_1.field_id_17';

    /**
     * the column name for the field_id_6 field
     */
    const COL_FIELD_ID_6 = 'tf_form_entries_1.field_id_6';

    /**
     * the column name for the field_id_5 field
     */
    const COL_FIELD_ID_5 = 'tf_form_entries_1.field_id_5';

    /**
     * the column name for the field_id_4 field
     */
    const COL_FIELD_ID_4 = 'tf_form_entries_1.field_id_4';

    /**
     * the column name for the field_id_2 field
     */
    const COL_FIELD_ID_2 = 'tf_form_entries_1.field_id_2';

    /**
     * the column name for the field_id_1 field
     */
    const COL_FIELD_ID_1 = 'tf_form_entries_1.field_id_1';

    /**
     * the column name for the author_id field
     */
    const COL_AUTHOR_ID = 'tf_form_entries_1.author_id';

    /**
     * the column name for the entry_date field
     */
    const COL_ENTRY_DATE = 'tf_form_entries_1.entry_date';

    /**
     * the column name for the edit_date field
     */
    const COL_EDIT_DATE = 'tf_form_entries_1.edit_date';

    /**
     * the column name for the completed_by field
     */
    const COL_COMPLETED_BY = 'tf_form_entries_1.completed_by';

    /**
     * the column name for the completed_date field
     */
    const COL_COMPLETED_DATE = 'tf_form_entries_1.completed_date';

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
        self::TYPE_PHPNAME       => array('EntryId', 'BookingId', 'FieldId29', 'FieldId52', 'FieldId54', 'FieldId53', 'FieldId55', 'FieldId58', 'FieldId57', 'FieldId56', 'FieldId51', 'FieldId50', 'FieldId49', 'FieldId48', 'FieldId47', 'FieldId46', 'FieldId45', 'FieldId44', 'FieldId43', 'FieldId42', 'FieldId41', 'FieldId40', 'FieldId37', 'FieldId35', 'FieldId33', 'FieldId32', 'FieldId31', 'FieldId30', 'FieldId28', 'FieldId26', 'FieldId25', 'FieldId19', 'FieldId18', 'FieldId17', 'FieldId6', 'FieldId5', 'FieldId4', 'FieldId2', 'FieldId1', 'AuthorId', 'EntryDate', 'EditDate', 'CompletedBy', 'CompletedDate', ),
        self::TYPE_CAMELNAME     => array('entryId', 'bookingId', 'fieldId29', 'fieldId52', 'fieldId54', 'fieldId53', 'fieldId55', 'fieldId58', 'fieldId57', 'fieldId56', 'fieldId51', 'fieldId50', 'fieldId49', 'fieldId48', 'fieldId47', 'fieldId46', 'fieldId45', 'fieldId44', 'fieldId43', 'fieldId42', 'fieldId41', 'fieldId40', 'fieldId37', 'fieldId35', 'fieldId33', 'fieldId32', 'fieldId31', 'fieldId30', 'fieldId28', 'fieldId26', 'fieldId25', 'fieldId19', 'fieldId18', 'fieldId17', 'fieldId6', 'fieldId5', 'fieldId4', 'fieldId2', 'fieldId1', 'authorId', 'entryDate', 'editDate', 'completedBy', 'completedDate', ),
        self::TYPE_COLNAME       => array(FormEntries1TableMap::COL_ENTRY_ID, FormEntries1TableMap::COL_BOOKING_ID, FormEntries1TableMap::COL_FIELD_ID_29, FormEntries1TableMap::COL_FIELD_ID_52, FormEntries1TableMap::COL_FIELD_ID_54, FormEntries1TableMap::COL_FIELD_ID_53, FormEntries1TableMap::COL_FIELD_ID_55, FormEntries1TableMap::COL_FIELD_ID_58, FormEntries1TableMap::COL_FIELD_ID_57, FormEntries1TableMap::COL_FIELD_ID_56, FormEntries1TableMap::COL_FIELD_ID_51, FormEntries1TableMap::COL_FIELD_ID_50, FormEntries1TableMap::COL_FIELD_ID_49, FormEntries1TableMap::COL_FIELD_ID_48, FormEntries1TableMap::COL_FIELD_ID_47, FormEntries1TableMap::COL_FIELD_ID_46, FormEntries1TableMap::COL_FIELD_ID_45, FormEntries1TableMap::COL_FIELD_ID_44, FormEntries1TableMap::COL_FIELD_ID_43, FormEntries1TableMap::COL_FIELD_ID_42, FormEntries1TableMap::COL_FIELD_ID_41, FormEntries1TableMap::COL_FIELD_ID_40, FormEntries1TableMap::COL_FIELD_ID_37, FormEntries1TableMap::COL_FIELD_ID_35, FormEntries1TableMap::COL_FIELD_ID_33, FormEntries1TableMap::COL_FIELD_ID_32, FormEntries1TableMap::COL_FIELD_ID_31, FormEntries1TableMap::COL_FIELD_ID_30, FormEntries1TableMap::COL_FIELD_ID_28, FormEntries1TableMap::COL_FIELD_ID_26, FormEntries1TableMap::COL_FIELD_ID_25, FormEntries1TableMap::COL_FIELD_ID_19, FormEntries1TableMap::COL_FIELD_ID_18, FormEntries1TableMap::COL_FIELD_ID_17, FormEntries1TableMap::COL_FIELD_ID_6, FormEntries1TableMap::COL_FIELD_ID_5, FormEntries1TableMap::COL_FIELD_ID_4, FormEntries1TableMap::COL_FIELD_ID_2, FormEntries1TableMap::COL_FIELD_ID_1, FormEntries1TableMap::COL_AUTHOR_ID, FormEntries1TableMap::COL_ENTRY_DATE, FormEntries1TableMap::COL_EDIT_DATE, FormEntries1TableMap::COL_COMPLETED_BY, FormEntries1TableMap::COL_COMPLETED_DATE, ),
        self::TYPE_FIELDNAME     => array('entry_id', 'booking_id', 'field_id_29', 'field_id_52', 'field_id_54', 'field_id_53', 'field_id_55', 'field_id_58', 'field_id_57', 'field_id_56', 'field_id_51', 'field_id_50', 'field_id_49', 'field_id_48', 'field_id_47', 'field_id_46', 'field_id_45', 'field_id_44', 'field_id_43', 'field_id_42', 'field_id_41', 'field_id_40', 'field_id_37', 'field_id_35', 'field_id_33', 'field_id_32', 'field_id_31', 'field_id_30', 'field_id_28', 'field_id_26', 'field_id_25', 'field_id_19', 'field_id_18', 'field_id_17', 'field_id_6', 'field_id_5', 'field_id_4', 'field_id_2', 'field_id_1', 'author_id', 'entry_date', 'edit_date', 'completed_by', 'completed_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('EntryId' => 0, 'BookingId' => 1, 'FieldId29' => 2, 'FieldId52' => 3, 'FieldId54' => 4, 'FieldId53' => 5, 'FieldId55' => 6, 'FieldId58' => 7, 'FieldId57' => 8, 'FieldId56' => 9, 'FieldId51' => 10, 'FieldId50' => 11, 'FieldId49' => 12, 'FieldId48' => 13, 'FieldId47' => 14, 'FieldId46' => 15, 'FieldId45' => 16, 'FieldId44' => 17, 'FieldId43' => 18, 'FieldId42' => 19, 'FieldId41' => 20, 'FieldId40' => 21, 'FieldId37' => 22, 'FieldId35' => 23, 'FieldId33' => 24, 'FieldId32' => 25, 'FieldId31' => 26, 'FieldId30' => 27, 'FieldId28' => 28, 'FieldId26' => 29, 'FieldId25' => 30, 'FieldId19' => 31, 'FieldId18' => 32, 'FieldId17' => 33, 'FieldId6' => 34, 'FieldId5' => 35, 'FieldId4' => 36, 'FieldId2' => 37, 'FieldId1' => 38, 'AuthorId' => 39, 'EntryDate' => 40, 'EditDate' => 41, 'CompletedBy' => 42, 'CompletedDate' => 43, ),
        self::TYPE_CAMELNAME     => array('entryId' => 0, 'bookingId' => 1, 'fieldId29' => 2, 'fieldId52' => 3, 'fieldId54' => 4, 'fieldId53' => 5, 'fieldId55' => 6, 'fieldId58' => 7, 'fieldId57' => 8, 'fieldId56' => 9, 'fieldId51' => 10, 'fieldId50' => 11, 'fieldId49' => 12, 'fieldId48' => 13, 'fieldId47' => 14, 'fieldId46' => 15, 'fieldId45' => 16, 'fieldId44' => 17, 'fieldId43' => 18, 'fieldId42' => 19, 'fieldId41' => 20, 'fieldId40' => 21, 'fieldId37' => 22, 'fieldId35' => 23, 'fieldId33' => 24, 'fieldId32' => 25, 'fieldId31' => 26, 'fieldId30' => 27, 'fieldId28' => 28, 'fieldId26' => 29, 'fieldId25' => 30, 'fieldId19' => 31, 'fieldId18' => 32, 'fieldId17' => 33, 'fieldId6' => 34, 'fieldId5' => 35, 'fieldId4' => 36, 'fieldId2' => 37, 'fieldId1' => 38, 'authorId' => 39, 'entryDate' => 40, 'editDate' => 41, 'completedBy' => 42, 'completedDate' => 43, ),
        self::TYPE_COLNAME       => array(FormEntries1TableMap::COL_ENTRY_ID => 0, FormEntries1TableMap::COL_BOOKING_ID => 1, FormEntries1TableMap::COL_FIELD_ID_29 => 2, FormEntries1TableMap::COL_FIELD_ID_52 => 3, FormEntries1TableMap::COL_FIELD_ID_54 => 4, FormEntries1TableMap::COL_FIELD_ID_53 => 5, FormEntries1TableMap::COL_FIELD_ID_55 => 6, FormEntries1TableMap::COL_FIELD_ID_58 => 7, FormEntries1TableMap::COL_FIELD_ID_57 => 8, FormEntries1TableMap::COL_FIELD_ID_56 => 9, FormEntries1TableMap::COL_FIELD_ID_51 => 10, FormEntries1TableMap::COL_FIELD_ID_50 => 11, FormEntries1TableMap::COL_FIELD_ID_49 => 12, FormEntries1TableMap::COL_FIELD_ID_48 => 13, FormEntries1TableMap::COL_FIELD_ID_47 => 14, FormEntries1TableMap::COL_FIELD_ID_46 => 15, FormEntries1TableMap::COL_FIELD_ID_45 => 16, FormEntries1TableMap::COL_FIELD_ID_44 => 17, FormEntries1TableMap::COL_FIELD_ID_43 => 18, FormEntries1TableMap::COL_FIELD_ID_42 => 19, FormEntries1TableMap::COL_FIELD_ID_41 => 20, FormEntries1TableMap::COL_FIELD_ID_40 => 21, FormEntries1TableMap::COL_FIELD_ID_37 => 22, FormEntries1TableMap::COL_FIELD_ID_35 => 23, FormEntries1TableMap::COL_FIELD_ID_33 => 24, FormEntries1TableMap::COL_FIELD_ID_32 => 25, FormEntries1TableMap::COL_FIELD_ID_31 => 26, FormEntries1TableMap::COL_FIELD_ID_30 => 27, FormEntries1TableMap::COL_FIELD_ID_28 => 28, FormEntries1TableMap::COL_FIELD_ID_26 => 29, FormEntries1TableMap::COL_FIELD_ID_25 => 30, FormEntries1TableMap::COL_FIELD_ID_19 => 31, FormEntries1TableMap::COL_FIELD_ID_18 => 32, FormEntries1TableMap::COL_FIELD_ID_17 => 33, FormEntries1TableMap::COL_FIELD_ID_6 => 34, FormEntries1TableMap::COL_FIELD_ID_5 => 35, FormEntries1TableMap::COL_FIELD_ID_4 => 36, FormEntries1TableMap::COL_FIELD_ID_2 => 37, FormEntries1TableMap::COL_FIELD_ID_1 => 38, FormEntries1TableMap::COL_AUTHOR_ID => 39, FormEntries1TableMap::COL_ENTRY_DATE => 40, FormEntries1TableMap::COL_EDIT_DATE => 41, FormEntries1TableMap::COL_COMPLETED_BY => 42, FormEntries1TableMap::COL_COMPLETED_DATE => 43, ),
        self::TYPE_FIELDNAME     => array('entry_id' => 0, 'booking_id' => 1, 'field_id_29' => 2, 'field_id_52' => 3, 'field_id_54' => 4, 'field_id_53' => 5, 'field_id_55' => 6, 'field_id_58' => 7, 'field_id_57' => 8, 'field_id_56' => 9, 'field_id_51' => 10, 'field_id_50' => 11, 'field_id_49' => 12, 'field_id_48' => 13, 'field_id_47' => 14, 'field_id_46' => 15, 'field_id_45' => 16, 'field_id_44' => 17, 'field_id_43' => 18, 'field_id_42' => 19, 'field_id_41' => 20, 'field_id_40' => 21, 'field_id_37' => 22, 'field_id_35' => 23, 'field_id_33' => 24, 'field_id_32' => 25, 'field_id_31' => 26, 'field_id_30' => 27, 'field_id_28' => 28, 'field_id_26' => 29, 'field_id_25' => 30, 'field_id_19' => 31, 'field_id_18' => 32, 'field_id_17' => 33, 'field_id_6' => 34, 'field_id_5' => 35, 'field_id_4' => 36, 'field_id_2' => 37, 'field_id_1' => 38, 'author_id' => 39, 'entry_date' => 40, 'edit_date' => 41, 'completed_by' => 42, 'completed_date' => 43, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, )
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
        $this->setName('tf_form_entries_1');
        $this->setPhpName('FormEntries1');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\TheFarm\\Models\\FormEntries1');
        $this->setPackage('TheFarm.Models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('entry_id', 'EntryId', 'INTEGER', true, 5, null);
        $this->addColumn('booking_id', 'BookingId', 'INTEGER', true, 5, null);
        $this->addColumn('field_id_29', 'FieldId29', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_52', 'FieldId52', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_54', 'FieldId54', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_53', 'FieldId53', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_55', 'FieldId55', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_58', 'FieldId58', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_57', 'FieldId57', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_56', 'FieldId56', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_51', 'FieldId51', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_50', 'FieldId50', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_49', 'FieldId49', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_48', 'FieldId48', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_47', 'FieldId47', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_46', 'FieldId46', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_45', 'FieldId45', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_44', 'FieldId44', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_43', 'FieldId43', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_42', 'FieldId42', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_41', 'FieldId41', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_40', 'FieldId40', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_37', 'FieldId37', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_35', 'FieldId35', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_33', 'FieldId33', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_32', 'FieldId32', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_31', 'FieldId31', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_30', 'FieldId30', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_28', 'FieldId28', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_26', 'FieldId26', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_25', 'FieldId25', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_19', 'FieldId19', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_18', 'FieldId18', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_17', 'FieldId17', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_6', 'FieldId6', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_5', 'FieldId5', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_4', 'FieldId4', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_2', 'FieldId2', 'LONGVARCHAR', false, null, null);
        $this->addColumn('field_id_1', 'FieldId1', 'LONGVARCHAR', false, null, null);
        $this->addColumn('author_id', 'AuthorId', 'INTEGER', true, 5, null);
        $this->addColumn('entry_date', 'EntryDate', 'INTEGER', true, 10, null);
        $this->addColumn('edit_date', 'EditDate', 'INTEGER', true, 10, null);
        $this->addColumn('completed_by', 'CompletedBy', 'INTEGER', false, 5, null);
        $this->addColumn('completed_date', 'CompletedDate', 'INTEGER', false, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('EntryId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? FormEntries1TableMap::CLASS_DEFAULT : FormEntries1TableMap::OM_CLASS;
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
     * @return array           (FormEntries1 object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FormEntries1TableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FormEntries1TableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FormEntries1TableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FormEntries1TableMap::OM_CLASS;
            /** @var FormEntries1 $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FormEntries1TableMap::addInstanceToPool($obj, $key);
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
            $key = FormEntries1TableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FormEntries1TableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FormEntries1 $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FormEntries1TableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FormEntries1TableMap::COL_ENTRY_ID);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_BOOKING_ID);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_29);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_52);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_54);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_53);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_55);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_58);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_57);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_56);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_51);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_50);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_49);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_48);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_47);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_46);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_45);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_44);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_43);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_42);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_41);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_40);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_37);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_35);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_33);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_32);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_31);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_30);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_28);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_26);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_25);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_19);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_18);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_17);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_6);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_5);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_4);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_2);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_FIELD_ID_1);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_AUTHOR_ID);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_ENTRY_DATE);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_EDIT_DATE);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_COMPLETED_BY);
            $criteria->addSelectColumn(FormEntries1TableMap::COL_COMPLETED_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.entry_id');
            $criteria->addSelectColumn($alias . '.booking_id');
            $criteria->addSelectColumn($alias . '.field_id_29');
            $criteria->addSelectColumn($alias . '.field_id_52');
            $criteria->addSelectColumn($alias . '.field_id_54');
            $criteria->addSelectColumn($alias . '.field_id_53');
            $criteria->addSelectColumn($alias . '.field_id_55');
            $criteria->addSelectColumn($alias . '.field_id_58');
            $criteria->addSelectColumn($alias . '.field_id_57');
            $criteria->addSelectColumn($alias . '.field_id_56');
            $criteria->addSelectColumn($alias . '.field_id_51');
            $criteria->addSelectColumn($alias . '.field_id_50');
            $criteria->addSelectColumn($alias . '.field_id_49');
            $criteria->addSelectColumn($alias . '.field_id_48');
            $criteria->addSelectColumn($alias . '.field_id_47');
            $criteria->addSelectColumn($alias . '.field_id_46');
            $criteria->addSelectColumn($alias . '.field_id_45');
            $criteria->addSelectColumn($alias . '.field_id_44');
            $criteria->addSelectColumn($alias . '.field_id_43');
            $criteria->addSelectColumn($alias . '.field_id_42');
            $criteria->addSelectColumn($alias . '.field_id_41');
            $criteria->addSelectColumn($alias . '.field_id_40');
            $criteria->addSelectColumn($alias . '.field_id_37');
            $criteria->addSelectColumn($alias . '.field_id_35');
            $criteria->addSelectColumn($alias . '.field_id_33');
            $criteria->addSelectColumn($alias . '.field_id_32');
            $criteria->addSelectColumn($alias . '.field_id_31');
            $criteria->addSelectColumn($alias . '.field_id_30');
            $criteria->addSelectColumn($alias . '.field_id_28');
            $criteria->addSelectColumn($alias . '.field_id_26');
            $criteria->addSelectColumn($alias . '.field_id_25');
            $criteria->addSelectColumn($alias . '.field_id_19');
            $criteria->addSelectColumn($alias . '.field_id_18');
            $criteria->addSelectColumn($alias . '.field_id_17');
            $criteria->addSelectColumn($alias . '.field_id_6');
            $criteria->addSelectColumn($alias . '.field_id_5');
            $criteria->addSelectColumn($alias . '.field_id_4');
            $criteria->addSelectColumn($alias . '.field_id_2');
            $criteria->addSelectColumn($alias . '.field_id_1');
            $criteria->addSelectColumn($alias . '.author_id');
            $criteria->addSelectColumn($alias . '.entry_date');
            $criteria->addSelectColumn($alias . '.edit_date');
            $criteria->addSelectColumn($alias . '.completed_by');
            $criteria->addSelectColumn($alias . '.completed_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(FormEntries1TableMap::DATABASE_NAME)->getTable(FormEntries1TableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FormEntries1TableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FormEntries1TableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FormEntries1TableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FormEntries1 or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FormEntries1 object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \TheFarm\Models\FormEntries1) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FormEntries1TableMap::DATABASE_NAME);
            $criteria->add(FormEntries1TableMap::COL_ENTRY_ID, (array) $values, Criteria::IN);
        }

        $query = FormEntries1Query::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FormEntries1TableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FormEntries1TableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tf_form_entries_1 table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FormEntries1Query::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FormEntries1 or Criteria object.
     *
     * @param mixed               $criteria Criteria or FormEntries1 object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FormEntries1 object
        }

        if ($criteria->containsKey(FormEntries1TableMap::COL_ENTRY_ID) && $criteria->keyContainsValue(FormEntries1TableMap::COL_ENTRY_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FormEntries1TableMap::COL_ENTRY_ID.')');
        }


        // Set the correct dbName
        $query = FormEntries1Query::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FormEntries1TableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FormEntries1TableMap::buildTableMap();
