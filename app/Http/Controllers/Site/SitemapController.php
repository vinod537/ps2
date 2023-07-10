<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Page\Entities\Page;
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
        // get 10 categories order by created_at descending
        $categories = Category::select('slug')->orderBy('created_at', 'desc')->take(10)->get();

        // echo '<pre>'; print_r($categories); exit;
        return view('site.pages.sitemap_user', compact('categories'));
    }

    public function sitemapAuto() {
        // Load the XML file
        $path = base_path('sitemap-test.xml');
        $xml = simplexml_load_file($path);

        // get all categories from the database created_at descending from yesterday only
        $categories = Category::select('slug','created_at')->where('created_at', '>=', Carbon::yesterday())->get();

        // iterate over all categories and add them to the XML file
        foreach ($categories as $category) {
            // append new child
            $url = $xml->addChild('url');
            $url->addChild('loc', route('site.category', ['slug' => $category->slug]));
            $url->addChild('lastmod', date('Y-m-d', strtotime($category->created_at)));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', '0.9');
        }

        $press_releases = PressRelease::select('slug','created_at')->where('created_at', '>=', Carbon::yesterday())->get();

        foreach ($press_releases as $press_release) {
            $url = $xml->addChild('url');
            $url->addChild('loc', route('event.detail', ['id' => $press_release->slug]));
            $url->addChild('lastmod', date('Y-m-d', strtotime($press_release->created_at)));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', '0.5');
        }

        $pages = Page::select('slug','created_at')->where('created_at', '>=', Carbon::yesterday())->get();
        
        foreach ($pages as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', url(settingHelper('page_detail_prefix').'/'.$page->slug));
            $url->addChild('lastmod', date('Y-m-d', strtotime($page->created_at)));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', '0.9');
        }

        $posts = Post::select('id', 'slug','created_at')->where('created_at', '>=', Carbon::yesterday())->get();

        foreach ($posts as $post) {
            $url = $xml->addChild('url');
            $url->addChild('loc', route('article.detail', ['id' => $post->id, 'slug' => $post->slug]));
            $url->addChild('lastmod', date('Y-m-d', strtotime($post->created_at)));
            $url->addChild('changefreq', 'daily');
            $url->addChild('priority', '0.6');
        }

        // save the updated XML file
        $xml->asXML($path);
    }

}
