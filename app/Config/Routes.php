<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login', 'LoginController::index');
$routes->get('/register', 'LoginController::registerPage');

$routes->post('/login', 'LoginController::login');
$routes->post('/register', 'LoginController::register');

$routes->get('/logout', 'LoginController::logout');

$routes->group('notes', function($routes) {
    $routes->get('add', 'NotesController::addPage', ['as' => 'note-add']);
    $routes->get('edit/(:num)', 'NotesController::editPage/$1', ['as' => 'note-edit']);
    $routes->post('add', 'NotesController::add', ['as' => 'note-add']);
    $routes->post('edit/(:num)', 'NotesController::edit/$1', ['as' => 'note-edit']);
    $routes->get('delete/(:num)', 'NotesController::delete/$1', ['as' => 'note-delete']);
});
