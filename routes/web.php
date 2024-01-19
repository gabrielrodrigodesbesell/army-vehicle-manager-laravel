<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Grupos
    Route::delete('grupos/destroy', 'GruposController@massDestroy')->name('grupos.massDestroy');
    Route::post('grupos/parse-csv-import', 'GruposController@parseCsvImport')->name('grupos.parseCsvImport');
    Route::post('grupos/process-csv-import', 'GruposController@processCsvImport')->name('grupos.processCsvImport');
    Route::resource('grupos', 'GruposController');

    // Secoes
    Route::delete('secoes/destroy', 'SecoesController@massDestroy')->name('secoes.massDestroy');
    Route::post('secoes/parse-csv-import', 'SecoesController@parseCsvImport')->name('secoes.parseCsvImport');
    Route::post('secoes/process-csv-import', 'SecoesController@processCsvImport')->name('secoes.processCsvImport');
    Route::resource('secoes', 'SecoesController');

    // Veiculos
    Route::delete('veiculos/destroy', 'VeiculosController@massDestroy')->name('veiculos.massDestroy');
    Route::post('veiculos/media', 'VeiculosController@storeMedia')->name('veiculos.storeMedia');
    Route::post('veiculos/ckmedia', 'VeiculosController@storeCKEditorImages')->name('veiculos.storeCKEditorImages');
    Route::post('veiculos/parse-csv-import', 'VeiculosController@parseCsvImport')->name('veiculos.parseCsvImport');
    Route::post('veiculos/process-csv-import', 'VeiculosController@processCsvImport')->name('veiculos.processCsvImport');
    Route::resource('veiculos', 'VeiculosController');

    // Graduacao
    Route::delete('graduacaos/destroy', 'GraduacaoController@massDestroy')->name('graduacaos.massDestroy');
    Route::post('graduacaos/parse-csv-import', 'GraduacaoController@parseCsvImport')->name('graduacaos.parseCsvImport');
    Route::post('graduacaos/process-csv-import', 'GraduacaoController@processCsvImport')->name('graduacaos.processCsvImport');
    Route::resource('graduacaos', 'GraduacaoController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::post('asset-categories/parse-csv-import', 'AssetCategoryController@parseCsvImport')->name('asset-categories.parseCsvImport');
    Route::post('asset-categories/process-csv-import', 'AssetCategoryController@processCsvImport')->name('asset-categories.processCsvImport');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::post('asset-statuses/parse-csv-import', 'AssetStatusController@parseCsvImport')->name('asset-statuses.parseCsvImport');
    Route::post('asset-statuses/process-csv-import', 'AssetStatusController@processCsvImport')->name('asset-statuses.processCsvImport');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::post('task-statuses/parse-csv-import', 'TaskStatusController@parseCsvImport')->name('task-statuses.parseCsvImport');
    Route::post('task-statuses/process-csv-import', 'TaskStatusController@processCsvImport')->name('task-statuses.processCsvImport');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::post('task-tags/parse-csv-import', 'TaskTagController@parseCsvImport')->name('task-tags.parseCsvImport');
    Route::post('task-tags/process-csv-import', 'TaskTagController@processCsvImport')->name('task-tags.processCsvImport');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Io Pessoa
    Route::delete('io-pessoas/destroy', 'IoPessoaController@massDestroy')->name('io-pessoas.massDestroy');
    Route::post('io-pessoas/parse-csv-import', 'IoPessoaController@parseCsvImport')->name('io-pessoas.parseCsvImport');
    Route::post('io-pessoas/process-csv-import', 'IoPessoaController@processCsvImport')->name('io-pessoas.processCsvImport');
    Route::resource('io-pessoas', 'IoPessoaController');

    // Io Veiculo
    Route::delete('io-veiculos/destroy', 'IoVeiculoController@massDestroy')->name('io-veiculos.massDestroy');
    Route::post('io-veiculos/parse-csv-import', 'IoVeiculoController@parseCsvImport')->name('io-veiculos.parseCsvImport');
    Route::post('io-veiculos/process-csv-import', 'IoVeiculoController@processCsvImport')->name('io-veiculos.processCsvImport');
    Route::resource('io-veiculos', 'IoVeiculoController');
    
    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Codigo Qr
    Route::delete('codigo-qrs/destroy', 'CodigoQrController@massDestroy')->name('codigo-qrs.massDestroy');
    Route::post('codigo-qrs/parse-csv-import', 'CodigoQrController@parseCsvImport')->name('codigo-qrs.parseCsvImport');
    Route::post('codigo-qrs/process-csv-import', 'CodigoQrController@processCsvImport')->name('codigo-qrs.processCsvImport');
    Route::resource('codigo-qrs', 'CodigoQrController');
    Route::get('codigo-qrs/{id}/qrcode', 'CodigoQrController@showQrCode')->name('codigo-qrs.showQrCode');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
