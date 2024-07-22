<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 * '/test' => 'test#index',
 */
define('BASE', __DIR__);
define('TAREAS_JSON_PATH', __DIR__ . '/Tareas.json');
$routes = array(
    '/' => 'tarea#index',
    '/tarea' => 'tarea#index',
    '/tarea/add' => 'tarea#add',
    '/tarea/detalle' => 'tarea#detalle',
    '/tarea/edita' => 'tarea#edita',
    '/tarea/delete' => 'tarea#delete'
);

