<?php

use Illuminate\Http\Request;

$page = settingHelper('page_detail_prefix') ?? 'page';
$article = settingHelper('article_detail_prefix') ?? 'article';
URL::forceScheme('http');

Route::feeds();
// isInstalledCheck
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
	],
 
	function () use ($page, $article) {

		Route::group(['middleware' => ['XSS']], function () {

			Route::get('/', 'HomeController@home')->name('home');
			Route::get('/app-privacy-policy', 'HomeController@appprivacypolicy')->name('app-privacy-policy');
			Route::get('/terms-conditions', 'HomeController@termsconditions')->name('terms-conditions');
			Route::get('/pharma-apps', 'HomeController@pharmaapps')->name('pharma-apps');
			Route::get('/bespoke', 'HomeController@newbespoke')->name('be-spoke');
			Route::get('/grievance-redressal', 'HomeController@grievanceredressal')->name('grievance-redressal');
			Route::get('/news-letter', 'HomeController@newsletter')->name('news-letter');
			Route::get('/news-wire', 'HomeController@newswire')->name('news-wire');
			//start auth route
			Route::get('/login', 'UserController@showLoginForm')->name('site.login.form');
			Route::get('/social/login/redirect', 'UserController@socialloginredirect')->name('site.login.form');
			Route::post('/login', 'UserController@login')->name('site.login');
			Route::get('/register', 'UserController@showRegistrationForm')->name('site.register.form');
			Route::post('/register', 'UserController@register')->name('site.register');
			Route::get('/logout', 'UserController@logout')->name('site.logout');
			Route::get('activation/{email}/{activationCode}', 'UserController@activation');
			Route::get('sitemap', 'SitemapController@sitemap')->name('sitemap');
			Route::get('/sitemap-auto', 'SitemapController@sitemapAuto')->name('sitemap-auto');
			Route::get('/sitemap-user', 'SitemapController@sitemapUser')->name('sitemap-user');
			Route::get('/forgot-password', 'UserController@forgotPassword')->name('forget-password');
			Route::post('/forgot-password', 'UserController@postForgotPassword')->name('do-forget-password');
			Route::get('reset/{email}/{activationCode}', 'UserController@resetPassword');
			Route::post('reset/{email}/{activationCode}', 'UserController@PostResetPassword')->name('reset-password');
			//end auth route

			Route::get('newshome', 'ArticleController@search')->name('article.search');
			Route::get('get-read-more-post-search', 'ArticleController@getReadMorePostSearch');

			Route::post('article/post/comment', 'CommentController@save')->name('article.save.comment');
			Route::post('article/post/comment/reply', 'CommentController@saveReply')->name('article.save.reply');
			Route::get('submit/news', 'ArticleController@submitNewsForm')->name('submit.news.form');
			Route::post('submit/news', 'ArticleController@saveNews')->name('submit.news.save');
			Route::post('site/send/message', 'PageController@sendMessage')->name('site.send.message');
			Route::post('site/send/eventmessage', 'PageController@sendEventMessage')->name('site.send.eventmessage');
			Route::post('poll-store', 'PollController@savePoll')->name('site.poll.store');
			Route::get('site-switch-langauge', 'CommentController@switchLanguage');
			Route::get('mode-change', 'CommentController@modeChange');
			Route::get('category/{slug}', 'ArticleController@postByCategory')->name('site.category');
			Route::get('sub-category/{slug}', 'ArticleController@postBySubCategory')->name('site.sub-category');
			Route::get('get-read-more-post-subcategory', 'ArticleController@getPostSubcategory');
			Route::get('get-read-more-post-category', 'ArticleController@getReadMorePostCategory');
			Route::get('tags/{slug}', 'ArticleController@postByTags')->name('site.tags');
			Route::get('get-read-more-post-tags', 'ArticleController@getReadMorePostTags');
			Route::get('get-read-more-post', 'ArticleController@getReadMorePost');
			Route::get('get-read-more-post-profile', 'ArticleController@getReadMorePostProfile');


			Route::get('update-press-release-by-auto', 'HomeController@UpdatePressReleaseByAuto')->name('updatepressreleasebyauto');
			//		author panel
			Route::get('author-profile/{id}', 'AuthorController@profile')->name('site.author');

			Route::group(['middleware' => ['loginCheck']], function () {
				//      update profile
				Route::get('my-profile', 'AuthorController@myProfile')->name('site.profile');

				Route::get('author-profile-edit', 'AuthorController@myProfileEdit')->name('site.profile.form');
				Route::post('author-profile-update', 'AuthorController@myProfileUpdate')->name('site.profile.save');

				Route::get('author-social', 'AuthorController@social')->name('site.author.socials');
				Route::post('author-social', 'AuthorController@socialUpdate')->name('site.author.socials.update');

				Route::get('author-preference', 'AuthorController@preference')->name('site.author.preference');
				Route::post('author-preference', 'AuthorController@preferenceUpdate')->name('site.author.preference.update');

				// author password
				Route::get('author-password', 'AuthorController@changePassword')->name('site.author.password');
			});
			//		article by dates
			Route::get('date/{date}', 'ArticleController@postByDate')->name('article.date');
			Route::get('get-read-more-post-date', 'ArticleController@getReadMorePostDate');

			//quiz-routes
			Route::get('get-quiz-answer-array', 'QuizController@getAnswerArray');
			Route::get('get-quiz-result-array', 'QuizController@getResultArray');

			Route::get('post/reaction', 'ReactionController@postReaction');

			Route::get('albums', 'PageController@imageAlbums')->name('image.albums');
			Route::get('album-gallery/{slug}', 'PageController@imageGallery')->name('album.gallery');

			// Route::get('feed/{id}', 'PageController@feed')->name('feed');
			// Route::get('feedss', 'PageController@feeds')->name('feedsaa');

			Route::get('feed', 'PageController@feed')->name('feed');
			Route::get('feeds', 'PageController@feeds')->name('feeds');



			Route::get('404', function () {
				return view('site.pages.404');
			});
			Route::get('403', function () {
				return view('site.pages.403');
			});
		});

		Route::post('upload', 'ArticleController@upload');

		// Route::get('story/{slug}', 'ArticleController@show')->name('article.detail');



		// Route::group(['prefix' => $article], function(){
		//     Route::get('story/{slug}', 'ArticleController@show')->name('article.detail');
		// });

		Route::group(['prefix' => $page], function () {
			Route::get('/{slug}', 'PageController@page')->name('site.page');
		});

		// Social login
		Route::get('login/{provider}', 'SocialController@redirect');
		Route::get('login/{provider}/callback', 'SocialController@Callback');

		Route::get('press-releases/{id}', 'ArticleController@eventshow')->name('event.detail');

		Route::get('{id}/{slug}', 'ArticleController@show')->name('article.detail')->where('id', '[0-9]+');
		Route::get('preview/{id}/{slug}', 'ArticleController@Previewshow')->name('article.detail.preview')->where('id', '[0-9]+');



		// Apis

		Route::group(['middleware' => ['XSS']], function () {
			Route::group(['prefix' => 'apis'], function () {


				Route::get('search', 'ApisController@search');
				Route::get('allcategory', 'ApisController@allcategory');
				Route::get('category/{slug}', 'ApisController@SearchByCategory');



				// Route::get('get-read-more-post-search', 'ApisController@getReadMorePostSearch');

				// Route::post('article/post/comment', 'CommentController@save')->name('article.save.comment');
				// Route::post('article/post/comment/reply', 'CommentController@saveReply')->name('article.save.reply');
				// Route::get('submit/news', 'ApisController@submitNewsForm')->name('submit.news.form');
				// Route::post('submit/news', 'ApisController@saveNews')->name('submit.news.save');
				// Route::post('site/send/message', 'PageController@sendMessage')->name('site.send.message');
				// Route::post('site/send/eventmessage', 'PageController@sendEventMessage')->name('site.send.eventmessage');
				// Route::post('poll-store', 'PollController@savePoll')->name('site.poll.store');
				// Route::get('site-switch-langauge', 'CommentController@switchLanguage');
				// Route::get('mode-change', 'CommentController@modeChange');

				// Route::get('sub-category/{slug}', 'ApisController@postBySubCategory')->name('site.sub-category');
				// Route::get('get-read-more-post-subcategory', 'ApisController@getPostSubcategory');
				// Route::get('get-read-more-post-category', 'ApisController@getReadMorePostCategory');
				// Route::get('tags/{slug}', 'ApisController@postByTags')->name('site.tags');
				// Route::get('get-read-more-post-tags', 'ApisController@getReadMorePostTags');
				// Route::get('get-read-more-post', 'ApisController@getReadMorePost');
				// Route::get('get-read-more-post-profile', 'ApisController@getReadMorePostProfile');
				// //		author panel
				// Route::get('author-profile/{id}', 'AuthorController@profile')->name('site.author');

				// //		article by dates
				// Route::get('date/{date}', 'ApisController@postByDate')->name('article.date');
				// Route::get('get-read-more-post-date', 'ApisController@getReadMorePostDate');

				// //quiz-routes
				// Route::get('get-quiz-answer-array', 'QuizController@getAnswerArray');
				// Route::get('get-quiz-result-array', 'QuizController@getResultArray');

				// Route::get('post/reaction', 'ReactionController@postReaction');

				// Route::get('albums', 'PageController@imageAlbums')->name('image.albums');
				// Route::get('album-gallery/{slug}', 'PageController@imageGallery')->name('album.gallery');



			});
		});
	}
);
