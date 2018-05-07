<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/26
 * Time: 上午10:11
 */

namespace App\Tests;
use App\HttpController\Index;
use App\Models\User\Role;
use EasySwoole\Core\Http\Request;
use EasySwoole\Core\Http\Response;
use PHPUnit\DbUnit\Database\DefaultConnection;
use PHPUnit_Extensions_Database_DataSet_ArrayDataSet;
use PHPUnit\DbUnit\DataSet\IDataSet;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\Framework\TestCase;
class IndexTest extends TestCase
{
    public function testIndex()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
    use TestCaseTrait;

    /**
     * @return  DefaultConnection
     */
    public function getConnection()
    {
        $database = 'ckzc';
        $user = 'root';
        $password = 'mmDongkaikjcx13579';
        $dsn="mysql:host=139.129.119.229;dbname=$database";
        $pdo = new \PDO($dsn, $user, $password);
        return $this->createDefaultDBConnection($pdo, $database);
    }
    protected function getDataSet()
    {
        return new MyApp_DbUnit_ArrayDataSet(
            [
                'ckzc_role' => [
                    [
                        'uid' => 23,
                        'sex' => 1,
                        'nickname' => 'joe',
                        'icon' => 'npc_001'
                    ]
                ],
            ]
        );
    }
    public function testGuestbook()
    {
        $dataSet = $this->getConnection()->createDataSet();
        var_dump($dataSet->getTableMetaData('ckzc_role')->getColumns());//获取字段
        $dataSet = $this->getConnection()->getRowCount('ckzc_role');
        var_dump($dataSet);
        $this->assertEquals(1,$dataSet);
        // ...
    }

    public function testFilteredGuestbook()
    {
        $tableNames = 'ckzc_role';

        $role = new Role();
        $rs = $role->createRole('2','kjcx',1);
//        $queryTable = $this->getConnection()->createQueryTable($tableNames, "SELECT * FROM $tableNames where uid = 2");
//        $data = $queryTable->getRow(0);
//        $this->assertEquals('kjcx',$data['nickname']);

    }

    public function testTest()
    {

        $index = new Index('');
        $c= $index->test(1,2);
        $this->assertEquals(3,$c);
    }


}