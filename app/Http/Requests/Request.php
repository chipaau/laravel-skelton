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
        $parentRules = parent::getParameterRules();
        $rules       = [
            self::RULE_ALLOWED_PAGING_PARAMS => [
                self::PARAM_PAGING_SIZE,
                self::PARAM_PAGING_NUMBER,
            ],
        ];
        $result = empty($parentRules) === true ? $rules : $rules + $parentRules;
        return $result;
    }
}