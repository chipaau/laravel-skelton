<?php

namespace Chipaau\Repositories;

use Neomerx\JsonApi\Contracts\Encoder\Parameters\EncodingParametersInterface;

interface RepositoryInterface {
    public function getCollection(callable $callback = null);
    public function getPaginatedCollection(callable $callback = null);
    public function getItem($id, callable $callback = null);
    public function create(array $data = array());
    public function update($id, array $data = array(), callable $callback = null);
    public function delete($id, callable $callback = null);
    public function setParameters(array $parameters = array());
}