<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 上午11:08
 */
namespace App\Models\User;
use App\Models\Model;

class Account extends Model
{
    private $db;
    private $redisdb;
    private $table = 'ckzc_member';
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->mysqlPool->getObj();
        $this->redisdb = $this->reidsPool->getObj();
    }

    public function index()
    {

        $arr = ['uid'=>2,'sex'=>1,'status'=>1,'create_time'=>time()];
        $this->db->insert("ckzc_role",$arr);
    }

    /**
     * 单独查询
     * @param $where
     * @return array
     */
    function find($where)
    {
        $arr = $this->db->where($where)->getOne($this->table);
        $this->freeMysql($this->db);
        return $arr;
    }

    /**
     * 插入数据
     * @param $member_info
     * @return mixed
     */
    function insert($data)
    {
        $id = $this->db->insert($this->table, $data);
        $this->freeMysql($this->db);
        return $id;
    }

    /**
     * 修改用户信息
     * @param $where
     * @param $data
     * @return mixed
     */
    function update($where,$data)
    {
        $result = $this->db->where($where)->update($this->table,$data);
        if ($this->db->getLastErrno() === 0)
            return true;
        else{
            echo 'Update failed. Error: '. $this->db->getLastError();
            return false;
        }
    }

    /**
     * 根据用户id创建token
     * @param $uid
     * @return bool|string
     */
    public function crateToken($uid)
    {
        $token = md5($uid . rand(10000,99999) . rand(10000,99999). microtime() );
        //插入到
         $rs = $this->redisdb->exec("set",$token,$uid);
         $this->freeRedis($this->redisdb);
         if($rs){
             return $token;
         }else{
             return false;
         }
    }

    /**
     * 获取token
     * @param $token
     * @return bool
     */
    public function getToken($token)
    {
        $rs = $this->redisdb->exec("get",$token);
        var_dump($rs);
        $this->freeRedis($this->redisdb);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

}