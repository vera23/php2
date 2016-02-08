<?php


/*$binded �������� ������  ���� � ����������� ������ ������*/

class News extends Model
{
    public $title;
    public $published;
    public $lead;
    public $text;

    const TABLE = "news";

    public static function findLastTreeNews()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE published = ?';
        return $db->query($sql, self::class, ["2010-05-07 00:00:00"]);
    }
}

/*- � ������ �� ��������, ��� ��� ����� ���������� �����*/

$sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY published DESC LIMIT = ?';
return $db->query($sql, self::class, [3]);

//ArrayAccess tests

$a = ['one' => 'ololo', 'two' => 'alala'];

$news = new \App\Models\News($a);
var_dump(array_key_exists('one', $news)); //bool(false)


$news = new \App\Models\News();
$news = ['one' => 'ololo', 'two' => 'alala'];

var_dump(array_key_exists('one', $news)); //bool(true)


$a = ['one' => 'ololo', 'two' => 'alala'];

$news = new \App\Models\News($a);
$news[] = 'tree';

var_dump($news);

//array(2) {
//    ["one"]=> string(5) "ololo" ["two"]=> string(5) "alala" } object(App\Models\News)
    #1 (11) { ["title"]=> NULL ["published"]=> NULL ["lead"]=> NULL ["text"]=> NULL ["author_id"]=> NULL ["titleAlert"]=> NULL ["leadAlert"]=> NULL ["textAlert"]=> NULL ["data":protected]=> array(0) { } ["id"]=> NULL ["container":"App\Models\News":private]=> array(3) { ["one"]=> string(5) "ololo" ["two"]=> string(5) "alala" [0]=> string(4) "tree" } }






