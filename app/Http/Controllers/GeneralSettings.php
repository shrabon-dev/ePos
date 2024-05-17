<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralSettings extends Controller
{
    // Tax List showing method
    public function tax(){
        $taxs = Tax::all();
        return view('backend.settings.tax.tax',compact('taxs'));
    }
    public function tax_store(Request $request){
         $request->validate([
            '*' => 'required',
        ]);
        Tax::create($request->except('_token'));
        return back()->with('status','Successfully created a new Tax');
    }
    public function site_setting(Request $request){
        $siteSettings = SiteSetting::all();
        if ($request->isMethod('post')) {
            // Update company name
            $companyNameSetting = $siteSettings->where('name', 'company_name')->first();
            $companyNameSetting->value = $request->company_name;
            $companyNameSetting->save();

            // Update mobile
            $mobileSetting = $siteSettings->where('name', 'mobile')->first();
            $mobileSetting->value = $request->mobile;
            $mobileSetting->save();

            // Update email
            $emailSetting = $siteSettings->where('name', 'email')->first();
            $emailSetting->value = $request->email;
            $emailSetting->save();
            // Update email
            if( $request->company_logo){
                $temp_addre = $request->file('company_logo');
                $orginal_name = $request->file('company_logo')->getClientOriginalName();
                $newName = time().$orginal_name;
                $temp_addre->storeAs('public/logo/',$newName);
                // return  $orginal_name;
                $company_logo = $siteSettings->where('name', 'company_logo')->first();
                $company_logo->value = $newName;
                $company_logo->save();
            }

            return view('backend.settings.site_setting',compact('siteSettings'));
        }
        $siteSettings = SiteSetting::all();
        return view('backend.settings.site_setting',compact('siteSettings'));
    }
    public function invoice_setting(){
        return view('backend.settings.invoice_setting');
    }
}
