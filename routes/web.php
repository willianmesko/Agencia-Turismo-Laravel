<?php

$this->group(['prefix' => 'panel', 'namespace' => 'Panel', 'middleware' => ['auth', 'admin']], function(){

    $this->any('brands/search', 'BrandController@search')->name('brands.search');
    $this->get('brands/{id}/planes', 'BrandController@planes')->name('brands.planes');
    $this->resource('brands', 'BrandController');

    $this->any('planes/search', 'PlaneController@search')->name('planes.search');
    $this->resource('planes', 'PlaneController');

    $this->post('states', 'StateController@search')->name('states.search');
    $this->get('states', 'StateController@index')->name('states.index');

    $this->any('state/{initials}/cities/search', 'CityController@search')->name('state.cities.search');
    $this->get('state/{initials}/cities', 'CityController@index')->name('state.cities');

    $this->any('flights/search', 'FlightController@search')->name('flights.search');
    $this->resource('flights', 'FlightController');

    $this->any('city/{id}/airports/search', 'AirportController@search')->name('aiports.search');
    $this->resource('city/{id}/airports', 'AirportController');

    $this->any('users/search', 'UserController@search')->name('users.search');
    $this->resource('users', 'UserController');

    $this->any('reserves/search', 'ReserveController@search')->name('reserves.search');
    $this->resource('reserves', 'ReserveController', [
        'except' => ['show', 'destroy']
    ]);    

    $this->get('/', 'PanelController@index')->name('panel');

});



$this->group(['middleware' => 'auth'], function(){
    $this->get('meu-perfil', 'Panel\UserController@myProfile')->name('my.profile');
    $this->post('atualizar-perfil', 'Panel\UserController@updateProfile')->name('update.profile');
    $this->get('sair', 'Panel\UserController@logout')->name('logout.user');

    $this->get('detalhes-compra/{idReserve}', 'Site\SiteController@purchaseDetail')->name('purchase.detail');
    $this->get('minhas-compras', 'Site\SiteController@myPurchases')->name('my.purchases');

    $this->get('detalhes-voo/{id}', 'Site\SiteController@detailsFlight')->name('details.flight');

    $this->post('reservar', 'Site\SiteController@reserveFlight')->name('reserve.flight');
});

$this->post('pesquisar', 'Site\SiteController@search')->name('search.flights.site');
$this->get('promocoes', 'Site\SiteController@promotions')->name('promotions');
$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
