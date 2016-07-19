<?php

namespace Chipaau\Controllers;

use Illuminate\Http\Request;

interface ControllerInterface {

    public function index(Request $request, $resource = null);
    public function show($resourceId, $childResourceId = null);
    public function store(Request $request, $resourceId = null);
    public function update(Request $request, $resourceId, $childResourceId = null);
    public function destroy($resourceId, $childResourceId = null);
}