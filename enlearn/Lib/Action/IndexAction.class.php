<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index()
    {
		if(!isset($_COOKIE["uName"]) && !isset($_COOKIE["uId"]))
		{
            $back->islogin = false;
		}
        else
        {
            $back->islogin = true;
        }
        echo json_encode($back);

    }
    public function add(){
        echo ($this->_post("title"));
    }
    public function addGroup () 
    {
        $group = M("Group");

        if(IS_POST)
        {
            $condition['group_name'] = $data['group_name'] = I("post.group_name");
            $data['group_type'] = I("post.type");
            $data['group_desc'] = I("post.group_desc");
            $data['user_id'] = I("post.uId");
            $data['create_time'] = I("post.ctime");
            $data["id"] = uniqid();
        }

        $ishave = $group->where($condition)->find();
        if($ishave)
        {
            $back["status"] = false;
            $back["msg"] = "该分组已经存在！";
        }
        else
        {
            $result = $group->add($data);
            if($result == 1)
            {
                $back["status"] = true;
                $back["msg"] = "添加分组成功";
            }
            else
            {
                $back["status"] = false;
                $back["msg"] = "添加分组失败";
            }
        }

        echo json_encode($back);

    }
    public function getGroup ()
    {
        $group = M("Group");
        $condition["group_type"] = I("post.type");
        $result = $group->where($condition)->field("user_id", true)->order("create_time desc")->select();
        if($result == NULL)
        {
            $result = [];
        }
        echo json_encode($result);
    }
    public function editGroup () 
    {
        $group = M("Group");
        if(IS_POST)
        {
            $data["group_type"] = I("post.type");
            $condition["group_name"] = $data["group_name"] = I("post.group_name");
            $data["group_desc"] = I("post.group_desc");
            $data['id'] = I("post.id");
            $data['create_time'] = I("post.ctime");
        }
        $result = $group->save($data);
        if($result == 1)
        {
            $back["status"] = true;
            $back["msg"] = "编辑分组成功";
        }
        else
        {
            $back["status"] = false;
            $back["msg"] = "编辑分组失败";
        }
        
        echo json_encode($back);
    }
    public function deleGroup () 
    {
        $group = M("Group");
        if(IS_POST)
        {
            $data["id"] = I("post.id");
        }
        $ishave = $group->where($data)->find();
        if($ishave)
        {
            $result = $group->where($data)->delete();
            if($result == 1)
            {
                $back["status"] = true;
                $back["msg"] = "删除分组成功";
            }
            else
            {
                $back["status"] = false;
                $back["msg"] = "删除分组失败";
            }
        }
        echo json_encode($back);
    }
}