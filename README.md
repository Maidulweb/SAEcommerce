##Laravel 10
php
DB::connection()->getPDO()

Facades provide a "static" interface to classes that are available in the application's [service container](https://laravel.com/docs/11.x/container). Laravel ships with many facades which provide access to almost all of Laravel's features.

php
php artisan make:migration add_posts_table --table=posts

php
$users = DB::table('users')->get();

$user = DB::table('users')->where('name', 'John')->first();

DB::table('posts')->where('id', '>', 9)->where('id', '<', 20)->get();

$user = DB::table('users')->find(3);

$user = Post::findOrFail($id);

$titles = DB::table('users')->pluck('title');

$users = DB::table('users')->count();

$users = DB::table('users')
->join('contacts', 'users.id', '=', 'contacts.user_id')
->join('orders', 'users.id', '=', 'orders.user_id')
->select('users.\*', 'contacts.phone', 'orders.price')
->get();

orderBy(), chunk(), chunkById(), update(), lazy(), each(), max(), min(), avg(), exists(), doesntExist(), select(), distinct(), addSelect(), groupBy(), selectRaw(), whereRaw(), havingRaw(), orderByRaw(), leftJoin(), rightJoin(), crossJoin(), joinSub()

php
{{ date(d-m-Y, strtotime($post->created_at)) }}

php
@method('PUT')

#### Validation

$request->validete([
'title' => ['required'],
'email'=>['required','email','unique:users,email,'.Auth::user()->id],
]);

#### Image

php
use File;

if($request->hasFile('image')){

$request->validete([
'image' => ['required']
]);

$fileName = time().'_'.$request->image->getClientOriginalName();
$filePath = $request->image->storeAs('uploads', $fileName);

File::delete(public_path($post->image));

$post->image = 'storage/'.$filePath;
}

$post->title = $request->title;
$post->save();

if($request->hasFile('image')){

if(File::exists(public_path($user->image))){
     File::delete(public_path($user->image));
  }

$request->validate([
'image'=>['image'],
]);

$image = $request->image;
$imageName = time().'\_'.$image->getClientOriginalName();
$image->move(public_path('uploads'),$imageName);
$path='/uploads/'.$imageName;  
}

$user->image = $path;

#### Seeder

php
DB::table('users)->insert([]);
$this->call(UserSeeder::class);

#### Error

@if ($errors->has('password'))
    <code>{{$errors->first('password')}}</code>
@endif

Auth::user()->name

#### Update Password

<input type="password" class="form-control" name="password_confirmation">
 $request->validate([
	'current_password'=>['required', 'current_password'],
	'password'=>['required','confirmed'],
  ]);

$request->user()->update([
	 'password'=>bcrypt($request->password)
]);
# SAEcommerce
