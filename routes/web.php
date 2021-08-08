<?php

use App\Http\Controllers\RewardsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

/* About */
Route::group(['prefix' => 'about', 'as' => 'about.'], function() {

    Route::get('/', function() {
        return view('about.about');
    })->name('index');

    /* Organizations */
    Route::group(['prefix' => 'organization', 'as' => 'org.'], function() {
        Route::get('jpcs-apc', function() {
            return view('about.jpcs');
        })->name('jpcs');
        Route::get('jissa-apc', function() {
            return view('about.jissa');
        })->name('jissa');
        Route::get('apc-msc', function() {
            return view('about.msc');
        })->name('msc');
        Route::get('gaming-genesis', function() {
            return view('about.gaming-genesis');
        })->name('gaming-genesis');
    });
});

/* Policies */
Route::group(['prefix' => 'policies', 'as' => 'policy.'], function() {

    /* Privacy Policy */
    Route::get('privacy-policy', function() {
       return view('policy.privacy');
    })->name('privacy');

});

Route::middleware('auth')->get('dashboard', function() {
   return redirect()->route('dashboard.index');
});

/* Leaderboards */
Route::get('leaderboard', function() {
    return view('dashboard.leaderboard');
})->name('leaderboard');

/* Accounts */
Route::group(['prefix' => 'account', 'middleware' => ['auth']], function() {

    /* Dashboard */
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {

        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    /* Profile */
    Route::group(['as' => 'account.'], function() {

        Route::get('/', function() {
           return redirect()->route('account.index');
        });

        Route::get('me', [AccountController::class, 'index'])->name('index');
    });

});

/* Admin */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'auth',
        'can:role:create|role:read|role:update|role:delete',
    ]
], function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    /* Roles */
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function() {
        Route::get('/', [AdminController::class, 'viewRoles'])->name('index');
        Route::get('{role}', [AdminController::class, 'viewRole'])->name('view');
    });

    /* Rewards */
    Route::group(['prefix' => 'rewards', 'as' => 'rewards.'], function() {
       Route::get('/', [RewardsController::class, 'index'])->name('index');
    });
});

Route::get('/test', function () {
   return url()->previous();
});

Route::middleware('auth')->get('user/points', [DashboardController::class, 'getCurrentUserPoints']);

require __DIR__.'/auth.php';
