<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">{{__('dashboard')}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    @if(Sentinel::getUser()->roles[0]->id != 4 && Sentinel::getUser()->roles[0]->id != 5)
                    <li class="nav-item ">
                        <a class="nav-link @yield('home')" href="{{ route('dashboard') }}">
                            <i class="fas fa-home fa-th-large"></i>{{__('dashboard')}}
                        </a>
                    </li>
                    @else
                    <li class="nav-item ">
                        <a class="nav-link @yield('home')" href="{{ route('user-account') }}">
                            <i class="fas fa-home fa-th-large"></i>{{__('profile')}}
                        </a>
                    </li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['polls_read']) || Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete']))
                    <li class="nav-item">
                        <a class="nav-link @yield('post-active')" href="{{route('press-release')}}">
                            <i class="mdi mdi-poll"></i>{{__('Press Release')}}
                        </a>
                    </li>
                @endif

                    @if(Sentinel::getUser()->hasAccess(['post_read']) || Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete']))
                        <li class="nav-item ">
                            <a class="nav-link @yield('post')" href="#" data-toggle="collapse" @yield('post-aria-expanded', 'aria-expanded=false') data-target="#submenu-2" aria-controls="submenu-2">
                                <i class="fas fa-fw fa-th-list"></i>{{__('posts')}}
                            </a>
                            <div id="submenu-2" class="collapse submenu @yield('post-show')">
                                <ul class="nav flex-column">
                                    @if(Sentinel::getUser()->hasAccess(['post_write']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('create_article')" href="{{ route('create-article') }}">{{ __('create_article') }} </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link @yield('create_video')" href="{{ route('create-video-post') }}">{{ __('create_video_post') }} </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @yield('create_audio')" href="{{ route('create-audio-post') }}">{{ __('create_audio_post') }} </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @yield('create_trivia_quiz')" href="{{ route('create-trivia-quiz') }}">{{ __('create_trivia_quiz') }} </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @yield('create_personality_quiz')" href="{{ route('create-personality-quiz') }}">{{ __('create_personality_quiz') }} </a>
                                        </li> -->
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link @yield('post-active')" href="{{ route('post') }}">{{ __('all_post') }}</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('slider-post-active')" href="{{ route('slider-posts') }}">{{ __('slider_posts') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @yield('feature-post-active')" href="{{ route('featured-posts') }}">{{ __('featured_posts') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @yield('breaking-post-active')" href="{{ route('breaking-posts') }}">{{ __('breaking_posts') }}</a>
                                    </li> -->


                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('top-post-active')" href="{{ route('top-posts') }}">{{ __('top_20_posts') }}</a>
                                    </li> -->


                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('insights-post-active')" href="{{ route('insights-posts') }}">{{ __('insights_plus_posts') }}</a>
                                    </li> -->


                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('viewpoint-post-active')" href="{{ route('viewpoint-posts') }}">{{ __('viewpoint_posts') }}</a>
                                    </li> -->

                                    <!-- 
                                    <li class="nav-item">
                                        <a class="nav-link @yield('events-post-active')" href="{{ route('events-posts') }}">{{ __('events_posts') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link @yield('advertisement-post-active')" href="{{ route('advertisement-posts') }}">{{ __('advertisement_posts') }}</a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link @yield('daily-post-active')" href="{{ route('daily-posts') }}">{{ __('daily_news_posts') }}</a>
                                    </li>

                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('recommended-post-active')" href="{{ route('recommended-posts') }}">{{ __('recommended_posts') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link @yield('editor-picks-active')" href="{{ route('editor-picks') }}">{{ __('editor_picks') }}</a>
                                    </li>
                                    -->
                                    <li class="nav-item">
                                        <a class="nav-link @yield('pending-post-active')" href="{{ route('pending-posts') }}">{{ __('Draft Post') }}</a>
                                    </li> 

                                    <!-- <li class="nav-item">
                                        <a class="nav-link @yield('submitted-post-active')" href="{{ route('submitted-posts') }}">{{ __('submitted_posts') }}</a>
                                    </li> -->
                                    @if(Sentinel::getUser()->hasAccess(['category_read']) || Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('category-active')" href="{{ route('categories') }}">{{__('categories')}}</a>
                                        </li>
                                    @endif
                                    @if(Sentinel::getUser()->hasAccess(['sub_category_read']) || Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('sub-category-active')" href="{{ route('sub-categories') }}">{{__('sub_categories')}}</a>
                                        </li>
                                    @endif

                                    
                                    @if(Sentinel::getUser()->hasAccess(['category_read']) || Sentinel::getUser()->hasAccess(['category_write']) || Sentinel::getUser()->hasAccess(['category_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('company-active')" href="{{ route('companies') }}">{{__('Companies')}}</a>
                                        </li>
                                    @endif
                                    @if(Sentinel::getUser()->hasAccess(['sub_category_read']) || Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('product-active')" href="{{ route('products') }}">{{__('Products')}}</a>
                                        </li>
                                    @endif

                                    
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['polls_read']) || Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete']))
                    <li class="nav-item">
                        <a class="nav-link @yield('import')" href="{{route('import')}}">
                            <i class="mdi mdi-poll"></i>{{__('Product Bulk Upload')}}
                        </a>
                    </li>
                    
                @endif



                    @if(Sentinel::getUser()->hasAccess(['rss_read']) || Sentinel::getUser()->hasAccess(['rss_write']) || Sentinel::getUser()->hasAccess(['rss_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('rss')" href="{{route('rss-feeds')}}">
                                <i class="mdi mdi-poll"></i>{{__('rss_feeds')}}
                            </a>
                        </li>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['comments_read']) || Sentinel::getUser()->hasAccess(['comments_write']) || Sentinel::getUser()->hasAccess(['comments_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('comments_active')" href="#" data-toggle="collapse" @yield('comments-aria-expanded', 'aria-expanded=false') data-target="#submenu-115" aria-controls="submenu-115">
                                <i class="fas fa-fw fa-comments"></i>{{__('comments')}}
                            </a>
                            <div id="submenu-115" class="collapse submenu @yield('comments-show')">
                                <ul class="nav flex-column">
                                    @if(Sentinel::getUser()->hasAccess(['comments_read']) || Sentinel::getUser()->hasAccess(['comments_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('comments')" href="{{ route('comments') }}">
                                                {{__('all_comments')}}
                                            </a>
                                        </li>
                                    @endif
                                 

                                </ul>
                            </div>
                        </li>
                    @endif
                    @if(Sentinel::getUser()->hasAccess(['album_read']) || Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('gallery')" href="#" data-toggle="collapse" @yield('gallery-aria-expanded', 'aria-expanded=false') data-target="#submenu-130" aria-controls="submenu-115">
                                <i class="fas fa-fw fa-image"></i>{{__('gallery')}}
                            </a>
                            <div id="submenu-130" class="collapse submenu @yield('gallery-show')">
                                <ul class="nav flex-column">
                                    @if(Sentinel::getUser()->hasAccess(['album_read']) || Sentinel::getUser()->hasAccess(['album_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('all-images-active')" href="{{ route('images') }}">
                                                {{__('images')}}
                                            </a>
                                        </li>
                                    @endif
                                    @if(Sentinel::getUser()->hasAccess(['album_read']) || Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete']))
                                        <li class="nav-item">
                                            <a class="nav-link @yield('albums-active')" href="{{ route('albums') }}">
                                                {{__('albums')}}
                                            </a>
                                        </li>
                                    @endif
{{--                                    @if(Sentinel::getUser()->hasAccess(['album_read']) || Sentinel::getUser()->hasAccess(['album_write']) || Sentinel::getUser()->hasAccess(['album_delete']))--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link @yield('albums-categories')" href="{{ route('album-categories') }}">--}}
{{--                                                {{__('categories')}}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
                                </ul>
                            </div>
                        </li>
                    @endif

              
                    @if(Sentinel::getUser()->hasAccess(['polls_read']) || Sentinel::getUser()->hasAccess(['polls_write']) || Sentinel::getUser()->hasAccess(['polls_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('poll')" href="{{route('polls')}}">
                                <i class="mdi mdi-poll"></i>{{__('polls')}}
                            </a>
                        </li>
                    @endif
                  
                    @if(Sentinel::getUser()->hasAccess(['ads_read']) || Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('ads')" href="{{ route('ads') }}">
                                <i class="fab fa-fw fa-buysellads"></i>{{__('ads')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('assign-ads')" href="{{ route('assign-ads') }}">
                                <i class="fab fa-fw fa-buysellads"></i>{{__('ads')}} {{__('Assign')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @yield('sliders')" href="{{ route('sliders') }}">
                                <i class="fab fa-fw fa-buysellads"></i>{{__(' Sliders')}}
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link @yield('youtubes')" href="{{ route('youtubes') }}">
                                <i class="fab fa-fw fa-buysellads"></i>{{__(' Youtube Post')}}
                            </a>
                        </li>
                       
                    @endif



                   

                    @if(Sentinel::getUser()->hasAccess(['theme_section_read']) || Sentinel::getUser()->hasAccess(['theme_section_write'])
                                        || Sentinel::getUser()->hasAccess(['theme_section_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('sections')" href="{{ route('sections') }}">
                                <i class="fas fa-cogs fa-th-large"></i>{{ __('home_content') }}
                            </a>
                        </li>
                    @endif


                    @if(Sentinel::getUser()->hasAccess(['theme_section_read']) || Sentinel::getUser()->hasAccess(['theme_section_write'])
                                        || Sentinel::getUser()->hasAccess(['theme_section_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('settings')" href="{{ route('setting-custom-header-footer') }}">
                                <i class="fas fa-cogs fa-th-large"></i>{{ __('Analytics & Other Script') }}
                            </a>
                        </li>

                        
                    @endif
                 

                    @if(Sentinel::getUser()->hasAccess(['socials_read']) || Sentinel::getUser()->hasAccess(['socials_write']) || Sentinel::getUser()->hasAccess(['socials_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('social')" href="{{route('socials')}}">
                                <i class="mdi mdi-poll"></i>{{__('socials')}}
                            </a>
                        </li>
                    @endif

               

                    <!-- @if(Sentinel::getUser()->hasAccess(['newsletter_read']) || Sentinel::getUser()->hasAccess(['newsletter_write']) || Sentinel::getUser()->hasAccess(['newsletter_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('newsletter_active')" href="#" data-toggle="collapse" @yield('newsletter-aria-expanded', 'aria-expanded=false') data-target="#submenu-114" aria-controls="submenu-114">
                                <i class="fa fa-paper-plane"></i>{{__('newsletter')}}
                            </a>
                            <div id="submenu-114" class="collapse submenu @yield('newsletter-show')">
                                <ul class="nav flex-column">
                                    <li class="nav-item ">
                                        <a class="nav-link @yield('send_newsletter')" href="{{ route('send-email-to-subscriber') }}">
                                            {{__('send_email_to_subscribers')}}
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link @yield('subscriber')" href="{{ route('subscriber-list') }}">
                                            {{ __('subscribers') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif -->

                    @if(Sentinel::getUser()->hasAccess(['contact_message_read']) || Sentinel::getUser()->hasAccess(['contact_message_write']) || Sentinel::getUser()->hasAccess(['contact_message_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('contact_message')" href="{{ route('contact') }}">
                                <i class="fas fa-fw fa-space-shuttle"></i>{{ __('contact_messages') }}
                            </a>
                        </li>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['permission_read']) || Sentinel::getUser()->hasAccess(['permission_write']) || Sentinel::getUser()->hasAccess(['permission_delete']) ||
                        Sentinel::getUser()->hasAccess(['role_read']) || Sentinel::getUser()->hasAccess(['role_write']) || Sentinel::getUser()->hasAccess(['role_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('rolePermission')" href="#" data-toggle="collapse" @yield('rolePermission_', 'aria-expanded=false') data-target="#submenu-110" aria-controls="submenu-110">
                                <i class="fas fa-fw fa-key"></i>{{ __('roles_&_permissions') }}
                            </a>
                            <div id="submenu-110" class="collapse submenu @yield('p-show')">

                                <ul class="nav flex-column">
                                    @if(Sentinel::getUser()->hasAccess(['permission_read']) || Sentinel::getUser()->hasAccess(['permission_write']) || Sentinel::getUser()->hasAccess(['permission_delete']))
                                        <li class="nav-item ">
                                            <a class="nav-link @yield('rolePermissionsub')" href="{{ route('roles')}}">
                                                {{ __('roles') }}
                                            </a>
                                        </li>
                                    @endif

                                    @if(Sentinel::getUser()->hasAccess(['role_read']) || Sentinel::getUser()->hasAccess(['role_write']) || Sentinel::getUser()->hasAccess(['role_delete']))
                                        <li class="nav-item ">
                                            <a class="nav-link @yield('permissions')" href="{{ route('permissions')}}">
                                                {{ __('permissions') }}
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>
                    @endif

                    @if(Sentinel::getUser()->hasAccess(['users_read']) || Sentinel::getUser()->hasAccess(['users_write']) || Sentinel::getUser()->hasAccess(['users_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('user-list')" href="{{route('users-list')}}">
                                <i class="fas fa-fw fa-users"></i>{{__('users')}}
                            </a>
                        </li>
                    @endif

                   

                  

                    @if(Sentinel::getUser()->hasAccess(['language_settings_read']) || Sentinel::getUser()->hasAccess(['language_settings_write']) || Sentinel::getUser()->hasAccess(['language_settings_delete']))
                        <li class="nav-item">
                            <a class="nav-link @yield('language-setting')" href="{{route('language-settings')}}">
                                <i class="fas fa-fw fa-globe"></i>{{__('language_settings')}}
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="#"> </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"> </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
