<?php

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

/*One to one relationship eloquent laravel */

	//Create a user by user Model
	Route::get("create-user", function(){
		$user = new App\User();
		$user->name = 'nguyentrungduc';
		$user->password = Hash::make('12345678');
		$user->email = 'ducnt220997@gmail.com';

		return $user->save();
	});

	//Create a phone by user Model
	Route::get("create-phone-by-user", function(){
		$user = App\User::find(1);

		$phone = new App\Phone();
		$phone->phone = '9429343852';
		 
		return $user->phone()->save($phone);
	});

	//Read a phone by user Model
	Route::get("read-phone-by-user", function(){
		$user = App\User::find(1);
		 
		dd($user->phone::all());
	});

	//Read a user by phone Model
	Route::get("read-phone-by-user", function(){
		$phone = App\Phone::find(1);
		 
		dd($phone->user::all());
	});

	//Update a phone by user Model
	Route::get("update-phone-by-user", function(){
		$user = App\User::find(1);

		$phone = [
			'phone' => '9429343852'
		];
		 
		dd($user->phone()->update($phone));
	});

	//Update a user by phone Model
	Route::get("update-user-by-phone", function(){
		$phone = App\Phone::find(1);

		$user = [
			'name' => 'Duc'
		];

		dd($phone->user()->update($user));
	});

	//Delete a phone by user Model
	Route::get("delete-phone-by-user", function(){
		$user = App\User::find(1);
		 
		dd($user->phone()->delete());
	});

	//Update a user by phone Model
	Route::get("update-user-by-phone", function(){
		$phone = App\Phone::find(1);

		dd($phone->user()->delete());
	});

	//Get phone per user Model
	Route::get("get-user-phone", function(){
		$user = App\User::find(1);

		dd([
			$user->phone(),
			$user->phone,
		]);
	});

/*One to one relationship eloquent laravel */

/*One to many relationship eloquent laravel */

	//Create post via user
	Route::get('create-post', function(){
		// $user = App\User::create([
		// 	'name' => 'nguyentrungduc_create_post',
		// 	'password' => Hash::make('12345678'),
		// 	'email' => 'ducnt220997@gmail.com1'
		// ]);

		$user = App\User::findOrFail(1);

		return $user->posts()->create([
			'title' => 'demo create post 2',
			'body' => 'create by user via relationship'
		]);

	});

	//Read post by user
	Route::get('read-post-by-user', function(){
		$user = App\User::findOrFail(4);

		dd($user->posts()->get());
	});

	//Read user by post
	Route::get('read-user-by-post', function(){
		$post = App\Post::findOrFail(1);

		dd($post->user()->get());
	});

	//Update post by user
	Route::get('update-post-by-user', function(){
		$user = App\User::findOrFail(4);

		dd($user->posts()->where('id', 1)->update([
			'title' => 'demo create post 1',
			'body' => 'create by user via relationship'
		]));
	});

	//Update user by post
	Route::get('update-user-by-post', function(){
		$post = App\Post::findOrFail(1);

		dd($post->user()->update([
			'name' => 'duc 123'
		]));
	});

	//Delete post by user
	Route::get('update-post-by-user', function(){
		$user = App\User::findOrFail(4);

		dd($user->posts()->whereUser_id(1)->delete());
	});

/*One to many relationship eloquent laravel */

/*Many to many relationship eloquent laravel */

	//Create categories
	Route::get("create-categories", function(){
		$user = App\User::findOrFail(4);
		dd($user->posts()->create([
			'title' => 'demo create post many many relationship',
			'body' => 'create by user via relationship'
		])->categories()->create([
			'slug' => str_slug('Hello World', '-'),
			'category' => 'Demo'
		]));
	});

	//Read categories
	Route::get('read-category', function(){
		$post = App\Post::find(4);

		dd($post->categories);
	});

	//Attach related data
	Route::get('attach', function(){
		$post = App\Post::find(2);
		dd($post->categories()->attach(2));
	});

	//Detach related data
	Route::get('attach', function(){
		$post = App\Post::find(2);
		dd($post->categories()->detach(2));
	});

	//Sync related data
	Route::get('sync', function(){
		$post = App\Post::find(2);
		dd($post->categories()->sync([2]));
	});

/*Many to many relationship eloquent laravel */

/*Many to through relationship eloquent laravel */

	//Create role
	Route::get("role", function(){
		$role = new App\Role();
		$role->role = 'demo';
		$role->save();

		return $user->save();
	});

	//Create User
	Route::get("create-user", function(){
		$user = new App\User();
		$user->name = 'nguyentrungduc';
		$user->password = Hash::make('12345678');
		$user->email = 'ducnt220997@gmail.com';
		$user->role_id = 1;

		return $user->save();
	});

	//Show Role/Post
	Route::get('role/post', function(){
		$role = App\Role::find(1);
		dd($role->posts);
	});

/*Many to through relationship eloquent laravel */

/*Polymorphic  relationship eloquent laravel */
	
	//Create comment
	Route::get("comment/create", function(){
		$post = App\Post::find(1);
		dd($post->comments()->create([
			'user_id' => 2,
			'content' => 'Demo'
		]));

		// $portfolio = App\Portfolio::find(1);
		// dd($portfolio->comments()->create([
		// 	'user_id' => 2,
		// 	'content' => 'Demo'
		// ]));
	});

	//Read
	Route::get("comment/read", function(){
		// $post = App\Post::findOrFail(1);
		// $comments = $post->comments;
		// foreach ($comments as $comment) {
		// 	dd($comment);
		// 	echo $comment->user->name . ' - ' . 
		// 		$comment->content . 
		// 		$comment->commentable->title;
		// }

		$portfolio = App\Portfolio::findOrFail(1);
		$comments = $portfolio->comments;
		foreach ($comments as $comment) {
			dd($comment);
			echo $comment->user->name . ' - ' . 
				$comment->content . 
				$comment->commentable->title;
		}
	});

	//Update
	Route::get('comment/update', function(){
		$post = App\Post::find(1);
		$comment = $post->comments()->where('id', 1)->first();
		$comment->update([
			'content' => 'Demo'
		]);
	});

	//Delete
	Route::get('comment/delete', function(){
		$post = App\Post::find(1);
		$comment = $post->comments()->where('id', 1)->delete();

		$portfolio = App\Portfolio::find(1);
		$comment = $portfolio->comments()->where('id', 1)->delete();
	});

	/*Many many*/
		//Read
		Route::get('tag/read', function(){
			// $posts = App\Post::find(1);

			// dd($posts->tags);

			$portfolio = App\Portfolio::find(1);

			dd($portfolio->tags);
		});

		//Attach
		Route::get('tag/attach', function(){
			// $posts = App\Post::find(1);

			// dd($posts->tags->attach([4, 6]));

			$portfolio = App\Portfolio::find(1);

			dd($portfolio->tags->attach([4, 6]));
		});

		//Detach
		Route::get('tag/detach', function(){
			// $posts = App\Post::find(1);

			// dd($posts->tags->detach([4, 6]));

			$portfolio = App\Portfolio::find(1);

			dd($portfolio->tags->detach([4, 6]));
		});

		//Synch
		Route::get('tag/sync', function(){
			// $posts = App\Post::find(1);

			// dd($posts->tags->sync([4, 6]));

			$portfolio = App\Portfolio::find(1);

			dd($portfolio->tags->sync([4, 6]));
		});
	/*Many many*/
/*Polymorphic  relationship eloquent laravel */