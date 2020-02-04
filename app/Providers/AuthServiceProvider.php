<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\User;
use App\Article;
use App\Cosmetologie;
use App\Personnel;
use App\Permission;
use App\Promotion;
use App\Service;
use App\Policies\ArticlePolicy;
use App\Policies\CosmetologPolicy;
use App\Policies\PersonnelPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\UserPolicy;
use App\Policies\PromotionPolicy;
use App\Policies\ServicePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    //Регистрация классов политик безопасности
    protected $policies = [
        Cosmetologie::class =>  CosmetologPolicy::class,
        Personnel::class =>  PersonnelPolicy::class,
        Article::class =>  ArticlePolicy::class,
        Permission::class =>  PermissionPolicy::class,
        User::class =>  UserPolicy::class,
        Promotion::class =>  PromotionPolicy::class,
        Service::class =>  ServicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    // Регистрируем политики безопасности
    // без классов -на прямую
    //Пример
    //  if(Gate::denies('ADD_COSMETOLOGIES')){
    //            abort(403);
    //        }
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('VIEW_ADMIN', function ($user){
            return $user->canDo('VIEW_ADMIN');
        });

        $gate->define('ADD_COSMETOLOGIES', function ($user){
            return $user->canDo('ADD_COSMETOLOGIES');
        });

        $gate->define('UPDATE_COSMETOLOGIES', function ($user){
            return $user->canDo('UPDATE_COSMETOLOGIES');
        });

        $gate->define('EDIT_USERS', function ($user){
            return $user->canDo('EDIT_USERS');

        });

        $gate->define('VIEW_REPORT', function ($user){
            return $user->canDo('VIEW_REPORT');

        });

        $gate->define('ADD_ARTICLES', function ($user){
            return $user->canDo('ADD_ARTICLES');

        });



//        $gate->define('VIEW_ADMIN', function ($user){
//            return $user->canDo(['VIEW_ADMIN', 'ADD_ARTICLES'], TRUE);
//
//        });

        //
    }
}
