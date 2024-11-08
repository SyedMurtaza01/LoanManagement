<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('submit')) {

                $request->validate([
                    'email' => 'required|email',
                    'light_logo' => 'nullable|file|mimes:jpg,png,jpeg',
                    'dark_logo' => 'nullable|file|mimes:jpg,png,jpeg',
                    'favicon_icon' => 'nullable|file|mimes:jpg,png,jpeg',
                    'phone_number' => 'nullable|string',
                    'address' => 'nullable|string',
                    'website_title' => 'nullable|string',
                    'footer_description' => 'nullable|string',
                ]);

                $setting = Setting::findOrFail(1);

                if ($request->hasFile('light_logo')) {
                    if ($setting->light_logo) {
                        if (file_exists(public_path('logos/' . $setting->light_logo))) {
                            unlink(public_path('logos/' . $setting->light_logo));
                        }
                    }
                    $lightLogo = $request->file('light_logo');
                    $lightLogoName = time() . '_light_' . $lightLogo->getClientOriginalName();
                    $lightLogo->move(public_path('logos'), $lightLogoName);
                    $setting->light_logo = $lightLogoName;
                }

                if ($request->hasFile('dark_logo')) {
                    if ($setting->dark_logo) {
                        if (file_exists(public_path('logos/' . $setting->dark_logo))) {
                            unlink(public_path('logos/' . $setting->dark_logo));
                        }
                    }
                    $darkLogo = $request->file('dark_logo');
                    $darkLogoName = time() . '_dark_' . $darkLogo->getClientOriginalName();
                    $darkLogo->move(public_path('logos'), $darkLogoName);
                    $setting->dark_logo = $darkLogoName;
                }

                if ($request->hasFile('footer_logo')) {
                    if ($setting->footer_logo) {
                        if (file_exists(public_path('logos/' . $setting->footer_logo))) {
                            unlink(public_path('logos/' . $setting->footer_logo));
                        }
                    }
                    $footer_logo = $request->file('footer_logo');
                    $footer_logoName = time() . '_footer_logo_' . $footer_logo->getClientOriginalName();
                    $footer_logo->move(public_path('logos'), $footer_logoName);
                    $setting->footer_logo = $footer_logoName;
                }

                 if ($request->hasFile('favicon_icon')) {
                    if ($setting->favicon_icon) {
                        if (file_exists(public_path('logos/' . $setting->favicon_icon))) {
                            unlink(public_path('logos/' . $setting->favicon_icon));
                        }
                    }
                    $favicon_icon = $request->file('favicon_icon');
                    $favicon_iconName = time() . '_favicon_icon_' . $favicon_icon->getClientOriginalName();
                    $favicon_icon->move(public_path('logos'), $favicon_iconName);
                    $setting->favicon_icon = $favicon_iconName;
                }

                $setting->update([
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'website_title' => $request->website_title,
                    'footer_description' => $request->footer_description,
                ]);

                return redirect()->back()->with('success', 'Settings updated successfully!');

        }
        $setting = "Setting";
        $web_setting = Setting::findOrFail(1);
        return view('admin.settings.index',compact('setting','web_setting'));
    }

}
