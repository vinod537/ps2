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

Route::group(

    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],

    function () {

    Route::prefix('posts')->group(function() {

        Route::group(['middleware'=>['loginCheck']],function(){



            Route::group(['middleware' => ['XSS']], function () {

                 route::get('sliders', 'PostController@sliders')->name('sliders')->middleware('permissionCheck:post_write');

                 Route::get('/create', 'PostController@createslider')->name('create-slider')->middleware('permissionCheck:post_write');
                 Route::get('/edit/{id}', 'PostController@edit')->name('edit-slider')->middleware('permissionCheck:post_write');
               


                Route::get('/', 'PostController@index')->name('post')->middleware('permissionCheck:post_read');


                Route::get('/press-release', 'PostController@press_release')->name('press-release')->middleware('permissionCheck:post_read');
                Route::get('/create/press-release', 'PostController@createPressRelease')->name('create-press-release')->middleware('permissionCheck:post_write');
                Route::get('/edit-press-release/{type}/{id}', 'PostController@editPressRelease')->name('edit-press-release')->middleware('permissionCheck:post_write');
              
                  


                Route::get('/create/article', 'PostController@createArticle')->name('create-article')->middleware('permissionCheck:post_write');
                Route::get('/create/video', 'PostController@createVideoPost')->name('create-video-post')->middleware('permissionCheck:post_write');
                Route::get('/create/audio', 'PostController@createAudioPost')->name('create-audio-post')->middleware('permissionCheck:post_write');



                //new type of posts routes
                Route::get('/create/trivia-quiz', 'PostController@createTriviaQuiz')->name('create-trivia-quiz')->middleware('permissionCheck:post_write');
                Route::get('/create/personality-quiz', 'PostController@createPersonalityQuiz')->name('create-personality-quiz')->middleware('permissionCheck:post_write');



                Route::get('/add-trivia-quiz-question', 'QuizController@addTriviaQuizQuestion')->name('add-trivia-quiz-question')->middleware('permissionCheck:post_write');
                Route::get('/add-trivia-quiz-question-to-db', 'QuizController@addTriviaQuizQuestionToDB')->name('add-trivia-quiz-question-to-db')->middleware('permissionCheck:post_write');
                Route::get('/add-trivia-quiz-answer', 'QuizController@addTriviaQuizAnswer')->name('add-trivia-quiz-answer')->middleware('permissionCheck:post_write');
                Route::get('/add-trivia-quiz-answer-to-db', 'QuizController@addTriviaQuizAnswerToDB')->name('add-trivia-quiz-answer-to-db')->middleware('permissionCheck:post_write');
                Route::get('/add-trivia-quiz-result', 'QuizController@addTriviaQuizResult')->name('add-trivia-quiz-result')->middleware('permissionCheck:post_write');
                Route::get('/add-trivia-quiz-result-to-db', 'QuizController@addTriviaQuizResultToDB')->name('add-trivia-quiz-result-to-db')->middleware('permissionCheck:post_write');



                Route::get('/edit/{type}/{id}', 'PostController@editPost')->name('edit-post')->middleware('permissionCheck:post_write');
                Route::delete('/remove-post-form', 'PostController@removePostFrom')->name('remove-post-form')->middleware('permissionCheck:post_write');
                Route::post('/add-to', 'PostController@addPostTo')->name('add-to')->middleware('permissionCheck:post_write');
                Route::post('/update/slider-order', 'PostController@updateSliderOrder')->name('update-slider-order')->middleware('permissionCheck:post_write');
                Route::post('/update/featured-order', 'PostController@updateFeaturedOrder')->name('update-featured-order')->middleware('permissionCheck:post_write');
                Route::post('/update/breaking-order', 'PostController@updateBreakingOrder')->name('update-breaking-order')->middleware('permissionCheck:post_write');
                Route::post('/update/recommended-order', 'PostController@updateRecommendedOrder')->name('update-recommended-order')->middleware('permissionCheck:post_write');
                Route::post('/update/editor-picks-order', 'PostController@updateEditorPicksOrder')->name('update-editor-picks-order')->middleware('permissionCheck:post_write');



                Route::post('/update/top-order', 'PostController@updateTopOrder')->name('update-top-order')->middleware('permissionCheck:post_write');
                Route::post('/update/insights-order', 'PostController@updateInsightsOrder')->name('update-insights-order')->middleware('permissionCheck:post_write');
                Route::post('/update/daily-order', 'PostController@updateDailyOrder')->name('update-daily-order')->middleware('permissionCheck:post_write');
                Route::post('/update/viewpoint-order', 'PostController@updateViewpointOrder')->name('update-viewpoint-order')->middleware('permissionCheck:post_write');
                Route::post('/update/events-order', 'PostController@updateEventsOrder')->name('update-events-order')->middleware('permissionCheck:post_write');
                Route::post('/update/advertisement-order', 'PostController@updateAdvertisementOrder')->name('update-advertisement-order')->middleware('permissionCheck:post_write');





                Route::get('/slider', 'PostController@slider')->name('slider-posts')->middleware('permissionCheck:post_read');
                Route::get('/featured', 'PostController@featuredPosts')->name('featured-posts')->middleware('permissionCheck:post_read');
                Route::get('/breaking', 'PostController@breakingPosts')->name('breaking-posts')->middleware('permissionCheck:post_read');
                Route::get('/top', 'PostController@topPosts')->name('top-posts')->middleware('permissionCheck:post_read');
                Route::get('/insights', 'PostController@insightsPosts')->name('insights-posts')->middleware('permissionCheck:post_read');
                Route::get('/daily', 'PostController@dailyPosts')->name('daily-posts')->middleware('permissionCheck:post_read');
                Route::get('/viewpoint', 'PostController@viewpointPosts')->name('viewpoint-posts')->middleware('permissionCheck:post_read');
                Route::get('/events', 'PostController@eventsPosts')->name('events-posts')->middleware('permissionCheck:post_read');
                Route::get('/advertisement', 'PostController@advertisementPosts')->name('advertisement-posts')->middleware('permissionCheck:post_read');
                Route::get('/recommended', 'PostController@recommendedPosts')->name('recommended-posts')->middleware('permissionCheck:post_read');
                Route::get('/editor-picks', 'PostController@editorPicksPosts')->name('editor-picks')->middleware('permissionCheck:post_read');
                Route::get('/pending', 'PostController@pendingPosts')->name('pending-posts')->middleware('permissionCheck:post_read');
                Route::get('/submitted', 'PostController@submittedPosts')->name('submitted-posts')->middleware('permissionCheck:post_read');
                Route::get('/submitted', 'PostController@submittedPosts')->name('submitted-posts')->middleware('permissionCheck:post_read');





                Route::post('/categories/fetch', 'PostController@fetchCategory')->name('category-fetch')->middleware('permissionCheck:post_read');
                Route::post('/sub-categories/fetch', 'PostController@fetchSubcategory')->name('subcategory-fetch')->middleware('permissionCheck:post_read');

                  // company and product

                  Route::get('/companies', 'CompanyController@companies')->name('companies')->middleware('permissionCheck:category_read');
                  Route::post('/companies/add', 'CompanyController@saveNewCompany')->name('save-new-company')->middleware('permissionCheck:category_write');
                  Route::get('/companies/edit/{id}', 'CompanyController@editCompany')->name('edit-company')->middleware('permissionCheck:category_write');
                  Route::post('/companies/update', 'CompanyController@updateCompany')->name('update-company')->middleware('permissionCheck:category_write');


                  
  
                  Route::get('/products', 'CompanyController@products')->name('products')->middleware('permissionCheck:sub_category_read');
                  Route::post('/products', 'CompanyController@productsAdd')->name('save-new-product')->middleware('permissionCheck:sub_category_write');
                  Route::get('/products/edit/{id}', 'CompanyController@editProduct')->name('edit-product')->middleware('permissionCheck:sub_category_write');
                  Route::post('/products/update', 'CompanyController@updateProduct')->name('update-product')->middleware('permissionCheck:sub_category_write');
  
                  Route::post('/companies/fetch', 'PostController@fetchCompany')->name('company-fetch')->middleware('permissionCheck:post_read');
                  Route::post('/products/fetch', 'PostController@fetchProduct')->name('product-fetch')->middleware('permissionCheck:post_read');
                  //filter
                //filter

                Route::get('/filter', 'PostController@filterPost')->name('filter-post')->middleware('permissionCheck:post_read');

                Route::get('/filter/product', 'PostController@filterProduct')->name('filter-product')->middleware('permissionCheck:post_read');

                Route::get('/filterpress', 'PostController@filterPostPress')->name('filter-post-press')->middleware('permissionCheck:post_read');
                //category

                Route::get('/categories', 'CategoryController@categories')->name('categories')->middleware('permissionCheck:category_read');
                Route::post('/categories/add', 'CategoryController@saveNewCategory')->name('save-new-category')->middleware('permissionCheck:category_write');
                Route::get('/categories/edit/{id}', 'CategoryController@editCategory')->name('edit-category')->middleware('permissionCheck:category_write');
                Route::post('/categories/update', 'CategoryController@updateCategory')->name('update-category')->middleware('permissionCheck:category_write');



                //subcategory

                Route::get('/sub-categories', 'CategoryController@subCategories')->name('sub-categories')->middleware('permissionCheck:sub_category_read');
                Route::post('/sub-categories', 'CategoryController@subCategoriesAdd')->name('save-new-sub-category')->middleware('permissionCheck:sub_category_write');
                Route::get('/sub-categories/edit/{id}', 'CategoryController@editSubCategory')->name('edit-sub-category')->middleware('permissionCheck:sub_category_write');
                Route::post('/sub-categories/update', 'CategoryController@updateSubCategory')->name('update-sub-category')->middleware('permissionCheck:sub_category_write');



                //poll

                Route::get('/polls', 'PollController@polls')->name('polls')->middleware('permissionCheck:polls_read');
                Route::get('/poll/create', 'PollController@create')->name('create-poll')->middleware('permissionCheck:polls_write');
                Route::post('/poll/store', 'PollController@store')->name('store-poll')->middleware('permissionCheck:polls_write');
                Route::get('/poll/edit/{id}', 'PollController@edit')->name('poll-edit')->middleware('permissionCheck:polls_write');
                Route::put('/poll/update/{id}', 'PollController@update')->name('update-poll')->middleware('permissionCheck:polls_write');



                //comments

                Route::get('/comments', 'CommentsController@Comments')->name('comments')->middleware('permissionCheck:comments_read');
                Route::get('/comment/setting', 'CommentsController@index')->name('setting-comment')->middleware('permissionCheck:comments_write');
                Route::post('/update/comment-setting', 'CommentsController@updateCommentSettings')->name('update-comment-settings')->middleware('permissionCheck:comments_write');



                Route::get('add-content', 'AddContentController@addContent')->name('add-content')->middleware('permissionCheck:post_write');
                Route::get('btn-image-modal-content/{content_count}', 'AddContentController@btnImageModalContent')->middleware('permissionCheck:post_write');
                Route::get('btn-image-modal-content/{content_count}', 'AddContentController@btnImageModalContent')->middleware('permissionCheck:post_write');



            });



            //post routes

            Route::post('/save/new-post/{type}', 'PostController@saveNewPost')->name('save-new-post')->middleware('permissionCheck:post_write');
            Route::post('/save/new-preview-post/{type}', 'PostController@saveNewPostpreview')->name('save-new-preview-post')->middleware('permissionCheck:post_write');
            Route::post('/preview-post/{slug}', 'PostController@ViewPostpreview')->name('view-new-preview-post')->middleware('permissionCheck:post_write');
            Route::post('/update/{type}/{id}', 'PostController@updatePost')->name('update-post')->middleware('permissionCheck:post_write');


            Route::post('/save/new-press-release/{type}', 'PostController@saveNewPressRelease')->name('save-new-press-release')->middleware('permissionCheck:post_write');
            Route::post('/update-press-release/{type}/{id}', 'PostController@updatePressRelease')->name('update-press-release')->middleware('permissionCheck:post_write');


            Route::post('/update/{id}', 'PostController@update')->name('update-slider')->middleware('permissionCheck:post_write');
            Route::post('/store', 'PostController@store')->name('store-slider')->middleware('permissionCheck:post_write');


            //quiz routes

            Route::post('/save/new-quiz/{type}', 'QuizController@saveNewQuiz')->name('save-new-quiz')->middleware('permissionCheck:post_write');
            //quiz routes
            Route::post('/update-quiz/{type}/{id}', 'QuizController@updateQuiz')->name('update-quiz')->middleware('permissionCheck:post_write');



//            rss routes

            Route::get('/rss-feeds', 'RssController@index')->name('rss-feeds')->middleware('permissionCheck:rss_read');
            Route::get('/import-rss', 'RssController@importRss')->name('import-rss')->middleware('permissionCheck:rss_write');
            Route::post('/save-rss-feed', 'RssController@saveNewRss')->name('save-rss-feed')->middleware('permissionCheck:rss_write');
            Route::get('/rss-feeds/edit/{id}', 'RssController@editRss')->name('edit-rss')->middleware('permissionCheck:rss_write');
            Route::post('/update-rss-feeds/{id}', 'RssController@updateRss')->name('update-rss')->middleware('permissionCheck:rss_write');



//            filter

            Route::get('/filter-rss', 'RssController@filter')->name('filter-rss')->middleware('permissionCheck:rss_read');



//            feed importing manually

            Route::get('/manually-feeding/{id}', 'RssController@manualImport')->name('manually-feeding')->middleware('permissionCheck:post_write');



        });

    });

});

