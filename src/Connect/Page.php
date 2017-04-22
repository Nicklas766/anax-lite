<?php
/**
 * Content
 */
namespace nicklas\Connect;

use \PDO;

class Page extends Connect implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


    public function __construct()
    {
        parent::__construct();
    }

    // Echo edit form. Uses ID
    public function getResultSet()
    {
        $sql = <<<EOD
SELECT
*,
CASE
WHEN (deleted <= NOW()) THEN "isDeleted"
WHEN (published <= NOW()) THEN "isPublished"
ELSE "notPublished"
END AS status
FROM content
WHERE type="page"
;
EOD;
        // get res with fetchAll
        return $this->getAllRes($sql);
    }

    public function getPage($path)
    {
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE path = "$path" AND type = "page" AND (deleted IS NULL OR deleted > NOW()) AND published <= NOW() OR
path = "$path" AND type = "block" AND (deleted IS NULL OR deleted > NOW()) AND published <= NOW();
EOD;
        // get res with one fetch
        return $this->getRes($sql);
    }
}
