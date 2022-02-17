<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'home']);

$routes->get('/posts/(:any)', 'Post::allPosts/$1', ['as' => 'posts']);
$routes->get('/post-details/(:num)/(:any)', 'Post::details/$1/$2', ['as' => 'details_post', 'filter' => 'auth']);

$routes->get('/post-create', 'Post::addPost', ['as' => 'add_post']);
$routes->post('/post-create', 'Post::savePost', ['as' => 'save_post']);

$routes->get('/post-edit/(:num)', 'Post::editPost/$1', ['as' => 'edit_post']);
$routes->put('/post-edit/(:num)', 'Post::updatePost/$1', ['as' => 'update_post']);

$routes->delete('/post-delete/(:num)', 'Post::deletePost/$1', ['as' => 'delete_post']);

$routes->group('auth', function ($routes) {
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::create', ['as' => 'create_user']);
    
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::loginValidate', ['as' => 'login_user']);

    $routes->get('profile', 'Auth::profile', ['as' => 'profile', 'filter' => 'auth']);
    $routes->post('profile', 'Auth::updateProfile', ['as' => 'update_profile_user']);

    $routes->get('logout','Auth::logout', ['as' => 'logout']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
