<?php
$app->group(['prefix' => 'api/v1/'], function() use($app){

    $app->post('transaction', ['uses' => 'TransactionController@save']);

});
