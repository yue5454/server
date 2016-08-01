<?php

class LoginAction extends Action {
	public function login () 
	{
		$user = M("User");

		if(IS_POST)
		{
			$data["user_name"] = I("post.username");
			$data["user_pwd"] = I("post.password","","md5");
		}
		$result = $user->where($data)->find();
		if($result && $result != null)
		{
			$back["status"] = "ok";
			$back["text"] = "登陆成功！";
			cookie("Uname",$data["user_name"]);
			cookie("Uid",$result["id"]);
			echo json_encode($back);
		}
		else
		{
			echo "登录失败";
		}
	}
	public function sign ()
	{
		$user = M("User");

		if(IS_POST)
		{
			$data["user_name"] = I("post.username");
			$data["user_pwd"] = I("post.password","","md5");
			$data["create_time"] = date("Y-m-d H:i:s", time());
			$data["id"] = uniqid();
		}
		$condition["user_name"] = I("post.username");
		$ishave = $user->where($condition)->find();
		if($ishave != null)
		{
			$back["status"] = "error";
			$back["text"] = "该用户已存在";
			echo json_encode($back);
		}
		else
		{
			$result = $user->add($data);
			if($result == 1)
			{
				$back["status"] = "ok";
				$back["text"] = "注册成功！";
				echo json_encode($back);
			}
			else 
			{
				$back["status"] = "error";
				$back["text"] = "注册失败";
				echo json_encode($back);
			}
		}
	}
}