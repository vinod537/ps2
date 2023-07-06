@if(!blank($feeds))
<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xml:base="https://pharmashots.com/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
    <title>PharmaShots | Incisive News in 3 Shots</title>
     
    <description>PharmaShots | Incisive News in 3 Shots</description>
        
        @foreach ($feeds as $post)
        @php
        $result = @$post->image->original_image;
        @endphp

        <item>
            <title> <![CDATA[<img align="left" hspace="5" src="{{basePath($post->image)}}/{{ $result }}"/>]]>{{$post->title}}</title>
         

            <link>@if($post->old_id) {{ route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) }} @else {{ route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) }} @endif</link>
            <description>
        
        {{strip_tags($post->content)}}</description>
        <enclosure url="{{basePath($post->image)}}/{{ $result }}" length="640035" type="image/webp" />
                <guid isPermaLink="false">@if($post->old_id) {{ route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ]) }} @else {{ route('article.detail', ['id' => $post->id, 'slug' => $post->slug ]) }} @endif</guid>
                <pubDate>{{ $post->updated_at->tz('UTC')->toAtomString() }}</pubDate>
                <source url="https://pharmashots.com/feeds">{{$post->title}}</source>
                <changefreq>daily</changefreq>

        </item>
        @endforeach
    </channel>
</rss>
@endif