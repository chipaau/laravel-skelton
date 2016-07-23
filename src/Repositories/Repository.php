<?php

namespace Chipaau\Repositories;

use Illuminate\Container\Container;
use Chipaau\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Chipaau\Repositories\RepositoryInterface;
use Chipaau\Repositories\RepositoryException;

/**
* Base repository
*/
abstract class Repository implements RepositoryInterface
{
    const PARAM_PAGING_SIZE = 'size';
    const PARAM_PAGING_NUMBER = 'number';
    const MAX_PAGE_SIZE = 30;

    protected $container;
    protected $model;
    protected $parameters;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->boot();
    }

    abstract protected function model();

    public function getCollection(callable $callback = null)
    {
        $query = $this->createQuery();
        if ($callback) {
            $query = $callback($query);
        } 
        return $query->get($this->getFieldSets());
    }

    public function getPaginatedCollection(callable $callback = null)
    {
        $query = $this->createQuery();
        if ($callback) {
            $query = $callback($query);
        } 
        return $this->paginateBuilder($query);
    }

        /**
     * @param Builder                     $builder
     * @param EncodingParametersInterface $parameters
     *
     * @return PagedDataInterface
     */
    protected function paginateBuilder(Builder $builder)
    {
        return $builder->paginate($this->getPageSize(), $this->getFieldSets(), 'page', $this->getPageNumber());
    }

    public function getItem($id, callable $callback = null)
    {

    }

    public function create(array $data = array())
    {

    }

    public function update($id, array $data = array(), callable $callback = null)
    {

    }

    public function delete($id, callable $callback = null)
    {

    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function boot() {
        $model = $this->container->make($this->model());
        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Chipaau\\Database\\Eloquent\\Model");
        $this->model = $model;
    }

    public function createQuery()
    {
        return $this->model->newQuery();
    }

    public function setParameters(array $parameters = array())
    {
        $this->parameters = $parameters;
        return $this;
    }

    public function getParameters($key = null)
    {
        $parameters = $this->parameters;
        if (!is_null($key) && isset($parameters[$key])) {
            $parameters = $parameters[$key];
        }

        return $parameters;
    }

    public function getFieldSets()
    {
        $value = array('*');
        if (isset($this->parameters['fieldsets']) && !empty($this->parameters['fieldsets'])) {
            $value = $this->parameters['fieldsets'];
        }

        return $value;
    }

    public function getPagingParameter($key = null, $default = null)
    {
        $paging = $this->getParameters('paging');
        if (is_null($key)) {
            return $paging;
        }

        $value = $default;
        if (empty($paging) === false && array_key_exists($key, $paging) === true) {
            $tmp   = (int)$paging[$key];
            $value = $tmp < 0 || $tmp > static::MAX_PAGE_SIZE ? static::MAX_PAGE_SIZE : $tmp;
        }
        return $value;
    }

        /**
     * @param EncodingParametersInterface|null $parameters
     *
     * @return int
     */
    protected function getPageSize()
    {
        return $this->getPagingParameter(self::PARAM_PAGING_SIZE, static::MAX_PAGE_SIZE);
    }

    /**
     * @param EncodingParametersInterface|null $parameters
     *
     * @return int|null
     */
    protected function getPageNumber()
    {
        return $this->getPagingParameter(self::PARAM_PAGING_NUMBER, null);
    }
}