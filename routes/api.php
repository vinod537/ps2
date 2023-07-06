<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v10')->group(function() {

     Route::post('registers', 'UserController@register');
     Route::post('forgot-password', 'UserController@forgotPassword');
     Route::post('login', 'UserController@authenticate');
    
     //firebase authentication
     Route::post('firebase-auth', 'UserController@firebaseAuth');

     Route::group(['middleware' => ['jwt.verify','loginCheck','api.localization','CheckApiKey']], function() {

         //UserControler
         Route::prefix('user')->group(function() {

             Route::get('me', 'UserController@getAuthenticatedUser');
             Route::get('logout', 'UserController@logout');
             Route::post('change-password', 'UserController@changePassword');

             Route::post('update-profile', 'UserController@updateUserInfo');

             Route::get('user-details-by-id', 'UserController@userDetailsById');
             Route::get('user-details-by-email', 'UserController@userDetailsByemail');
             Route::post('set-password', 'UserController@setPassword');
             Route::post('deactivate-account', 'UserController@deactivateAccount');
             Route::get('test', 'UserController@test');
         });

         Route::post('save-comment', 'CommentController@save');
         Route::post('save-comment-reply', 'CommentController@saveReply');
     });

    Route::group(['middleware' => ['api.localization', 'CheckApiKey']], function() {
        //HomeController
        Route::prefix('home')->group(function() {
            Route::get('/content', 'HomeController@homeContent');

        });
        //SettingsController
        Route::get('/settings', 'SettingsController@settings');

        //ConfigController
        Route::get('/config', 'ConfigController@config');

        //home page
        Route::get('/home-contents', 'HomeController@homeContents');

        //post by
        Route::get('/latest-posts', 'PostController@latestPosts');
        Route::get('/trending-posts', 'PostController@trendings');
        Route::get('/video-posts', 'PostController@videoPosts');
        Route::get('/video-posts-page', 'PostController@getVideoPosts');
        Route::get('/post-by-category/{id}', 'PostController@postByCategory');
        Route::get('/post-by-sub-category/{id}', 'PostController@postBySubCategory');
        Route::get('/post-by-tag/{slug}', 'PostController@postByTag');
        Route::get('/post-by-author/{id}', 'PostController@postByAuthor');
        Route::get('/post-by-date/{date}', 'PostController@postByDate');
        Route::get('/author-post', 'AuthorController@post');
        Route::get('/author-profile', 'AuthorController@profile');

        //post details url
        Route::get('/detail/{id}', 'PostController@articleDetail');
        Route::get('/comments/{id}', 'CommentController@comments');
        Route::get('/replies/{id}', 'CommentController@replies');

        Route::get('/all-tags', 'PostController@tags');
        Route::get('/discover', 'CategoryController@discover');
        Route::get('/discover-recommended-posts', 'CategoryController@discoverRecommendedPosts');
        Route::get('/discover-featured-posts', 'CategoryController@discoverFeaturedPosts');

        //search
        Route::get('/search', 'PostController@searchPost');
    });

});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group(['middleware' => ['XSS']], function () {
//     Route::get('/', 'ApiController@home')->name('home');
//     Route::get('/app-privacy-policy', 'HomeController@appprivacypolicy')->name('app-privacy-policy');
//     Route::get('/terms-conditions', 'HomeController@termsconditions')->name('terms-conditions');
//     Route::get('/pharma-apps', 'HomeController@pharmaapps')->name('pharma-apps');
//     Route::get('/be-spoke', 'HomeController@newbespoke')->name('be-spoke');
//     Route::get('/grievance-redressal', 'HomeController@grievanceredressal')->name('grievance-redressal');
//     Route::get('/news-letter', 'HomeController@newsletter')->name('news-letter');
//     Route::get('/news-wire', 'HomeController@newswire')->name('news-wire');
//     //start auth route
//     Route::get('/login', 'UserController@showLoginForm')->name('site.login.form');
//     Route::post('/login', 'UserController@login')->name('site.login');
//     Route::get('/register', 'UserController@showRegistrationForm')->name('site.register.form');
//     Route::post('/register', 'UserController@register')->name('site.register');
//     Route::get('/logout', 'UserController@logout')->name('site.logout');
//     Route::get('activation/{email}/{activationCode}','UserController@activation');
//     Route::get('sitemap','SitemapController@sitemap')->name('sitemap');
//     Route::get('/forgot-password','UserController@forgotPassword')->name('forget-password');
//     Route::post('/forgot-password','UserController@postForgotPassword')->name('do-forget-password');
//     Route::get('reset/{email}/{activationCode}','UserController@resetPassword');
//     Route::post('reset/{email}/{activationCode}','UserController@PostResetPassword')->name('reset-password');
//     //end auth route

//     Route::get('newshome', 'ApiController@search')->name('article.search');
//     Route::get('get-read-more-post-search', 'ApiController@getReadMorePostSearch');

//     Route::post('article/post/comment', 'CommentController@save')->name('article.save.comment');
//     Route::post('article/post/comment/reply', 'CommentController@saveReply')->name('article.save.reply');
//     Route::get('submit/news', 'ApiController@submitNewsForm')->name('submit.news.form');
//     Route::post('submit/news', 'ApiController@saveNews')->name('submit.news.save');
//     Route::post('site/send/message', 'PageController@sendMessage')->name('site.send.message');
//     Route::post('site/send/eventmessage', 'PageController@sendEventMessage')->name('site.send.eventmessage');
//     Route::post('poll-store', 'PollController@savePoll')->name('site.poll.store');
//     Route::get('site-switch-langauge', 'CommentController@switchLanguage');
//     Route::get('mode-change', 'CommentController@modeChange');
//     Route::get('category/{slug}','ApiController@postByCategory')->name('site.category');
//     Route::get('sub-category/{slug}','ApiController@postBySubCategory')->name('site.sub-category');
//     Route::get('get-read-more-post-subcategory','ApiController@getPostSubcategory');
//     Route::get('get-read-more-post-category','ApiController@getReadMorePostCategory');
//     Route::get('tags/{slug}','ApiController@postByTags')->name('site.tags');
//     Route::get('get-read-more-post-tags','ApiController@getReadMorePostTags');
//     Route::get('get-read-more-post','ApiController@getReadMorePost');
//     Route::get('get-read-more-post-profile','ApiController@getReadMorePostProfile');
//     //		author panel
//     Route::get('author-profile/{id}', 'AuthorController@profile')->name('site.author');

//     Route::group(['middleware'=>['loginCheck']],function() {
//         //      update profile
//         Route::get('my-profile', 'AuthorController@myProfile')->name('site.profile');

//         Route::get('author-profile-edit', 'AuthorController@myProfileEdit')->name('site.profile.form');
//         Route::post('author-profile-update', 'AuthorController@myProfileUpdate')->name('site.profile.save');

//         Route::get('author-social', 'AuthorController@social')->name('site.author.socials');
//         Route::post('author-social', 'AuthorController@socialUpdate')->name('site.author.socials.update');

//         Route::get('author-preference', 'AuthorController@preference')->name('site.author.preference');
//         Route::post('author-preference', 'AuthorController@preferenceUpdate')->name('site.author.preference.update');

//         // author password
//         Route::get('author-password', 'AuthorController@changePassword')->name('site.author.password');
//     });
//     //		article by dates
//     Route::get('date/{date}', 'ApiController@postByDate')->name('article.date');
//     Route::get('get-read-more-post-date', 'ApiController@getReadMorePostDate');

//     //quiz-routes
//     Route::get('get-quiz-answer-array', 'QuizController@getAnswerArray');
//     Route::get('get-quiz-result-array', 'QuizController@getResultArray');

//     Route::get('post/reaction', 'ReactionController@postReaction');

//     Route::get('albums', 'PageController@imageAlbums')->name('image.albums');
//     Route::get('album-gallery/{slug}', 'PageController@imageGallery')->name('album.gallery');

//     // Route::get('feed/{id}', 'PageController@feed')->name('feed');
//     // Route::get('feedss', 'PageController@feeds')->name('feedsaa');

//     Route::get('feed', 'PageController@feed')->name('feed');



//     Route::get('404', function () {
//         return view('site.pages.404');
//     });
//     Route::get('403', function () {
//         return view('site.pages.403');
//     });
// });
