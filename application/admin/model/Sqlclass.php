<?php 
 namespace app\admin\Model; 
use think\Model; 

class Sqlclass extends Model{ 
    
    //查询sqlclass表中所有数据  
    public function sel_all(){  
        $arr = $this->Table('vedio_sqlclass')->select();  
        return $this->list_level($arr,$pid=0,$level=0);  
    }  
    //递归遍历数据  
    public function list_level($arr,$pid=0,$level=0){  
        //定义一个静态数组  
        static $data = array();  
        foreach($arr as $k => $v){  
            if($v['pid'] == $pid){  
                $v['level'] = $level;  
                $data[] = $v;  
                $this->list_level($arr,$v['id'],$level+1);  
            }  
        }  
        return $data;  
    }  
}  