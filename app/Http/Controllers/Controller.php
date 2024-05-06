<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

use App\Models\CompanySettings;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $company = CompanySettings::orderBy('id', 'desc')->first();

        if ($company) {

            Session::put('name', $company->name);
            Session::put('favicon', $company->favicon);
            Session::put('logo', $company->site_logo);
            Session::put('company_icon', $company->company_icon);


            // $this->set_language('es'); // Default language is Spanish.
        }
    }

    public function set_language($language)
    {
        putenv('APP_LOCALE=' . $language);
        Session::put('language', $language);

        Artisan::call("config:cache");
        return redirect()->back();
    }
}
