<?php

namespace Chipaau\JsonApi;


/**
* Abstract JsonApiRequest
*/
class AbstractRequest extends Request
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