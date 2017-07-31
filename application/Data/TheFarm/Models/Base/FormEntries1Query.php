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
use TheFarm\Models\FormEntries1 as ChildFormEntries1;
use TheFarm\Models\FormEntries1Query as ChildFormEntries1Query;
use TheFarm\Models\Map\FormEntries1TableMap;

/**
 * Base class that represents a query for the 'tf_form_entries_1' table.
 *
 *
 *
 * @method     ChildFormEntries1Query orderByEntryId($order = Criteria::ASC) Order by the entry_id column
 * @method     ChildFormEntries1Query orderByBookingId($order = Criteria::ASC) Order by the booking_id column
 * @method     ChildFormEntries1Query orderByFieldId29($order = Criteria::ASC) Order by the field_id_29 column
 * @method     ChildFormEntries1Query orderByFieldId52($order = Criteria::ASC) Order by the field_id_52 column
 * @method     ChildFormEntries1Query orderByFieldId54($order = Criteria::ASC) Order by the field_id_54 column
 * @method     ChildFormEntries1Query orderByFieldId53($order = Criteria::ASC) Order by the field_id_53 column
 * @method     ChildFormEntries1Query orderByFieldId55($order = Criteria::ASC) Order by the field_id_55 column
 * @method     ChildFormEntries1Query orderByFieldId58($order = Criteria::ASC) Order by the field_id_58 column
 * @method     ChildFormEntries1Query orderByFieldId57($order = Criteria::ASC) Order by the field_id_57 column
 * @method     ChildFormEntries1Query orderByFieldId56($order = Criteria::ASC) Order by the field_id_56 column
 * @method     ChildFormEntries1Query orderByFieldId51($order = Criteria::ASC) Order by the field_id_51 column
 * @method     ChildFormEntries1Query orderByFieldId50($order = Criteria::ASC) Order by the field_id_50 column
 * @method     ChildFormEntries1Query orderByFieldId49($order = Criteria::ASC) Order by the field_id_49 column
 * @method     ChildFormEntries1Query orderByFieldId48($order = Criteria::ASC) Order by the field_id_48 column
 * @method     ChildFormEntries1Query orderByFieldId47($order = Criteria::ASC) Order by the field_id_47 column
 * @method     ChildFormEntries1Query orderByFieldId46($order = Criteria::ASC) Order by the field_id_46 column
 * @method     ChildFormEntries1Query orderByFieldId45($order = Criteria::ASC) Order by the field_id_45 column
 * @method     ChildFormEntries1Query orderByFieldId44($order = Criteria::ASC) Order by the field_id_44 column
 * @method     ChildFormEntries1Query orderByFieldId43($order = Criteria::ASC) Order by the field_id_43 column
 * @method     ChildFormEntries1Query orderByFieldId42($order = Criteria::ASC) Order by the field_id_42 column
 * @method     ChildFormEntries1Query orderByFieldId41($order = Criteria::ASC) Order by the field_id_41 column
 * @method     ChildFormEntries1Query orderByFieldId40($order = Criteria::ASC) Order by the field_id_40 column
 * @method     ChildFormEntries1Query orderByFieldId37($order = Criteria::ASC) Order by the field_id_37 column
 * @method     ChildFormEntries1Query orderByFieldId35($order = Criteria::ASC) Order by the field_id_35 column
 * @method     ChildFormEntries1Query orderByFieldId33($order = Criteria::ASC) Order by the field_id_33 column
 * @method     ChildFormEntries1Query orderByFieldId32($order = Criteria::ASC) Order by the field_id_32 column
 * @method     ChildFormEntries1Query orderByFieldId31($order = Criteria::ASC) Order by the field_id_31 column
 * @method     ChildFormEntries1Query orderByFieldId30($order = Criteria::ASC) Order by the field_id_30 column
 * @method     ChildFormEntries1Query orderByFieldId28($order = Criteria::ASC) Order by the field_id_28 column
 * @method     ChildFormEntries1Query orderByFieldId26($order = Criteria::ASC) Order by the field_id_26 column
 * @method     ChildFormEntries1Query orderByFieldId25($order = Criteria::ASC) Order by the field_id_25 column
 * @method     ChildFormEntries1Query orderByFieldId19($order = Criteria::ASC) Order by the field_id_19 column
 * @method     ChildFormEntries1Query orderByFieldId18($order = Criteria::ASC) Order by the field_id_18 column
 * @method     ChildFormEntries1Query orderByFieldId17($order = Criteria::ASC) Order by the field_id_17 column
 * @method     ChildFormEntries1Query orderByFieldId6($order = Criteria::ASC) Order by the field_id_6 column
 * @method     ChildFormEntries1Query orderByFieldId5($order = Criteria::ASC) Order by the field_id_5 column
 * @method     ChildFormEntries1Query orderByFieldId4($order = Criteria::ASC) Order by the field_id_4 column
 * @method     ChildFormEntries1Query orderByFieldId2($order = Criteria::ASC) Order by the field_id_2 column
 * @method     ChildFormEntries1Query orderByFieldId1($order = Criteria::ASC) Order by the field_id_1 column
 * @method     ChildFormEntries1Query orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildFormEntries1Query orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildFormEntries1Query orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildFormEntries1Query orderByCompletedBy($order = Criteria::ASC) Order by the completed_by column
 * @method     ChildFormEntries1Query orderByCompletedDate($order = Criteria::ASC) Order by the completed_date column
 *
 * @method     ChildFormEntries1Query groupByEntryId() Group by the entry_id column
 * @method     ChildFormEntries1Query groupByBookingId() Group by the booking_id column
 * @method     ChildFormEntries1Query groupByFieldId29() Group by the field_id_29 column
 * @method     ChildFormEntries1Query groupByFieldId52() Group by the field_id_52 column
 * @method     ChildFormEntries1Query groupByFieldId54() Group by the field_id_54 column
 * @method     ChildFormEntries1Query groupByFieldId53() Group by the field_id_53 column
 * @method     ChildFormEntries1Query groupByFieldId55() Group by the field_id_55 column
 * @method     ChildFormEntries1Query groupByFieldId58() Group by the field_id_58 column
 * @method     ChildFormEntries1Query groupByFieldId57() Group by the field_id_57 column
 * @method     ChildFormEntries1Query groupByFieldId56() Group by the field_id_56 column
 * @method     ChildFormEntries1Query groupByFieldId51() Group by the field_id_51 column
 * @method     ChildFormEntries1Query groupByFieldId50() Group by the field_id_50 column
 * @method     ChildFormEntries1Query groupByFieldId49() Group by the field_id_49 column
 * @method     ChildFormEntries1Query groupByFieldId48() Group by the field_id_48 column
 * @method     ChildFormEntries1Query groupByFieldId47() Group by the field_id_47 column
 * @method     ChildFormEntries1Query groupByFieldId46() Group by the field_id_46 column
 * @method     ChildFormEntries1Query groupByFieldId45() Group by the field_id_45 column
 * @method     ChildFormEntries1Query groupByFieldId44() Group by the field_id_44 column
 * @method     ChildFormEntries1Query groupByFieldId43() Group by the field_id_43 column
 * @method     ChildFormEntries1Query groupByFieldId42() Group by the field_id_42 column
 * @method     ChildFormEntries1Query groupByFieldId41() Group by the field_id_41 column
 * @method     ChildFormEntries1Query groupByFieldId40() Group by the field_id_40 column
 * @method     ChildFormEntries1Query groupByFieldId37() Group by the field_id_37 column
 * @method     ChildFormEntries1Query groupByFieldId35() Group by the field_id_35 column
 * @method     ChildFormEntries1Query groupByFieldId33() Group by the field_id_33 column
 * @method     ChildFormEntries1Query groupByFieldId32() Group by the field_id_32 column
 * @method     ChildFormEntries1Query groupByFieldId31() Group by the field_id_31 column
 * @method     ChildFormEntries1Query groupByFieldId30() Group by the field_id_30 column
 * @method     ChildFormEntries1Query groupByFieldId28() Group by the field_id_28 column
 * @method     ChildFormEntries1Query groupByFieldId26() Group by the field_id_26 column
 * @method     ChildFormEntries1Query groupByFieldId25() Group by the field_id_25 column
 * @method     ChildFormEntries1Query groupByFieldId19() Group by the field_id_19 column
 * @method     ChildFormEntries1Query groupByFieldId18() Group by the field_id_18 column
 * @method     ChildFormEntries1Query groupByFieldId17() Group by the field_id_17 column
 * @method     ChildFormEntries1Query groupByFieldId6() Group by the field_id_6 column
 * @method     ChildFormEntries1Query groupByFieldId5() Group by the field_id_5 column
 * @method     ChildFormEntries1Query groupByFieldId4() Group by the field_id_4 column
 * @method     ChildFormEntries1Query groupByFieldId2() Group by the field_id_2 column
 * @method     ChildFormEntries1Query groupByFieldId1() Group by the field_id_1 column
 * @method     ChildFormEntries1Query groupByAuthorId() Group by the author_id column
 * @method     ChildFormEntries1Query groupByEntryDate() Group by the entry_date column
 * @method     ChildFormEntries1Query groupByEditDate() Group by the edit_date column
 * @method     ChildFormEntries1Query groupByCompletedBy() Group by the completed_by column
 * @method     ChildFormEntries1Query groupByCompletedDate() Group by the completed_date column
 *
 * @method     ChildFormEntries1Query leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormEntries1Query rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormEntries1Query innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormEntries1Query leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormEntries1Query rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormEntries1Query innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormEntries1 findOne(ConnectionInterface $con = null) Return the first ChildFormEntries1 matching the query
 * @method     ChildFormEntries1 findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormEntries1 matching the query, or a new ChildFormEntries1 object populated from the query conditions when no match is found
 *
 * @method     ChildFormEntries1 findOneByEntryId(int $entry_id) Return the first ChildFormEntries1 filtered by the entry_id column
 * @method     ChildFormEntries1 findOneByBookingId(int $booking_id) Return the first ChildFormEntries1 filtered by the booking_id column
 * @method     ChildFormEntries1 findOneByFieldId29(string $field_id_29) Return the first ChildFormEntries1 filtered by the field_id_29 column
 * @method     ChildFormEntries1 findOneByFieldId52(string $field_id_52) Return the first ChildFormEntries1 filtered by the field_id_52 column
 * @method     ChildFormEntries1 findOneByFieldId54(string $field_id_54) Return the first ChildFormEntries1 filtered by the field_id_54 column
 * @method     ChildFormEntries1 findOneByFieldId53(string $field_id_53) Return the first ChildFormEntries1 filtered by the field_id_53 column
 * @method     ChildFormEntries1 findOneByFieldId55(string $field_id_55) Return the first ChildFormEntries1 filtered by the field_id_55 column
 * @method     ChildFormEntries1 findOneByFieldId58(string $field_id_58) Return the first ChildFormEntries1 filtered by the field_id_58 column
 * @method     ChildFormEntries1 findOneByFieldId57(string $field_id_57) Return the first ChildFormEntries1 filtered by the field_id_57 column
 * @method     ChildFormEntries1 findOneByFieldId56(string $field_id_56) Return the first ChildFormEntries1 filtered by the field_id_56 column
 * @method     ChildFormEntries1 findOneByFieldId51(string $field_id_51) Return the first ChildFormEntries1 filtered by the field_id_51 column
 * @method     ChildFormEntries1 findOneByFieldId50(string $field_id_50) Return the first ChildFormEntries1 filtered by the field_id_50 column
 * @method     ChildFormEntries1 findOneByFieldId49(string $field_id_49) Return the first ChildFormEntries1 filtered by the field_id_49 column
 * @method     ChildFormEntries1 findOneByFieldId48(string $field_id_48) Return the first ChildFormEntries1 filtered by the field_id_48 column
 * @method     ChildFormEntries1 findOneByFieldId47(string $field_id_47) Return the first ChildFormEntries1 filtered by the field_id_47 column
 * @method     ChildFormEntries1 findOneByFieldId46(string $field_id_46) Return the first ChildFormEntries1 filtered by the field_id_46 column
 * @method     ChildFormEntries1 findOneByFieldId45(string $field_id_45) Return the first ChildFormEntries1 filtered by the field_id_45 column
 * @method     ChildFormEntries1 findOneByFieldId44(string $field_id_44) Return the first ChildFormEntries1 filtered by the field_id_44 column
 * @method     ChildFormEntries1 findOneByFieldId43(string $field_id_43) Return the first ChildFormEntries1 filtered by the field_id_43 column
 * @method     ChildFormEntries1 findOneByFieldId42(string $field_id_42) Return the first ChildFormEntries1 filtered by the field_id_42 column
 * @method     ChildFormEntries1 findOneByFieldId41(string $field_id_41) Return the first ChildFormEntries1 filtered by the field_id_41 column
 * @method     ChildFormEntries1 findOneByFieldId40(string $field_id_40) Return the first ChildFormEntries1 filtered by the field_id_40 column
 * @method     ChildFormEntries1 findOneByFieldId37(string $field_id_37) Return the first ChildFormEntries1 filtered by the field_id_37 column
 * @method     ChildFormEntries1 findOneByFieldId35(string $field_id_35) Return the first ChildFormEntries1 filtered by the field_id_35 column
 * @method     ChildFormEntries1 findOneByFieldId33(string $field_id_33) Return the first ChildFormEntries1 filtered by the field_id_33 column
 * @method     ChildFormEntries1 findOneByFieldId32(string $field_id_32) Return the first ChildFormEntries1 filtered by the field_id_32 column
 * @method     ChildFormEntries1 findOneByFieldId31(string $field_id_31) Return the first ChildFormEntries1 filtered by the field_id_31 column
 * @method     ChildFormEntries1 findOneByFieldId30(string $field_id_30) Return the first ChildFormEntries1 filtered by the field_id_30 column
 * @method     ChildFormEntries1 findOneByFieldId28(string $field_id_28) Return the first ChildFormEntries1 filtered by the field_id_28 column
 * @method     ChildFormEntries1 findOneByFieldId26(string $field_id_26) Return the first ChildFormEntries1 filtered by the field_id_26 column
 * @method     ChildFormEntries1 findOneByFieldId25(string $field_id_25) Return the first ChildFormEntries1 filtered by the field_id_25 column
 * @method     ChildFormEntries1 findOneByFieldId19(string $field_id_19) Return the first ChildFormEntries1 filtered by the field_id_19 column
 * @method     ChildFormEntries1 findOneByFieldId18(string $field_id_18) Return the first ChildFormEntries1 filtered by the field_id_18 column
 * @method     ChildFormEntries1 findOneByFieldId17(string $field_id_17) Return the first ChildFormEntries1 filtered by the field_id_17 column
 * @method     ChildFormEntries1 findOneByFieldId6(string $field_id_6) Return the first ChildFormEntries1 filtered by the field_id_6 column
 * @method     ChildFormEntries1 findOneByFieldId5(string $field_id_5) Return the first ChildFormEntries1 filtered by the field_id_5 column
 * @method     ChildFormEntries1 findOneByFieldId4(string $field_id_4) Return the first ChildFormEntries1 filtered by the field_id_4 column
 * @method     ChildFormEntries1 findOneByFieldId2(string $field_id_2) Return the first ChildFormEntries1 filtered by the field_id_2 column
 * @method     ChildFormEntries1 findOneByFieldId1(string $field_id_1) Return the first ChildFormEntries1 filtered by the field_id_1 column
 * @method     ChildFormEntries1 findOneByAuthorId(int $author_id) Return the first ChildFormEntries1 filtered by the author_id column
 * @method     ChildFormEntries1 findOneByEntryDate(int $entry_date) Return the first ChildFormEntries1 filtered by the entry_date column
 * @method     ChildFormEntries1 findOneByEditDate(int $edit_date) Return the first ChildFormEntries1 filtered by the edit_date column
 * @method     ChildFormEntries1 findOneByCompletedBy(int $completed_by) Return the first ChildFormEntries1 filtered by the completed_by column
 * @method     ChildFormEntries1 findOneByCompletedDate(int $completed_date) Return the first ChildFormEntries1 filtered by the completed_date column *

 * @method     ChildFormEntries1 requirePk($key, ConnectionInterface $con = null) Return the ChildFormEntries1 by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOne(ConnectionInterface $con = null) Return the first ChildFormEntries1 matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries1 requireOneByEntryId(int $entry_id) Return the first ChildFormEntries1 filtered by the entry_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByBookingId(int $booking_id) Return the first ChildFormEntries1 filtered by the booking_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId29(string $field_id_29) Return the first ChildFormEntries1 filtered by the field_id_29 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId52(string $field_id_52) Return the first ChildFormEntries1 filtered by the field_id_52 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId54(string $field_id_54) Return the first ChildFormEntries1 filtered by the field_id_54 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId53(string $field_id_53) Return the first ChildFormEntries1 filtered by the field_id_53 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId55(string $field_id_55) Return the first ChildFormEntries1 filtered by the field_id_55 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId58(string $field_id_58) Return the first ChildFormEntries1 filtered by the field_id_58 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId57(string $field_id_57) Return the first ChildFormEntries1 filtered by the field_id_57 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId56(string $field_id_56) Return the first ChildFormEntries1 filtered by the field_id_56 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId51(string $field_id_51) Return the first ChildFormEntries1 filtered by the field_id_51 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId50(string $field_id_50) Return the first ChildFormEntries1 filtered by the field_id_50 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId49(string $field_id_49) Return the first ChildFormEntries1 filtered by the field_id_49 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId48(string $field_id_48) Return the first ChildFormEntries1 filtered by the field_id_48 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId47(string $field_id_47) Return the first ChildFormEntries1 filtered by the field_id_47 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId46(string $field_id_46) Return the first ChildFormEntries1 filtered by the field_id_46 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId45(string $field_id_45) Return the first ChildFormEntries1 filtered by the field_id_45 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId44(string $field_id_44) Return the first ChildFormEntries1 filtered by the field_id_44 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId43(string $field_id_43) Return the first ChildFormEntries1 filtered by the field_id_43 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId42(string $field_id_42) Return the first ChildFormEntries1 filtered by the field_id_42 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId41(string $field_id_41) Return the first ChildFormEntries1 filtered by the field_id_41 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId40(string $field_id_40) Return the first ChildFormEntries1 filtered by the field_id_40 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId37(string $field_id_37) Return the first ChildFormEntries1 filtered by the field_id_37 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId35(string $field_id_35) Return the first ChildFormEntries1 filtered by the field_id_35 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId33(string $field_id_33) Return the first ChildFormEntries1 filtered by the field_id_33 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId32(string $field_id_32) Return the first ChildFormEntries1 filtered by the field_id_32 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId31(string $field_id_31) Return the first ChildFormEntries1 filtered by the field_id_31 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId30(string $field_id_30) Return the first ChildFormEntries1 filtered by the field_id_30 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId28(string $field_id_28) Return the first ChildFormEntries1 filtered by the field_id_28 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId26(string $field_id_26) Return the first ChildFormEntries1 filtered by the field_id_26 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId25(string $field_id_25) Return the first ChildFormEntries1 filtered by the field_id_25 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId19(string $field_id_19) Return the first ChildFormEntries1 filtered by the field_id_19 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId18(string $field_id_18) Return the first ChildFormEntries1 filtered by the field_id_18 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId17(string $field_id_17) Return the first ChildFormEntries1 filtered by the field_id_17 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId6(string $field_id_6) Return the first ChildFormEntries1 filtered by the field_id_6 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId5(string $field_id_5) Return the first ChildFormEntries1 filtered by the field_id_5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId4(string $field_id_4) Return the first ChildFormEntries1 filtered by the field_id_4 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId2(string $field_id_2) Return the first ChildFormEntries1 filtered by the field_id_2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByFieldId1(string $field_id_1) Return the first ChildFormEntries1 filtered by the field_id_1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByAuthorId(int $author_id) Return the first ChildFormEntries1 filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByEntryDate(int $entry_date) Return the first ChildFormEntries1 filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByEditDate(int $edit_date) Return the first ChildFormEntries1 filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByCompletedBy(int $completed_by) Return the first ChildFormEntries1 filtered by the completed_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormEntries1 requireOneByCompletedDate(int $completed_date) Return the first ChildFormEntries1 filtered by the completed_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormEntries1[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormEntries1 objects based on current ModelCriteria
 * @method     ChildFormEntries1[]|ObjectCollection findByEntryId(int $entry_id) Return ChildFormEntries1 objects filtered by the entry_id column
 * @method     ChildFormEntries1[]|ObjectCollection findByBookingId(int $booking_id) Return ChildFormEntries1 objects filtered by the booking_id column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId29(string $field_id_29) Return ChildFormEntries1 objects filtered by the field_id_29 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId52(string $field_id_52) Return ChildFormEntries1 objects filtered by the field_id_52 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId54(string $field_id_54) Return ChildFormEntries1 objects filtered by the field_id_54 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId53(string $field_id_53) Return ChildFormEntries1 objects filtered by the field_id_53 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId55(string $field_id_55) Return ChildFormEntries1 objects filtered by the field_id_55 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId58(string $field_id_58) Return ChildFormEntries1 objects filtered by the field_id_58 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId57(string $field_id_57) Return ChildFormEntries1 objects filtered by the field_id_57 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId56(string $field_id_56) Return ChildFormEntries1 objects filtered by the field_id_56 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId51(string $field_id_51) Return ChildFormEntries1 objects filtered by the field_id_51 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId50(string $field_id_50) Return ChildFormEntries1 objects filtered by the field_id_50 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId49(string $field_id_49) Return ChildFormEntries1 objects filtered by the field_id_49 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId48(string $field_id_48) Return ChildFormEntries1 objects filtered by the field_id_48 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId47(string $field_id_47) Return ChildFormEntries1 objects filtered by the field_id_47 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId46(string $field_id_46) Return ChildFormEntries1 objects filtered by the field_id_46 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId45(string $field_id_45) Return ChildFormEntries1 objects filtered by the field_id_45 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId44(string $field_id_44) Return ChildFormEntries1 objects filtered by the field_id_44 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId43(string $field_id_43) Return ChildFormEntries1 objects filtered by the field_id_43 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId42(string $field_id_42) Return ChildFormEntries1 objects filtered by the field_id_42 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId41(string $field_id_41) Return ChildFormEntries1 objects filtered by the field_id_41 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId40(string $field_id_40) Return ChildFormEntries1 objects filtered by the field_id_40 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId37(string $field_id_37) Return ChildFormEntries1 objects filtered by the field_id_37 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId35(string $field_id_35) Return ChildFormEntries1 objects filtered by the field_id_35 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId33(string $field_id_33) Return ChildFormEntries1 objects filtered by the field_id_33 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId32(string $field_id_32) Return ChildFormEntries1 objects filtered by the field_id_32 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId31(string $field_id_31) Return ChildFormEntries1 objects filtered by the field_id_31 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId30(string $field_id_30) Return ChildFormEntries1 objects filtered by the field_id_30 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId28(string $field_id_28) Return ChildFormEntries1 objects filtered by the field_id_28 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId26(string $field_id_26) Return ChildFormEntries1 objects filtered by the field_id_26 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId25(string $field_id_25) Return ChildFormEntries1 objects filtered by the field_id_25 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId19(string $field_id_19) Return ChildFormEntries1 objects filtered by the field_id_19 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId18(string $field_id_18) Return ChildFormEntries1 objects filtered by the field_id_18 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId17(string $field_id_17) Return ChildFormEntries1 objects filtered by the field_id_17 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId6(string $field_id_6) Return ChildFormEntries1 objects filtered by the field_id_6 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId5(string $field_id_5) Return ChildFormEntries1 objects filtered by the field_id_5 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId4(string $field_id_4) Return ChildFormEntries1 objects filtered by the field_id_4 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId2(string $field_id_2) Return ChildFormEntries1 objects filtered by the field_id_2 column
 * @method     ChildFormEntries1[]|ObjectCollection findByFieldId1(string $field_id_1) Return ChildFormEntries1 objects filtered by the field_id_1 column
 * @method     ChildFormEntries1[]|ObjectCollection findByAuthorId(int $author_id) Return ChildFormEntries1 objects filtered by the author_id column
 * @method     ChildFormEntries1[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildFormEntries1 objects filtered by the entry_date column
 * @method     ChildFormEntries1[]|ObjectCollection findByEditDate(int $edit_date) Return ChildFormEntries1 objects filtered by the edit_date column
 * @method     ChildFormEntries1[]|ObjectCollection findByCompletedBy(int $completed_by) Return ChildFormEntries1 objects filtered by the completed_by column
 * @method     ChildFormEntries1[]|ObjectCollection findByCompletedDate(int $completed_date) Return ChildFormEntries1 objects filtered by the completed_date column
 * @method     ChildFormEntries1[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormEntries1Query extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\FormEntries1Query object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\FormEntries1', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormEntries1Query object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormEntries1Query
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormEntries1Query) {
            return $criteria;
        }
        $query = new ChildFormEntries1Query();
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
     * @return ChildFormEntries1|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormEntries1TableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFormEntries1 A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT entry_id, booking_id, field_id_29, field_id_52, field_id_54, field_id_53, field_id_55, field_id_58, field_id_57, field_id_56, field_id_51, field_id_50, field_id_49, field_id_48, field_id_47, field_id_46, field_id_45, field_id_44, field_id_43, field_id_42, field_id_41, field_id_40, field_id_37, field_id_35, field_id_33, field_id_32, field_id_31, field_id_30, field_id_28, field_id_26, field_id_25, field_id_19, field_id_18, field_id_17, field_id_6, field_id_5, field_id_4, field_id_2, field_id_1, author_id, entry_date, edit_date, completed_by, completed_date FROM tf_form_entries_1 WHERE entry_id = :p0';
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
            /** @var ChildFormEntries1 $obj */
            $obj = new ChildFormEntries1();
            $obj->hydrate($row);
            FormEntries1TableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFormEntries1|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the entry_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEntryId(1234); // WHERE entry_id = 1234
     * $query->filterByEntryId(array(12, 34)); // WHERE entry_id IN (12, 34)
     * $query->filterByEntryId(array('min' => 12)); // WHERE entry_id > 12
     * </code>
     *
     * @param     mixed $entryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByEntryId($entryId = null, $comparison = null)
    {
        if (is_array($entryId)) {
            $useMinMax = false;
            if (isset($entryId['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $entryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryId['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $entryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $entryId, $comparison);
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
     * @param     mixed $bookingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByBookingId($bookingId = null, $comparison = null)
    {
        if (is_array($bookingId)) {
            $useMinMax = false;
            if (isset($bookingId['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_BOOKING_ID, $bookingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingId['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_BOOKING_ID, $bookingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_BOOKING_ID, $bookingId, $comparison);
    }

    /**
     * Filter the query on the field_id_29 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId29('fooValue');   // WHERE field_id_29 = 'fooValue'
     * $query->filterByFieldId29('%fooValue%', Criteria::LIKE); // WHERE field_id_29 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId29 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId29($fieldId29 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId29)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_29, $fieldId29, $comparison);
    }

    /**
     * Filter the query on the field_id_52 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId52('fooValue');   // WHERE field_id_52 = 'fooValue'
     * $query->filterByFieldId52('%fooValue%', Criteria::LIKE); // WHERE field_id_52 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId52 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId52($fieldId52 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId52)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_52, $fieldId52, $comparison);
    }

    /**
     * Filter the query on the field_id_54 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId54('fooValue');   // WHERE field_id_54 = 'fooValue'
     * $query->filterByFieldId54('%fooValue%', Criteria::LIKE); // WHERE field_id_54 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId54 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId54($fieldId54 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId54)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_54, $fieldId54, $comparison);
    }

    /**
     * Filter the query on the field_id_53 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId53('fooValue');   // WHERE field_id_53 = 'fooValue'
     * $query->filterByFieldId53('%fooValue%', Criteria::LIKE); // WHERE field_id_53 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId53 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId53($fieldId53 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId53)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_53, $fieldId53, $comparison);
    }

    /**
     * Filter the query on the field_id_55 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId55('fooValue');   // WHERE field_id_55 = 'fooValue'
     * $query->filterByFieldId55('%fooValue%', Criteria::LIKE); // WHERE field_id_55 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId55 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId55($fieldId55 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId55)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_55, $fieldId55, $comparison);
    }

    /**
     * Filter the query on the field_id_58 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId58('fooValue');   // WHERE field_id_58 = 'fooValue'
     * $query->filterByFieldId58('%fooValue%', Criteria::LIKE); // WHERE field_id_58 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId58 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId58($fieldId58 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId58)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_58, $fieldId58, $comparison);
    }

    /**
     * Filter the query on the field_id_57 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId57('fooValue');   // WHERE field_id_57 = 'fooValue'
     * $query->filterByFieldId57('%fooValue%', Criteria::LIKE); // WHERE field_id_57 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId57 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId57($fieldId57 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId57)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_57, $fieldId57, $comparison);
    }

    /**
     * Filter the query on the field_id_56 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId56('fooValue');   // WHERE field_id_56 = 'fooValue'
     * $query->filterByFieldId56('%fooValue%', Criteria::LIKE); // WHERE field_id_56 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId56 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId56($fieldId56 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId56)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_56, $fieldId56, $comparison);
    }

    /**
     * Filter the query on the field_id_51 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId51('fooValue');   // WHERE field_id_51 = 'fooValue'
     * $query->filterByFieldId51('%fooValue%', Criteria::LIKE); // WHERE field_id_51 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId51 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId51($fieldId51 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId51)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_51, $fieldId51, $comparison);
    }

    /**
     * Filter the query on the field_id_50 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId50('fooValue');   // WHERE field_id_50 = 'fooValue'
     * $query->filterByFieldId50('%fooValue%', Criteria::LIKE); // WHERE field_id_50 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId50 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId50($fieldId50 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId50)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_50, $fieldId50, $comparison);
    }

    /**
     * Filter the query on the field_id_49 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId49('fooValue');   // WHERE field_id_49 = 'fooValue'
     * $query->filterByFieldId49('%fooValue%', Criteria::LIKE); // WHERE field_id_49 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId49 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId49($fieldId49 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId49)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_49, $fieldId49, $comparison);
    }

    /**
     * Filter the query on the field_id_48 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId48('fooValue');   // WHERE field_id_48 = 'fooValue'
     * $query->filterByFieldId48('%fooValue%', Criteria::LIKE); // WHERE field_id_48 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId48 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId48($fieldId48 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId48)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_48, $fieldId48, $comparison);
    }

    /**
     * Filter the query on the field_id_47 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId47('fooValue');   // WHERE field_id_47 = 'fooValue'
     * $query->filterByFieldId47('%fooValue%', Criteria::LIKE); // WHERE field_id_47 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId47 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId47($fieldId47 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId47)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_47, $fieldId47, $comparison);
    }

    /**
     * Filter the query on the field_id_46 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId46('fooValue');   // WHERE field_id_46 = 'fooValue'
     * $query->filterByFieldId46('%fooValue%', Criteria::LIKE); // WHERE field_id_46 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId46 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId46($fieldId46 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId46)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_46, $fieldId46, $comparison);
    }

    /**
     * Filter the query on the field_id_45 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId45('fooValue');   // WHERE field_id_45 = 'fooValue'
     * $query->filterByFieldId45('%fooValue%', Criteria::LIKE); // WHERE field_id_45 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId45 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId45($fieldId45 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId45)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_45, $fieldId45, $comparison);
    }

    /**
     * Filter the query on the field_id_44 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId44('fooValue');   // WHERE field_id_44 = 'fooValue'
     * $query->filterByFieldId44('%fooValue%', Criteria::LIKE); // WHERE field_id_44 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId44 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId44($fieldId44 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId44)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_44, $fieldId44, $comparison);
    }

    /**
     * Filter the query on the field_id_43 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId43('fooValue');   // WHERE field_id_43 = 'fooValue'
     * $query->filterByFieldId43('%fooValue%', Criteria::LIKE); // WHERE field_id_43 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId43 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId43($fieldId43 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId43)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_43, $fieldId43, $comparison);
    }

    /**
     * Filter the query on the field_id_42 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId42('fooValue');   // WHERE field_id_42 = 'fooValue'
     * $query->filterByFieldId42('%fooValue%', Criteria::LIKE); // WHERE field_id_42 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId42 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId42($fieldId42 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId42)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_42, $fieldId42, $comparison);
    }

    /**
     * Filter the query on the field_id_41 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId41('fooValue');   // WHERE field_id_41 = 'fooValue'
     * $query->filterByFieldId41('%fooValue%', Criteria::LIKE); // WHERE field_id_41 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId41 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId41($fieldId41 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId41)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_41, $fieldId41, $comparison);
    }

    /**
     * Filter the query on the field_id_40 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId40('fooValue');   // WHERE field_id_40 = 'fooValue'
     * $query->filterByFieldId40('%fooValue%', Criteria::LIKE); // WHERE field_id_40 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId40 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId40($fieldId40 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId40)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_40, $fieldId40, $comparison);
    }

    /**
     * Filter the query on the field_id_37 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId37('fooValue');   // WHERE field_id_37 = 'fooValue'
     * $query->filterByFieldId37('%fooValue%', Criteria::LIKE); // WHERE field_id_37 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId37 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId37($fieldId37 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId37)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_37, $fieldId37, $comparison);
    }

    /**
     * Filter the query on the field_id_35 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId35('fooValue');   // WHERE field_id_35 = 'fooValue'
     * $query->filterByFieldId35('%fooValue%', Criteria::LIKE); // WHERE field_id_35 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId35 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId35($fieldId35 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId35)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_35, $fieldId35, $comparison);
    }

    /**
     * Filter the query on the field_id_33 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId33('fooValue');   // WHERE field_id_33 = 'fooValue'
     * $query->filterByFieldId33('%fooValue%', Criteria::LIKE); // WHERE field_id_33 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId33 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId33($fieldId33 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId33)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_33, $fieldId33, $comparison);
    }

    /**
     * Filter the query on the field_id_32 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId32('fooValue');   // WHERE field_id_32 = 'fooValue'
     * $query->filterByFieldId32('%fooValue%', Criteria::LIKE); // WHERE field_id_32 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId32 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId32($fieldId32 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId32)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_32, $fieldId32, $comparison);
    }

    /**
     * Filter the query on the field_id_31 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId31('fooValue');   // WHERE field_id_31 = 'fooValue'
     * $query->filterByFieldId31('%fooValue%', Criteria::LIKE); // WHERE field_id_31 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId31 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId31($fieldId31 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId31)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_31, $fieldId31, $comparison);
    }

    /**
     * Filter the query on the field_id_30 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId30('fooValue');   // WHERE field_id_30 = 'fooValue'
     * $query->filterByFieldId30('%fooValue%', Criteria::LIKE); // WHERE field_id_30 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId30 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId30($fieldId30 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId30)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_30, $fieldId30, $comparison);
    }

    /**
     * Filter the query on the field_id_28 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId28('fooValue');   // WHERE field_id_28 = 'fooValue'
     * $query->filterByFieldId28('%fooValue%', Criteria::LIKE); // WHERE field_id_28 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId28 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId28($fieldId28 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId28)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_28, $fieldId28, $comparison);
    }

    /**
     * Filter the query on the field_id_26 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId26('fooValue');   // WHERE field_id_26 = 'fooValue'
     * $query->filterByFieldId26('%fooValue%', Criteria::LIKE); // WHERE field_id_26 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId26 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId26($fieldId26 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId26)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_26, $fieldId26, $comparison);
    }

    /**
     * Filter the query on the field_id_25 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId25('fooValue');   // WHERE field_id_25 = 'fooValue'
     * $query->filterByFieldId25('%fooValue%', Criteria::LIKE); // WHERE field_id_25 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId25 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId25($fieldId25 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId25)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_25, $fieldId25, $comparison);
    }

    /**
     * Filter the query on the field_id_19 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId19('fooValue');   // WHERE field_id_19 = 'fooValue'
     * $query->filterByFieldId19('%fooValue%', Criteria::LIKE); // WHERE field_id_19 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId19 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId19($fieldId19 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId19)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_19, $fieldId19, $comparison);
    }

    /**
     * Filter the query on the field_id_18 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId18('fooValue');   // WHERE field_id_18 = 'fooValue'
     * $query->filterByFieldId18('%fooValue%', Criteria::LIKE); // WHERE field_id_18 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId18 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId18($fieldId18 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId18)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_18, $fieldId18, $comparison);
    }

    /**
     * Filter the query on the field_id_17 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId17('fooValue');   // WHERE field_id_17 = 'fooValue'
     * $query->filterByFieldId17('%fooValue%', Criteria::LIKE); // WHERE field_id_17 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId17 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId17($fieldId17 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId17)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_17, $fieldId17, $comparison);
    }

    /**
     * Filter the query on the field_id_6 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId6('fooValue');   // WHERE field_id_6 = 'fooValue'
     * $query->filterByFieldId6('%fooValue%', Criteria::LIKE); // WHERE field_id_6 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId6 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId6($fieldId6 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId6)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_6, $fieldId6, $comparison);
    }

    /**
     * Filter the query on the field_id_5 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId5('fooValue');   // WHERE field_id_5 = 'fooValue'
     * $query->filterByFieldId5('%fooValue%', Criteria::LIKE); // WHERE field_id_5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId5 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId5($fieldId5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId5)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_5, $fieldId5, $comparison);
    }

    /**
     * Filter the query on the field_id_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId4('fooValue');   // WHERE field_id_4 = 'fooValue'
     * $query->filterByFieldId4('%fooValue%', Criteria::LIKE); // WHERE field_id_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId4 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId4($fieldId4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId4)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_4, $fieldId4, $comparison);
    }

    /**
     * Filter the query on the field_id_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId2('fooValue');   // WHERE field_id_2 = 'fooValue'
     * $query->filterByFieldId2('%fooValue%', Criteria::LIKE); // WHERE field_id_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId2 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId2($fieldId2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId2)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_2, $fieldId2, $comparison);
    }

    /**
     * Filter the query on the field_id_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByFieldId1('fooValue');   // WHERE field_id_1 = 'fooValue'
     * $query->filterByFieldId1('%fooValue%', Criteria::LIKE); // WHERE field_id_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fieldId1 The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByFieldId1($fieldId1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fieldId1)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_FIELD_ID_1, $fieldId1, $comparison);
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
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query on the completed_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletedBy(1234); // WHERE completed_by = 1234
     * $query->filterByCompletedBy(array(12, 34)); // WHERE completed_by IN (12, 34)
     * $query->filterByCompletedBy(array('min' => 12)); // WHERE completed_by > 12
     * </code>
     *
     * @param     mixed $completedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByCompletedBy($completedBy = null, $comparison = null)
    {
        if (is_array($completedBy)) {
            $useMinMax = false;
            if (isset($completedBy['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_BY, $completedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedBy['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_BY, $completedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_BY, $completedBy, $comparison);
    }

    /**
     * Filter the query on the completed_date column
     *
     * Example usage:
     * <code>
     * $query->filterByCompletedDate(1234); // WHERE completed_date = 1234
     * $query->filterByCompletedDate(array(12, 34)); // WHERE completed_date IN (12, 34)
     * $query->filterByCompletedDate(array('min' => 12)); // WHERE completed_date > 12
     * </code>
     *
     * @param     mixed $completedDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function filterByCompletedDate($completedDate = null, $comparison = null)
    {
        if (is_array($completedDate)) {
            $useMinMax = false;
            if (isset($completedDate['min'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_DATE, $completedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($completedDate['max'])) {
                $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_DATE, $completedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormEntries1TableMap::COL_COMPLETED_DATE, $completedDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFormEntries1 $formEntries1 Object to remove from the list of results
     *
     * @return $this|ChildFormEntries1Query The current query, for fluid interface
     */
    public function prune($formEntries1 = null)
    {
        if ($formEntries1) {
            $this->addUsingAlias(FormEntries1TableMap::COL_ENTRY_ID, $formEntries1->getEntryId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_form_entries_1 table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormEntries1TableMap::clearInstancePool();
            FormEntries1TableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormEntries1TableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormEntries1TableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormEntries1TableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormEntries1TableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormEntries1Query
