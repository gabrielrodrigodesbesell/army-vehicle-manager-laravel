<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Grupos
    Route::apiResource('grupos', 'GruposApiController');

    // Secoes
    Route::apiResource('secoes', 'SecoesApiController');

    // Veiculos
    Route::post('veiculos/media', 'VeiculosApiController@storeMedia')->name('veiculos.storeMedia');
    Route::apiResource('veiculos', 'VeiculosApiController');

    // Graduacao
    Route::apiResource('graduacaos', 'GraduacaoApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Status
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Codigo Qr
    Route::apiResource('codigo-qrs', 'CodigoQrApiController');

    // Io Pessoa
    Route::apiResource('io-pessoas', 'IoPessoaApiController');

    // Io Veiculo
    Route::apiResource('io-veiculos', 'IoVeiculoApiController');
});
