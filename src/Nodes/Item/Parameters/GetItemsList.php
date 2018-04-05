<?php

namespace Shopee\Nodes\Item\Parameters;

use Shopee\RequestParameters;

class GetItemsList extends RequestParameters
{
    protected $parameters = [
        'pagination_offset' => 0,
        'pagination_entries_per_page' => 100,
    ];

    public function getPaginationOffset(): int
    {
        return $this->parameters['pagination_offset'];
    }

    /**
     * Specifies the starting entry of data to return in the current call.
     * Default is 0. if data is more than one page, the offset can be some entry to start next call.
     *
     * @param int $offset uint32
     * @return $this
     */
    public function setPaginationOffset(int $offset)
    {
        $this->parameters['pagination_offset'] = $offset;

        return $this;
    }

    public function getPaginationEntriesPerPage(): int
    {
        return $this->parameters['pagination_entries_per_page'];
    }

    /**
     * If many items are available to retrieve, you may need to call GetItemsList multiple times to retrieve all the
     * data. Each result set is returned as a page of entries. Use the Pagination filters to control the maximum number
     * of entries (<= 100) to retrieve per page (i.e., per call), the offset number to start next call.
     * This integer value is usUed to specify the maximum number of entries to return in a single ""page"" of data.
     *
     * @param int $perPage uint32
     * @return $this
     */
    public function setPaginationEntriesPerPage(int $perPage = 100)
    {
        $this->parameters['pagination_entries_per_page'] = $perPage;

        return $this;
    }

    public function getUpdateTimeFrom(): ?int
    {
        return $this->parameters['update_time_from'];
    }

    /**
     * The update_time_from and update_time_to fields specify a date range for retrieving orders (based on the item
     * update time). The update_time_from field is the starting date range. The maximum date range that may be specified
     * with the update_time_from and update_time_to fields is 15 days.
     *
     * @param int $timestamp
     * @return $this
     */
    public function setUpdateTimeFrom(int $timestamp)
    {
        $this->parameters['update_time_from'] = $timestamp;

        return $this;
    }

    public function getUpdateTimeTo(): ?int
    {
        return $this->parameters['update_time_to'];
    }

    /**
     * The update_time_from and update_time_to fields specify a date range for retrieving orders (based on the item
     * update time). The update_time_to field is the ending date range. The maximum date range that may be specified
     * with the update_time_from and update_time_to fields is 15 days.
     *
     * @param int $timestamp
     * @return $this
     */
    public function setUpdateTimeTo(int $timestamp)
    {
        $this->parameters['update_time_to'] = $timestamp;

        return $this;
    }
}
