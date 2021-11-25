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
    $router->get('news', ['uses' => 'NewsController@get']);
    $router->get('news/{id}', ['uses' => 'NewsController@detail']);
    $router->get('produk-hukum', ['uses' => 'ProdukHukumController@produk']);
    $router->get('produk-hukum/search', ['uses' => 'ProdukHukumController@produkSearch']);
    $router->get('produk-hukum/category', ['uses' => 'ProdukHukumController@produkByCategory']);
    $router->get('produk-hukum/category/search', ['uses' => 'ProdukHukumController@produkSearchByCategory']);
    $router->get('produk-hukum/{id}', ['uses' => 'ProdukHukumController@produkById']);
    $router->get('produk-hukum/menaker/count', ['uses' => 'ProdukHukumController@countPermenaker']);
    $router->get('produk-hukum/perbp2mi/count', ['uses' => 'ProdukHukumController@countPerBp2mi']);
    $router->get('produk-hukum/kepka/count', ['uses' => 'ProdukHukumController@countKepka']);
    $router->get('produk-hukum/se/count', ['uses' => 'ProdukHukumController@countSEKepala']);
    $router->get('informasi-hukum', ['uses' => 'ProdukHukumController@informasi']);
    $router->get('informasi-hukum/search', ['uses' => 'ProdukHukumController@informasiSearch']);
    $router->get('informasi-hukum/category', ['uses' => 'ProdukHukumController@produkByCategory']);
    $router->get('informasi-hukum/{id}', ['uses' => 'ProdukHukumController@produkById']);
    $router->get('category', ['uses' => 'KategoriController@get']);
    $router->get('category/produk-hukum', ['uses' => 'KategoriController@getProdukHukum']);
    $router->get('category/informasi-hukum', ['uses' => 'KategoriController@getInformasiHukum']);
    $router->get('category/{id}', ['uses' => 'KategoriController@getById']);
    $router->get('faq', ['uses' => 'FaqController@get']);
    $router->post('konsultasi', ['uses' => 'KonsultasiController@create']);
    $router->get('konsultasi/testmail', ['uses' => 'KonsultasiController@test']);
    $router->get('rating', ['uses' => 'RatingController@find']);
    $router->post('rating', ['uses' => 'RatingController@create']);
    $router->get('upt', ['uses' => 'UptController@get']);
});

