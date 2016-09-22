<?php 
/*
 * 标题：阿狸子快速订单管理系统
 * 作者：justo2008（旺旺号）
 * 官方网址：www.alizi.net
 * 淘宝店铺：https://hiweb.taobao.com/
 */
 
class ItemModel extends Model {

	protected $fields = array('id','title','url','icon','logo','description');

	public function _initialize(){
 		parent::_initialize();
 		$this->config = R('Common/config');
	}

	public function hotList(){
    		$list   = array();
    		$where = "status=1 AND logo!='' and is_hot=1";
    		if($this->config['item_hot_show']==1 && $this->config['item_hot_num']>0){
				$list  = $this->field($this->fields)->where($where)->order('is_hot desc,sort_order desc,id asc')->limit($this->config['item_hot_num'])->select();
    		}
			
    		return $list;
    }
	
    public function newList(){
	$list   = array();
            $list['title'] = lang('newItem');
	$where = "status=1 AND image!='' ";
	if($this->aliziConfig['item_new_show']==1 && $this->aliziConfig['item_new_num']>0){
	      $list['list']  = $this->field($this->fields)->where($where)->order('sort_order desc,id desc')->limit($this->aliziConfig['item_new_num'])->select();
	}
	return $list;
    }
	
	public function getcategoryList($cid) {

        $Model    = M('Item');
		$TagsType = M('TagsType');
		$list     = array();
	    //INNER JOIN '.C('DB_PREFIX').'tags_type tags_type ON tags_relationship.tags_type_id=tags_type.tags_id 
		//tags_type.tags_pid<>0 and

		$list = $Model->query('SELECT item.title,item.url,item.icon,item.description,item.is_hot,item.logo FROM 
		__TABLE__ item 
		INNER JOIN '.C('DB_PREFIX').'tags_relationship tags_relationship ON item.id=tags_relationship.item_id 
		INNER JOIN '.C('DB_PREFIX').'tags_type tags_type ON tags_relationship.tags_type_id=tags_type.id 
		WHERE item.status=1 AND tags_type.tags_id='.$cid.' ORDER BY item.sort_order DESC,item.id ASC LIMIT 100');
		
	    return $list;
    }
	
	public function gettuijianList($cid) {

        $Model    = M('Item');
		$TagsType = M('TagsType');
		$list     = array();
	    //INNER JOIN '.C('DB_PREFIX').'tags_type tags_type ON tags_relationship.tags_type_id=tags_type.tags_id 
		//tags_type.tags_pid<>0 and

		$list = $Model->query('SELECT item.title,item.url,item.icon,item.description,item.is_hot,item.logo FROM __TABLE__ item INNER JOIN '.C('DB_PREFIX').'tags_relationship tags_relationship ON item.id=tags_relationship.item_id WHERE item.status=1 AND tags_relationship.tags_type_id='.$cid.' ORDER BY item.sort_order DESC,item.id ASC LIMIT 50');
		
	    return $list;
    }

    public function categoryList(string $item_category_id,$num=5 ){
    	$data   = array();
            $category = is_array($item_category_id)?$item_category_id:explode(',', $item_category_id);
            foreach($category as $cid){
                $title = M('Category')->where('id='.$cid)->getField('name');
                $list  = $this->field($this->fields)->where("status=1 AND category_id={$cid}")->order('sort_order desc,id desc')->limit($num)->select();
                $data[] = array('title'=>$title,'list'=>$list);
            }
    	return $data;
    }

}
?>