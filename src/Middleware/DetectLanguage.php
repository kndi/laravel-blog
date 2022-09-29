<?php


namespace BinshopsBlog\Middleware;

use Closure;
use BinshopsBlog\Models\BinshopsLanguage;
use Illuminate\Support\Facades\App;

class DetectLanguage
{
    public function handle($request, Closure $next)
    {
        $lang = BinshopsLanguage::where('locale', App::currentLocale())
            ->where('active', true)
            ->first();

        if (!$lang){
            return abort(404);
        }
        $request->attributes->add(['lang_id' => $lang->id, 'locale' => $lang->locale]);

        return $next($request);
    }
}
