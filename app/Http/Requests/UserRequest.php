<?php namespace App\Http\Requests;

use Neomerx\Limoncello\Errors\ErrorCollection;
use App\User as Model;
use App\Schemas\UserSchema as Schema;

/**
 * @package Neomerx\LimoncelloIlluminate
 */
class UserRequest extends Request
{
    /** Related schema class */
    const SCHEMA = Schema::class;

    protected function includeParameters()
    {
        return array('comments');
    }

    /**
     * Validate input for 'store' action.
     *
     * @param ErrorCollection $errors
     *
     * @return void
     */
    protected function validateOnPost(ErrorCollection $errors)
    {
        $this->validateData([
            Schema::KEYWORD_ID => $this->getId(),
        ], [
            Schema::KEYWORD_ID => 'required|unique:' . Model::TABLE_NAME . ',' . Model::FIELD_ID,
        ], $errors);

        $this->validateAttributes([
            Schema::ATTR_NAME => 'required|max:' . Model::LENGTH_NAME,
        ], $errors);
    }

    /**
     * Validate input for 'update' action.
     *
     * @param ErrorCollection $errors
     *
     * @return void
     */
    protected function validateOnPatch(ErrorCollection $errors)
    {
        $this->validateData([
            Schema::KEYWORD_ID => $this->getId(),
        ], [
            Schema::KEYWORD_ID => 'required|exists:' . Model::TABLE_NAME . ',' . Model::FIELD_ID,
        ], $errors);

        $this->validateAttributes([
            Schema::ATTR_NAME => 'required|max:' . Model::LENGTH_NAME,
        ], $errors);
    }
}