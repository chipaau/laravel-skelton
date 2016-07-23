<?php

namespace Chipaau\Controllers;

interface ControllerInterface {

    public function index($resource = null);
    public function show($resourceId, $childResourceId = null);
    public function store($resourceId = null);
    public function update($resourceId, $childResourceId = null);
    public function destroy($resourceId, $childResourceId = null);
}