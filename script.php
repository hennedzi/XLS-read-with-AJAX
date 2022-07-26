<?php
require_once __DIR__ . '/PHPExcel/Classes/PHPExcel/IOFactory.php';
class ExcelRead
{
    function import($dbh)
    { //Функция импорта из Excel в БД;
        $xls = PHPExcel_IOFactory::load(__DIR__ . '/pricelist.xls');
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();
        $i = 0;
        foreach ($sheet->toArray() as $row) {
            if (doubleval($row[1]) && doubleval($row[2]) && intval($row[3]) && intval($row[4])) {
                $sth = $dbh->prepare("INSERT INTO `products` SET `name` = :name, `cost` = :cost,`wholesale_cost` = :wholesale_cost, `first_stock_Availability` = :first_stock_Availability,`second_stock_Availability` = :second_stock_Availability, `country` = :country");
                $sth->execute(array('name' => $row[0], 'cost' => doubleval($row[1]), 'wholesale_cost' => doubleval($row[2]), 'first_stock_Availability' => intval($row[3]), 'second_stock_Availability' => intval($row[4]), 'country' => $row[5]));
                $i++;
            }
        }
        print("Импортированно строк:" . $i);
    }
}


class Db
{
    private $db_name, $login, $pass, $dbh;
    function __construct($db_name = 'Excel', $login = 'root', $pass = '')
    {
        $this->db_name = $db_name;
        $this->login = $login;
        $this->pass = $pass;
        try {
            $this->dbh = new PDO(
                'mysql:dbname=' . $this->db_name . ';host=localhost',
                $this->login,
                $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function dbQuery($row = "SELECT * FROM `products`")
    {
        $sth = $this->dbh->prepare($row);
        $sth->execute();
        $list = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }

    function createRow()
    {
        $priselist = new ExcelRead();
        $priselist->import($this->dbh);
    }
}
   
$connect = new Db();
//$connect->createRow();
$list = $connect->dbQuery();

$f=0;
$s=0;
foreach($list as $i){
$f+=$list[$i][3];
$s+=$list[$i][4];
}
echo "Первый склад"+$f;
echo "Второй склад"+$s;
?>

