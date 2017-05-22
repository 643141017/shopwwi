<?php
/**
 * Theme Inform
 *
 *
 * * @网店运维 (c) 2015-2018 ShopWWI Inc. (http://www.shopwwi.com)
 * @license    http://www.shopwwi.c om
 * @link       交流群号：111731672
 * @since      网店运维提供技术支持 授权请购买shopwwi授权
 */



defined('ByShopWWI') or exit('Access Invalid!');

class theme_informControl extends BaseTyqControl{
    protected $c_id = 0;        // 圈子id
    protected $identity = 0;    // 身份 0游客 1圈主 2管理 3成员 4申请中 5申请失败
    protected $tyq_info = array();
    protected $cm_info = array();
    public function __construct(){
        parent::__construct();
        $this->c_id = intval($_GET['c_id']);
        if($this->c_id <= 0){
            echo '<script>DialogManager.close("inform");</script>';
        }
        Tpl::output('c_id', $this->c_id);
        Language::read('manage_inform');
    }
    /**
     * Share the binding
     */
    public function indexWwi(){
        // memberInfo
        $this->memberInfo();
        if(empty($this->cm_info)){
            showDialog(L('tyq_inform_error'));
        }

        $t_id = intval($_GET['t_id']);
        if($t_id <= 0){
            echo '<script>DialogManager.close("inform");</script>';
        }
        $model = Model();
        $r_id = intval($_GET['r_id']);
        $where = array();
        $where['tyq_id'] = $this->c_id;
        $where['theme_id']  = $t_id;
        $where['reply_id']  = $r_id;
        $inform_info = $model->table('tyq_inform')->where($where)->find();
        if(!empty($inform_info)){
            echo '<script>showError("'.L('tyq_inform_have_been_reported').'");DialogManager.close("inform");</script>';exit;
        }
        if(chksubmit()){
            $tyq_info = $model->table('tyq')->field('tyq_name')->where(array('tyq_id'=>$this->c_id))->find();
            if(!empty($tyq_info)){
                echo '<script>DialogManager.close("inform");</script>';
            }
            $theme_info = $model->table('tyq_theme')->field('theme_name')->where(array('theme_id'=>$t_id))->find();
            if(!empty($theme_info)){
                echo '<script>DialogManager.close("inform");</script>';
            }
            $insert = array();
            $insert['tyq_id']        = $this->c_id;
            $insert['tyq_name']      = $tyq_info['tyq_name'];
            $insert['theme_id']         = $t_id;
            $insert['theme_name']       = $theme_info['theme_name'];
            $insert['reply_id']         = $r_id;
            $insert['member_id']        = $_SESSION['member_id'];
            $insert['member_name']      = $_SESSION['member_name'];
            $insert['inform_content']   = $_POST['content'];
            $insert['inform_time']      = time();
            $insert['inform_type']      = 0;
            $insert['inform_state']     = 0;
            $model->table('tyq_inform')->insert($insert);

            // Update the inform number
            $update = array(
                        'new_informcount'=>array('exp', 'new_informcount+1')
                    );
            $model->table('tyq')->where(array('tyq_id'=>$this->c_id))->update($update);

            showDialog(L('nc_common_op_succ'), '', 'succ', '$(\'a[nctype="inform_cancel"]\').click();');
        }
        Tpl::output('t_id', $t_id);
        Tpl::showpage('theme.inform','null_layout');
    }
}
