<?php if (!defined('THINK_PATH')) exit();?><div class="bjui-pageContent">
    <form action="<?php echo U('adduser');?>" class="pageForm" data-toggle="validate">
        
        <table class="table table-condensed table-hover">
            <tbody>
                
               
                <tr>         
                    <td>
                        <label for="j_dialog_tel" class="control-label x85">用户名：</label>
                        <input type="text" name="username" id="j_dialog_tel" value="" data-rule="required" size="20">
                    </td>

                  
                </tr>
                <tr>         
                    <td>
                        <label for="j_dialog_tel" class="control-label x85">昵称：</label>
                        <input type="text" name="nickname" id="j_dialog_tel" value="" data-rule="required" size="20">
                    </td>

                </tr>
                <tr>         
                    <td>
                        <label for="j_dialog_tel" class="control-label x85">默认密码：</label>
                        <input type="text"  id="j_dialog_tel" value="123456" data-rule="required" size="20" readonly="true">
                    </td>

                </tr>

            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close">关闭</button></li>
        <li><button type="submit" class="btn-default">保存</button></li>
    </ul>
</div>