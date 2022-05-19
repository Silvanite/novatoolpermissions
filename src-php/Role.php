<?php

namespace Silvanite\NovaToolPermissions;

use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Silvanite\Brandenburg\Policy;
use Laravel\Nova\Fields\BelongsToMany;
use Silvanite\Brandenburg\Role as RoleModel;
use Silvanite\NovaFieldCheckboxes\Checkboxes;

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

            Text::make(__('Name'), 'name')->sortable(),

            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->rules('required')
                ->creationRules('unique:roles')
                ->updateRules('unique:roles,slug,{{resourceId}}')
                ->sortable(),

            Checkboxes::make(__('Permissions'), 'permissions')->options(collect(Policy::all())
                ->mapWithKeys(function ($policy) {
                    return [
                        $policy => __($policy),
                    ];
                })
                ->sort()
                ->toArray()),

            Text::make(__('Users'), function () {
                return count($this->users);
            })->onlyOnIndex(),

            BelongsToMany::make(__('Users'), 'users', config('novatoolpermissions.userResource', 'App\Nova\User'))
                ->searchable(),
        ];
    }

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group()
    {
        return __(config('novatoolpermissions.roleResourceGroup', static::$group));
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Roles');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Role');
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
