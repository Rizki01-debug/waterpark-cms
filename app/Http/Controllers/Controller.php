<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Import model perusahaan
use App\Models\CompanyProfile;
use App\Models\CompanyContact;
use App\Models\CompanySocial;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Kirim data global ke semua view Blade
        view()->composer('*', function ($view) {
            $view->with([
                'companyProfile' => CompanyProfile::first(),
                'companyContact' => CompanyContact::first(),
                'companySocial'  => CompanySocial::first(),
            ]);
        });
    }
}
