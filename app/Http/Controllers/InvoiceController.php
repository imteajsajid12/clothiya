<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Language;
use App\Models\Order;
use Session;
use PDF;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class InvoiceController extends Controller
{
    //download invoice
    public function invoice_download($id)
    {

        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code');
        } else {
            $currency_code = Currency::findOrFail(get_setting('system_default_currency'))->code;
        }
        $language_code = Session::get('locale', Config::get('app.locale'));

        if (Language::where('code', $language_code)->first()->rtl == 1) {
            $direction = 'rtl';
            $text_align = 'right';
            $not_text_align = 'left';
        } else {
            $direction = 'ltr';
            $text_align = 'left';
            $not_text_align = 'right';
        }

        if (
            $currency_code == 'BDT' ||
            $language_code == 'bd'
        ) {
            // bengali font
            $font_family = "'Hind Siliguri','freeserif'";
        } elseif (
            $currency_code == 'KHR' ||
            $language_code == 'kh'
        ) {
            // khmer font
            $font_family = "'Hanuman','sans-serif'";
        } elseif ($currency_code == 'AMD') {
            // Armenia font
            $font_family = "'arnamu','sans-serif'";
            // }elseif($currency_code == 'ILS'){
            //     // Israeli font
            //     $font_family = "'Varela Round','sans-serif'";
        } elseif (
            $currency_code == 'AED' ||
            $currency_code == 'EGP' ||
            $language_code == 'sa' ||
            $currency_code == 'IQD' ||
            $language_code == 'ir' ||
            $language_code == 'om' ||
            $currency_code == 'ROM' ||
            $currency_code == 'SDG' ||
            $currency_code == 'ILS' ||
            $language_code == 'jo'
        ) {
            // middle east/arabic/Israeli font
            $font_family = "xbriyaz";
        } elseif ($currency_code == 'THB') {
            // thai font
            $font_family = "'Kanit','sans-serif'";
        } elseif (
            $currency_code == 'CNY' ||
            $language_code == 'zh'
        ) {
            // Chinese font
            $font_family = "'sun-exta','gb'";
        } elseif (
            $currency_code == 'MMK' ||
            $language_code == 'mm'
        ) {
            // Myanmar font
            $font_family = 'tharlon';
        } elseif (
            $currency_code == 'THB' ||
            $language_code == 'th'
        ) {
            // Thai font
            $font_family = "'zawgyi-one','sans-serif'";
        } elseif (
            $currency_code == 'USD'
        ) {
            // Thai font
            $font_family = "'Roboto','sans-serif'";
        } else {
            // general for all
            $font_family = "freeserif";
        }

        // $config = ['instanceConfigurator' => function($mpdf) {
        //     $mpdf->showImageErrors = true;
        // }];
        // mpdf config will be used in 4th params of loadview

        $config = [];

        $order = Order::findOrFail($id);
        return PDF::loadView('backend.invoices.invoice', [
            'order' => $order,
            'font_family' => $font_family,
            'direction' => $direction,
            'text_align' => $text_align,
            'not_text_align' => $not_text_align
        ], [], $config)->download('order-' . $order->code . '.pdf');
    }



    //download select invoice
    public function select_invoice_download(Request $request)
    {



        //dd($request->all());
       if(!isset($request->selected_items)){
           return back();
       }
        $products = Order::whereIn('id', $request->selected_items)->get();
        //return view('backend.invoices.pikuplist', [
        //    'order' => $products
        //]);
        //dd($products);
        if (Session::has('currency_code')) {
            $currency_code = Session::get('currency_code');
        } else {
            $currency_code = Currency::findOrFail(get_setting('system_default_currency'))->code;
        }
        $language_code = Session::get('locale', Config::get('app.locale'));

        if (Language::where('code', $language_code)->first()->rtl == 1) {
            $direction = 'rtl';
            $text_align = 'right';
            $not_text_align = 'left';
        } else {
            $direction = 'ltr';
            $text_align = 'left';
            $not_text_align = 'right';
        }

        if (
            $currency_code == 'BDT' ||
            $language_code == 'bd'
        ) {
            // bengali font
            $font_family = "'Hind Siliguri','freeserif'";
        } elseif (
            $currency_code == 'KHR' ||
            $language_code == 'kh'
        ) {
            // khmer font
            $font_family = "'Hanuman','sans-serif'";
        } elseif ($currency_code == 'AMD') {
            // Armenia font
            $font_family = "'arnamu','sans-serif'";
            // }elseif($currency_code == 'ILS'){
            //     // Israeli font
            //     $font_family = "'Varela Round','sans-serif'";
        } elseif (
            $currency_code == 'AED' ||
            $currency_code == 'EGP' ||
            $language_code == 'sa' ||
            $currency_code == 'IQD' ||
            $language_code == 'ir' ||
            $language_code == 'om' ||
            $currency_code == 'ROM' ||
            $currency_code == 'SDG' ||
            $currency_code == 'ILS' ||
            $language_code == 'jo'
        ) {
            // middle east/arabic/Israeli font
            $font_family = "xbriyaz";
        } elseif ($currency_code == 'THB') {
            // thai font
            $font_family = "'Kanit','sans-serif'";
        } elseif (
            $currency_code == 'CNY' ||
            $language_code == 'zh'
        ) {
            // Chinese font
            $font_family = "'sun-exta','gb'";
        } elseif (
            $currency_code == 'MMK' ||
            $language_code == 'mm'
        ) {
            // Myanmar font
            $font_family = 'tharlon';
        } elseif (
            $currency_code == 'THB' ||
            $language_code == 'th'
        ) {
            // Thai font
            $font_family = "'zawgyi-one','sans-serif'";
        } elseif (
            $currency_code == 'USD'
        ) {
            // Thai font
            $font_family = "'Roboto','sans-serif'";
        } else {
            // general for all
            $font_family = "freeserif";
        }

        // $config = ['instanceConfigurator' => function($mpdf) {
        //     $mpdf->showImageErrors = true;
        // }];
        // mpdf config will be used in 4th params of loadview

        $config = [];
    //  foreach ($request->selected_items as $key => $value) {
          
        //$order = Order::findOrFail($value);
        return view('backend.invoices.pikuplist', [
            'order' => $products,
            'font_family' => $font_family,
            'direction' => $direction,
            'text_align' => $text_align,
            'not_text_align' => $not_text_align
        ], [], $config);
}   
    
        // public function bulk_invoice_download(Request $request){
        //     if (Session::has('currency_code')) {
        //         $currency_code = Session::get('currency_code');
        //     } else {
        //         $currency_code = Currency::findOrFail(get_setting('system_default_currency'))->code;
        //     }
        //     $language_code = Session::get('locale', Config::get('app.locale'));
    
        //     if (Language::where('code', $language_code)->first()->rtl == 1) {
        //         $direction = 'rtl';
        //         $text_align = 'right';
        //         $not_text_align = 'left';
        //     } else {
        //         $direction = 'ltr';
        //         $text_align = 'left';
        //         $not_text_align = 'right';
        //     }
    
        //     if (
        //         $currency_code == 'BDT' ||
        //         $language_code == 'bd'
        //     ) {
        //         // bengali font
        //         $font_family = "'Hind Siliguri','freeserif'";
        //     } elseif (
        //         $currency_code == 'KHR' ||
        //         $language_code == 'kh'
        //     ) {
        //         // khmer font
        //         $font_family = "'Hanuman','sans-serif'";
        //     } elseif ($currency_code == 'AMD') {
        //         // Armenia font
        //         $font_family = "'arnamu','sans-serif'";
        //         // }elseif($currency_code == 'ILS'){
        //         //     // Israeli font
        //         //     $font_family = "'Varela Round','sans-serif'";
        //     } elseif (
        //         $currency_code == 'AED' ||
        //         $currency_code == 'EGP' ||
        //         $language_code == 'sa' ||
        //         $currency_code == 'IQD' ||
        //         $language_code == 'ir' ||
        //         $language_code == 'om' ||
        //         $currency_code == 'ROM' ||
        //         $currency_code == 'SDG' ||
        //         $currency_code == 'ILS' ||
        //         $language_code == 'jo'
        //     ) {
        //         // middle east/arabic/Israeli font
        //         $font_family = "xbriyaz";
        //     } elseif ($currency_code == 'THB') {
        //         // thai font
        //         $font_family = "'Kanit','sans-serif'";
        //     } elseif (
        //         $currency_code == 'CNY' ||
        //         $language_code == 'zh'
        //     ) {
        //         // Chinese font
        //         $font_family = "'sun-exta','gb'";
        //     } elseif (
        //         $currency_code == 'MMK' ||
        //         $language_code == 'mm'
        //     ) {
        //         // Myanmar font
        //         $font_family = 'tharlon';
        //     } elseif (
        //         $currency_code == 'THB' ||
        //         $language_code == 'th'
        //     ) {
        //         // Thai font
        //         $font_family = "'zawgyi-one','sans-serif'";
        //     } elseif (
        //         $currency_code == 'USD'
        //     ) {
        //         // Thai font
        //         $font_family = "'Roboto','sans-serif'";
        //     } else {
        //         // general for all
        //         $font_family = "freeserif";
        //     }
    
        //      $config = ['instanceConfigurator' => function($mpdf) {
        //          $mpdf->showImageErrors = true;
        //      }];
        //     // mpdf config will be used in 4th params of loadview
    

        //     //dd($request->selected_items);
        //     $config = [];
        //     if($request->selected_items != null){

        //         $pdfs = []; // Initialize an array to store PDF file paths

        //         foreach ($request->selected_items as $key => $value) {
            
        //             $order = Order::findOrFail($value);
        //             $pdf = PDF::loadView('backend.invoices.invoice', [
        //                 'order' => $order,
        //                 'font_family' => $font_family,
        //                 'direction' => $direction,
        //                 'text_align' => $text_align,
        //                 'not_text_align' => $not_text_align
        //             ], [], $config);
                    
        //             // Generate a unique filename for each PDF
        //             $filename = 'order-' . $order->code . '.pdf';
        //             $pdf->save(storage_path('app/' . $filename));
                    
        //             // Store the file path in the array
        //             $pdfs[] = storage_path('app/' . $filename);
        //         }

        //         // Create a zip file containing all the PDFs
        //         $zipFile = 'invoices'.date('Y-m-d-H-i-s').'.zip';
    
        //         $zip = new ZipArchive;
        //         if ($zip->open(storage_path('app/' . $zipFile), ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
        //             foreach ($pdfs as $pdfFile) {
        //                 $zip->addFile($pdfFile, basename($pdfFile));
        //             }
        //             $zip->close();
        //         }

        //         // Download the zip file
        //         foreach ($pdfs as $pdfFile) {
        //             unlink($pdfFile);
        //         }
                
        //         // Download the zip file
        //         return response()->download(storage_path('app/' . $zipFile))->deleteFileAfterSend(true);

        //     }else{
        //         flash(translate('The selected items field is required.'))->error();
        //         return back();
        //     }
        // }

        public function bulk_invoice_download(Request $request){
            if (Session::has('currency_code')) {
                $currency_code = Session::get('currency_code');
            } else {
                $currency_code = Currency::findOrFail(get_setting('system_default_currency'))->code;
            }
            $language_code = Session::get('locale', Config::get('app.locale'));
    
            if (Language::where('code', $language_code)->first()->rtl == 1) {
                $direction = 'rtl';
                $text_align = 'right';
                $not_text_align = 'left';
            } else {
                $direction = 'ltr';
                $text_align = 'left';
                $not_text_align = 'right';
            }
    
            if (
                $currency_code == 'BDT' ||
                $language_code == 'bd'
            ) {
                // bengali font
                $font_family = "'Hind Siliguri','freeserif'";
            } elseif (
                $currency_code == 'KHR' ||
                $language_code == 'kh'
            ) {
                // khmer font
                $font_family = "'Hanuman','sans-serif'";
            } elseif ($currency_code == 'AMD') {
                // Armenia font
                $font_family = "'arnamu','sans-serif'";
                // }elseif($currency_code == 'ILS'){
                //     // Israeli font
                //     $font_family = "'Varela Round','sans-serif'";
            } elseif (
                $currency_code == 'AED' ||
                $currency_code == 'EGP' ||
                $language_code == 'sa' ||
                $currency_code == 'IQD' ||
                $language_code == 'ir' ||
                $language_code == 'om' ||
                $currency_code == 'ROM' ||
                $currency_code == 'SDG' ||
                $currency_code == 'ILS' ||
                $language_code == 'jo'
            ) {
                // middle east/arabic/Israeli font
                $font_family = "xbriyaz";
            } elseif ($currency_code == 'THB') {
                // thai font
                $font_family = "'Kanit','sans-serif'";
            } elseif (
                $currency_code == 'CNY' ||
                $language_code == 'zh'
            ) {
                // Chinese font
                $font_family = "'sun-exta','gb'";
            } elseif (
                $currency_code == 'MMK' ||
                $language_code == 'mm'
            ) {
                // Myanmar font
                $font_family = 'tharlon';
            } elseif (
                $currency_code == 'THB' ||
                $language_code == 'th'
            ) {
                // Thai font
                $font_family = "'zawgyi-one','sans-serif'";
            } elseif (
                $currency_code == 'USD'
            ) {
                // Thai font
                $font_family = "'Roboto','sans-serif'";
            } else {
                // general for all
                $font_family = "freeserif";
            }
    
             $config = ['instanceConfigurator' => function($mpdf) {
                 $mpdf->showImageErrors = true;
             }];
            // mpdf config will be used in 4th params of loadview
    

            //dd($request->selected_items);
            $config = [];
            if($request->selected_items != null){
                    
                $orders = Order::whereIn('id', $request->selected_items)->get();
                // Load invoice view and add it to the PDF
                $view = view('backend.invoices.multipleInvoice', [
                    'orders' => $orders,
                    'font_family' => $font_family,
                    'direction' => $direction,
                    'text_align' => $text_align,
                    'not_text_align' => $not_text_align
                ]);
                $html = $view->render();
                $pdf = PDF::loadHTML($html);
                return $pdf->stream('invoices.pdf');
            }else{
                flash(translate('The selected items field is required.'))->error();
                return back();
            }
        }
    }

