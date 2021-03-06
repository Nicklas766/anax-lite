<?php
/**
 * Content
 */
namespace nicklas\Connect;

use \PDO;

class Blog extends Connect implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


    public function __construct()
    {
        parent::__construct();
    }
    public function setApp($app)
    {
        $this->app = $app;
        $this->currentUrl = $app->request->getRoute();
    }
    public function showPost($res)
    {
        $text = $this->app->textfilter->doFilter(esc($res["data"]), esc($res["filter"]));
        echo <<<EOD
<article>
<header>
<h1>{$res["title"]}</h1>
<p><i>Latest update: <time datetime=''{$res["published_iso8601"]}'' pubdate>{$res["published"]}</time></i></p>
</header>
$text
</article>
EOD;
    }

    public function showBlog($res)
    {
        //loop through array, put data into table rows
        $rows = null;
        foreach ($res as $row) {
            $rows .= "<section><header>";
            $rows .= "<h1><a href='blog/" . esc($row['slug']) ."'>" . esc($row['title']) ."</a></h1>";
            if (!esc($row['deleted']) == "") {
                $rows .= "<p><i style='color:red;'>Deleted:" . esc($row['deleted']) . "</i></p>";
            }
            $rows .= "<p><i>Published: <time datetime='". esc($row['published_iso8601']) ."' pubdate>". esc($row['published']) ."</time></i></p>";
            $rows .= "</header>";

            $rows .= "".$this->app->textfilter->doFilter(esc($row["data"]), esc($row["filter"]))."</section></article>";
        }
        //print out result as a html table using php heredoc
        echo<<<EOD
$rows
EOD;
    }
    public function getBlogPost($slug)
    {
        //  Matches blog/slug, display content by slug and type post
        $sql = <<<EOD
SELECT *,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content WHERE slug = "$slug" AND type = "post" AND (deleted IS NULL OR deleted > NOW()) AND published <= NOW()
ORDER BY published DESC;
EOD;
        // return res
        return $this->getRes($sql);
    }
    public function getBlog()
    {
        $sql = <<<EOD
SELECT *,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content WHERE type="post" ORDER BY published DESC;
EOD;
        // get res with fetchAll
        return $this->getAllRes($sql);
    }
}
