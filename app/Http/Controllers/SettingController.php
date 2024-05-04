<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\City;
use App\Models\CompanySettings;
use App\Models\Country;
use App\Models\Sex;
use App\Models\State;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    const UPLOAD_PATH = 'public/logos';

    public function index()
    {
        $genders = Sex::get();
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $user = User::find(auth()->user()->id);
        return view('settings.index', compact('genders', 'countries', 'states', 'cities', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function company()
    {
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        $company = CompanySettings::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
        return view('settings.company_settings', compact('countries', 'states', 'cities', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_companies(Request $request): RedirectResponse
    {
        try {
            $logo = $this->_procesarArchivo($request);
            $resultado = array_merge($request->post(), $logo);
            $company = CompanySettings::where('id', $request->id)->first();

            if (is_null($company)) {
                CompanySettings::create($resultado);
            } else {
                $company->update($resultado);
            }
            Artisan::call("config:cache");
            Toastr::success(__('added successfully'), 'Success');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return Redirect::back();
    }

    public function banks()
    {
        $banks = Banks::all();
        return view('settings.banks', compact('banks'));
    }

    public function separadorDirectorios($path)
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
    private function _procesarArchivo(Request $request)
    {
        $company = CompanySettings::where('id', $request->id)->first();
        if ($company) {
            $name1 = $company->site_logo;
            $name2 = $company->favicon;
            $name3 = $company->company_icon;
        }
        $request->validate([
            'site_logo' => 'file|image|max:2048',
            'favicon' => 'file|image|max:2048',
            'company_icon' => 'file|image|max:2048',
        ]);

        $ruta = self::UPLOAD_PATH;
        if ($request->hasFile('site_logo')) {
            $site_logo = $request->file('site_logo');
            $filename1 = date('Ymd') . '_' . $site_logo->getClientOriginalName();
            $name1 = str_replace(' ', '_', $filename1);
            $this->_eliminarArchivo($name1);
            $site_logo->storeAs($ruta, $name1);
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $filename2 = date('Ymd') . '_' . $favicon->getClientOriginalName();
            $name2 = str_replace(' ', '_', $filename2);
            $this->_eliminarArchivo($name2);
            $favicon->storeAs($ruta, $name2);
        }

        if ($request->hasFile('company_icon')) {
            $company_icon = $request->file('company_icon');
            $filename3 = date('Ymd') . '_' . $company_icon->getClientOriginalName();
            $name3 = str_replace(' ', '_', $filename3);
            $this->_eliminarArchivo($name3);
            $company_icon->storeAs($ruta, $name3);
        }
        $user_id = auth()->user()->id;
        $img = array('user_id' => $user_id, 'site_logo' => $name1, 'favicon' => $name2, 'company_icon' => $name3);
        return $img;
    }
    private function _eliminarArchivo($name)
    {
        $archivo = self::UPLOAD_PATH . '/' . $name;
        Storage::disk('public')->delete([$archivo]);
    }
}