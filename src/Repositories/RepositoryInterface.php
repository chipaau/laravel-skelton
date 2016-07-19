<?php

namespace Chipaau\Repositories;

interface RepositoryInterface {
    public function collection(callable $callback = null, array $columns = array('*'));
    public function paginate(array $paging = array(), callable $callback = null, array $columns = array('*'));
    public function item($id, array $with = array(), callable $callback = null);
    public function create(array $data = array());
    public function update($id, array $data = array(), callable $callback = null);
    public function delete($id, callable $callback = null);
}