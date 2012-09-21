<?php
class IndexAction extends Action {

    public function index() {
        // 关联写入
        $User = D("Member");
        $info[] =   '关联数据操作开始';
        G('1');
        // 添加用户数据
        $User->name     = 'thinkphp';
        $User->dept_id  = 1;
        // 用户档案数据
        $User->Profile  = array(
            'email'     => 'liu21st@gmail.com',
            'nickname'  => '流年',
        );
        // 用户的银行卡数据
        $User->Card     = array(
            array('id'=>1,'card' => '12345678'),
            array('id'=>2,'card' => '88888888'),
        );
        // 用户的所属项目组数据
        $User->Groups = array(
            array('id' => 1),
            array('id' => 2),
        );
        $info[] =   '<div class="result">'.dump($User->data(),false).'</div>';
        // 关联添加用户数据
        $id = $User->relation(true)->add();
        $info[] =   '用户数据关联写入完成！用时：'.G('1','2',6).'s';

        // 关联查询
        $user = $User->relation(true)->find($id);
        $info[] =   '查询用户ID为'.$id.'的所有关联数据,用时：'.G('2','3',6).'s';
        $info[] =   '<div class="result">'.dump($user,false).'</div>';
        $user = $User->relation('Profile')->find($id);
        $info[] =   '查询用户ID为'.$id.'的用户档案关联数据,用时：'.G('3','4',6).'s';
        $info[] =   '<div class="result">'.dump($user,false).'</div>';
        $list = $User->relation('Card')->order('id desc')->limit(2)->select();
        $info[] =   '查询用户的数据集并包含用户银行卡关联数据,用时：'.G('4','5',6).'s';
        foreach ($list as $key=>$val){
            $info[] =   '<div class="result">'.dump($val,false).'</div>';
        }
        G('6');
        // 关联更新
        $user['id']     = $id;
        $user['name']   = 'tp';
        // HAS_ONE 关联数据的更新直接赋值
        $user['Profile']['email'] = 'thinkphp@qq.com';
        $user['dept_id'] = 2;
        // 注意HAS_MANY 的关联数据要加上主键的值
        // 可以更新部分数据
        $user['Card']   = array(
            array('id'  => 1, 'card' => '66666666'), // 更新主键为1的记录
            array('card'=> '77777777'), // 增加一条新的记录
        );

        // MANY_TO_MANY 的数据更新是重新写入
        $user['Groups'] = array(
            array('id'  => 2),
            array('id'  => 3),
        );
        $User->where(array('id'=>$id))->relation(true)->save($user);
        $info[] =   '用户数据关联更新完成！用时：'.G('6','7',6).'s';
        // 查询更新后的数据
        $user = $User->relation(true)->find($id);
        $info[] =   '查询更新后的用户ID为'.$id.'的用户关联数据,用时：'.G('7','8',6).'s';
        $info[] =   '<div class="result">'.dump($user,false).'</div>';

        // 关联删除
        $User->relation(true)->delete($id);
        $info[] =   '用户ID为' . $id . '数据关联删除完成！用时：'.G('8','9',6).'s';
        $this->assign('info',$info);
        $this->display();
    }
}
?>