<?php namespace App\Providers;

use Collective\Html\HtmlServiceProvider;

class FormMacroServiceProvider extends HtmlServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        \Form::macro('myField', function()
        {
            return '<input type="awesome">';
        });

    }

}