<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\PressRelease;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\SubCategory;
use Modules\Widget\Entities\Widget;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class SitemapController extends Controller
{
    public function sitemap(){
        $post_slugs = Post::select('slug','updated_at')->where('visibility',1)->where('status',1)->get();
        $page_slugs = Page::select('slug','updated_at')->get();
        $categories_slug = Category::select('slug','updated_at')->get();
        $subCategories_slug = SubCategory::select('slug','updated_at')->get();

        $tags_slug = Widget::where('content_type',2)->where('status',1)->get();

        $sitemap =  Sitemap::create();

        $sitemap->add(Url::create('/')
            ->setLastModificationDate(Carbon::today())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0));

        foreach ($post_slugs as $post_slug):
                $sitemap->add(Url::create(settingHelper('article_detail_prefix').'/'.$post_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $post_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        endforeach;

        foreach ($page_slugs as $page_slug):
                $sitemap->add(Url::create(settingHelper('page_detail_prefix').'/'.$page_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $page_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;

        foreach ($categories_slug as $category_slug):
                $sitemap->add(Url::create('category/'.$category_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $category_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;

        foreach ($subCategories_slug as $subCategory_slug):
                $sitemap->add(Url::create('sub-category/'.$subCategory_slug->slug)
                ->setLastModificationDate(Carbon::createFromFormat('Y-m-d H:i:s', $subCategory_slug->updated_at))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
//        dd($tags_slug);
        foreach ($tags_slug as $tag_slug):
            foreach (explode(',',$tag_slug->content) as $t_slug)
//                dd($t_slug);
                $sitemap->add(Url::create('tags/'.$t_slug)
                ->setLastModificationDate(Carbon::today())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        endforeach;
                $sitemap->writeToFile('sitemap.xml');

        return redirect()->back()->with('success', __('successfully_generated'));
    }

    public function sitemapUser() {
        $pageNumber = request()->query('page');
        $linksToShow = 100;
        $limit = 50;
        if (!$pageNumber) { $pageNumber = 1; }
        $offset = ($pageNumber - 1) * $limit;
        
        // get all the data based on the limit and offset
        $categories = Category::select('id', 'slug', 'updated_at')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();
        $press_releases = PressRelease::select('id', 'slug', 'updated_at')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();
        $pages = Page::select('id', 'slug', 'updated_at')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();
        $posts = Post::select('id', 'slug', 'updated_at')->orderBy('updated_at', 'desc')->skip($offset)->take($limit)->get();

        // iterate over each array and make the full url
        foreach ($categories as $category) {
            $category->url = route('site.category', ['slug' => $category->slug]);
        }
        foreach ($press_releases as $press_release) {
            $press_release->url = route('event.detail', ['id' => $press_release->slug]);
        }
        foreach ($pages as $page) {
            $page->url = url(settingHelper('page_detail_prefix').'/'.$page->slug);
        }
        foreach ($posts as $post) {
            $post->url = route('article.detail', ['id' => $post->id, 'slug' => $post->slug]);
        }

        // combine all the data into one array
        $urls = $posts->merge($press_releases)->merge($pages)->merge($categories);

        // get a slice of the data based on the offset and number of items per page
        // $slice = $urls->slice($offset, $linksToShow);

        // create a new instance of LengthAwarePaginator
        // using $url instead of slice, because we already used limit and offset
        $allUrls = new LengthAwarePaginator(
            $urls,
            $posts->count() + $press_releases->count() + $pages->count() + $categories->count(),
            $linksToShow,
            $pageNumber,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('site.pages.sitemap_user', compact('allUrls', 'pageNumber'));
    }

    public function sitemapAuto() {
        // Load the XML file
        $path = base_path('sitemap.xml');
        // if file exists load it, otherwise show error message
        if (file_exists($path)) {
            // load the file
            $xml = simplexml_load_file($path);

            // do it from 8 july instead of yesterday because we're running it for the first time
            // $dateToPickPagesFrom = Carbon::parse('2023-07-08'); // will change this
            $dateToPickPagesFrom = Carbon::yesterday();

            // get all categories from the database created_at descending from yesterday only
            $categories = Category::select('slug','created_at')->where('created_at', '>=', $dateToPickPagesFrom)->get();

            // iterate over all categories and add them to the XML file
            foreach ($categories as $category) {
                // append new child
                $url = $xml->addChild('url');
                $url->addChild('loc', route('site.category', ['slug' => $category->slug]));
                $url->addChild('lastmod', date('Y-m-d', strtotime($category->created_at)));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', '0.9');
            }

            $press_releases = PressRelease::select('slug','created_at')->where('created_at', '>=', $dateToPickPagesFrom)->get();

            foreach ($press_releases as $press_release) {
                $url = $xml->addChild('url');
                $url->addChild('loc', route('event.detail', ['id' => $press_release->slug]));
                $url->addChild('lastmod', date('Y-m-d', strtotime($press_release->created_at)));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', '0.5');
            }

            $pages = Page::select('slug','created_at')->where('created_at', '>=', $dateToPickPagesFrom)->get();
            
            foreach ($pages as $page) {
                $url = $xml->addChild('url');
                $url->addChild('loc', url(settingHelper('page_detail_prefix').'/'.$page->slug));
                $url->addChild('lastmod', date('Y-m-d', strtotime($page->created_at)));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', '0.9');
            }

            $posts = Post::select('id', 'slug','created_at')->where('created_at', '>=', $dateToPickPagesFrom)->get();

            foreach ($posts as $post) {
                $url = $xml->addChild('url');
                $url->addChild('loc', route('article.detail', ['id' => $post->id, 'slug' => $post->slug]));
                $url->addChild('lastmod', date('Y-m-d', strtotime($post->created_at)));
                $url->addChild('changefreq', 'daily');
                $url->addChild('priority', '0.6');
            }

            // save the updated XML file
            // if its saved echo a message
            if ($xml->asXML($path)) {
                echo 'XML file updated';
            } else {
                echo 'Error while updating XML file';
            }
        } else {
            return 'Error loading XML file';
        }
    }

}
