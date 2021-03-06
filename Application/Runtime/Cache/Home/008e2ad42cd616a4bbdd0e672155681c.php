<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?php echo U('user');?>" method="post">
        <input type="hidden" name="pageSize" value="${model.pageSize}">
        <input type="hidden" name="pageCurrent" value="${model.pageCurrent}">
        <input type="hidden" name="orderField" value="${param.orderField}">
        <input type="hidden" name="orderDirection" value="${param.orderDirection}">
        <div class="bjui-searchBar">
           
             <label>用户名：</label><input type="text" value="<?php echo ($_POST['username']); ?>" name="username" size="15" />
            
           
            
            <button type="submit" class="btn-default" data-icon="search">查询</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">清空查询</a>
             <a class="btn btn-red" href="<?php echo U('updateuser');?>"  data-toggle="dialog" data-width="460" data-height="180" data-id="dialog">添加信息</a>
           

        </div>
        
    </form>
</div>
<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" data-selected-multi="true">
        <thead>
            <tr>
                <th  align="center">ID</th>
                <th  align="center">用户名</th>
                <th  align="center">昵称</th>
            
                <th align="center" width="100">操作</th>
            </tr>
        </thead>
       
        <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr data-id="<?php echo ($v["id"]); ?>">
                <td  align="center"><?php echo ($v["id"]); ?></td>
                <td  align="center"><?php echo ($v["username"]); ?></td>
                <td  align="center"><?php echo ($v["nickname"]); ?></td>
               
                <td align="center">
                  
                    <a href="<?php echo U('userdel',array('id'=>$v['id']));?>" class="btn btn-red" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗？">删除</a>
                    
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