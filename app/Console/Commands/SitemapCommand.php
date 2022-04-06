<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Illuminate\Support\Str;

class SitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Sitemap::create()
            ->add('/')
            ->add('/questions')
            ->add('/questions?tab=newest')
            ->add('/questions?tab=hot')
            ->add('/questions?tab=active')
            ->add('/questions?tab=week')
            ->add('/questions?tab=month')
            ->add('/tags')
            ->add('/tags?tab=popular')
            ->add('/tags?tab=name')
            ->add('/tags?tab=new')
            ->add('/users')
            ->add('/users?tab=new users')
            ->add('/users?tab=voters')
            ->writeToFile(public_path('sitemaps/sitemap_1.xml'));

        $sitemaps = ['sitemaps/sitemap_1.xml'];

        DB::table('questions')->chunkById(39000, function ($rows) use (&$sitemaps) {
            $sm = Sitemap::create();
            foreach ($rows as $row) {
                $sm->add('/questions/' . $row->id . '/' . Str::slug($row->title, '-'));
            }
            $number = count($sitemaps) + 1;
            $path = 'sitemaps/sitemap_' . $number . '.xml';
            $sm->writeToFile(public_path($path));
            $sitemaps[] = $path;
        });

        DB::table('tags')->chunkById(39000, function ($rows) use (&$sitemaps) {
            $sm = Sitemap::create();
            foreach ($rows as $row) {
                $sm->add('/questions/tagged/' . $row->tag_name);
            }
            $number = count($sitemaps) + 1;
            $path = 'sitemaps/sitemap_' . $number . '.xml';
            $sm->writeToFile(public_path($path));
            $sitemaps[] = $path;
        });

        DB::table('users')->chunkById(39000, function ($rows) use (&$sitemaps) {
            $sm = Sitemap::create();
            foreach ($rows as $row) {
                $sm->add('/users/' . $row->id. '/' . $row->display_name);
            }
            $number = count($sitemaps) + 1;
            $path = 'sitemaps/sitemap_' . $number . '.xml';
            $sm->writeToFile(public_path($path));
            $sitemaps[] = $path;
        });


        $si = SitemapIndex::create();
        foreach ($sitemaps as $sm) {
            $si->add($sm);
        }
        $si->writeToFile(public_path('sitemap.xml'));

        return 0;
    }
}
