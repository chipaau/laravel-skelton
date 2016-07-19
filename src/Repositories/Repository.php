<?php

namespace Chipaau\Repositories;

use Illuminate\Container\Container;
use Chipaau\Database\Eloquent\Model;
use Chipaau\Repositories\RepositoryInterface;
use Chipaau\Repositories\RepositoryException;

/**
* Base repository
*/
abstract class Repository implements RepositoryInterface
{
    
    protected $container;
    protected $model;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->boot();
    }

    abstract protected function model();

    public function collection(callable $callback = null, array $columns = array('*'))
    {
        $query = $this->createQuery();
        if ($callback) {
            $query = $callback($query);
        } 
        return $query->get($columns);
    }

    public function paginate(array $paging = array(), callable $callback = null, array $columns = array('*'))
    {

    }

    public function item($id, array $with = array(), callable $callback = null)
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
}