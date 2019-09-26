<?php

namespace Mtc\CurrentlyViewing\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserLog
 *
 * @package Mtc\CurrentlyViewing\Http\Resources
 */
class UserLog extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource = $this->resource
            ->map(function ($user_id) {
                $user = app(config('auth.providers.users.model'))->find($user_id);
                $user->setVisible([
                    'name'
                ]);
                return $user;
            });
        return parent::toArray($request);
    }
}
