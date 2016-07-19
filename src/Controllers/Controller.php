<?php

namespace Chipaau\Controllers;

use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Chipaau\Repositories\Repository;
use Chipaau\Controllers\ControllerInterface;
use Chipaau\Repositories\RepositoryException;
use Chipaau\JsonApi\Request AS JsonApiRequest;
use Chipaau\JsonApi\RequestException;
use Neomerx\Limoncello\Contracts\Http\ResponsesInterface;
use Illuminate\Routing\Controller AS IlluminateController;

/**
* Base controller
*/
abstract class Controller extends IlluminateController implements ControllerInterface
{
    /**
     * Illuminate Container
     * @var Container
     */
    protected $container;

    /**
     * Neomerx  JsonApiRequest
     * @var JsonApiRequest
     */
    protected $request;
    
    /**
     * repository class
     * @var Repository
     */
    protected $repository;

    public function __construct(Container $container, ResponsesInterface $response)
    {
        $this->container = $container;
        $this->response = $response;
        $this->boot();
    }

    abstract function setRepository();
    abstract function setRequest();

    /**
     * Display a listing of the resources.
     *
     * @return Response
     */
    public function index(Request $request, $resource = null)
    {
        dd('here controller', $this->response);
        $parameters = $this->getRequest()->getParameters();
        $data = $this->repository->collection();
        dd($data);
        //here its ok
        $pagedData = $this->callApiIndex($parameters);
        return $this->getResponses()->getPagedDataResponse($pagedData);
    }

    // public function index(Request $request, $resource = null)
    // {
    //     return $this->repository->collection();
    // }

    public function show($resourceId, $childResourceId = null)
    {

    }

    public function store(Request $request, $resourceId = null)
    {

    }

    public function update(Request $request, $resourceId, $childResourceId = null)
    {

    }

    public function destroy($resourceId, $childResourceId = null)
    {
        
    }

    /**
     * @return JsonApiRequest
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Repository
     * @throws RepositoryException
     */
    public function boot() 
    {
        $this->registerRepository();
        $this->registerRequest();
    }

    private function registerRepository()
    {
        $repository = $this->container->make($this->setRepository());
        if (!$repository instanceof Repository)
            throw new RepositoryException("Class {$this->setRepository()} must be an instance of Chipaau\\Repositories\\Repository");
        $this->repository = $repository;
    }

    private function registerRequest()
    {

        $request = $this->container->make($this->setRequest());
        if (!$request instanceof JsonApiRequest)
            throw new RequestException("Class {$this->setRequest()} must be an instance of Chipaau\\JsonApi\\Request");
        $this->request = $request;
    }
}