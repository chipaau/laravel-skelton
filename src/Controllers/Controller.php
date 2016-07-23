<?php

namespace Chipaau\Controllers;

use Chipaau\Repositories\Repository;
use Chipaau\JsonApi\RequestException;
use Chipaau\Controllers\ControllerInterface;
use Chipaau\Repositories\RepositoryException;
use Chipaau\JsonApi\Request AS JsonApiRequest;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller AS IlluminateController;
use Neomerx\Limoncello\Contracts\Http\ResponsesInterface;
use Neomerx\Limoncello\Contracts\JsonApi\FactoryInterface;

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

    public function __construct(Container $container, ResponsesInterface $response, FactoryInterface $factory)
    {
        $this->container = $container;
        $this->response = $response;
        $this->factory = $factory;
        $this->boot();
    }

    abstract function setRepository();
    abstract function setRequest();

    /**
     * Display a listing of the resources.
     *
     * @return Response
     */
    public function index($resource = null)
    {
        $parameters = $this->getParameters();
        $data = $this->repository->setParameters($parameters)->getPaginatedCollection();
        return $this->json($data);

    }

    public function show($resourceId, $childResourceId = null)
    {

    }

    public function store($resourceId = null)
    {

    }

    public function update($resourceId, $childResourceId = null)
    {

    }

    public function destroy($resourceId, $childResourceId = null)
    {
        
    }

    /**
     * @return JsonApiRequest
     */
    protected function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return JsonApiRequest
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return JsonApiRequest
     */
    protected function getResponses()
    {
        return $this->response;
    }

    /**
     * @return Neomerx\Limoncello\Http\Reponses
     */
    protected function getRepository()
    {
        return $this->repository;
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

    public function getParameters()
    {
        $parameters = $this->getRequest()->getParameters();
        return [
            'include' => $parameters->getIncludePaths(),
            'fieldsets' => $parameters->getFieldSets(),
            'sort' => $parameters->getSortParameters(),
            'paging' => $parameters->getPaginationParameters(),
            'filtering' => $parameters->getFilteringParameters(),
            'unrecognized' => $parameters->getUnrecognizedParameters()
        ];
    }

    protected function json($data)
    {
        if ($data instanceof LengthAwarePaginator) {
            return $this->paginatedResponse($data);
        }

        return $this->getResponses()->getContentResponse($data);
    }

    protected function paginatedResponse(LengthAwarePaginator $paginator)
    {
        $request = $this->container->make(Request::class);
        $url     = $request->url();
        $query   = $request->query();
        $data  = $this->getFactory()->createPagingStrategy()->createPagedData($paginator, $url, true, $query);
        return $this->getResponses()->getPagedDataResponse($data);
    }
}