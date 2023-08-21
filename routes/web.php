<?php

Route::any(config('softswiss.wallet_uri'), 'SoftswissController@webhook')
    ->name('softswiss.webhook');
