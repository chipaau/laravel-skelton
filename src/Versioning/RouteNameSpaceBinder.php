<?php 

namespace Chipaau\Versioning;

use Illuminate\Routing\Route;
use Chipaau\Versioning\ApiVersion;

/**
* Route namespace binder
*/
class RouteNameSpaceBinder
{
    protected $versioning;

    public function __construct(ApiVersion $apiVersion)
    {
        $this->versioning = $apiVersion;
    }

    public function changeBindings(Route $route)
    {
        if ($this->versioning->getVersion() === ApiVersion::DEFAULT_VERSION_NAMESPACE) return;
        $action = $route->getAction();
        $namespace = $action['namespace'] . '\\' . $this->versioning->getVersion();
        $action['uses'] = str_replace($action['namespace'], $namespace, $action['uses']);
        $action['controller'] = str_replace($action['namespace'], $namespace, $action['controller']);
        $action['namespace'] = $namespace;
        $route->setAction($action);
    }

}