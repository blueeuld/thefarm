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
use TheFarm\Models\BookingEvents as ChildBookingEvents;
use TheFarm\Models\BookingEventsQuery as ChildBookingEventsQuery;
use TheFarm\Models\Map\BookingEventsTableMap;

/**
 * Base class that represents a query for the 'tf_booking_events' table.
 *
 *
 *
 * @method     ChildBookingEventsQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method     ChildBookingEventsQuery orderByEventTitle($order = Criteria::ASC) Order by the event_title column
 * @method     ChildBookingEventsQuery orderByStartDt($order = Criteria::ASC) Order by the start_dt column
 * @method     ChildBookingEventsQuery orderByEndDt($order = Criteria::ASC) Order by the end_dt column
 * @method     ChildBookingEventsQuery orderByFacilityId($order = Criteria::ASC) Order by the facility_id column
 * @method     ChildBookingEventsQuery orderByAllDay($order = Criteria::ASC) Order by the all_day column
 * @method     ChildBookingEventsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildBookingEventsQuery orderByAuthorId($order = Criteria::ASC) Order by the author_id column
 * @method     ChildBookingEventsQuery orderByEntryDate($order = Criteria::ASC) Order by the entry_date column
 * @method     ChildBookingEventsQuery orderByEditDate($order = Criteria::ASC) Order by the edit_date column
 * @method     ChildBookingEventsQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildBookingEventsQuery orderByCalledBy($order = Criteria::ASC) Order by the called_by column
 * @method     ChildBookingEventsQuery orderByCancelledBy($order = Criteria::ASC) Order by the cancelled_by column
 * @method     ChildBookingEventsQuery orderByCancelledReason($order = Criteria::ASC) Order by the cancelled_reason column
 * @method     ChildBookingEventsQuery orderByDateCancelled($order = Criteria::ASC) Order by the date_cancelled column
 * @method     ChildBookingEventsQuery orderByPersonalized($order = Criteria::ASC) Order by the personalized column
 * @method     ChildBookingEventsQuery orderByBookingItemId($order = Criteria::ASC) Order by the booking_item_id column
 * @method     ChildBookingEventsQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildBookingEventsQuery orderByDeletedDate($order = Criteria::ASC) Order by the deleted_date column
 * @method     ChildBookingEventsQuery orderByDeletedBy($order = Criteria::ASC) Order by the deleted_by column
 * @method     ChildBookingEventsQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     ChildBookingEventsQuery orderByIsKids($order = Criteria::ASC) Order by the is_kids column
 * @method     ChildBookingEventsQuery orderByInclOsDoneNumber($order = Criteria::ASC) Order by the incl_os_done_number column
 * @method     ChildBookingEventsQuery orderByInclOsDoneAmount($order = Criteria::ASC) Order by the incl_os_done_amount column
 * @method     ChildBookingEventsQuery orderByFocOsDoneNumber($order = Criteria::ASC) Order by the foc_os_done_number column
 * @method     ChildBookingEventsQuery orderByFocOsDoneAmount($order = Criteria::ASC) Order by the foc_os_done_amount column
 * @method     ChildBookingEventsQuery orderByNotInclOsDoneNumber($order = Criteria::ASC) Order by the not_incl_os_done_number column
 * @method     ChildBookingEventsQuery orderByNotInclOsDoneAmount($order = Criteria::ASC) Order by the not_incl_os_done_amount column
 * @method     ChildBookingEventsQuery orderByIncl($order = Criteria::ASC) Order by the incl column
 * @method     ChildBookingEventsQuery orderByNotIncl($order = Criteria::ASC) Order by the not_incl column
 * @method     ChildBookingEventsQuery orderByFoc($order = Criteria::ASC) Order by the foc column
 *
 * @method     ChildBookingEventsQuery groupByEventId() Group by the event_id column
 * @method     ChildBookingEventsQuery groupByEventTitle() Group by the event_title column
 * @method     ChildBookingEventsQuery groupByStartDt() Group by the start_dt column
 * @method     ChildBookingEventsQuery groupByEndDt() Group by the end_dt column
 * @method     ChildBookingEventsQuery groupByFacilityId() Group by the facility_id column
 * @method     ChildBookingEventsQuery groupByAllDay() Group by the all_day column
 * @method     ChildBookingEventsQuery groupByStatus() Group by the status column
 * @method     ChildBookingEventsQuery groupByAuthorId() Group by the author_id column
 * @method     ChildBookingEventsQuery groupByEntryDate() Group by the entry_date column
 * @method     ChildBookingEventsQuery groupByEditDate() Group by the edit_date column
 * @method     ChildBookingEventsQuery groupByNotes() Group by the notes column
 * @method     ChildBookingEventsQuery groupByCalledBy() Group by the called_by column
 * @method     ChildBookingEventsQuery groupByCancelledBy() Group by the cancelled_by column
 * @method     ChildBookingEventsQuery groupByCancelledReason() Group by the cancelled_reason column
 * @method     ChildBookingEventsQuery groupByDateCancelled() Group by the date_cancelled column
 * @method     ChildBookingEventsQuery groupByPersonalized() Group by the personalized column
 * @method     ChildBookingEventsQuery groupByBookingItemId() Group by the booking_item_id column
 * @method     ChildBookingEventsQuery groupByIsActive() Group by the is_active column
 * @method     ChildBookingEventsQuery groupByDeletedDate() Group by the deleted_date column
 * @method     ChildBookingEventsQuery groupByDeletedBy() Group by the deleted_by column
 * @method     ChildBookingEventsQuery groupByItemId() Group by the item_id column
 * @method     ChildBookingEventsQuery groupByIsKids() Group by the is_kids column
 * @method     ChildBookingEventsQuery groupByInclOsDoneNumber() Group by the incl_os_done_number column
 * @method     ChildBookingEventsQuery groupByInclOsDoneAmount() Group by the incl_os_done_amount column
 * @method     ChildBookingEventsQuery groupByFocOsDoneNumber() Group by the foc_os_done_number column
 * @method     ChildBookingEventsQuery groupByFocOsDoneAmount() Group by the foc_os_done_amount column
 * @method     ChildBookingEventsQuery groupByNotInclOsDoneNumber() Group by the not_incl_os_done_number column
 * @method     ChildBookingEventsQuery groupByNotInclOsDoneAmount() Group by the not_incl_os_done_amount column
 * @method     ChildBookingEventsQuery groupByIncl() Group by the incl column
 * @method     ChildBookingEventsQuery groupByNotIncl() Group by the not_incl column
 * @method     ChildBookingEventsQuery groupByFoc() Group by the foc column
 *
 * @method     ChildBookingEventsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookingEventsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookingEventsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookingEventsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookingEventsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookingEventsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookingEventsQuery leftJoinContactRelatedByAuthorId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactRelatedByAuthorId relation
 * @method     ChildBookingEventsQuery rightJoinContactRelatedByAuthorId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactRelatedByAuthorId relation
 * @method     ChildBookingEventsQuery innerJoinContactRelatedByAuthorId($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactRelatedByAuthorId relation
 *
 * @method     ChildBookingEventsQuery joinWithContactRelatedByAuthorId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactRelatedByAuthorId relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithContactRelatedByAuthorId() Adds a LEFT JOIN clause and with to the query using the ContactRelatedByAuthorId relation
 * @method     ChildBookingEventsQuery rightJoinWithContactRelatedByAuthorId() Adds a RIGHT JOIN clause and with to the query using the ContactRelatedByAuthorId relation
 * @method     ChildBookingEventsQuery innerJoinWithContactRelatedByAuthorId() Adds a INNER JOIN clause and with to the query using the ContactRelatedByAuthorId relation
 *
 * @method     ChildBookingEventsQuery leftJoinBookingItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingItems relation
 * @method     ChildBookingEventsQuery rightJoinBookingItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingItems relation
 * @method     ChildBookingEventsQuery innerJoinBookingItems($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingItems relation
 *
 * @method     ChildBookingEventsQuery joinWithBookingItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingItems relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithBookingItems() Adds a LEFT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildBookingEventsQuery rightJoinWithBookingItems() Adds a RIGHT JOIN clause and with to the query using the BookingItems relation
 * @method     ChildBookingEventsQuery innerJoinWithBookingItems() Adds a INNER JOIN clause and with to the query using the BookingItems relation
 *
 * @method     ChildBookingEventsQuery leftJoinContactRelatedByCalledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactRelatedByCalledBy relation
 * @method     ChildBookingEventsQuery rightJoinContactRelatedByCalledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactRelatedByCalledBy relation
 * @method     ChildBookingEventsQuery innerJoinContactRelatedByCalledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactRelatedByCalledBy relation
 *
 * @method     ChildBookingEventsQuery joinWithContactRelatedByCalledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactRelatedByCalledBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithContactRelatedByCalledBy() Adds a LEFT JOIN clause and with to the query using the ContactRelatedByCalledBy relation
 * @method     ChildBookingEventsQuery rightJoinWithContactRelatedByCalledBy() Adds a RIGHT JOIN clause and with to the query using the ContactRelatedByCalledBy relation
 * @method     ChildBookingEventsQuery innerJoinWithContactRelatedByCalledBy() Adds a INNER JOIN clause and with to the query using the ContactRelatedByCalledBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinContactRelatedByCancelledBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactRelatedByCancelledBy relation
 * @method     ChildBookingEventsQuery rightJoinContactRelatedByCancelledBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactRelatedByCancelledBy relation
 * @method     ChildBookingEventsQuery innerJoinContactRelatedByCancelledBy($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactRelatedByCancelledBy relation
 *
 * @method     ChildBookingEventsQuery joinWithContactRelatedByCancelledBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactRelatedByCancelledBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithContactRelatedByCancelledBy() Adds a LEFT JOIN clause and with to the query using the ContactRelatedByCancelledBy relation
 * @method     ChildBookingEventsQuery rightJoinWithContactRelatedByCancelledBy() Adds a RIGHT JOIN clause and with to the query using the ContactRelatedByCancelledBy relation
 * @method     ChildBookingEventsQuery innerJoinWithContactRelatedByCancelledBy() Adds a INNER JOIN clause and with to the query using the ContactRelatedByCancelledBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinContactRelatedByDeletedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContactRelatedByDeletedBy relation
 * @method     ChildBookingEventsQuery rightJoinContactRelatedByDeletedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContactRelatedByDeletedBy relation
 * @method     ChildBookingEventsQuery innerJoinContactRelatedByDeletedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the ContactRelatedByDeletedBy relation
 *
 * @method     ChildBookingEventsQuery joinWithContactRelatedByDeletedBy($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ContactRelatedByDeletedBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithContactRelatedByDeletedBy() Adds a LEFT JOIN clause and with to the query using the ContactRelatedByDeletedBy relation
 * @method     ChildBookingEventsQuery rightJoinWithContactRelatedByDeletedBy() Adds a RIGHT JOIN clause and with to the query using the ContactRelatedByDeletedBy relation
 * @method     ChildBookingEventsQuery innerJoinWithContactRelatedByDeletedBy() Adds a INNER JOIN clause and with to the query using the ContactRelatedByDeletedBy relation
 *
 * @method     ChildBookingEventsQuery leftJoinFacilities($relationAlias = null) Adds a LEFT JOIN clause to the query using the Facilities relation
 * @method     ChildBookingEventsQuery rightJoinFacilities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Facilities relation
 * @method     ChildBookingEventsQuery innerJoinFacilities($relationAlias = null) Adds a INNER JOIN clause to the query using the Facilities relation
 *
 * @method     ChildBookingEventsQuery joinWithFacilities($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Facilities relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithFacilities() Adds a LEFT JOIN clause and with to the query using the Facilities relation
 * @method     ChildBookingEventsQuery rightJoinWithFacilities() Adds a RIGHT JOIN clause and with to the query using the Facilities relation
 * @method     ChildBookingEventsQuery innerJoinWithFacilities() Adds a INNER JOIN clause and with to the query using the Facilities relation
 *
 * @method     ChildBookingEventsQuery leftJoinItems($relationAlias = null) Adds a LEFT JOIN clause to the query using the Items relation
 * @method     ChildBookingEventsQuery rightJoinItems($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Items relation
 * @method     ChildBookingEventsQuery innerJoinItems($relationAlias = null) Adds a INNER JOIN clause to the query using the Items relation
 *
 * @method     ChildBookingEventsQuery joinWithItems($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Items relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithItems() Adds a LEFT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingEventsQuery rightJoinWithItems() Adds a RIGHT JOIN clause and with to the query using the Items relation
 * @method     ChildBookingEventsQuery innerJoinWithItems() Adds a INNER JOIN clause and with to the query using the Items relation
 *
 * @method     ChildBookingEventsQuery leftJoinEventStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingEventsQuery rightJoinEventStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventStatus relation
 * @method     ChildBookingEventsQuery innerJoinEventStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the EventStatus relation
 *
 * @method     ChildBookingEventsQuery joinWithEventStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithEventStatus() Adds a LEFT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingEventsQuery rightJoinWithEventStatus() Adds a RIGHT JOIN clause and with to the query using the EventStatus relation
 * @method     ChildBookingEventsQuery innerJoinWithEventStatus() Adds a INNER JOIN clause and with to the query using the EventStatus relation
 *
 * @method     ChildBookingEventsQuery leftJoinBookingEventUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the BookingEventUsers relation
 * @method     ChildBookingEventsQuery rightJoinBookingEventUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BookingEventUsers relation
 * @method     ChildBookingEventsQuery innerJoinBookingEventUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the BookingEventUsers relation
 *
 * @method     ChildBookingEventsQuery joinWithBookingEventUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BookingEventUsers relation
 *
 * @method     ChildBookingEventsQuery leftJoinWithBookingEventUsers() Adds a LEFT JOIN clause and with to the query using the BookingEventUsers relation
 * @method     ChildBookingEventsQuery rightJoinWithBookingEventUsers() Adds a RIGHT JOIN clause and with to the query using the BookingEventUsers relation
 * @method     ChildBookingEventsQuery innerJoinWithBookingEventUsers() Adds a INNER JOIN clause and with to the query using the BookingEventUsers relation
 *
 * @method     \TheFarm\Models\ContactQuery|\TheFarm\Models\BookingItemsQuery|\TheFarm\Models\FacilitiesQuery|\TheFarm\Models\ItemsQuery|\TheFarm\Models\EventStatusQuery|\TheFarm\Models\BookingEventUsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookingEvents findOne(ConnectionInterface $con = null) Return the first ChildBookingEvents matching the query
 * @method     ChildBookingEvents findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookingEvents matching the query, or a new ChildBookingEvents object populated from the query conditions when no match is found
 *
 * @method     ChildBookingEvents findOneByEventId(int $event_id) Return the first ChildBookingEvents filtered by the event_id column
 * @method     ChildBookingEvents findOneByEventTitle(string $event_title) Return the first ChildBookingEvents filtered by the event_title column
 * @method     ChildBookingEvents findOneByStartDt(string $start_dt) Return the first ChildBookingEvents filtered by the start_dt column
 * @method     ChildBookingEvents findOneByEndDt(string $end_dt) Return the first ChildBookingEvents filtered by the end_dt column
 * @method     ChildBookingEvents findOneByFacilityId(int $facility_id) Return the first ChildBookingEvents filtered by the facility_id column
 * @method     ChildBookingEvents findOneByAllDay(int $all_day) Return the first ChildBookingEvents filtered by the all_day column
 * @method     ChildBookingEvents findOneByStatus(string $status) Return the first ChildBookingEvents filtered by the status column
 * @method     ChildBookingEvents findOneByAuthorId(int $author_id) Return the first ChildBookingEvents filtered by the author_id column
 * @method     ChildBookingEvents findOneByEntryDate(int $entry_date) Return the first ChildBookingEvents filtered by the entry_date column
 * @method     ChildBookingEvents findOneByEditDate(int $edit_date) Return the first ChildBookingEvents filtered by the edit_date column
 * @method     ChildBookingEvents findOneByNotes(string $notes) Return the first ChildBookingEvents filtered by the notes column
 * @method     ChildBookingEvents findOneByCalledBy(int $called_by) Return the first ChildBookingEvents filtered by the called_by column
 * @method     ChildBookingEvents findOneByCancelledBy(int $cancelled_by) Return the first ChildBookingEvents filtered by the cancelled_by column
 * @method     ChildBookingEvents findOneByCancelledReason(string $cancelled_reason) Return the first ChildBookingEvents filtered by the cancelled_reason column
 * @method     ChildBookingEvents findOneByDateCancelled(int $date_cancelled) Return the first ChildBookingEvents filtered by the date_cancelled column
 * @method     ChildBookingEvents findOneByPersonalized(string $personalized) Return the first ChildBookingEvents filtered by the personalized column
 * @method     ChildBookingEvents findOneByBookingItemId(int $booking_item_id) Return the first ChildBookingEvents filtered by the booking_item_id column
 * @method     ChildBookingEvents findOneByIsActive(string $is_active) Return the first ChildBookingEvents filtered by the is_active column
 * @method     ChildBookingEvents findOneByDeletedDate(int $deleted_date) Return the first ChildBookingEvents filtered by the deleted_date column
 * @method     ChildBookingEvents findOneByDeletedBy(int $deleted_by) Return the first ChildBookingEvents filtered by the deleted_by column
 * @method     ChildBookingEvents findOneByItemId(int $item_id) Return the first ChildBookingEvents filtered by the item_id column
 * @method     ChildBookingEvents findOneByIsKids(string $is_kids) Return the first ChildBookingEvents filtered by the is_kids column
 * @method     ChildBookingEvents findOneByInclOsDoneNumber(string $incl_os_done_number) Return the first ChildBookingEvents filtered by the incl_os_done_number column
 * @method     ChildBookingEvents findOneByInclOsDoneAmount(string $incl_os_done_amount) Return the first ChildBookingEvents filtered by the incl_os_done_amount column
 * @method     ChildBookingEvents findOneByFocOsDoneNumber(string $foc_os_done_number) Return the first ChildBookingEvents filtered by the foc_os_done_number column
 * @method     ChildBookingEvents findOneByFocOsDoneAmount(string $foc_os_done_amount) Return the first ChildBookingEvents filtered by the foc_os_done_amount column
 * @method     ChildBookingEvents findOneByNotInclOsDoneNumber(string $not_incl_os_done_number) Return the first ChildBookingEvents filtered by the not_incl_os_done_number column
 * @method     ChildBookingEvents findOneByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return the first ChildBookingEvents filtered by the not_incl_os_done_amount column
 * @method     ChildBookingEvents findOneByIncl(int $incl) Return the first ChildBookingEvents filtered by the incl column
 * @method     ChildBookingEvents findOneByNotIncl(int $not_incl) Return the first ChildBookingEvents filtered by the not_incl column
 * @method     ChildBookingEvents findOneByFoc(int $foc) Return the first ChildBookingEvents filtered by the foc column *

 * @method     ChildBookingEvents requirePk($key, ConnectionInterface $con = null) Return the ChildBookingEvents by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOne(ConnectionInterface $con = null) Return the first ChildBookingEvents matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingEvents requireOneByEventId(int $event_id) Return the first ChildBookingEvents filtered by the event_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByEventTitle(string $event_title) Return the first ChildBookingEvents filtered by the event_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByStartDt(string $start_dt) Return the first ChildBookingEvents filtered by the start_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByEndDt(string $end_dt) Return the first ChildBookingEvents filtered by the end_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByFacilityId(int $facility_id) Return the first ChildBookingEvents filtered by the facility_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByAllDay(int $all_day) Return the first ChildBookingEvents filtered by the all_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByStatus(string $status) Return the first ChildBookingEvents filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByAuthorId(int $author_id) Return the first ChildBookingEvents filtered by the author_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByEntryDate(int $entry_date) Return the first ChildBookingEvents filtered by the entry_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByEditDate(int $edit_date) Return the first ChildBookingEvents filtered by the edit_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByNotes(string $notes) Return the first ChildBookingEvents filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByCalledBy(int $called_by) Return the first ChildBookingEvents filtered by the called_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByCancelledBy(int $cancelled_by) Return the first ChildBookingEvents filtered by the cancelled_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByCancelledReason(string $cancelled_reason) Return the first ChildBookingEvents filtered by the cancelled_reason column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByDateCancelled(int $date_cancelled) Return the first ChildBookingEvents filtered by the date_cancelled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByPersonalized(string $personalized) Return the first ChildBookingEvents filtered by the personalized column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByBookingItemId(int $booking_item_id) Return the first ChildBookingEvents filtered by the booking_item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByIsActive(string $is_active) Return the first ChildBookingEvents filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByDeletedDate(int $deleted_date) Return the first ChildBookingEvents filtered by the deleted_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByDeletedBy(int $deleted_by) Return the first ChildBookingEvents filtered by the deleted_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByItemId(int $item_id) Return the first ChildBookingEvents filtered by the item_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByIsKids(string $is_kids) Return the first ChildBookingEvents filtered by the is_kids column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByInclOsDoneNumber(string $incl_os_done_number) Return the first ChildBookingEvents filtered by the incl_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByInclOsDoneAmount(string $incl_os_done_amount) Return the first ChildBookingEvents filtered by the incl_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByFocOsDoneNumber(string $foc_os_done_number) Return the first ChildBookingEvents filtered by the foc_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByFocOsDoneAmount(string $foc_os_done_amount) Return the first ChildBookingEvents filtered by the foc_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByNotInclOsDoneNumber(string $not_incl_os_done_number) Return the first ChildBookingEvents filtered by the not_incl_os_done_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return the first ChildBookingEvents filtered by the not_incl_os_done_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByIncl(int $incl) Return the first ChildBookingEvents filtered by the incl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByNotIncl(int $not_incl) Return the first ChildBookingEvents filtered by the not_incl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookingEvents requireOneByFoc(int $foc) Return the first ChildBookingEvents filtered by the foc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookingEvents[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookingEvents objects based on current ModelCriteria
 * @method     ChildBookingEvents[]|ObjectCollection findByEventId(int $event_id) Return ChildBookingEvents objects filtered by the event_id column
 * @method     ChildBookingEvents[]|ObjectCollection findByEventTitle(string $event_title) Return ChildBookingEvents objects filtered by the event_title column
 * @method     ChildBookingEvents[]|ObjectCollection findByStartDt(string $start_dt) Return ChildBookingEvents objects filtered by the start_dt column
 * @method     ChildBookingEvents[]|ObjectCollection findByEndDt(string $end_dt) Return ChildBookingEvents objects filtered by the end_dt column
 * @method     ChildBookingEvents[]|ObjectCollection findByFacilityId(int $facility_id) Return ChildBookingEvents objects filtered by the facility_id column
 * @method     ChildBookingEvents[]|ObjectCollection findByAllDay(int $all_day) Return ChildBookingEvents objects filtered by the all_day column
 * @method     ChildBookingEvents[]|ObjectCollection findByStatus(string $status) Return ChildBookingEvents objects filtered by the status column
 * @method     ChildBookingEvents[]|ObjectCollection findByAuthorId(int $author_id) Return ChildBookingEvents objects filtered by the author_id column
 * @method     ChildBookingEvents[]|ObjectCollection findByEntryDate(int $entry_date) Return ChildBookingEvents objects filtered by the entry_date column
 * @method     ChildBookingEvents[]|ObjectCollection findByEditDate(int $edit_date) Return ChildBookingEvents objects filtered by the edit_date column
 * @method     ChildBookingEvents[]|ObjectCollection findByNotes(string $notes) Return ChildBookingEvents objects filtered by the notes column
 * @method     ChildBookingEvents[]|ObjectCollection findByCalledBy(int $called_by) Return ChildBookingEvents objects filtered by the called_by column
 * @method     ChildBookingEvents[]|ObjectCollection findByCancelledBy(int $cancelled_by) Return ChildBookingEvents objects filtered by the cancelled_by column
 * @method     ChildBookingEvents[]|ObjectCollection findByCancelledReason(string $cancelled_reason) Return ChildBookingEvents objects filtered by the cancelled_reason column
 * @method     ChildBookingEvents[]|ObjectCollection findByDateCancelled(int $date_cancelled) Return ChildBookingEvents objects filtered by the date_cancelled column
 * @method     ChildBookingEvents[]|ObjectCollection findByPersonalized(string $personalized) Return ChildBookingEvents objects filtered by the personalized column
 * @method     ChildBookingEvents[]|ObjectCollection findByBookingItemId(int $booking_item_id) Return ChildBookingEvents objects filtered by the booking_item_id column
 * @method     ChildBookingEvents[]|ObjectCollection findByIsActive(string $is_active) Return ChildBookingEvents objects filtered by the is_active column
 * @method     ChildBookingEvents[]|ObjectCollection findByDeletedDate(int $deleted_date) Return ChildBookingEvents objects filtered by the deleted_date column
 * @method     ChildBookingEvents[]|ObjectCollection findByDeletedBy(int $deleted_by) Return ChildBookingEvents objects filtered by the deleted_by column
 * @method     ChildBookingEvents[]|ObjectCollection findByItemId(int $item_id) Return ChildBookingEvents objects filtered by the item_id column
 * @method     ChildBookingEvents[]|ObjectCollection findByIsKids(string $is_kids) Return ChildBookingEvents objects filtered by the is_kids column
 * @method     ChildBookingEvents[]|ObjectCollection findByInclOsDoneNumber(string $incl_os_done_number) Return ChildBookingEvents objects filtered by the incl_os_done_number column
 * @method     ChildBookingEvents[]|ObjectCollection findByInclOsDoneAmount(string $incl_os_done_amount) Return ChildBookingEvents objects filtered by the incl_os_done_amount column
 * @method     ChildBookingEvents[]|ObjectCollection findByFocOsDoneNumber(string $foc_os_done_number) Return ChildBookingEvents objects filtered by the foc_os_done_number column
 * @method     ChildBookingEvents[]|ObjectCollection findByFocOsDoneAmount(string $foc_os_done_amount) Return ChildBookingEvents objects filtered by the foc_os_done_amount column
 * @method     ChildBookingEvents[]|ObjectCollection findByNotInclOsDoneNumber(string $not_incl_os_done_number) Return ChildBookingEvents objects filtered by the not_incl_os_done_number column
 * @method     ChildBookingEvents[]|ObjectCollection findByNotInclOsDoneAmount(string $not_incl_os_done_amount) Return ChildBookingEvents objects filtered by the not_incl_os_done_amount column
 * @method     ChildBookingEvents[]|ObjectCollection findByIncl(int $incl) Return ChildBookingEvents objects filtered by the incl column
 * @method     ChildBookingEvents[]|ObjectCollection findByNotIncl(int $not_incl) Return ChildBookingEvents objects filtered by the not_incl column
 * @method     ChildBookingEvents[]|ObjectCollection findByFoc(int $foc) Return ChildBookingEvents objects filtered by the foc column
 * @method     ChildBookingEvents[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookingEventsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \TheFarm\Models\Base\BookingEventsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\TheFarm\\Models\\BookingEvents', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookingEventsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookingEventsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookingEventsQuery) {
            return $criteria;
        }
        $query = new ChildBookingEventsQuery();
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
     * @return ChildBookingEvents|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookingEventsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookingEventsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBookingEvents A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_id, event_title, start_dt, end_dt, facility_id, all_day, status, author_id, entry_date, edit_date, notes, called_by, cancelled_by, cancelled_reason, date_cancelled, personalized, booking_item_id, is_active, deleted_date, deleted_by, item_id, is_kids, incl_os_done_number, incl_os_done_amount, foc_os_done_number, foc_os_done_amount, not_incl_os_done_number, not_incl_os_done_amount, incl, not_incl, foc FROM tf_booking_events WHERE event_id = :p0';
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
            /** @var ChildBookingEvents $obj */
            $obj = new ChildBookingEvents();
            $obj->hydrate($row);
            BookingEventsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBookingEvents|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE event_id = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE event_id > 12
     * </code>
     *
     * @param     mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $eventId, $comparison);
    }

    /**
     * Filter the query on the event_title column
     *
     * Example usage:
     * <code>
     * $query->filterByEventTitle('fooValue');   // WHERE event_title = 'fooValue'
     * $query->filterByEventTitle('%fooValue%', Criteria::LIKE); // WHERE event_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eventTitle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEventTitle($eventTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eventTitle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_TITLE, $eventTitle, $comparison);
    }

    /**
     * Filter the query on the start_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDt('2011-03-14'); // WHERE start_dt = '2011-03-14'
     * $query->filterByStartDt('now'); // WHERE start_dt = '2011-03-14'
     * $query->filterByStartDt(array('max' => 'yesterday')); // WHERE start_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $startDt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByStartDt($startDt = null, $comparison = null)
    {
        if (is_array($startDt)) {
            $useMinMax = false;
            if (isset($startDt['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_START_DT, $startDt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startDt['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_START_DT, $startDt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_START_DT, $startDt, $comparison);
    }

    /**
     * Filter the query on the end_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDt('2011-03-14'); // WHERE end_dt = '2011-03-14'
     * $query->filterByEndDt('now'); // WHERE end_dt = '2011-03-14'
     * $query->filterByEndDt(array('max' => 'yesterday')); // WHERE end_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $endDt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEndDt($endDt = null, $comparison = null)
    {
        if (is_array($endDt)) {
            $useMinMax = false;
            if (isset($endDt['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_END_DT, $endDt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endDt['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_END_DT, $endDt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_END_DT, $endDt, $comparison);
    }

    /**
     * Filter the query on the facility_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFacilityId(1234); // WHERE facility_id = 1234
     * $query->filterByFacilityId(array(12, 34)); // WHERE facility_id IN (12, 34)
     * $query->filterByFacilityId(array('min' => 12)); // WHERE facility_id > 12
     * </code>
     *
     * @see       filterByFacilities()
     *
     * @param     mixed $facilityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByFacilityId($facilityId = null, $comparison = null)
    {
        if (is_array($facilityId)) {
            $useMinMax = false;
            if (isset($facilityId['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FACILITY_ID, $facilityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($facilityId['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FACILITY_ID, $facilityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_FACILITY_ID, $facilityId, $comparison);
    }

    /**
     * Filter the query on the all_day column
     *
     * Example usage:
     * <code>
     * $query->filterByAllDay(1234); // WHERE all_day = 1234
     * $query->filterByAllDay(array(12, 34)); // WHERE all_day IN (12, 34)
     * $query->filterByAllDay(array('min' => 12)); // WHERE all_day > 12
     * </code>
     *
     * @param     mixed $allDay The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByAllDay($allDay = null, $comparison = null)
    {
        if (is_array($allDay)) {
            $useMinMax = false;
            if (isset($allDay['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ALL_DAY, $allDay['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($allDay['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ALL_DAY, $allDay['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_ALL_DAY, $allDay, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_STATUS, $status, $comparison);
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
     * @see       filterByContactRelatedByAuthorId()
     *
     * @param     mixed $authorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByAuthorId($authorId = null, $comparison = null)
    {
        if (is_array($authorId)) {
            $useMinMax = false;
            if (isset($authorId['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_AUTHOR_ID, $authorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorId['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_AUTHOR_ID, $authorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_AUTHOR_ID, $authorId, $comparison);
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
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEntryDate($entryDate = null, $comparison = null)
    {
        if (is_array($entryDate)) {
            $useMinMax = false;
            if (isset($entryDate['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ENTRY_DATE, $entryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($entryDate['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ENTRY_DATE, $entryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_ENTRY_DATE, $entryDate, $comparison);
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
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEditDate($editDate = null, $comparison = null)
    {
        if (is_array($editDate)) {
            $useMinMax = false;
            if (isset($editDate['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_EDIT_DATE, $editDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($editDate['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_EDIT_DATE, $editDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_EDIT_DATE, $editDate, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_NOTES, $notes, $comparison);
    }

    /**
     * Filter the query on the called_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCalledBy(1234); // WHERE called_by = 1234
     * $query->filterByCalledBy(array(12, 34)); // WHERE called_by IN (12, 34)
     * $query->filterByCalledBy(array('min' => 12)); // WHERE called_by > 12
     * </code>
     *
     * @see       filterByContactRelatedByCalledBy()
     *
     * @param     mixed $calledBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByCalledBy($calledBy = null, $comparison = null)
    {
        if (is_array($calledBy)) {
            $useMinMax = false;
            if (isset($calledBy['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_CALLED_BY, $calledBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calledBy['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_CALLED_BY, $calledBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_CALLED_BY, $calledBy, $comparison);
    }

    /**
     * Filter the query on the cancelled_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCancelledBy(1234); // WHERE cancelled_by = 1234
     * $query->filterByCancelledBy(array(12, 34)); // WHERE cancelled_by IN (12, 34)
     * $query->filterByCancelledBy(array('min' => 12)); // WHERE cancelled_by > 12
     * </code>
     *
     * @see       filterByContactRelatedByCancelledBy()
     *
     * @param     mixed $cancelledBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByCancelledBy($cancelledBy = null, $comparison = null)
    {
        if (is_array($cancelledBy)) {
            $useMinMax = false;
            if (isset($cancelledBy['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_BY, $cancelledBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cancelledBy['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_BY, $cancelledBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_BY, $cancelledBy, $comparison);
    }

    /**
     * Filter the query on the cancelled_reason column
     *
     * Example usage:
     * <code>
     * $query->filterByCancelledReason('fooValue');   // WHERE cancelled_reason = 'fooValue'
     * $query->filterByCancelledReason('%fooValue%', Criteria::LIKE); // WHERE cancelled_reason LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cancelledReason The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByCancelledReason($cancelledReason = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cancelledReason)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_REASON, $cancelledReason, $comparison);
    }

    /**
     * Filter the query on the date_cancelled column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCancelled(1234); // WHERE date_cancelled = 1234
     * $query->filterByDateCancelled(array(12, 34)); // WHERE date_cancelled IN (12, 34)
     * $query->filterByDateCancelled(array('min' => 12)); // WHERE date_cancelled > 12
     * </code>
     *
     * @param     mixed $dateCancelled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByDateCancelled($dateCancelled = null, $comparison = null)
    {
        if (is_array($dateCancelled)) {
            $useMinMax = false;
            if (isset($dateCancelled['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DATE_CANCELLED, $dateCancelled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCancelled['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DATE_CANCELLED, $dateCancelled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_DATE_CANCELLED, $dateCancelled, $comparison);
    }

    /**
     * Filter the query on the personalized column
     *
     * Example usage:
     * <code>
     * $query->filterByPersonalized('fooValue');   // WHERE personalized = 'fooValue'
     * $query->filterByPersonalized('%fooValue%', Criteria::LIKE); // WHERE personalized LIKE '%fooValue%'
     * </code>
     *
     * @param     string $personalized The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByPersonalized($personalized = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($personalized)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_PERSONALIZED, $personalized, $comparison);
    }

    /**
     * Filter the query on the booking_item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBookingItemId(1234); // WHERE booking_item_id = 1234
     * $query->filterByBookingItemId(array(12, 34)); // WHERE booking_item_id IN (12, 34)
     * $query->filterByBookingItemId(array('min' => 12)); // WHERE booking_item_id > 12
     * </code>
     *
     * @see       filterByBookingItems()
     *
     * @param     mixed $bookingItemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByBookingItemId($bookingItemId = null, $comparison = null)
    {
        if (is_array($bookingItemId)) {
            $useMinMax = false;
            if (isset($bookingItemId['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookingItemId['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $bookingItemId, $comparison);
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive('fooValue');   // WHERE is_active = 'fooValue'
     * $query->filterByIsActive('%fooValue%', Criteria::LIKE); // WHERE is_active LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isActive The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByIsActive($isActive = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isActive)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_IS_ACTIVE, $isActive, $comparison);
    }

    /**
     * Filter the query on the deleted_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedDate(1234); // WHERE deleted_date = 1234
     * $query->filterByDeletedDate(array(12, 34)); // WHERE deleted_date IN (12, 34)
     * $query->filterByDeletedDate(array('min' => 12)); // WHERE deleted_date > 12
     * </code>
     *
     * @param     mixed $deletedDate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByDeletedDate($deletedDate = null, $comparison = null)
    {
        if (is_array($deletedDate)) {
            $useMinMax = false;
            if (isset($deletedDate['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_DATE, $deletedDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedDate['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_DATE, $deletedDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_DATE, $deletedDate, $comparison);
    }

    /**
     * Filter the query on the deleted_by column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedBy(1234); // WHERE deleted_by = 1234
     * $query->filterByDeletedBy(array(12, 34)); // WHERE deleted_by IN (12, 34)
     * $query->filterByDeletedBy(array('min' => 12)); // WHERE deleted_by > 12
     * </code>
     *
     * @see       filterByContactRelatedByDeletedBy()
     *
     * @param     mixed $deletedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByDeletedBy($deletedBy = null, $comparison = null)
    {
        if (is_array($deletedBy)) {
            $useMinMax = false;
            if (isset($deletedBy['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_BY, $deletedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedBy['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_BY, $deletedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_DELETED_BY, $deletedBy, $comparison);
    }

    /**
     * Filter the query on the item_id column
     *
     * Example usage:
     * <code>
     * $query->filterByItemId(1234); // WHERE item_id = 1234
     * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
     * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
     * </code>
     *
     * @see       filterByItems()
     *
     * @param     mixed $itemId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByItemId($itemId = null, $comparison = null)
    {
        if (is_array($itemId)) {
            $useMinMax = false;
            if (isset($itemId['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($itemId['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_ITEM_ID, $itemId, $comparison);
    }

    /**
     * Filter the query on the is_kids column
     *
     * Example usage:
     * <code>
     * $query->filterByIsKids('fooValue');   // WHERE is_kids = 'fooValue'
     * $query->filterByIsKids('%fooValue%', Criteria::LIKE); // WHERE is_kids LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isKids The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByIsKids($isKids = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isKids)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_IS_KIDS, $isKids, $comparison);
    }

    /**
     * Filter the query on the incl_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByInclOsDoneNumber('fooValue');   // WHERE incl_os_done_number = 'fooValue'
     * $query->filterByInclOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE incl_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $inclOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByInclOsDoneNumber($inclOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($inclOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_INCL_OS_DONE_NUMBER, $inclOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the incl_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByInclOsDoneAmount(1234); // WHERE incl_os_done_amount = 1234
     * $query->filterByInclOsDoneAmount(array(12, 34)); // WHERE incl_os_done_amount IN (12, 34)
     * $query->filterByInclOsDoneAmount(array('min' => 12)); // WHERE incl_os_done_amount > 12
     * </code>
     *
     * @param     mixed $inclOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByInclOsDoneAmount($inclOsDoneAmount = null, $comparison = null)
    {
        if (is_array($inclOsDoneAmount)) {
            $useMinMax = false;
            if (isset($inclOsDoneAmount['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($inclOsDoneAmount['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_INCL_OS_DONE_AMOUNT, $inclOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the foc_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByFocOsDoneNumber('fooValue');   // WHERE foc_os_done_number = 'fooValue'
     * $query->filterByFocOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE foc_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $focOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByFocOsDoneNumber($focOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($focOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_FOC_OS_DONE_NUMBER, $focOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the foc_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByFocOsDoneAmount(1234); // WHERE foc_os_done_amount = 1234
     * $query->filterByFocOsDoneAmount(array(12, 34)); // WHERE foc_os_done_amount IN (12, 34)
     * $query->filterByFocOsDoneAmount(array('min' => 12)); // WHERE foc_os_done_amount > 12
     * </code>
     *
     * @param     mixed $focOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByFocOsDoneAmount($focOsDoneAmount = null, $comparison = null)
    {
        if (is_array($focOsDoneAmount)) {
            $useMinMax = false;
            if (isset($focOsDoneAmount['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($focOsDoneAmount['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_FOC_OS_DONE_AMOUNT, $focOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the not_incl_os_done_number column
     *
     * Example usage:
     * <code>
     * $query->filterByNotInclOsDoneNumber('fooValue');   // WHERE not_incl_os_done_number = 'fooValue'
     * $query->filterByNotInclOsDoneNumber('%fooValue%', Criteria::LIKE); // WHERE not_incl_os_done_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notInclOsDoneNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByNotInclOsDoneNumber($notInclOsDoneNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notInclOsDoneNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_NUMBER, $notInclOsDoneNumber, $comparison);
    }

    /**
     * Filter the query on the not_incl_os_done_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByNotInclOsDoneAmount(1234); // WHERE not_incl_os_done_amount = 1234
     * $query->filterByNotInclOsDoneAmount(array(12, 34)); // WHERE not_incl_os_done_amount IN (12, 34)
     * $query->filterByNotInclOsDoneAmount(array('min' => 12)); // WHERE not_incl_os_done_amount > 12
     * </code>
     *
     * @param     mixed $notInclOsDoneAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByNotInclOsDoneAmount($notInclOsDoneAmount = null, $comparison = null)
    {
        if (is_array($notInclOsDoneAmount)) {
            $useMinMax = false;
            if (isset($notInclOsDoneAmount['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notInclOsDoneAmount['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL_OS_DONE_AMOUNT, $notInclOsDoneAmount, $comparison);
    }

    /**
     * Filter the query on the incl column
     *
     * Example usage:
     * <code>
     * $query->filterByIncl(1234); // WHERE incl = 1234
     * $query->filterByIncl(array(12, 34)); // WHERE incl IN (12, 34)
     * $query->filterByIncl(array('min' => 12)); // WHERE incl > 12
     * </code>
     *
     * @param     mixed $incl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByIncl($incl = null, $comparison = null)
    {
        if (is_array($incl)) {
            $useMinMax = false;
            if (isset($incl['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_INCL, $incl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($incl['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_INCL, $incl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_INCL, $incl, $comparison);
    }

    /**
     * Filter the query on the not_incl column
     *
     * Example usage:
     * <code>
     * $query->filterByNotIncl(1234); // WHERE not_incl = 1234
     * $query->filterByNotIncl(array(12, 34)); // WHERE not_incl IN (12, 34)
     * $query->filterByNotIncl(array('min' => 12)); // WHERE not_incl > 12
     * </code>
     *
     * @param     mixed $notIncl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByNotIncl($notIncl = null, $comparison = null)
    {
        if (is_array($notIncl)) {
            $useMinMax = false;
            if (isset($notIncl['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL, $notIncl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notIncl['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL, $notIncl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_NOT_INCL, $notIncl, $comparison);
    }

    /**
     * Filter the query on the foc column
     *
     * Example usage:
     * <code>
     * $query->filterByFoc(1234); // WHERE foc = 1234
     * $query->filterByFoc(array(12, 34)); // WHERE foc IN (12, 34)
     * $query->filterByFoc(array('min' => 12)); // WHERE foc > 12
     * </code>
     *
     * @param     mixed $foc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByFoc($foc = null, $comparison = null)
    {
        if (is_array($foc)) {
            $useMinMax = false;
            if (isset($foc['min'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FOC, $foc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($foc['max'])) {
                $this->addUsingAlias(BookingEventsTableMap::COL_FOC, $foc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookingEventsTableMap::COL_FOC, $foc, $comparison);
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByContactRelatedByAuthorId($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_AUTHOR_ID, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_AUTHOR_ID, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactRelatedByAuthorId() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactRelatedByAuthorId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinContactRelatedByAuthorId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactRelatedByAuthorId');

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
            $this->addJoinObject($join, 'ContactRelatedByAuthorId');
        }

        return $this;
    }

    /**
     * Use the ContactRelatedByAuthorId relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactRelatedByAuthorIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactRelatedByAuthorId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactRelatedByAuthorId', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingItems object
     *
     * @param \TheFarm\Models\BookingItems|ObjectCollection $bookingItems The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByBookingItems($bookingItems, $comparison = null)
    {
        if ($bookingItems instanceof \TheFarm\Models\BookingItems) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $bookingItems->getBookingItemId(), $comparison);
        } elseif ($bookingItems instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_BOOKING_ITEM_ID, $bookingItems->toKeyValue('PrimaryKey', 'BookingItemId'), $comparison);
        } else {
            throw new PropelException('filterByBookingItems() only accepts arguments of type \TheFarm\Models\BookingItems or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingItems relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinBookingItems($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingItems');

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
            $this->addJoinObject($join, 'BookingItems');
        }

        return $this;
    }

    /**
     * Use the BookingItems relation BookingItems object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingItemsQuery A secondary query class using the current class as primary query
     */
    public function useBookingItemsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBookingItems($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingItems', '\TheFarm\Models\BookingItemsQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByContactRelatedByCalledBy($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_CALLED_BY, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_CALLED_BY, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactRelatedByCalledBy() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactRelatedByCalledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinContactRelatedByCalledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactRelatedByCalledBy');

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
            $this->addJoinObject($join, 'ContactRelatedByCalledBy');
        }

        return $this;
    }

    /**
     * Use the ContactRelatedByCalledBy relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactRelatedByCalledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactRelatedByCalledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactRelatedByCalledBy', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByContactRelatedByCancelledBy($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_BY, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_CANCELLED_BY, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactRelatedByCancelledBy() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactRelatedByCancelledBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinContactRelatedByCancelledBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactRelatedByCancelledBy');

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
            $this->addJoinObject($join, 'ContactRelatedByCancelledBy');
        }

        return $this;
    }

    /**
     * Use the ContactRelatedByCancelledBy relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactRelatedByCancelledByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactRelatedByCancelledBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactRelatedByCancelledBy', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Contact object
     *
     * @param \TheFarm\Models\Contact|ObjectCollection $contact The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByContactRelatedByDeletedBy($contact, $comparison = null)
    {
        if ($contact instanceof \TheFarm\Models\Contact) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_DELETED_BY, $contact->getContactId(), $comparison);
        } elseif ($contact instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_DELETED_BY, $contact->toKeyValue('PrimaryKey', 'ContactId'), $comparison);
        } else {
            throw new PropelException('filterByContactRelatedByDeletedBy() only accepts arguments of type \TheFarm\Models\Contact or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContactRelatedByDeletedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinContactRelatedByDeletedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContactRelatedByDeletedBy');

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
            $this->addJoinObject($join, 'ContactRelatedByDeletedBy');
        }

        return $this;
    }

    /**
     * Use the ContactRelatedByDeletedBy relation Contact object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\ContactQuery A secondary query class using the current class as primary query
     */
    public function useContactRelatedByDeletedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinContactRelatedByDeletedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContactRelatedByDeletedBy', '\TheFarm\Models\ContactQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Facilities object
     *
     * @param \TheFarm\Models\Facilities|ObjectCollection $facilities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByFacilities($facilities, $comparison = null)
    {
        if ($facilities instanceof \TheFarm\Models\Facilities) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_FACILITY_ID, $facilities->getFacilityId(), $comparison);
        } elseif ($facilities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_FACILITY_ID, $facilities->toKeyValue('PrimaryKey', 'FacilityId'), $comparison);
        } else {
            throw new PropelException('filterByFacilities() only accepts arguments of type \TheFarm\Models\Facilities or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Facilities relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinFacilities($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Facilities');

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
            $this->addJoinObject($join, 'Facilities');
        }

        return $this;
    }

    /**
     * Use the Facilities relation Facilities object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\FacilitiesQuery A secondary query class using the current class as primary query
     */
    public function useFacilitiesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFacilities($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Facilities', '\TheFarm\Models\FacilitiesQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\Items object
     *
     * @param \TheFarm\Models\Items|ObjectCollection $items The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByItems($items, $comparison = null)
    {
        if ($items instanceof \TheFarm\Models\Items) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_ITEM_ID, $items->getItemId(), $comparison);
        } elseif ($items instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_ITEM_ID, $items->toKeyValue('PrimaryKey', 'ItemId'), $comparison);
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
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
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
     * Filter the query by a related \TheFarm\Models\EventStatus object
     *
     * @param \TheFarm\Models\EventStatus|ObjectCollection $eventStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByEventStatus($eventStatus, $comparison = null)
    {
        if ($eventStatus instanceof \TheFarm\Models\EventStatus) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_STATUS, $eventStatus->getStatusCd(), $comparison);
        } elseif ($eventStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_STATUS, $eventStatus->toKeyValue('PrimaryKey', 'StatusCd'), $comparison);
        } else {
            throw new PropelException('filterByEventStatus() only accepts arguments of type \TheFarm\Models\EventStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EventStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinEventStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EventStatus');

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
            $this->addJoinObject($join, 'EventStatus');
        }

        return $this;
    }

    /**
     * Use the EventStatus relation EventStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\EventStatusQuery A secondary query class using the current class as primary query
     */
    public function useEventStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEventStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EventStatus', '\TheFarm\Models\EventStatusQuery');
    }

    /**
     * Filter the query by a related \TheFarm\Models\BookingEventUsers object
     *
     * @param \TheFarm\Models\BookingEventUsers|ObjectCollection $bookingEventUsers the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookingEventsQuery The current query, for fluid interface
     */
    public function filterByBookingEventUsers($bookingEventUsers, $comparison = null)
    {
        if ($bookingEventUsers instanceof \TheFarm\Models\BookingEventUsers) {
            return $this
                ->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $bookingEventUsers->getEventId(), $comparison);
        } elseif ($bookingEventUsers instanceof ObjectCollection) {
            return $this
                ->useBookingEventUsersQuery()
                ->filterByPrimaryKeys($bookingEventUsers->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookingEventUsers() only accepts arguments of type \TheFarm\Models\BookingEventUsers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BookingEventUsers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function joinBookingEventUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BookingEventUsers');

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
            $this->addJoinObject($join, 'BookingEventUsers');
        }

        return $this;
    }

    /**
     * Use the BookingEventUsers relation BookingEventUsers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TheFarm\Models\BookingEventUsersQuery A secondary query class using the current class as primary query
     */
    public function useBookingEventUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookingEventUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BookingEventUsers', '\TheFarm\Models\BookingEventUsersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookingEvents $bookingEvents Object to remove from the list of results
     *
     * @return $this|ChildBookingEventsQuery The current query, for fluid interface
     */
    public function prune($bookingEvents = null)
    {
        if ($bookingEvents) {
            $this->addUsingAlias(BookingEventsTableMap::COL_EVENT_ID, $bookingEvents->getEventId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tf_booking_events table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookingEventsTableMap::clearInstancePool();
            BookingEventsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookingEventsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookingEventsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookingEventsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookingEventsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookingEventsQuery
