<?php

use App\User;
use App\Photo;
use App\Comment;
use App\Jobs\TestJob;
use App\Mail\QueueableMail;
use App\Notifications\PaymentFaild;
use App\Contracts\Shape as ShapeInterface;
use App\Exceptions\ClassNotFound;
use App\Http\Resources\UserResource;

Route::get('/cache', function () {


    return Cache::remember('users', 1, function () {
        \File::put(base_path('home.txt'), 'Hello');
        return User::all();
    });
});



Route::get('appends', function () {

    return new UserResource(User::first());
});


Route::get('basic-auth', function () {

    return "Hello";
})->middleware('auth.basic');


Route::get('/exceptions', function () {
    throw new ClassNotFound("class not found ", 1);
});
Route::get('shapes', function (ShapeInterface $shape) {
    dd($shape);
});
 Route::get('webpack', function () {

    return view('webpack');
 });

 Route::get('files', function () {
    File::put(app_path('tests/home/s.txt'), str_random());

    return File::get(app_path('tests/home/s.txt'));
 });
 Route::get('jobs', function () {



     dispatch(new  TestJob);
        return;
 });


// should using Cache and Redis
    Route::view('comments', 'comments', ['comments' => Comment::all() ]);



    Route::get('/pivot', function () {
        $user = User::first();
        $photo = Photo::first();
        $photo->users()->attach($user, ['name' => 'Osama']);
        return $photo->users;
    });

    Route::get('/eloquent', function () {
        $users = App\User::find([20], ['email', 'name']); // pass an array
        $users = App\User::where(['id' => 18, 'email' => 'o@o.com'])->get(); // pass an array
        return $users;
    });
    Route::get('notifications', function () {

        return App\User::first()->notify(new PaymentFaild(['name' => 'Osama']));
    });

    Route::post('rules', function () {
        request()->validate([
        'name' => ['required', new App\Rules\UpperCase]
        ]);

        return "Passes";
    });

    Route::get('/createMany', function () {
        //App\Post::truncate();
        $user = App\User::first();
        $posts = [
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ['title' => str_random(15), 'content' => str_random(20)],
        ];
        $user->posts()->createMany($posts);
        return $user->posts;
    });
// component and slots
    Route::get('/component', function () {
        return view('component');
    });
// fluent Routing
    Route::prefix('pre')->name('h')->middleware('auth')->get('/s', function () {
        return route('h');
    });

    Route::get('/collection2', function () {

         $users = collect(['jane', 'joe', 'susan'])->map(function ($name) {
            return 'Mr.' . ucfirst($name);
         })->filter(function ($name) {
            return !str_contains($name, 'Susan');
         })->implode(', ');

         //$users = App\User::InRandomOrder()->take(4)->get();

         return $users;
    });

    Route::get('paginate', function () {

        return view('paginate', ['users' => App\User::paginate(4)]);
    });

    Route::resource('posts', 'PostController');



// query builder references
    Route::get('/DB', 'testController@databaseWithDB');
// ORM
    Route::get('/ORM', 'testController@ORM');
// show some statistic with query builder
    Route::get('/stat', 'testController@statistic');
// forms
    Route::get('/form', 'testController@form');
//post form
    Route::post('/form', 'testController@formPost')->name('formPost');

// config file route
    Route::get('/configFiles', 'testController@configFiles');
// helpers methods
    Route::get('/helpers', 'testController@helpers');
// languages
    Route::get('/langs/{lang}', 'testController@langs');
// DB relationships
    Route::get('/relationships', 'testController@relationships');
// sessions
    Route::get('/sessions', 'testController@sessions');
// Validation
    Route::get('/validation', 'testController@validation')->middleware(App\Http\Middleware\Test::class);
// pagination
    Route::get('/pagination', 'testController@pagination')->middleware('Test', 'Test');// multiple
//middleware
    Route::get('/middleware', ['middleware' => 'Test','uses'=>'testController@testMiddleware' ]);
// blade
    Route::get('/blade', 'testController@blade');
// redirect
    Route::redirect('/first', '/second', 301);
// return only view
    Route::view('/welcome', 'welcome', ['name' => 'Osama']);
// match
    Route::match(['get', 'post'], '/match', function () {
        return "s";
    });
// invoke controller
    Route::get('/invoke', 'InvokeController');
    Route::get('/invoke/1', 'InvokeController@show');
// resource controller
    Route::resource('resource', 'resourceController', [
    // 'only' => ['index', 'show']
    // everything except ...
    // 'except' => ['create', 'store', 'update', 'destroy'],
    ]);

// patterns

// global
    Route::pattern('id', '[0-9]+');
// with route
    Route::get('/patterns/{id}', function ($id) {
        return $id;
    })->where('id', '[0-9]+');
// upload files form
    Route::get('/upload-form', 'testController@uploadForm');
    Route::post('/upload-form', 'testController@uploadForm');
// group parameters
    Route::group(
        ['prefix'=> 'admin', 'middleware' => ['admin', 'manger'], 'name' => 'admin.','namespace' => 'Admin'],
        function () {
            Route::get('/', function () {
                return "Hello";
            });
        }
    );


// Laracasts videos
    Route::get('/global', 'Laracasts@global');
    Route::get('/mutators', 'Laracasts@mutators');
    Route::get('/scopes', 'Laracasts@scopes');
    Route::get('/redirectErrors', 'Laracasts@redirectErrors');
    Route::get('/showErrors', 'Laracasts@showErrors')->name('showErrors');
    Route::get('/relationship', 'Laracasts@relationship');
    Route::get('/injectService', 'Laracasts@injectService');
    Route::get('/artisan', 'Laracasts@artisan');
    Route::get('/check', 'Laracasts@check');
    Route::post('/check', 'Laracasts@check')->name('check');

    Route::get('/storage', 'Laracasts@storage')->name('storage');
    Route::get('/collection', 'Laracasts@collection')->name('collection');
    Route::get('/images', 'Laracasts@images')->name('images');



    Route::get('/schedule', 'Laracasts@schedule')->name('schedule');




    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
