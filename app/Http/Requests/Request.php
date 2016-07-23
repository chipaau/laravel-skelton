<?php

namespace App\Http\Requests;

use Chipaau\JsonApi\Request AS JsonApiRequest;
use Chipaau\Repositories\Repository;

/**
* Abstract JsonApiRequest
*/
class Request extends JsonApiRequest
{

    /**
     * @inheritdoc
     */
    protected function getParameterRules()
    {
        $rules = array();
        if (!empty($this->pagingParameters())) {
            $rules[self::RULE_ALLOWED_PAGING_PARAMS] = $this->pagingParameters();
        }

        if (!empty($this->unrecognizedParameters())) {
            $rules[self::RULE_ALLOW_UNRECOGNIZED] = $this->unrecognizedParameters();
        }

        if (!empty($this->includeParameters())) {
            $rules[self::RULE_ALLOWED_INCLUDE_PATHS] = $this->includeParameters();
        }

        if (!empty($this->fieldSetParameters())) {
            $rules[self::RULE_ALLOWED_FIELD_SET_TYPES] = $this->fieldSetParameters();
        }
        
        if (!empty($this->sortFieldParameters())) {
            $rules[self::RULE_ALLOWED_SORT_FIELDS] = $this->sortFieldParameters();
        }

        if (!empty($this->filteringParameters())) {
            $rules[self::RULE_ALLOWED_FILTERING_PARAMS] = $this->filteringParameters();
        }
        
        return $rules;
    }

    protected function pagingParameters()
    {
        return [
            Repository::PARAM_PAGING_SIZE,
            Repository::PARAM_PAGING_NUMBER
        ];
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