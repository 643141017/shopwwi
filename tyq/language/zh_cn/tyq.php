<?php
defined('ByShopWWI') or exit('Access Invalid!');
/**
 * control
 */
$lang['tyq_group_not_exists']	= '圈子不存在';
$lang['tyq_theme_not_exists']	= '话题不存在';
$lang['tyq_grooup_not_create']	= '对不起，管理员已经关闭创建新圈子功能。';
$lang['tyq_theme_cannot_be_published']	= '网站已经关闭发表话题功能。';
$lang['tyq_has_been_closed_reply']	= '网站已经关闭回复话题功能 。';
$lang['tyq_operation_too_frequent']	= '操作太频繁，请稍后再试。';

/**
 * group_manage
 */
$lang['tyq_tclass_max_10']		= '已经创建10个话题分类，不能在继续创建。';
$lang['tyq_tclass_name_not_null']= '请填写分类名称';
$lang['tyq_sort_error']			= '排序不能为空且只能填写数字';
$lang['ftyq_please_choose']		= '请选择想要添加的圈子';


// 话题分类
$lang['tyq_tclass_add']			= '添加分类';
$lang['tyq_tclass_edit']			= '编辑分类';
$lang['tyq_tclass_add_max_10']	= '只能创建10个分类';


$lang['tyq_tclass_name']			= '分类名称';
$lang['tyq_tclass_sort']			= '分类排序';
$lang['tyq_tclass_status']		= '显示状态';
$lang['tyq_tclass_man_maxlength']= '分类名称不能超过4个字符';
$lang['tyq_tclass_sort_not_null']= '请填写分类排序';
$lang['tyq_tclass_sort_is_digits']	= '请填写数字';
$lang['tyq_tclass_sort_max']		= '数值不能超过255';
$lang['nc_sort']					= '排序';


// 编辑器
$lang['nc_title']					= '标题';
$lang['nc_font']					= '字体';
$lang['nc_Microsoft_YaHei']			= '微软雅黑';
$lang['nc_simsun']					= '宋体';
$lang['nc_simhei']					= '黑体';
$lang['nc_font_size']				= '大小';
$lang['nc_font_bold']				= '文字加粗';
$lang['nc_font_italic']				= '文字斜体';
$lang['nc_font_underline']			= '文字下划线';
$lang['nc_font_color']				= '文字颜色';
$lang['nc_upload_affix']			= '上传附件';
$lang['nc_upload_image_affix']		= '上传图片附件';
$lang['nc_insert_link_address']		= '插入链接地址';
$lang['nc_line']					= '链接';
$lang['nc_find']					= '查找';
$lang['nc_link_content']			= '链接文字内容';
$lang['nc_link_address']			= '链接跳转地址';
$lang['nc_video']					= '视频';
$lang['nc_video_address']			= '视频的flash地址';
$lang['nc_image']					= '图片';
$lang['nc_insert_network_image']	= '插入网络图片';
$lang['nc_goods']					= '商品';
$lang['nc_insert_relevance_goods']	= '插入相关商品';
$lang['nc_insert_smilier']			= '插入表情';
$lang['nc_smilier']					= '表情';
$lang['nc_relevance_adjunct']		= '相关附件';
$lang['nc_relevance_adjunct_help_one']	= '附件上传支持jpg、jpeg、gif、png格式图片，建议上传尺寸1000像素以内不超过1M大小的图片。';
$lang['nc_relevance_adjunct_help_two']	= '上传图片后可选择插入主题帖子中，没有插入帖子的附件，将作为候选附件保留至下次发帖使用或可手动删除。';
$lang['nc_insert']					= '插入';
$lang['nc_select_insert_goods']		= '选择插入帖中的商品';
$lang['nc_edit_theme']				= '编辑话题';
$lang['nc_edit_reply']				= '编辑回复';
$lang['nc_release_new_theme']		= '发布新话题';
$lang['nc_name_not_null']			= '请填写标题';
$lang['nc_name_min_max_length']		= '标题在4到30字符之间';
$lang['nc_content_not_null']		= '请填写内容';
$lang['nc_content_min_length']		= '内容不能少于%d个字符';
$lang['nc_advanced_reply']			= '高级回复';
$lang['nc_release_reply']			= '发表回复';
$lang['nc_reply_theme']				= '回复话题';
$lang['nc_read_perm']				= '阅读权限';

// 友情圈子
$lang['tyq_name']				= '圈子名称';
$lang['nc_show']					= '显示';
$lang['nc_hide']					= '隐藏';
$lang['ftyq_add']				= '添加友情圈子';
$lang['ftyq_edit']				= '编辑友情圈子';
$lang['ftyq_sort']				= '圈子排序';
$lang['ftyq_please_choose']		= '请选择圈子';
$lang['ftyq_sort_not_null']		= '请填写友情圈子排序';

// 基本设置
$lang['tyq_desc']				= '圈子描述';
$lang['tyq_notice']				= '圈子公告';
$lang['tyq_logo']				= '圈子LOGO';
$lang['tyq_image_upload']		= '图片上传';
$lang['tyq_apply_verify']		= '申请审核';
$lang['tyq_submit_setting']		= '提交设置';
$lang['tyq_maxlength']			= '不能超过255个字符';
$lang['tyq_need_grade']			= '申请成为本圈管理员时所需要的会员等级限制。';
$lang['tyq_no_requirement']		= '没有要求';

// 成员
$lang['tyq_member']				= '成员';
$lang['tyq_add_time']			= '加入时间';
$lang['tyq_last_speak']			= '最后发言';
$lang['tyq_nospeak']				= '禁言';
$lang['tyq_manage']				= '管理';
$lang['tyq_manage_title']		= '设为管理';
$lang['tyq_manage_confirm_one']	= '最多只能添加';
$lang['tyq_manage_confirm_two']	= '个管理员，超出部分不会被添加。';
$lang['tyq_manage_cancel']		= '取消管理';
$lang['tyq_nospeak_cancel']		= '解除禁言';
$lang['tyq_star']				= '明星';
$lang['tyq_star_title']			= '设为明星';
$lang['tyq_star_cancel']			= '取消明星';
$lang['tyq_stat_member']			= '明星成员';
$lang['nc_ban']						= '禁止';
$lang['nc_allow']					= '允许';
$lang['nc_insert_username']			= '输入用户名';

$lang['tyq_apply_time']			= '申请时间';
$lang['tyq_apply_reason']		= '申请理由';
$lang['tyq_self_introduction']	= '自我介绍';
$lang['tyq_pass']				= '通过';
$lang['tyq_refuse']				= '拒绝';
$lang['tyq_refuse_confirm']		= '确定要拒绝申请吗？';

// To apply for management
$lang['tyq_level']				= '等级';
$lang['tyq_apply_to']			= '申请成为';
$lang['tyq_apply_to_reason']		= '管理员的原因';
$lang['tyq_apply_h4']			= '希望您能告诉我们是什么原因使您希望成为本圈管理？';
$lang['tyq_apply_h5']			= '例如：本人在线时间长，有充裕的时间管理本圈。';

/**
 * group
 */
$lang['tyq_apply_content_null']	= '请填写申请原因';
$lang['nc_apply_op_succ']			= '申请成功';
$lang['tyq_apply_join']			= '申请加入';
$lang['tyq_member_list']			= '成员列表';
$lang['tyq_member_no_join']		= '您不是该圈子的成员';
$lang['nc_deit_op_succ']			= '编辑成功';
$lang['tyq_member_like_and_show_goods']	= '成员分享和喜欢的商品';
$lang['tyq_apply_to_be_a_management']	= '申请成为管理';

// 创建圈子
$lang['tyq_create_a_group']		= '创建一个圈子';
$lang['tyq_first_from']			= '欢迎你先在';
$lang['tyq_find_like_group']		= '发现喜欢的圈子。';
$lang['nc_welcome_at']				= '欢迎在';
$lang['nc_welcome_words']			= '这个快乐和谐的地方，聚集和你爱好相同，品位相当的好朋友，畅谈交流，分享心情，享受生活！';
$lang['tyq_allow_create_group_count']	= '最多可创建圈子数';
$lang['tyq_yet_create_group_count']		= '已经创建圈子数';
$lang['tyq_allow_join_group_count']	= '最多可加入圈子数';
$lang['tyq_yet_join_group_count']	= '已经加入圈子数';
$lang['tyq_belong_to_class']			= '所属类目';
$lang['tyq_belong_to_class_tips']	= '根据您的圈子主题类型，选择适当的分类。';
$lang['tyq_name_tips']				= '圈子名称规定使用4~12个字符，确定后不可修改。';
$lang['tyq_introduction']			= '圈子简介';
$lang['tyq_introduction_tips']		= '对您建立的圈子进行简单的文字介绍，创建后圈主可做修改，字数不超过255字。';
$lang['tyq_tag']						= '圈子标签';
$lang['tyq_tag_tips']				= '建立圈子标签有利于全局搜索查找到您的圈子，多个标签请用&quot;,&quot;进行分隔。';
$lang['tyq_apply_reason']			= '申请理由';
$lang['tyq_apply_reason_tips']		= '认真填写申请圈子的理由提交至平台，以确保管理人员及时审核并通过，字数不要超过255字。';
$lang['tyq_my_read_carefully_agree']	= '我已认真阅读并同意《';
$lang['tyq_notice_for_use']			= '圈子使用须知';
$lang['tyq_all_terms']				= '》中的所有条款';
$lang['tyq_submit_applications']		= '提交申请';
$lang['tyq_name_4_to_12_length']		= '圈子名称4到12个字符之间';
$lang['tyq_name_already_exists']		= '该名称已存在，请更换一个名称';
$lang['tyq_255_maxlength']			= '不能超过255个字符';
$lang['tyq_tag_maxlength']			= '不能超过255个字符';

// 申请加入
$lang['tyq_of_reason']				= '的原因';
$lang['tyq_join_tips_h4']			= '成为圈中成员之前，希望您能告诉我们是什么原因使您加入到本圈？';
$lang['tyq_join_tips_h5']			= '例如：本人乃购物达人，大家志同道合，有好多购物经验要和圈友分享哦！';
$lang['tyq_newbie_introduction']		= '新人自我介绍';
$lang['tyq_apply_content_maxlength']	= '申请原因不能超过140个字符';

$lang['tyq_type']				= '类型';

// 商品
$lang['tyq_firend']				= '圈友';
$lang['nc_at']						= '于';
$lang['nc_show']					= '显示';
$lang['nc_like']					= '喜欢';
$lang['nc_share_default_content']	= '赞！我很喜欢这件商品。';
$lang['nc_comment']					= '评论';
$lang['nc_share_goods_null']		= '很遗憾，尚无圈友分享过商品。';

// 圈友
$lang['tyq_introduction_desc']	= '在这里写下你的个性介绍，是让别的圈友了解并熟悉你的最佳方法。';
$lang['tyq_introduction_example']= '例如：大家好，我是咪咪，女，90后，天秤座，来自北京，我有好多好多的购物经验要跟大伙儿分享~ 爱好：买衣服，挑首饰，自拍，交朋友...';
$lang['tyq_introduction_not_null']	= '请填写自我介绍';
$lang['tyq_introduction_maxlength']	= '自我介绍不能超过140个字符';
$lang['tyq_my_cart']				= '我的名片';
$lang['tyq_join']				= '加入';
$lang['tyq_introduction_null']	= '暂无自我介绍';
$lang['tyq_other_friend']		= '其他圈友';
$lang['tyq_edit_personal_information']	= '修改个人信息';
$lang['tyq_today']				= '今日';

// 话题
$lang['tyq_not_login_prompt']	= '您目前还没有登录，请先';
$lang['tyq_not_join_prompt_one']	= '请您先';
$lang['tyq_not_join_prompt_two']	= '加入本圈';
$lang['tyq_not_join_prompt_three']	= '后再发帖';
$lang['tyq_waiting_verify_prompt']	= '等待申请审核通过后才能发表话题';
$lang['tyq_nospeak_prompt']		= '被禁言，不能在发布话题。';
$lang['tyq_all']					= '全部';
$lang['tyq_digest_theme']		= '精品话题';
$lang['tyq_preview']				= '图文';
$lang['tyq_list']				= '列表';
$lang['tyq_author']				= '作者';
$lang['tyq_reply_or_see']		= '回复/查看';
$lang['tyq_last_speak']			= '最后发言';
$lang['tyq_unfold_theme']		= '展开主题';
$lang['tyq_click_image_unfold']	= '点击图片展开';
$lang['tyq_be_nospeak_member']	= '被禁言用户';
$lang['tyq_publish_time']		= '发表时间';
$lang['tyq_browsecount_one']		= '已有';
$lang['tyq_browsecount_two']		= '人次浏览；';
$lang['tyq_commentcount_one']	= '人次回复本主题';
$lang['tyq_lastspeak_member']	= '最后回复人';
$lang['tyq_lastspeak_time']		= '最后回复时间';
$lang['tyq_no_digest']			= '很遗憾，本圈尚无精华话题。';
$lang['tyq_no_theme']			= '很遗憾，尚无圈友发表的话题。';
$lang['tyq_is_under_approval']	= '圈子正在审批中，请稍后再试...';
$lang['tyq_approval_fail']		= '很遗憾，该圈子审批失败：（';
$lang['tyq_reason']				= '原因';
$lang['tyq_is_closed']			= '对不起，该圈子已被关闭！';

// poll
$lang['tyq_poll_options']		= '投票选项';
$lang['tyq_poll_options_max']	= '最多可添加 20 个选项';
$lang['tyq_poll_days']			= '记票天数';
$lang['nc_day']						= '天';
$lang['tyq_poll_patterns']		= '投票方式';
$lang['tyq_poll_radio']			= '单选';
$lang['tyq_poll_chexkbox']		= '复选';
$lang['tyq_poll_sort']			= '顺序';
$lang['tyq_option']				= '选项';
$lang['tyq_add_new']				= '增加一项';
$lang['tyq_poll_options_not_null']	= '请输入投票选项';
$lang['tyq_poll_options_min_error']	= '投票选项不能少于两个';
$lang['tyq_poll_options_max_error']	= '调查选项不能超过20个字，请重新输入';
$lang['tyq_poll_has_end']		= '投票已经结束';
$lang['tyq_poll_has_join']		= '你已经参与过投票';
$lang['tyq_poll_choose_options']	= '请选择投票选项';
$lang['tyq_poll_success']		= '投票成功';

// group sidebar
$lang['tyq_notice']				= '圈子公告';
$lang['tyq_information']			= '圈子信息';
$lang['tyq_no_notice']			= '暂无公告';
$lang['tyq_belong_to_class']		= '所属分类';
$lang['tyq_build_time']			= '建立时间';
$lang['tyq_friend_count']		= '圈友数量';
$lang['tyq_theme_amount']		= '话题总数';
$lang['tyq_person']				= '人';
$lang['tyq_item']				= '条';
$lang['tyq_is_null']				= '暂无';
$lang['tyq_star_firend']			= '明星圈友';
$lang['tyq_jion_new']			= '最新加入';
$lang['tyq_no_firend']			= '暂无圈友';
$lang['tyq_theme_count']			= '话题数';
$lang['ztc_hotsell_goods_recommend']= '热销商品推荐';
$lang['ztc_have_sales']				= '已销售';
$lang['ztc_bi']						= '笔';
$lang['ztc_go_and_see']				= '去看看';

// group top
$lang['tyq_apply_to_join']		= '申请加入';
$lang['tyq_quit_group']			= '退出';
$lang['tyq_applying_wait_verify']= '申请中，等待审核。';
$lang['tyq_desc_null_default']	= '不相识的你我却拥有相同的爱好，圈子让我们距离更近:)';
$lang['tyq_no_administrate']		= '暂无管理员';
$lang['tyq_create_my_new_tyq']= '创建我的新圈子';
$lang['tyq_wait_verity_count']	= '新会员审核';
$lang['tyq_new_inform']			= '新举报';
$lang['tyq_management_application']	= '管理申请';
$lang['tyq_current_location']	= '当前位置';

// To apply for management
$lang['tyq_apply_error']			= '你不符合申请条件';
$lang['tyq_repeat_apply_error']	= '请不要重复申请';

/**
 * index
 */
$lang['tyq_create_max_error']	= '您所创建的圈子已经达到允许创建上限，无法继续创建圈子。';
$lang['tyq_join_max_error']		= '您所加入的圈子已经达到允许加入上限，无法继续创建圈子。';
$lang['tyq_name_not_null']		= '圈子名称不能为空';
$lang['tyq_create']				= '创建圈子';

$lang['tyq_welcome_to']			= '您好,欢迎来到';
$lang['tyq_login_prompt_one']	= '如果您已经是会员请';
$lang['tyq_login_prompt_two']	= '后进行操作;';
$lang['tyq_register_prompt_one']	= '或现在就';
$lang['tyq_register_prompt_two']	= '成为会员。';
$lang['tyq_welcome_back_to']		= '欢迎回到';
$lang['tyq_into_user_centre']	= '进入个人中心';
$lang['my_theme']					= '我的帖子';
$lang['tyq_hot_group']			= '热门圈子';
$lang['tyq_new_theme']			= '新话题';
$lang['tyq_group_member']		= '组员';
$lang['tyq_new_member']			= '新成员';
$lang['tyq_recommend_group']		= '推荐圈子';
$lang['tyq_recommend_theme']		= '推荐话题';
$lang['tyq_friend_show_order']	= '圈友晒单';
$lang['tyq_excellent_goods']		= '优秀圈成员';

$lang['tyq_new_theme_two']		= '最新话题';
$lang['tyq_hot_theme']			= '热门话题';
$lang['tyq_hot_reply']			= '热门回复';
$lang['tyq_theme_come_from']		= '话题来自';

/**
 * search
 */

$lang['tyq_to_search']			= '搜索到';
$lang['tyq_yu']					= '与';
$lang['tyq_relevant']			= '有关联的';
$lang['tyq_class_relavant']		= '分类有关联的';
$lang['tyq_result']				= '结果';
$lang['tyq_result_null']			= '没有找到你想要的结果';
$lang['tyq_theme_author']		= '话题作者';
$lang['tyq_lastspeak']			= '最后回复';
$lang['tyq_release_time']		= '发布时间';
$lang['tyq_come_from_group']		= '来自圈子';
$lang['tyq_reply_time']			= '回复时间';
$lang['tyq_look_at_original']	= '查看原文';
$lang['tyq_go']					= '去';
$lang['tyq_home_page_around']	= '首页逛逛';
$lang['tyq_search_null_msg']		= '您也可以创建此圈子，并与今后来到这里的朋友分享交流。';
$lang['tyq_instantly_create']	= '立即创建';

/**
 * theme
 */
$lang['tyq_no_join_ban_release']	= '没有加入圈子用户不能发帖';
$lang['nc_release_op_succ']			= '发布成功';
$lang['nc_release_op_fail']			= '发布失败';
$lang['tyq_release_theme']		= '发表话题';
$lang['nc_deit_op_fail']			= '编辑失败';
$lang['tyq_no_join_ban_reply']	= '没有加入圈子用户不能回复';
$lang['tyq_reply_not_null']		= '请填写回复内容';

$lang['tyq_bought_goods']		= '已购的商品';
$lang['tyq_favorite_goods']		= '收藏的商品';
$lang['tyq_selected']			= '已选择';
$lang['tyq_bought_goods_null']	= '您还没有购买过商品。';
$lang['tyq_favorite_goods_null']	= '您还没有收藏过商品。';
$lang['tyq_selected_goods']		= '已选商品';
$lang['tyq_insert_theme']		= '插入到话题';
$lang['tyq_network_image']		= '网络图片';
$lang['tyq_album_image']			= '相册图片';
$lang['tyq_insert_image_url']	= '输入图片地址';
$lang['tyq_select_image_from_album']	= '从我的相册中选择图片';
$lang['tyq_upload_image_null']	= '您还没有上传过图片';
$lang['tyq_select_image']		= '选择图片';

$lang['tyq_goods_link']			= '商品链接';
$lang['tyq_goods_link_tips1']	= '可添加本商城';
$lang['tyq_goods_link_tips2']	= '、淘宝或者天猫';
$lang['tyq_goods_link_tips3']	= '的商品链接';
$lang['tyq_goods_error1']		= '对多只能选自10个商品！';
$lang['tyq_goods_error2']		= '你添加的链接不正确';
$lang['tyq_Insufficient_permissions']	= '权限不足，不能查看话题';
// 详细页
$lang['tyq_landlord']			= '楼主';
$lang['tyq_posted_in']			= '发表于';
$lang['tyq_return']				= '返回';
$lang['tyq_last_edit']			= '最后编辑';
$lang['tyq_relevance_goods']		= '相关商品';
$lang['tyq_goods_detail']		= '商品详情';
$lang['tyq_affix_image_title_one']	= '话题“';
$lang['tyq_affix_image_title_two']	= '”中的附件';
$lang['tyq_theme_manage']		= '话题管理';
$lang['tyq_digest']				= '精华';
$lang['tyq_digest_cancel']		= '取消精华';
$lang['tyq_stick']				= '置顶';
$lang['tyq_stick_cancel']		= '取消置顶';
$lang['tyq_see_all']				= '查看全部';
$lang['tyq_see_TA']				= '只看TA的内容';
$lang['tyq_floor']				= '楼';
$lang['tyq_of_post']				= '的帖子';
$lang['tyq_my_manage']			= '我的管理';
$lang['tyq_edit_my_reply']		= '编辑我的回复';
$lang['tyq_delete_my_reply']		= '删除我的回复';
$lang['tyq_reply_image_title_one']	= '“';
$lang['tyq_reply_image_title_two']	= '楼”回复中的附件';
$lang['tyq_reply_manage']		= '回复管理';
$lang['tyq_theme_is_closed']		= '本话题已经关闭';
$lang['tyq_nospeak_reply_prompt']= '被禁言，不能回复话题。';
$lang['tyq_of_reply']			= '的回复';
$lang['tyq_share_theme']			= '分享话题';
$lang['tyq_inform_theme']		= '举报话题';
$lang['tyq_inform_reply']		= '举报回复';
$lang['tyq_radio_poll']			= '单选投票';
$lang['tyq_checkbox_poll']		= '多选投票';
$lang['tyq_owned_by_all']		= '共有';
$lang['tyq_participate_in_the_vote']	= '人参与投票';
$lang['tyq_poll_ends']			= '（投票结束）';
$lang['tyq_have_to_vote']		= '（已经参与）';
$lang['nc_etc']						= '等';
$lang['tyq_have_poll']			= '人已投票';
$lang['tyq_vote_option_not_null']= '请选择投票选项';
$lang['tyq_new_poll']			= '新投票';

// group level
$lang['level_introduction']		= '等级说明';
$lang['level_h3_1']				= '会员头衔&经验值对照表';
$lang['level_h3_2']				= '积分规则';
$lang['level']					= '级别';
$lang['level_rank']				= '头衔';
$lang['level_need_exp']			= '所需经验值';
$lang['level_user_action']		= '用户行为';
$lang['level_exp_in_table']		= '经验值对照表';
$lang['level_daily_exp_ceiling']= '每日经验值上限';
$lang['level_release_theme']	= '发表话题帖子';
$lang['level_reply_theme']		= '回复他人帖子';
$lang['level_replied_theme']	= '帖子被他人回复';
$lang['level_needing_attention']= '注：通常情况下，经验值不会下降。如果贴子被删除，则该贴之前所产生的加分会被收回，但不会额外扣分。';