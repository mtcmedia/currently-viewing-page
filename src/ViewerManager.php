<?php

namespace Mtc\CurrentlyViewing;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Class ViewerManager
 *
 * @package Mtc\CurrentlyViewing
 */
class ViewerManager
{

    /**
     * Add user to the list for given path
     *
     * @param $user
     * @param $path
     */
    public function addUser($user, $path)
    {
        $current_viewers = $this->getActiveUserData($path);
        $current_viewers->put($user->id, now()->addSeconds(config('currently_viewing.watch_expiry_seconds'))->format('U'));
        $this->store($current_viewers, $path);
    }

    /**
     * Get the list of users currently viewing the path
     *
     * @param $path
     * @return \Illuminate\Support\Collection
     */
    public function currentlyViewing($path)
    {
        return $this->getActiveUserData($path)->keys();
    }

    /**
     * Get the data stored for the path
     * @param $path
     * @return \Illuminate\Support\Collection
     */
    protected function getActiveUserData($path)
    {
        $data = Cache::get($this->getCachename($path)) ?? [];

        return collect($data)
            ->filter(function ($expires) {
                return $expires > time();
            });
    }

    /**
     * Store data for path
     *
     * @param $viewers
     * @param $path
     */
    protected function store($viewers, $path)
    {
        Cache::forget($this->getCacheName($path));
        Cache::rememberForever($this->getCacheName($path), function () use ($viewers) {
            return $viewers->toArray();
        });
    }

    /**
     * Get the name of the cache file where we store information about current users
     *
     * @param $path
     * @return string
     */
    protected function getCachename($path)
    {
        return config('currently_viewing.prefix') . Str::slug($path);
    }
}