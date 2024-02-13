<?php

namespace App\Http\Routing;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Routing\Route;

class ResourceRegistrar extends BaseResourceRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = [
        'list', 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy',
    ];


    /**
     * Add the list method for a resourceful route.
     *
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    public function addResourceList(string $name, string $base, string $controller, array $options): Route
    {
        $uri = $this->getResourceUri($name).'/data';

        $action = $this->getResourceAction($name, $controller, 'data', $options);

        return $this->router->get($uri, $action);
    }
}
