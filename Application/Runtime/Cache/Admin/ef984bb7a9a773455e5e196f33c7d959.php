<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Access-Control-Allow-Origin" content="*/*">
    <title>博客后台---<?php echo ($title); ?></title>
    <link href="/Application/Admin/Static/css/toast.css" rel="stylesheet" type="text/css"/>
    <link href="/Application/Admin/Static/css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="/Application/Admin/Static/css/amazeui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/Application/Admin/Static/css/amazeui.reset.css" rel="stylesheet" type="text/css"/>
    <link href="/Application/Admin/Static/css/app.css" rel="stylesheet" type="text/css"/>
    <script src="/Application/Admin/Static/js/jquery.min.js" type="text/javascript" ></script>
    <script src="/Application/Admin/Static/js/jquery.form.min.js" type="text/javascript" ></script>
    <script src="/Application/Admin/Static/js/webuploader.js" type="text/javascript" ></script>
    <script src="/Application/Admin/Static/js/amazeui.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="/Public/plugs/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/Public/plugs/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/Public/plugs/ueditor/zh-cn.js"></script>
</head>
<body>
<?php $account = $_SESSION['account']; $level = $_SESSION['level']; ?>
<div class="am-g">
    <!--头部-->
    <div style="height: 57px;width: 100%;"></div>
    <div class="header-box">
        <header>
            <div class="am-fl tpl-header-logo">
                <a href="<?php echo U('Admin/admin');?>"><img src="/Application/Admin/Static/img/logo.png" alt=""></a>
            </div>
            <div class="tpl-header-fluid">
                <div class="am-fl tpl-header-switch-button am-icon-list">
                    <span></span>
                </div>
                <div class="am-fl tpl-header-navbar tpl-header-navbar-admin">
                    <?php if(($level) == "-100000000"): ?><ul >
                            <li class="am-text-sm am-dropdown tpl-dropdown" data-am-dropdown>
                                <a href="javascript:void(0);" class="am-dropdown-toggle tpl-dropdown-toggle" data-am-dropdown-toggle>后台配置 <i class="am-icon-chevron-down"></i></a>
                                <div class="am-dropdown-content tpl-dropdown-content am-g admin">
                                    <ul class="am-u-sm-4">
                                        <li>
                                            <a href="JavaScript:void(0)">后台设置</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo U('Admin/index');?>">菜单目录</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo U('Admin/account');?>">管理权限</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul><?php endif; ?>
                </div>

                <div class="am-fr tpl-header-navbar">
                    <ul>
                        <li class="am-text-sm tpl-header-navbar-welcome">

                            <a href="javascript:void(0);">欢迎你, <span><?php echo ($account); ?></span> </a>
                        </li>
                        <li class="am-text-sm"  onclick="exitlogin()" >
                            <a href="javascript:void(0);">
                                <span class="am-icon-sign-out"></span> 退出
                            </a>
                        </li>
                        <?php if(($level) == "-100000000"): ?><li class="am-text-sm" >
                                <a  href="/cc.php" target="_blank">
                                    <span class="am-icon-birthday-cake"> 清空缓存</span>
                                </a>
                            </li><?php endif; ?>
                    </ul>
                    <script type="text/javascript">
                        function exitlogin(){
                            window.location.href ="<?php echo U('Admin/Index/index');?>";
                        }
                    </script>
                </div>
            </div>
        </header>
    </div>
    <!--左侧-->
    <div class="left-sidebar">
        <?php
 $pid = $_SESSION['pid']; $cid = $_SESSION['cid']; ?>
        <ul class="sidebar-nav" >
            <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuItem): $mod = ($i % 2 );++$i; $active = $menuItem['id'] == $pid?"active":""; $style = $menuItem['id'] == $pid?"display:block":""; $icon = $menuItem['id'] == $pid?"sidebar-nav-sub-ico-rotate":""; ?>
                <li class="sidebar-nav-link " id="menu-<?php echo ($menuItem["id"]); ?>">
                    <a href="javascript:void(0);" class="sidebar-nav-sub-title <?php echo ($active); ?>">
                        <i class="am-icon-table sidebar-nav-link-logo"></i>
                        <?php echo ($menuItem["title"]); ?>
                        <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico <?php echo ($icon); ?>"></span>
                    </a>
                    <ul class="sidebar-nav sidebar-nav-sub" style="<?php echo ($style); ?>">
                        <?php if(is_array($menuChildrens)): $i = 0; $__LIST__ = $menuChildrens;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuChildren): $mod = ($i % 2 );++$i; if($menuChildren['p_id'] == $menuItem['id']): $cActive = $menuChildren['id'] == $cid?"active":""; ?>
                                <li class="sidebar-nav-link" id="menu-children-<?php echo ($menuChildren["id"]); ?>">
                                    <a href="###" class="<?php echo ($cActive); ?>" onclick='thisMenuIndex(<?php echo ($menuItem["id"]); ?>,<?php echo ($menuChildren["id"]); ?>,"<?php echo ($adminlUrl); echo ($menuChildren['url']); ?>")'>
                                    <span class="am-icon-angle-right sidebar-nav-link-logo"></span> <?php echo ($menuChildren["title"]); ?>
                                    </a>
                                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <!--内容区域-->
    <div class="tpl-content-wrapper clearfix">
        
	<div class="tpl-content-wrapper-body row-content">
		<div class="row">
			<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
				<div class="widget am-cf">
					<div class="widget-head am-cf">
						<div class="widget-title  am-cf"><?php echo ($title); ?>
						</div>
						<?php $style = $query['state'] ? '': "style='display: none;'"; ?>
						<div id="query-container" <?php echo ($style); ?> class="am-cf">
							<form class="am-u-sm-12 am-u-md-4 am-u-lg-4 am-form tpl-form-border-form tpl-form-border-br tpl-form-line-form" id="searchForm" name="searchform" action="" method="get">

								<?php if(is_array($queryhidden)): $i = 0; $__LIST__ = $queryhidden;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><input type="hidden" name="<?php echo ($item["name"]); ?>" value="<?php echo ($item["value"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php if(!empty($query)): ?><div class="am-form-group">
										<label  class="am-u-sm-3 am-form-label"><?php echo ($query['title']); ?></label>
										<div class="am-u-sm-9	 am-input-group am-input-group-sm " style="padding-left: 0;padding-right: 0;float: left;">
											<input type="text" name="<?php echo ($query['name']); ?>"  class="am-form-field" style="max-width: 195px"  id="queryInput" placeholder="<?php echo ($query["opt"]["placeholder"]); ?>"
												   value="<?php echo ($query['value']); ?>">
											<?php $prompt = $query['opt']['prompt']; ?>
											<?php if(!empty($prompt)): ?><br/>
												<p style="font-size: 12px">搜索关键词：<?php echo ($prompt); ?></p><?php endif; ?>
										</div>
									</div><?php endif; ?>
								<?php if(!empty($queryselect)): if(is_array($queryselect)): $i = 0; $__LIST__ = $queryselect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$queryselectItem): $mod = ($i % 2 );++$i; $keyarr = array_keys($queryselectItem['arrvalue']); ?>
									<div class="am-form-group">
										<label  class="am-u-sm-3 am-form-label"><?php echo ($queryselectItem['title']); ?></label>
										<div class="am-u-sm-6" style="padding-left: 0;padding-right: 0">
											<select data-am-selected="{btnSize:'sm'}" name="<?php echo ($queryselectItem['name']); ?>" id="querySelest" onchange="setQueryPlaceholder(this)">
												<option><?php echo ($queryselectItem['defaultvalue']); ?></option>
												<?php if(is_array($queryselectItem['arrvalue'])): $i = 0; $__LIST__ = $queryselectItem['arrvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$options): $mod = ($i % 2 );++$i; $selected = $queryselectItem['select'] == $keyarr[$i-1]?'selected="selected"':""; ?>
													<option  value="<?php echo ($keyarr[$i-1]); ?>" <?php echo ($selected); ?>><?php echo ($options); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
										<br/>
										<p style="font-size: 12px" class="am-u-sm-offset-3"><?php echo ($queryselectItem['opt']['prompt']); ?></p>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
									<script type="text/javascript">
										function setQueryPlaceholder(dom) {
                                            var a = $('#querySelest option:selected').text();
                                            if(a){
                                                $("#queryInput").attr("placeholder","请搜索："+a);
                                            }else{
                                                $("#queryInput").attr("placeholder","");
											}
                                        }
									</script><?php endif; ?>
								<?php if(!empty($startime)): ?><div class="am-form-group">
										<label  class="am-u-sm-3 am-form-label"><?php echo ($startime["title"]); ?></label>
										<div class="am-u-sm-5 am-input-group am-input-group-sm " style="padding-left: 0;padding-right: 0;float: left;">
											<input  id="<?php echo ($startime['name']); ?>_star" type="text" name="<?php echo ($startime['name']); ?>" data-am-datepicker  class="am-form-field"  placeholder="请选择开始时间"
													value="<?php echo ($startime['value']); ?>" readonly>
										</div>
									</div><?php endif; ?>
								<?php if(!empty($endtime)): ?><div class="am-form-group">
										<label  class="am-u-sm-3 am-form-label"><?php echo ($endtime["title"]); ?></label>
										<div class="am-u-sm-5 am-input-group am-input-group-sm " style="padding-left: 0;padding-right: 0;float: left;">
											<input id="<?php echo ($endtime['name']); ?>_end" type="text" name="<?php echo ($endtime['name']); ?>"  data-am-datepicker  class="am-form-field"  placeholder="请选择结束时间"
												   value="<?php echo ($endtime['value']); ?>" readonly>
										</div>
									</div>
									<script type="text/javascript">
                                        var stardom  = $("#<?php echo ($startime['name']); ?>_star");
                                        var enddom  = $("#<?php echo ($endtime['name']); ?>_end");
                                        var startime = "";
                                        var endtime = "";
                                        $(stardom).datepicker().
                                        on('changeDate.datepicker.amui', function(event) {
                                            startime = Date.parse(new Date($(stardom).val()));
                                            endtime = Date.parse(new Date($(enddom).val()));
                                            if(endtime && startime > endtime){
                                                toast.error("开始时间不能大于结束时间");
                                            }
                                        });
                                        $(enddom).datepicker().
                                        on('changeDate.datepicker.amui', function(event) {
                                            endtime =  Date.parse(new Date($(enddom).val()));
                                            startime =  Date.parse(new Date($(stardom).val()));
                                            if(endtime && startime > endtime){
                                                toast.error("开始时间不能大于结束时间");
                                            }else{
                                                console.log("123");
											}
                                        });
									</script><?php endif; ?>
								<?php if(!empty($query)): $url='http://'.$_SERVER['HTTP_HOST'].'/newadmin/admin.php'.$_SERVER['PHP_SELF']; ?>
									<p class="am-u-sm-offset-2">
										<button type="submit" class="am-btn am-btn-sm am-btn-success ">查询</button>
										<button type="button" class="am-btn am-btn-default am-btn-sm tpl-table-list-field" id="close-query">隐藏</button>
										<a href="<?php echo ($url); ?>" class="am-btn am-btn-default am-btn-sm tpl-table-list-field am-btn-danger">清除</a>
									</p><?php endif; ?>
							</form>
						</div>
					</div>
					<div class="widget-body am-fr">
						<div class="am-u-sm-12 am-u-md-4 am-u-lg-4">
                            <div class="am-form-group">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
										<?php if(!empty($query)): ?><button id="open-query" name="excel" class="am-btn am-btn-sm am-btn-primary">搜索</button>
											<script type="text/javascript">
                                                $("#open-query").click(function(){
                                                    $("#query-container").show();
                                                })
                                                $("#close-query").click(function(){
                                                    $("#query-container").hide();
                                                })
											</script><?php endif; ?>
										<?php if(is_array($buttonList)): $i = 0; $__LIST__ = $buttonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$button): $mod = ($i % 2 );++$i;?><<?php echo ($button['attr']["label"]); ?> href="<?php echo ($button['attr']["href"]); ?>" class="<?php echo ($button['attr']["class"]); ?>" target-form="<?php echo ($button['attr']["target-form"]); ?>">
	                                        	<?php echo ($button['attr']["icon"]); ?>
	                                        	<?php echo ($button["title"]); ?>
	                                        </<?php echo ($button['attr']["label"]); ?>><?php endforeach; endif; else: echo "" ;endif; ?>
										<?php if(!empty($excel)): $url = $excel['url']; ?>
											<button id="open-upload-excel" onclick="checkaction()"  class="am-btn am-btn-sm am-btn  am-btn-default am-btn-warning"><span class="am-icon-plus"></span>导出excel</button >
											<script type="text/javascript">
                                                function checkaction(){
                                                    toast.success("正在执行导出操作,请勿关闭浏览器");
                                                    document.searchform.action="<?php echo ($url); ?>";
                                                    document.searchform.method="post"
                                                    searchform.submit();
                                                }
											</script><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
							<?php if(!empty($grossincome)): ?><p style="text-align: right"><?php echo ($grossincome['value']); ?></p><?php endif; ?>
							<?php if(!empty($select)): ?><form style="float: right" id="<?php echo ($select['name']); ?>_form_select" action="" method="get">
									<?php  $keyarr = array_keys($select['arrvalue']); ?>
									<div class="am-form-group">
										<select data-am-selected="{btnSize:'sm'}" name="<?php echo ($select['name']); ?>" onchange="submitSelectForm()">
											<option><?php echo ($select['defaultvalue']); ?></option>
											<?php if(is_array($select['arrvalue'])): $i = 0; $__LIST__ = $select['arrvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$options): $mod = ($i % 2 );++$i; $selected = $select['select'] == $keyarr[$i-1]?'selected="selected"':""; ?>
												<option  value="<?php echo ($keyarr[$i-1]); ?>" <?php echo ($selected); ?> ><?php echo ($options); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
									</div>
								</form>
								<script>
                                    function submitSelectForm(){
                                        var form = document.getElementById("<?php echo ($select['name']); ?>_form_select");
                                        form.submit();
                                    }
								</script><?php endif; ?>
						</div>
						<?php if(!empty($keyList)): ?><div class="am-u-sm-12">
							<table width="100%" class="am-table am-table-compact am-table-bordered am-table-striped tpl-table-black">
								<thead>
									<tr>
										<th class="checkbox">
											<label>
												<input type="checkbox" id="builderAllCheckbox" name="">
											</label>
										</th>
										<?php if(is_array($keyList)): $i = 0; $__LIST__ = $keyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field["title"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$e): $mod = ($i % 2 );++$i;?><tr>
											<td class="checkbox">
												<label>
													<input class="ids" type="checkbox"  value="<?php echo ($e['id']); ?>" name="ids[]">
												</label>
											</td>
											<?php if(is_array($keyList)): $i = 0; $__LIST__ = $keyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><td>
													<?php echo ($e[$field['name']]); ?>	
												</td><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>									
								</tbody>
							</table>
						</div><?php endif; ?>
						<?php if(!empty($pagination)): echo ($pagination); endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="am-modal am-modal-prompt" tabindex="-1" id="anchorImgVerify">
		<div class="am-modal-dialog">
			<div class="am-modal-hd">不通过理由</div>
			<div class="am-modal-bd">
					<div style="padding-bottom:20px;">
						<select class="am-modal-prompt-input" data-am-selected="{searchBox: 1,maxHeight: 200}">
							<option value="2">政治议论</option>
							<option value="3">传播淫秽信息</option>
							<option value="4">刀具等高危表演</option>
							<option value="5">危害他人及自身安全</option>
							<option value="6">传播毒品</option>
							<option value="7">涉及传播传销信息</option>
							<option value="9">其他</option>
						</select>
					</div>
					<textarea class="am-modal-prompt-input" placeholder="填写不通过理由"></textarea>
			</div>
			<div class="am-modal-footer">
				<span class="am-modal-btn" data-am-modal-cancel>取消</span>
				<span class="am-modal-btn" data-am-modal-confirm>提交</span>
			</div>
		</div>
	</div>

    </div>
</div>
<!--<div id="win">-->
<!--<div class="shadow"></div>-->
<!--<div class="win-box">-->
<!--<p>新增主播</p>-->
<!---->
<!--</div>-->
<!--</div>-->
<script src="/Application/Admin/Static/js/toast.js" type="text/javascript" ></script>
<script src="/Application/Admin/Static/js/toast.class.js" type="text/javascript" ></script>
<script src="/Application/Admin/Static/js/app.js" type="text/javascript" ></script>
<script>
    function  thisMenuIndex(pid,cid,url) {
        console.log(cid);
        $.ajax({
            type:"post",
            data:{"pid":pid,"cid":cid},
            url:"<?php echo U('Admin/Index/menuIndex');?>",
            success:function(){
                window.location.href = url;
            },
            error:function(){
                window.location.href = url;
            }
        })
    }
    //        console.log("%c四溢满孤舟",'font-size:12px;color:red');
    //        console.log("%c点点坠穷楼",'font-size:12px;color:red');
    //        console.log("%c化雨踏空去",'font-size:12px;color:red');
    //        console.log("%c虚空步神州",'font-size:12px;color:red');
    //        console.log("%c祥云桥上望",'font-size:12px;color:red');
    //        console.log("%c青伞伫桥头",'font-size:12px;color:red;');
</script>
</body>
</html>