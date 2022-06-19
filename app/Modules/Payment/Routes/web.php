<?php

Route::group([
    'middleware' => 'web'
], function () {

    Route::post('/click/prepare', function (\Illuminate\Http\Request $request) {
        return Payment::getGateway('click')->prepare($request);
    });

    Route::post('/click/complete', function (\Illuminate\Http\Request $request) {
        return Payment::getGateway('click')->complete($request);
    });

    Route::post('/payme/process', function (\Illuminate\Http\Request $request) {
        return Payment::getGateway('payme')->process($request);
    });

    Route::post('/apelsin/process', function (\Illuminate\Http\Request $request) {
        return Payment::getGateway('apelsin')->process($request);
    });

});