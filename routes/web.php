<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "JDIH WEB API Interface";
});

$router->group(['prefix' => '/api/v1/'], function () use ($router) {
    $router->get('news', ['as' => 'news', 'uses' => 'NewsController@get']);
    $router->get('news/{id}', ['as' => 'newsDetail', 'uses' => 'NewsController@detail']);
    $router->get('produk-hukum', ['as' => 'produkHukum', 'uses' => 'ProdukHukumController@produk']);
    $router->get('produk-hukum/category', ['as' => 'produkHukumCategory', 'uses' => 'ProdukHukumController@produkByCategory']);
    $router->get('produk-hukum/{id}', ['as' => 'produkHukumCategoryById', 'uses' => 'ProdukHukumController@produkById']);
    $router->get('informasi-hukum', ['as' => 'infoHukum', 'uses' => 'ProdukHukumController@informasi']);
    $router->get('informasi-hukum/category', ['as' => 'infoHukumCategory', 'uses' => 'ProdukHukumController@produkByCategory']);
    $router->get('informasi-hukum/{id}', ['as' => 'informasiHukumCategoryById', 'uses' => 'ProdukHukumController@produkById']);
    $router->get('category', ['as' => 'category', 'uses' => 'KategoriController@get']);
    $router->get('category/produk-hukum', ['as' => 'categoryProduk', 'uses' => 'KategoriController@getProdukHukum']);
    $router->get('category/informasi-hukum', ['as' => 'categoryInformasi', 'uses' => 'KategoriController@getInformasiHukum']);
    $router->get('category/{id}', ['as' => 'categoryById', 'uses' => 'KategoriController@getById']);
});

