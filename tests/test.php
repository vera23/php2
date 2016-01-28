<?php



/*$binded �������� ������  ���� � ����������� ������ ������*/

class News extends Model
{
    public $title;
    public $published;
    public $lead;
    public $text;

    const TABLE = "news";

    public static function findLastTreeNews() {
        $db = new Db();
        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE published = ?';
        return $db->query($sql, self::class, ["2010-05-07 00:00:00"]);
    }
}

/*- � ������ �� ��������, ��� ��� ����� ���������� �����*/

$sql = 'SELECT * FROM ' . self::TABLE . ' ORDER BY published DESC LIMIT = ?';
return $db->query($sql, self::class, [3]);




