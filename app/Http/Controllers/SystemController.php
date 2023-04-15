<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Mail\EmailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Utility;
use Artisan;

class SystemController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('Store Settings')) {
            $settings = Utility::settings();
            $languages = Utility::languages();
            $EmailTemplates = EmailTemplate::all();
            return view('settings.index', compact('settings', 'languages','EmailTemplates'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('Store Settings')) {
            if($request->logo_dark)
            {
                $request->validate(
                    [
                        'logo_dark' => 'image|mimes:png|max:20480',
                    ]
                );
                $logoName = 'logo-dark.png';
                $dir = 'uploads/logo/';
                // $logo_dark         = $user->id.'_proposal_logo.png';

                // $path                 = $request->file('proposal_logo')->storeAs('/proposal_logo', $proposal_logo);

                $path = Utility::upload_file($request,'logo_dark',$logoName,$dir,[]);
                if($path['flag'] == 1){
                    $logo_dark = $path['url'];
                }else{
                    return redirect()->back()->with('error', __($path['msg']));
                }


                // $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);

                // $path     = $request->file('logo_dark')->storeAs('uploads/logo/', $logoName);
            }

            if($request->logo_light)
            {
                $request->validate(
                    [
                        'logo_light' => 'image|mimes:png|max:20480',
                    ]
                );
                $lightlogoName = 'logo-light.png';


                $dir = 'uploads/logo/';


                $path = Utility::upload_file($request,'logo_light',$lightlogoName,$dir,[]);
                if($path['flag'] == 1){
                    $logo_light = $path['url'];
                }else{
                    return redirect()->back()->with('error', __($path['msg']));
                }


                // $path     = $request->file('logo_light')->storeAs('uploads/logo/', $lightlogoName);
            }

            if($request->favicon)
            {
                $request->validate(
                    [
                        'favicon' => 'image|mimes:png|max:20480',
                    ]
                );
                $favicon = 'favicon.png';


                $dir = 'uploads/logo/';


                $path = Utility::upload_file($request,'favicon',$favicon,$dir,[]);
                if($path['flag'] == 1){
                    $favicon = $path['url'];
                }else{
                    return redirect()->back()->with('error', __($path['msg']));
                }

                // $path    = $request->file('favicon')->storeAs('uploads/logo/', $favicon);
            }

            $rules = [
                'app_name' => 'required|string|max:50',
                'default_language' => 'required|string|max:50',
                'footer_text' => 'required|string|max:50',
            ];

            $request->validate($rules);

            $arrEnv = [
                'APP_NAME' => $request->app_name,
                'DEFAULT_LANG' => $request->default_language,
                'FOOTER_TEXT' => $request->footer_text,
                'DISPLAY_LANDING' => $request->display_landing ?? 'off',
            ];

            Utility::setEnvironmentValue($arrEnv);


            // $settings = Utility::settings();
            // $post1['gdpr_cookie'] = (!empty($request->gdpr_cookie)) ? $request->gdpr_cookie : 'off' ;
            // $post1['cookie_text'] = $request->cookie_text;
            // $post1['color'] = $request->has('color') ? $request-> color : 'theme-3';
            // $post1['cust_theme_bg'] = (!empty($request->cust_theme_bg)) ? 'on' : 'off';
            // $post1['cust_darklayout'] = (!empty($request->cust_darklayout)) ? 'on' : 'off';
            // $post1['SITE_RTL'] = (!empty($request->SITE_RTL)) ? 'on' : 'off';

            // foreach ($post1 as $key => $data) {
            //     if (in_array($key, array_keys($settings))) {
            //         \DB::insert(
            //             'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
            //             [
            //                 $data,
            //                 $key,
            //                 \Auth::user()->getCreatedBy(),
            //             ]
            //         );
            //     }
            // }


            if (!empty($request->color) || !empty($request->cust_theme_bg) || !empty($request->cust_darklayout) || !empty($request->SITE_RTL) || !empty($request->gdpr_cookie) || !empty($request->disable_signup_button)) {
                $post1 = $request->all();
                if (!isset($request->cust_theme_bg)) {
                    $post1['cust_theme_bg'] = 'off';
                }
                if (!isset($request->cust_darklayout)) {
                    $post1['cust_darklayout'] = 'off';
                }

                if (!isset($request->gdpr_cookie)) {
                    $post1['gdpr_cookie'] = 'off';
                }

                $post1['cookie_text'] = $request->cookie_text;

                if (!isset($request->disable_signup_button)) {
                    $post1['disable_signup_button'] = 'off';
                }

                $post1['SITE_RTL'] = (!empty($request->SITE_RTL)) ? 'on' : 'off';

                unset($post1['_token'], $post1['logo_dark'], $post1['logo_light'], $post1['favicon']);
                $settings = Utility::settings();
                foreach ($post1 as $key => $data) {
                    if (in_array($key, array_keys($settings))) {
                        \DB::insert(
                            'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                            [
                                $data,
                                $key,
                                \Auth::user()->getCreatedBy(),
                            ]
                        );
                    }
                }
            }

            return redirect()->back()->with('success', __('Settings updated successfully.'));


            Artisan::call('config:cache');
            Artisan::call('config:clear');
            return redirect()->back()->with('success', __('Logo updated successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function recaptchaSettingStore(Request $request)
    {


        $user = \Auth::user();
        $rules = [];

        if ($request->recaptcha_module == 'yes') {
            $rules['google_recaptcha_key'] = 'required|string|max:50';
            $rules['google_recaptcha_secret'] = 'required|string|max:50';
        }

        $validator = \Validator::make(
            $request->all(),
            $rules
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $arrEnv = [
            'RECAPTCHA_MODULE' => $request->recaptcha_module ?? 'no',
            'NOCAPTCHA_SITEKEY' => $request->google_recaptcha_key,
            'NOCAPTCHA_SECRET' => $request->google_recaptcha_secret,
        ];

        if (Utility::setEnvironmentValue($arrEnv)) {
            return redirect()->back()->with('success', __('Recaptcha Settings updated successfully'));
        } else {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function saveGeneralSettings(Request $request)
    {
        if (Auth::user()->can('Store Settings')) {
            $post = [];
            if ($request->has('low_product_stock_threshold')) {
                $post['low_product_stock_threshold'] = $request->input('low_product_stock_threshold');
            }

            if (!empty($post) && count($post) > 0) {
                $created_at = $updated_at = date('Y-m-d H:i:s');

                foreach ($post as $key => $data) {
                    DB::insert(
                        'INSERT INTO settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`) ',
                        [
                            $data,
                            $key,
                            Auth::user()->getCreatedBy(),
                            $created_at,
                            $updated_at,
                        ]
                    );
                }
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'mail_driver' => 'required|string|max:50',
                    'mail_host' => 'required|string|max:50',
                    'mail_port' => 'required|string|max:50',
                    'mail_username' => 'required|string|max:50',
                    'mail_password' => 'required|string|max:255',
                    'mail_encryption' => 'required|string|max:50',
                    'mail_from_address' => 'required|string|max:50',
                    'mail_from_name' => 'required|string|max:50',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $env = [
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
                'FOOTER_LINK_1' => $request->footer_link_1,
                'FOOTER_LINK_2' => $request->footer_link_2,
                'FOOTER_LINK_3' => $request->footer_link_3,
                'FOOTER_VALUE_1' => $request->footer_value_1,
                'FOOTER_VALUE_2' => $request->footer_value_1,
                'FOOTER_VALUE_3' => $request->footer_value_1,
            ];

            Utility::setEnvironmentValue($env);

            return redirect()->back()->with('success', __('Settings updated successfully.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function saveSystemSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if ($request->has('system_settings') && $request->system_settings == 1) {

            unset($post['system_settings']);
        } else {

            $validator = Validator::make(
                $request->all(),
                [
                    'company_name' => 'required',
                    'company_email' => 'required',
                    'company_email_from_name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }
        }

        $created_at = $updated_at = date('Y-m-d H:i:s');
        foreach ($post as $key => $data) {
            DB::insert(
                'INSERT INTO settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`) ',
                [
                    $data,
                    $key,
                    Auth::user()->getCreatedBy(),
                    $created_at,
                    $updated_at,
                ]
            );
        }

        return redirect()->back()->with('success', __('Settings updated successfully.'));
    }
    public function saveTemplateSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if (isset($post['purchase_invoice_template']) && (!isset($post['purchase_invoice_color']) || empty($post['purchase_invoice_color']))) {
            $post['purchase_invoice_color'] = "ffffff";
        }

        if (isset($post['sale_invoice_template']) && (!isset($post['sale_invoice_color']) || empty($post['sale_invoice_color']))) {
            $post['sale_invoice_color'] = "ffffff";
        }

        if (isset($post['quotation_invoice_template']) && (!isset($post['quotation_invoice_color']) || empty($post['quotation_invoice_color']))) {
            $post['quotation_invoice_color'] = "ffffff";
        }

        $created_at = $updated_at = date('Y-m-d H:i:s');

        foreach ($post as $key => $data) {
            DB::insert(
                'INSERT INTO settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`) ',
                [
                    $data,
                    $key,
                    Auth::user()->getCreatedBy(),
                    $created_at,
                    $updated_at,
                ]
            );
        }

        if (isset($post['purchase_invoice_template'])) {
            return redirect()->back()->with('success', __('Purchase Invoice Setting updated successfully.'));
        }

        if (isset($post['sale_invoice_template'])) {
            return redirect()->back()->with('success', __('Sale Invoice Setting updated successfully'));
        }

        if (isset($post['quotation_invoice_template'])) {
            return redirect()->back()->with('success', __('Quotation Invoice Setting updated successfully'));
        }
    }

    public function saveInvoiceFooterSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        $created_at = $updated_at = date('Y-m-d H:i:s');

        foreach ($post as $key => $data) {
            DB::insert(
                'INSERT INTO settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`), `updated_at` = VALUES(`updated_at`) ',
                [
                    $data,
                    $key,
                    Auth::user()->getCreatedBy(),
                    $created_at,
                    $updated_at,
                ]
            );
        }

        return redirect()->back()->with('success', __('Invoice Footer Setting updated successfully'));
    }

    public function testEmail(Request $request)
    {
        $data = [];
        $data['mail_driver'] = $request->mail_driver;
        $data['mail_host'] = $request->mail_host;
        $data['mail_port'] = $request->mail_port;
        $data['mail_username'] = $request->mail_username;
        $data['mail_password'] = $request->mail_password;
        $data['mail_encryption'] = $request->mail_encryption;
        $data['mail_from_address'] = $request->mail_from_address;
        $data['mail_from_name'] = $request->mail_from_name;

        return view('users.test_email', compact('data'));
    }

    public function testEmailSend(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            // return redirect()->back()->with('error', $messages->first());
        }

        try {
            config([
                'mail.driver' => $request->mail_driver,
                'mail.host' => $request->mail_host,
                'mail.port' => $request->mail_port,
                'mail.encryption' => $request->mail_encryption,
                'mail.username' => $request->mail_username,
                'mail.password' => $request->mail_password,
                'mail.from.address' => $request->mail_from_address,
                'mail.from.name' => $request->mail_from_name,
            ]);
//            Mail::to($request->email)->send(new EmailTest());
        } catch (\Exception $e) {
            $smtp_error =__('E-Mail has been not sent due to SMTP configuration');
            return response()->json(
                ['is_success' => false,
                'message' => $smtp_error,
            ]);
        }
        return response()->json(['is_success' => true, 'message' => __('Email send Successfully')]);
    }


    public function storageSettingStore(Request $request)
    {

        if(isset($request->storage_setting) && $request->storage_setting == 'local')
        {

            $request->validate(
                [

                    'local_storage_validation' => 'required',
                    'local_storage_max_upload_size' => 'required',
                ]
            );

            $post['storage_setting'] = $request->storage_setting;
            $local_storage_validation = implode(',', $request->local_storage_validation);
            $post['local_storage_validation'] = $local_storage_validation;
            $post['local_storage_max_upload_size'] = $request->local_storage_max_upload_size;

        }

        if(isset($request->storage_setting) && $request->storage_setting == 's3')
        {
            $request->validate(
                [
                    's3_key'                  => 'required',
                    's3_secret'               => 'required',
                    's3_region'               => 'required',
                    's3_bucket'               => 'required',
                    's3_url'                  => 'required',
                    's3_endpoint'             => 'required',
                    's3_max_upload_size'      => 'required',
                    's3_storage_validation'   => 'required',
                ]
            );
            $post['storage_setting']            = $request->storage_setting;
            $post['s3_key']                     = $request->s3_key;
            $post['s3_secret']                  = $request->s3_secret;
            $post['s3_region']                  = $request->s3_region;
            $post['s3_bucket']                  = $request->s3_bucket;
            $post['s3_url']                     = $request->s3_url;
            $post['s3_endpoint']                = $request->s3_endpoint;
            $post['s3_max_upload_size']         = $request->s3_max_upload_size;
            $s3_storage_validation              = implode(',', $request->s3_storage_validation);
            $post['s3_storage_validation']      = $s3_storage_validation;
        }

        if(isset($request->storage_setting) && $request->storage_setting == 'wasabi')
        {
            $request->validate(
                [
                    'wasabi_key'                    => 'required',
                    'wasabi_secret'                 => 'required',
                    'wasabi_region'                 => 'required',
                    'wasabi_bucket'                 => 'required',
                    'wasabi_url'                    => 'required',
                    'wasabi_root'                   => 'required',
                    'wasabi_max_upload_size'        => 'required',
                    'wasabi_storage_validation'     => 'required',
                ]
            );
            $post['storage_setting']            = $request->storage_setting;
            $post['wasabi_key']                 = $request->wasabi_key;
            $post['wasabi_secret']              = $request->wasabi_secret;
            $post['wasabi_region']              = $request->wasabi_region;
            $post['wasabi_bucket']              = $request->wasabi_bucket;
            $post['wasabi_url']                 = $request->wasabi_url;
            $post['wasabi_root']                = $request->wasabi_root;
            $post['wasabi_max_upload_size']     = $request->wasabi_max_upload_size;
            $wasabi_storage_validation          = implode(',', $request->wasabi_storage_validation);
            $post['wasabi_storage_validation']  = $wasabi_storage_validation;
        }

        foreach($post as $key => $data)
        {

            $arr = [
                $data,
                $key,
                \Auth::user()->id,
            ];

            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', $arr
            );
        }

        return redirect()->back()->with('success', 'Storage setting successfully updated.');

    }
}
