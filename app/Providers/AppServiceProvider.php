<?php

namespace App\Providers;

use App\Models\Dino;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use SplFileInfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });

        $fragmentFiles = File::allFiles(resource_path('assets/fragments'));
        $fragmentNames = array_map(function (SplFileInfo $file) {
            return $file->getFilename();
        }, $fragmentFiles);

        $groups = ['body' => [], 'mouth' => [], 'eyes' => []];
        foreach ($fragmentNames as $fragment) {
            $fragmentEnd = substr($fragment, strlen($fragment) - 5);

            switch ($fragmentEnd) {
                case "b.png":
                    array_push($groups['body'], $fragment);
                    break;
                case "m.png":
                    array_push($groups['mouth'], $fragment);
                    break;
                case "e.png":
                    array_push($groups['eyes'], $fragment);
                    break;
            }
        }

        Dino::$fragments = $fragmentNames;
        Dino::$bodyFragments = $groups['body'];
        Dino::$mouthFragments = $groups['mouth'];
        Dino::$eyesFragments = $groups['eyes'];
    }
}
