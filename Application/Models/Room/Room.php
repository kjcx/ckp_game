<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/22
 * Time: 上午10:30
 */

namespace App\Models\Room;


use App\Models\Model;
use App\Traits\MongoTrait;
use App\Models\Execl\Room as ExcelRoom;

class Room extends Model
{
    use MongoTrait;

    private $mongoTable = 'ckzc.room';
    private $excelRoom;
    const initRoomKey = 101;//初始化赠送的roomkey
    private $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->excelRoom = new ExcelRoom();
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
        parent::__construct();
    }

    
    /**
     * 初始化的时候要送一个账户 一个住宅
     */
    public function init()
    {
        $roomInfo = $this->excelRoom->getRoomByKey(self::initRoomKey);
        $initRoom = $this->createRoom($roomInfo);
    }

    /**
     *
     */
    public function getUseRoom()
    {
        
    }

    /**
     * 获取当前用户的住宅信息
     */
    public function getRooms()
    {
        return $this->collection->find(['uid' => $this->uid])->toArray();
    }
    /**
     * 创建一个住宅
     * @param $roomInfo
     * @return array|bool
     */
    private function createRoom($roomInfo)
    {
        if (!empty($roomInfo)) {
            $data = $this->createData($roomInfo);
            $result = $this->collection->insertOne($data);
            if ($result->isAcknowledged()) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * 创建数据
     * @param $roomInfo
     * @return array
     */
    private function createData($roomInfo)
    {
        $config = explode(';',$roomInfo['Furniture']);
        $configs = [];
        if (!empty($config)) {
            foreach ($config as $k => $c) {
                $temp = explode(',',$c);
                $configs[] = [
                    'position' => $temp['0'],//位置
                    'item' =>$temp['1'] ,//家具
                    'level' => 1,//家具等级
                ];
            }
        }
        $data = [
            'uid' => $this->uid,
            'value' => $roomInfo['Status'],//身价
            'roomId' => $roomInfo['Key'],//roomId
            'level' => 1,//当前房屋等级
            'config' => $configs//房屋配置
        ];
        return $data;
    }

}