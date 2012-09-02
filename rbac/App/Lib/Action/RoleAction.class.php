<?php
// 角色模块
class RoleAction extends CommonAction {
    function _filter(&$map){
        if(!empty($_POST['name'])) {
        $map['title'] = array('like',"%".$_POST['name']."%");
        }
    }

    public function setApp() {
        $id     = $_POST['groupAppId'];
        $groupId	=	$_POST['groupId'];
        $group    =   D('Role');
        $group->delGroupApp($groupId);
        $result = $group->setGroupApps($groupId,$id);

        if($result===false) {
            $this->error('项目授权失败！');
        }else {
            $this->success('项目授权成功！');
        }
    }

    public function app() {
        //读取系统的项目列表
        $node    =  D("Node");
        $list	=	$node->where('level=1')->field('id,title')->select();
        foreach ($list as $vo){
            $appList[$vo['id']]	=	$vo['title'];
        }

        //读取系统组列表
        $group   =  D('Role');
        $list       =  $group->field('id,name')->select();
        foreach ($list as $vo){
            $groupList[$vo['id']]	=	$vo['name'];
        }
        $this->assign("groupList",$groupList);

        //获取当前用户组项目权限信息
        $groupId =  isset($_GET['groupId'])?$_GET['groupId']:'';
        $groupAppList = array();
        if(!empty($groupId)) {
            $this->assign("selectGroupId",$groupId);
            //获取当前组的操作权限列表
            $list	=	$group->getGroupAppList($groupId);
            foreach ($list as $vo){
                $groupAppList[$vo['id']]	=	$vo['id'];
            }
        }
        $this->assign('groupAppList',$groupAppList);
        $this->assign('appList',$appList);
        $this->display();

        return;
    }

    public function setModule() {
        $id     = $_POST['groupModuleId'];
        $groupId	=	$_POST['groupId'];
        $appId	=	$_POST['appId'];
        $group    =   D("Role");
        $group->delGroupModule($groupId,$appId);
        $result = $group->setGroupModules($groupId,$id);

        if($result===false) {
            $this->error('模块授权失败！');
        }else {
            $this->success('模块授权成功！');
        }
    }

    public function module() {
        $groupId =  $_GET['groupId'];
        $appId  = $_GET['appId'];

        $group   =  D("Role");
        //读取系统组列表
        $list=$group->field('id,name')->select();
        foreach ($list as $vo){
            $groupList[$vo['id']]	=	$vo['name'];
        }
        $this->assign("groupList",$groupList);

        if(!empty($groupId)) {
            $this->assign("selectGroupId",$groupId);
            //读取系统组的授权项目列表
            $list	=	$group->getGroupAppList($groupId);
            foreach ($list as $vo){
                $appList[$vo['id']]	=	$vo['title'];
            }
            $this->assign("appList",$appList);
        }
        $node    =  D("Node");
        if(!empty($appId)) {
            $this->assign("selectAppId",$appId);
            //读取当前项目的模块列表
            $where['level']=2;
            $where['pid']=$appId;
            $nodelist=$node->field('id,title')->where($where)->select();
            foreach ($nodelist as $vo){
                $moduleList[$vo['id']]	=	$vo['title'];
            }
        }

        //获取当前项目的授权模块信息
        $groupModuleList = array();
        if(!empty($groupId) && !empty($appId)) {
            $grouplist	=	$group->getGroupModuleList($groupId,$appId);
            foreach ($grouplist as $vo){
                $groupModuleList[$vo['id']]	=	$vo['id'];
            }
        }

        $this->assign('groupModuleList',$groupModuleList);
        $this->assign('moduleList',$moduleList);

        $this->display();

        return;
    }

    public function setAction() {
        $id     = $_POST['groupActionId'];
        $groupId	=	$_POST['groupId'];
        $moduleId	=	$_POST['moduleId'];
        $group    =   D("Role");
        $group->delGroupAction($groupId,$moduleId);
        $result = $group->setGroupActions($groupId,$id);

        if($result===false) {
            $this->error('操作授权失败！');
        }else {
            $this->success('操作授权成功！');
        }
    }

    public function action() {
        $groupId =  $_GET['groupId'];
        $appId  = $_GET['appId'];
        $moduleId  = $_GET['moduleId'];

        $group   =  D("Role");
        //读取系统组列表
        $grouplist=$group->field('id,name')->select();
        foreach ($grouplist as $vo){
            $groupList[$vo['id']]	=	$vo['name'];
        }
        $this->assign("groupList",$groupList);

        if(!empty($groupId)) {
            $this->assign("selectGroupId",$groupId);
            //读取系统组的授权项目列表
            $list	=	$group->getGroupAppList($groupId);
            foreach ($list as $vo){
                $appList[$vo['id']]	=	$vo['title'];
            }
            $this->assign("appList",$appList);
        }
        if(!empty($appId)) {
            $this->assign("selectAppId",$appId);
            //读取当前项目的授权模块列表
            $list	=	$group->getGroupModuleList($groupId,$appId);
            foreach ($list as $vo){
                $moduleList[$vo['id']]	=	$vo['title'];
            }
            $this->assign("moduleList",$moduleList);
        }
        $node    =  D("Node");

        if(!empty($moduleId)) {
            $this->assign("selectModuleId",$moduleId);
            //读取当前项目的操作列表
            $map['level']=3;
            $map['pid']=$moduleId;
            $list	=	$node->where($map)->field('id,title')->select();
            if($list) {
                foreach ($list as $vo){
                    $actionList[$vo['id']]	=	$vo['title'];
                }
            }
        }

        //获取当前用户组操作权限信息
        $groupActionList = array();
        if(!empty($groupId) && !empty($moduleId)) {
            //获取当前组的操作权限列表
            $list	=	$group->getGroupActionList($groupId,$moduleId);
            if($list) {
            foreach ($list as $vo){
                $groupActionList[$vo['id']]	=	$vo['id'];
            }
            }

        }

        $this->assign('groupActionList',$groupActionList);
        //$actionList = array_diff_key($actionList,$groupActionList);
        $this->assign('actionList',$actionList);

        $this->display();

        return;
    }

    public function setUser() {
        $id     = $_POST['groupUserId'];
        $groupId	=	$_POST['groupId'];
        $group    =   D("Role");
        $group->delGroupUser($groupId);
        $result = $group->setGroupUsers($groupId,$id);
        if($result===false) {
            $this->error('授权失败！');
        }else {
            $this->success('授权成功！');
        }
    }

    public function user() {
        //读取系统的用户列表
        $user    =   D("User");
        $list2=$user->field('id,account,nickname')->select();
        //echo $user->getlastsql();
        //dump(	$user);
        foreach ($list2 as $vo){
            $userList[$vo['id']]	=	$vo['account'].' '.$vo['nickname'];
        }

        $group    =   D("Role");
        $list=$group->field('id,name')->select();
        foreach ($list as $vo){
            $groupList[$vo['id']]	=	$vo['name'];
        }
        $this->assign("groupList",$groupList);

        //获取当前用户组信息
        $groupId =  isset($_GET['id'])?$_GET['id']:'';
        $groupUserList = array();
        if(!empty($groupId)) {
            $this->assign("selectGroupId",$groupId);
            //获取当前组的用户列表
            $list	=	$group->getGroupUserList($groupId);
            foreach ($list as $vo){
                $groupUserList[$vo['id']]	=	$vo['id'];
            }

        }
        $this->assign('groupUserList',$groupUserList);
        $this->assign('userList',$userList);
        $this->display();

        return;
    }

    public function _before_edit(){
       $Group = D('Role');
        //查找满足条件的列表数据
        $list     = $Group->field('id,name')->select();
        $this->assign('list',$list);

    }

    public function _before_add(){
       $Group = D('Role');
        //查找满足条件的列表数据
        $list     = $Group->field('id,name')->select();
        $this->assign('list',$list);

    }
}