<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 下午3:42
 */
namespace App\Models\LoadData;
use App\Models\Model;
use think\Db;

class ShopAll extends Model
{

    public function get()
    {
        $data = Db::table('ckzc.Drop')->where('Id','in',['1000','1001','1002','1003','1004','4102','4103'])->select();
//        var_dump($data);
        $item = Db::table('item')->select();
        foreach ($item as $v) {
            $new_item[$v['Id']] = $v;
        }
//        var_dump($new_item);
        foreach ($data as $v) {
                $DropLib = $v['DropLib'];//商品id，数量，权重
                $arr = explode(';',$DropLib);
//                var_dump($arr);
                $data1 = $this->rand_arr($arr,$new_item,$v['Id']);
               $new[] = $data1;
        }
        return $new;
    }
    public function rand_arr($arr,$new_item,$Id){
//        var_dump($arr);//测试只取9个商品即可
        $data = [];

        foreach ($arr as $k =>$v) {
            if($k<9){
                $item = explode(',',$v);
//                var_dump($item);
                $data['GridId'] = $k;
                $data['DropKuId'] = $Id;
                $data['Id'] = $item[0];
                $data['Count'] = $new_item[$item[0]]['Count'];
                if($Id == 1000){
                    $ShopType = 11;
                }elseif ($Id == 1001){
                    $ShopType = 12;
                }elseif ($Id == 1002){
                    $ShopType = 13;
                }elseif ($Id == 1003){
                    $ShopType = 14;
                }elseif ($Id == 1004){
                    $ShopType = 15;
                }elseif ($Id == 4102){
                    $ShopType = 107;
                }elseif ($Id == 4103){
                    $ShopType = 108;
                }
                $data['ShopType'] = $ShopType;
                $data['DiscountedPrice'] = 1;
                $new_arr[] = $data;
            }
        }
        return $new_arr;
    }
}