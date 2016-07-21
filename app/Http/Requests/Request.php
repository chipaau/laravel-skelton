<?php

namespace App\Http\Requests;

use Chipaau\JsonApi\Request AS JsonApiRequest;

/**
* Abstract JsonApiRequest
*/
class Request extends JsonApiRequest
{
    
    /** Query parameter */
    const PARAM_PAGING_SIZE = 'size';
    /** Query parameter */
    const PARAM_PAGING_NUMBER = 'number';

    /**
     * @inheritdoc
     */
    protected function getParameterRules()
    {
        return [
            self::RULE_ALLOWED_PAGING_PARAMS => $this->pagingParameters(),
            self::RULE_ALLOW_UNRECOGNIZED => $this->unrecognizedParameters(),
            self::RULE_ALLOWED_INCLUDE_PATHS => $this->includeParameters(),
            self::RULE_ALLOWED_FIELD_SET_TYPES => $this->fieldSetParameters(),
            self::RULE_ALLOWED_SORT_FIELDS => $this->sortFieldParameters(),
            self::RULE_ALLOWED_FILTERING_PARAMS => $this->filteringParameters(),
        ];
    }

    protected function getPagingParameters()
    {
        return [
            self::PARAM_PAGING_SIZE,
            self::PARAM_PAGING_NUMBER
        ];
    }

    protected function pagingParameters()
    {
        return array();
    }

    protected function unrecognizedParameters()
    {
        return array();
    }

    protected function includeParameters()
    {
        return array();
    }

    protected function fieldSetParameters()
    {
        return array();
    }

    protected function sortFieldParameters()
    {
        return array();
    }

    protected function filteringParameters()
    {
        return array();
    }

}