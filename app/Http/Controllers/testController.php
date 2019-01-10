<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App;
use App\User;
use App\Form;
use Config;
use DB;
use App\studentsForms;
class testController extends Controller
{

	// query builder references 
   	public function databaseWithDB() {
       
      // RAW SQL 
      //DB::select('SELECT * FROM ads');
      //DB::inert('INSERT INTO ...'. []);
      echo "<title>Database: Query Builder </title>";
      // chunk rows (every 1 row will do action)
      DB::table('ads')->orderBy('id')->chunk(1, function ($ads) {
           
          foreach ($ads as  $ad) {
            echo $ad->title . '<br />';
          }
          echo "<hr />";
        
      });
   		$users = DB::table('users')->orderBy('id')->get(); // all 
      echo $users;
   		echo "<pre>";
   		print_r($users);
   		echo "<hr />";
   		// where and first result
   		$user = DB::table('users')->where('email', 'o@o.net')->first();
   		// get only one value as String 
   		echo $email = DB::table('users')->where('id', 1)->value('email') . '<br />';
   		// select one column only 
		$emails = DB::table('users')->pluck('email');
		print_r($emails);
		echo "<hr />";
		// users Count 
		$usersCount = DB::table('users')->count();
		// max Value || you can choose count, max, min,  avg, and sum
		$price = DB::table('forms')->max('id');

		// select 100 records then continue
		DB::table('users')->orderBy('id', 'DESC')->chunk(100, function ($users) {
		    foreach ($users as $user) {
            $user->id;
            $user->email;
            $user->password;
		    }
		});
    
   		foreach ($users as $user) { // each user is an object and the columns is the values of this object 
    		echo '<br />' . $user->name . '<br />';
		}
		// slecet specific columns
		$users = DB::table('users')->select('name', 'email as user_email')->get();
		// non duplicated values 
		$users = DB::table('users')->distinct()->get();
		// add select to existing query 
		$query = DB::table('users')->select('name');
		$users = $query->addSelect('id')->get();
		// normal RAW SQL Statemnet 
		$allUsers = DB::table('users')
                     ->select(DB::raw('count(*)'))
                     ->get();
		print_r($allUsers);
      $orders = DB::table('forms')
                ->orderByRaw('updated_at - created_at DESC')
                ->get();
      // order by
      $u = DB::table('users')->orderBy('id', 'desc')->get();
      // join 
      $users = DB::table('stuentsforms')
            ->join('forms', 'students_forms.form_id', '=', 'forms.id')
            ->join('users', 'students_forms.student_id', '=', 'users.id')
            ->select('users.*', 'forms.*')
            ->get();

       // insert record 
        /*  DB::table('users')->insert(
            ['column' => 'value',
             'column_2' => 'value2']
         );
         // update 
          DB::table('users')->insert(
            ['column' => 'value',
             'column_2' => 'value2']
         ); 
         // delete
         Db::table('users')->where('id', 1)->delete(); */
   	}

   	public function statistic() {
   		$usersCount = DB::table('users')->count();
   		$formsCount = DB::table('forms')->count();
   		$specializationsCount = DB::table('specializations')->count();
   		$messagesCount = DB::table('messages')->count();

   		echo "<h1 style='text-align: center'>
   			users count is {$usersCount}<br />
   			forms count is {$formsCount}<br />
   			specializations count is {$specializationsCount}<br />
   			messages count is {$messagesCount}
   		</h1>"; 
      }

      public function form() {

        return view('form');
      }

      public function formPost(Request $request) {

        return $request->name;
      }

      public function configFiles() {
         Config::set('app.locale', 'ar'); // set
         config(['app.testKey' => 's']); // set
         echo config('app.testKey'); //  get

      }

      public function uploadForm(Request $request) {

         if($request->isMethod('post')) {

            // print_r($request->all());

            echo $request->path() . '<br />';

            echo $request->url() . '<br />';

            echo $request->fullUrl() . '<br />';
            // static inputs 
            echo $request->image_name . '<br />';
            // if there isn't input with this name 
           $not_found = $request->input('image_names', 'this input is not found ');
            // files
            //echo $request->file('image') . '<br />'; // tmp_name

            //echo $request->file('image')->getClientOriginalName(); // image name
         }

         return view('forms.upload');
      }

      public function ORM() {
        // ORM is the same of query builder  
       /*  $users = User::get();
        
        $forms = Form::all();
        
        $first = "first row is " . Form::first() . '<br />';
        $last  = "last row is " . Form::orderBy('id', 'desc')->first() . '<br />';
        Form::where('id', 2)->get();
        // insert 
        $newForm = new Form;
        $newForm->id = rand(1,99999);
        $newForm->formName = "form";
        $newForm->policy = '';
        $newForm->save();
        // search
        $formData  = Form::find(3);

        // delete
        Form::where('id', 3)->delete();
        Form::destroy(3); // primary key // instead of restore the delete 
        // $formData->delete(2);
        User::take(2)->get(); // for limit
        */
        $users = User::orderBy('id','')->limit(10)->get();
        foreach ($users as $user) {
              echo $user->id . '<br />';
            }    
      }

      public function helpers() {
    
        $array_add = array_add(['name' => 'Desk'], 'price', 100); // ['name' => 'Desk', 'price' => 100]
        
        $array = ['products' => ['desk' => ['price' => 100]]];
        $flattened = array_dot($array); // ['products.desk.price' => 100]
        
        $array = ['name' => 'Desk', 'price' => 100];
        $filtered = array_except($array, ['price']); // ['name' => 'Desk']


        $array = ['products' => ['desk' => ['price' => 100]]];
        $price = array_get($array, 'products.desk.price'); // 100


        $array = ['product' => ['name' => 'Desk', 'price' => 100]];
        $contains = array_has($array, 'product.name'); // true
        $contains = array_has($array, ['product.price', 'product.discount']);// false

        $array = ['name' => 'Desk', 'price' => 100, 'orders' => 10];
        $slice = array_only($array, ['name', 'price']); // ['name' => 'Desk', 'price' => 100]


        $array = ['one', 'two', 'three', 'four'];
        $array = array_prepend($array, 'zero'); // ['zero', 'one', 'two', 'three', 'four']
        $array = array_prepend($array, 'Desk', 'name'); // ['name' => 'Desk', 'price' => 100]


        $array = [1, 2, 3, 4, 5];
        $random = array_random($array); // 4 - (retrieved randomly)
        $random = array_random($array, 2); // 3 - 5  2 items


        $array = ['Desk', 'Table', 'Chair'];
        $sorted = array_sort($array); // ['Chair', 'Desk', 'Table']


        $array = [100, '200', 300, '400', 500];
        $filtered = array_where($array, function ($value, $key) {
            return is_string($value);
        }); // [1 => 200, 3 => 400]


        $array = [100, 200, 300];
        $first = head($array); // 100
        $last = last($array);// 300

        // paths 
        $app_path = app_path();
        $root = base_path();
        $config = config_path();
        $database = database_path();
        $public = public_path(); 
        $resource = resource_path();
        //strings
        $slice = str_before('This is my name', 'my name'); // 'This is '
        $slice = str_after('This is my name', 'This is');// ' my name'
        $contains = str_contains('This is my name', 'my'); // true
        $adjusted = str_start('this/string', '/'); // /this/string
        $adjusted = str_finish('this/string', '/'); // this/string/
        $truncated = str_limit('The quick brown fox jumps over the lazy dog', 20, '.........');
        $plural = str_plural('child', 1); // child 
        $carP = str_plural('car'); // cars
        $formP = str_plural('form'); // forms
        $car = str_singular('cars'); // car
        $random = str_random(10); // random string 
        $slug = str_slug('Laravel 5 Framework', '-'); // laravel-5-framework
        $converted = title_case('a nice title uses the correct case'); // A Nice Title Uses The Correct Case

       $current = url()->current();
       $previous = url()->previous();
        // return redirect(url()->previous()); or return back();
       // throw HTTP case(404, 403, 500)
       // abort(500);
       // abort_if(! Auth::user()->isAdmin(), 403);
       //abort_unless(Auth::user()->isAdmin(), 403);
        $password = bcrypt('my-secret-password');
        blank('');// true
        blank('   '); // true
        blank(null); // true
        blank(collect()); // true

        blank(0);// false 
        blank(true);// false 
        blank(false);// false

        filled(0);// true
        filled(true);// true
        filled(false);// true

        

        filled('');// false
        filled('   ');// false
        filled(null);// false
        filled(collect());// false

        $now = now(); // date and time
        $today = today(); // date and empty time 


        $minutes = 40;
        $cookie = cookie('name', 'value', $minutes);
        // return redirect()->route('route.name');

        session(['chairs' => 7, 'instruments' => 3]);

        // return response()->json($array, 200);
        $callback = function ($value) {
            return $value * 2;
        };

        $result = transform(5, $callback);

      }

      public function langs($lang = 'en') {
        App::setLocale($lang);
        echo 'you are view this page in '.App::getLocale() . ' lang <br />' ;
        //echo __('auth.throttle'); 
        echo trans('auth.throttle'); // same as above 
      }

      public function relationships() {
        /*$row =  DB::table('students_forms')->
            join('users', 'students_forms.student_id', '=', 'users.id')
            ->join('forms', 'students_forms.form_id','=','forms.id')
            ->first();*/
            /*$form = Form::find(1);
            $form = $row->studentsForms;
            $user  = User::findOrFail(13);
            $row = $user->studentsForms; */
            $row = studentsForms::with('form')->with('user')->get();
            return response()->json($row);
      }
      public function sessions() {
          // sessions
          //1 create 
          session(['type' => 'success', 'msg' => 'successfully create session']);
          session()->put('type','successsssss');
          // in array 
          session()->push('do','value1');
          session()->push('do','value2');
          session()->push('do','value3');
          // display session 
          session()->pull('do'); // delete after display 
          session()->get('type'); // echo 
          session()->pull('type'); // delete after display  
          session()->all(); // print_r

           echo 's' . session()->get('do');

          // delete sessions 
          session()->forget('key'); // delete one session
          session()->flush(); // delete all 
          session(['key' => 'value']);
          session()->put('type','successsssss');

          session()->push('do','value1');
          session()->push('do','value2');
          // array of the same key 
          //  [do] => Array ([0]=>value1 [1]=>value2)
          print_r(session()->all());
          // return response with session
          return back()->with('message', 'hello1')->with('message2', 'Hello2');
      }
      public function validation(Request $request) {
        echo $request;
          $validat = [
           'title' => 'bail|required|unique:posts|max:255', // stop validat on bail if it's not valid 
           // if unique:posts not unique then stop and not complete to max
           'body' => 'required',
           'name' => 'required|string|max:255',
           'username' => 'required|string|max:255|unique:users',
           'password' => 'required|string|min:6|confirmed',
           'null' => 'nullable',
           'image' => 'image|max:1024'// for images
          ];
      }

      public function pagination() {
        $users = User::paginate(10,['username'], 'slider');
      
        return view('pagination', compact('users'));
      }

      public function testMiddleware() {
         echo "<br /> Hi from middleware ";
      }
         
      public function blade() {
        return view('blade');
      }
}
