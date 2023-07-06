<div class="entry-header">
    <div class="header-top p-4">
        <h3 class="entry-title">{!! $post->title ?? '' !!}</h3>
        <div class="entry-meta mb-2">
            <ul class="global-list">
                <li><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                    {{ $post->updated_at->format('F j, Y') }}
                </li>
            </ul>
        </div><!-- /.entry-meta -->
    </div>
    <div class="entry-thumbnail" height="100%">
        @include('site.pages.article.partials.detail_image')
    </div>
</div>

<div class="entry-content p-4">
    @if(@$post->post_type == 'audio')
        @include('site.pages.article.partials.audio')
    @endif
    <div class="paragraph">
        {!! $post->content !!}
    </div>
    @if(isset($post->read_more_link))
        <div class="rss-content-actual-link">
            <a href="{{ $post->read_more_link }}" class="btn btn-primary" target="_blank">{{ __('read_actual_content') }} <i class="fa fa-long-arrow-right"></i>
            </a>
        </div>
    @endif
    @include('site.pages.article.partials.content')
    @if(settingHelper('adthis_option')==1 and settingHelper('addthis_public_id')!=null and settingHelper('addthis_toolbox')!=null)
        {!! base64_decode(settingHelper('addthis_toolbox')) !!}
    @endif
    @if(@$post->post_type == 'trivia-quiz')
        @include('site.pages.article.partials.trivia-quiz')
    @endif
    @if(@$post->post_type == 'personality-quiz')
        @include('site.pages.article.partials.personality-quiz')
    @endif

    @if(@$post->user->permissions['author_show'] == 1)
        @include('site.pages.article.partials.author')
    @endif
</div>
