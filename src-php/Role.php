<?php

namespace Silvanite\NovaToolPermissions;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Silvanite\Brandenburg\Policy;
use Benjaminhirsch\NovaSlugField\Slug;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Silvanite\Brandenburg\Role as RoleModel;
use Silvanite\NovaFieldCheckboxes\Checkboxes;
use Benjaminhirsch\NovaSlugField\TextWithSlug;

class Role extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = RoleModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'slug',
        'name',
    ];

    public static $with = [
        'users',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            TextWithSlug::make('Name')->sortable()->slug('Slug'),
            Slug::make('Slug')->sortable(),

            Checkboxes::make('Permissions')->options(collect(Policy::all())->mapWithKeys(function ($policy) {
                return [
                    $policy => __($policy),
                ];
            })->sort()->toArray()),

            Text::make('Users', function () {
                return count($this->users);
            })->onlyOnIndex(),

            BelongsToMany::make('Users', 'users', config('brandenburg.nova.userResource', 'App\Nova\User'))->searchable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
