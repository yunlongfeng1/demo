<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form  data-toggle="ajaxsearch"   action="<?php echo U('table');?>" method="post" >
        <input type="hidden" name="pageSize" value="${model.pageSize}">
        <input type="hidden" name="pageCurrent" value="${model.pageCurrent}">
        <input type="hidden" name="orderField" value="${param.orderField}">
        <input type="hidden" name="orderDirection" value="${param.orderDirection}">
        <div class="bjui-searchBar">
            <label>关注商品:</label>
            <select name="zhongdian" id="j_dialog_operation" data-toggle="selectpicker">
                <option value="0">全部</option>
                <?php $zhongdian = C('zhongdian');?>
                <?php if(is_array($zhongdian)): foreach($zhongdian as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($_POST['zhongdian'] == $k) echo 'selected';?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>&nbsp;

            <select name="selsecType" id="j_dialog_operation" data-toggle="selectpicker">
                <option value="0">无</option>
              
                     <option value="1" <?php if($_POST['selsecType'] == 1) echo 'selected';?>>电话</option>
                     <option value="2" <?php if($_POST['selsecType'] == 2) echo 'selected';?>>姓名</option>
                     <option value="3" <?php if($_POST['selsecType'] == 3) echo 'selected';?>>身份证</option>
               
            </select>
           <input type="text"  value="<?php echo ($_POST['selsecTypeValue']); ?>" name="selsecTypeValue" class="form-control" size="10">
            &nbsp;
             <label>职业：</label><input type="text" value="<?php echo ($_POST['zhiye1']); ?>" name="zhiye1" size="15" />
             <label for="j_dialog_name" class="control-label x90">意向面积：</label>
            <select name="mianji" id="j_dialog_operation" data-toggle="selectpicker">
                <option value="0">全部</option>
                <?php $mianji = C('mianji');?>
                <?php if(is_array($mianji)): foreach($mianji as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($_POST['mianji'] == $k) echo 'selected';?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>
            <label>职业顾问：</label><input type="text" id="customNo" value="<?php echo ($_POST['zhiye']); ?>" name="zhiye" class="form-control" size="10">&nbsp;
            
           
            <button type="button" class="showMoreSearch" data-toggle="moresearch" data-name="custom"><i class="fa fa-angle-double-down"></i></button>
            <button type="submit" class="btn-default" data-icon="search" >查询</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">清空查询</a>
             <a class="btn btn-red" href="<?php echo U('dialog-normal');?>"  data-toggle="dialog" data-width="860" data-height="400" data-id="dialog">添加信息</a>
           

        </div>
        <div class="bjui-moreSearch">
           
            <label for="j_dialog_name" class="control-label x90">工作区域：</label>

            <select name="danwei" id="j_dialog_operation" data-toggle="selectpicker">
                     <option value="0">全部</option>
                    <?php $danwei = C('city');?>
                    <?php if(is_array($danwei)): foreach($danwei as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($_POST['danwei'] == $k) echo 'selected';?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>

             <label for="j_dialog_tel" class="control-label x85">居住区域：</label>
             <select name="juzhu" id="j_dialog_operation" data-toggle="selectpicker">
                <option value="0">全部</option>
                <?php $juzhu = C('city');?>
                <?php if(is_array($juzhu)): foreach($juzhu as $k=>$v): ?><option value="<?php echo ($k); ?>" <?php if($_POST['juzhu'] == $k) echo 'selected';?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
             </select>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-selected-multi="true">
        <thead>
            <tr>
                <th  align="center">ID</th>
                <th  align="center">姓名</th>
                <th  align="center">关注产品</th>
                <th  align="center">年龄</th>
                <th  align="center">性别</th>
                <th  align="center">电话</th>
                <th  align="center">身份证</th>
                <th   align="center">意向面积</th>
                <!-- <th   align="center">认知途径</th>
                <th   align="center">认知途径2</th> -->
                <th   align="center">职业顾问</th>
                <th   align="center">途径姓名</th>
                <th   align="center">途径联系人电话</th>
                <th   align="center">客户类型</th>
                <th   align="center">职业</th>
                <th   align="center">工作区域</th>
                <th   align="center">居住区域</th>
                <th   align="center">现住面积</th>
                <th   align="center">意向房源</th>
                <th   align="center">预算</th>

                <th   align="center">购买用途</th>
               <!--  <th   align="center">对比竞品</th> -->
                <th   align="center">未成交原因</th>
                <!-- <th   align="center">兴趣爱好</th> -->
                <!-- <th   align="center">职业</th> -->
                <th   align="center">提交时间</th>
                <th align="center" width="100">操作</th>
            </tr>
        </thead>
        <?php  $zhongdian = C("zhongdian"); $sex = C("sex"); $city = C("city"); $mianji = C("mianji"); ?>
        <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr data-id="<?php echo ($v["id"]); ?>">
                <td  align="center"><?php echo ($v["id"]); ?></td>
                <td  align="center"><?php echo ($v["name"]); ?></td>
                <td  align="center"><?php echo ($zhongdian[$v[zhongdian]]); ?></td>
                <td  align="center"><?php echo ($v["ages"]); ?></td>
                <td  align="center"><?php echo ($sex[$v[sex]]); ?></td>
                <td  align="center"><?php echo ($v["tel"]); ?></td>
                <td  align="center"><?php echo ($v["shenfenzheng"]); ?></td>
                <td  align="center"><?php echo ($mianji[$v[mianji]]); ?></td>
               <!--  <td  align="center"><?php echo ($v["contents"]); ?></td>
                <td  align="center"><?php echo ($v["contents2"]); ?></td> -->
                <td  align="center"><?php echo ($v["zhiye"]); ?></td>
                <td  align="center"><?php echo ($v["yewu"]); ?></td>
                <td  align="center"><?php echo ($v["yewu_tel"]); ?></td>
                <td  align="center"><?php echo ($v["kehuleixing"]); ?></td>
                <td  align="center"><?php echo ($v["zhiye1"]); ?></td>
                <td  align="center"><?php echo ($city[$v[danwei]]); ?></td>
                <td  align="center"><?php echo ($city[$v[juzhu]]); ?></td>
                <td  align="center"><?php echo ($v["mianji2"]); ?></td>
                <td  align="center"><?php echo ($v["yixiang"]); ?></td>
                <td  align="center"><?php echo ($v["yushuan"]); ?></td>

                <td  align="center"><?php echo ($v["yongtu"]); ?></td>
                <!-- <td  align="center"><?php echo ($v["duibi"]); ?></td> -->
                <td  align="center"><?php echo ($v["yuanyin"]); ?></td>
                <!-- <td  align="center"><?php echo ($v["xingquah"]); ?></td> -->
                <!-- <td  align="center"><?php echo ($v["zhiyes"]); ?></td> -->
                <td  align="center"><?php echo ($v["createtime"]); ?></td>
                <td align="center">
                   <?php if($_SESSION['uid'] ==1){?>
                    <a href="<?php echo U('del',array('id'=>$v['id']));?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗？">删除</a>
                    <?php }?>
                </td>
            </tr><?php endforeach; endif; ?>
            
        </tbody>
    </table>
</div>
<div class="bjui-pageFooter">
    <div class="pages">
        <span>每页&nbsp;</span>
        <div class="selectPagesize">
            <select data-toggle="selectpicker" data-toggle-change="changepagesize">
                <option value="30">30</option>
                <option value="60">60</option>
                <option value="120">120</option>
                <option value="150">150</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?php echo ($count); ?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination" data-total="<?php echo ($count); ?>" data-page-size="30" data-page-current="1">
    </div>
</div>
<script type="text/javascript">
function mycallback(json) {

        $(this)

            .bjuiajax('ajaxDone', json)       // 信息提示

            .navtab('refresh')                // 刷新当前navtab

            .navtab('reloadFlag', json.tabid) // 为指定的tabid设置刷新标记

         

        //do other something...

    }
</script>