<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Form;
use Session;
use Artisan;
use Storage;
use Image;
use Illuminate\Support\Collection;

class Laracasts extends Controller
{

    public function global(Request $request)
    {
        DB::table('s')->get();
        Form::first()->increment('number', 50);
    }

    public function render(Request $request)
    {
        return view('name', compact('var')); // will return view Object
        return view('name', compact('var'))->render(); // will return html output
    }

    public function mutators()
    {

        $u = User::create([
            'password' => 's',
            'name' => 'new Name', // will adjust the name
            'username' => '2',
            'specialization' => '3'
        ]);

        return $u;
    }

    public function scopes()
    {
        $u = User::find(505);
        return $u->humansDate();
        //return User::name()->take(10)->get();
    }
    public function redirectErrors()
    {
        return redirect()->route('showErrors')->withErrors([
            'type' => '404',
            'msg'  => 'page not found'
        ]);
    }

    public function showErrors(Request $request)
    {

        //return $request->all() + ['age' => 22, 'job' => 'eng'];
        //$errors = Session::get('errors');
       // dd($errors->all());
        //return view('errors');
    }

    public function relationship()
    {

        User::find(13)->forms()->detach();
        User::find(13)->forms()->sync(Form::pluck('id'));
        //return User::find(11)->forms;
    }
    public function injectService()
    {
        User::truncate();
        //return view('inject');
    }
    public function artisan(Request $request)
    {

        // //return Artisan::call('make:controller' ,['name' => 'Ar']);
    }
    public function storage(Request $request)
    {
        // start from storage/app

        // get file content
        $getContent = Storage::get('osama.txt', 'new Content from storage');
        // put content
        Storage::put('osama.txt', 'new Content from storage');
        // download file
        // return Storage::download('osama.txt');
        Storage::size('osama.txt');
        Storage::lastModified('osama.txt');
        Storage::copy('old/file.jpg', 'new/file.jpg');
        Storage::move('old/file.jpg', 'new/file.jpg');
        return  Storage::url('osama.txt');
    }
    public function collection()
    {
        // define a new method in the collection container
        Collection::macro('name', function () {
            return $this->map(function ($value) {
                return $value['name'];
            });
        });

        $collection = collect([
            ["name" => "osama", "age" => 22],
            ["name" => "ahmed", "age" => 26],
        ]);
        $numbers = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $getNames = $collection->name(); // ["osama", "ahmed"]
        $average = collect([1, 1, 2, 4])->avg(); // 4 + 2 + 1 + 1 = (8 / 4) = 2
        $chunks = collect([1, 2, 3, 4, 5, 6, 7, 8])->chunk(4); // [ [1, 2, 3, 4], [5, 6, 7] ]
        $collapsed =collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]])->collapse(); // [1, 2, 3, 4, 5, 6, 7, 8, 9]
        // add the values only
        $concat = collect([1,2,3,4])->concat([5])->concat([6]);
        $contains = collect([1, 2, 3, 4, 5]);
        $contains->contains(function ($value, $key) {
            return $value >  5; // false
        });

        $first = $collection->first(function ($value, $key) {
            return $value['name'] == 'ahmed';
        });
        $firstWhere = $collection->firstWhere('name', 'ahmed');
        $deleteItem = $collection->map(function ($item, $key) {
            $collect = collect($item);
            return $collect->forget('name');
        });
        $getName = collect(['name' => 'Toma'])->get('name');
        $implode = collect([
            ['name' => 'Osama'],
            ['name' => 'Ahmed']])->implode('name', ' | ');
        $isEmpty = collect([])->isEmpty(); // true
        $isNotEmpty = collect([])->isNotEmpty(); // false
        $keys = collect(['name' => 'Toma'])->keys(); // [name]
        return '';
    }

    public function images(Request $request)
    {
            ini_set('max_execution_time', -1);
            // open an image file
            $img = Image::make(public_path('img/01.jpg'));
            $watermark = Image::make(public_path('img/04.png'));
            //$watermark->resize(500, 500);
            // $watermark->opacity(30);
            // resize image instance
            //$img->resize(320, 240);
            // insert a watermark
            $img->insert($watermark, 'center', 100, 10);
            // save image in desired format
            //$img->save('public/bar.jpg');
        return $img->response('png');
    }


    public function schedule()
    {
        return "s";
    }
}
