<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddMetaTags
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response) {
            $content = $response->getContent();
            $metaTag = '<link rel="manifest" href="'.url('manifest.json').'" />
                <meta name="apple-mobile-web-app-capable" content="yes">
                <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
                <meta name="apple-mobile-web-app-title" content="Zarbia">
                <link rel="apple-touch-icon" href="'.url('img/icons/icon-192x192.png').'">
                <link rel="apple-touch-startup-image" href="'.url('img/icons/icon-512x512.png').'">';
            $content = str_replace('<head>', "<head>\n{$metaTag}", $content);
            $response->setContent($content);
        }

        return $response;
    }
}
