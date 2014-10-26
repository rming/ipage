<!DOCTYPE html>
<html>
<head>
    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/typo.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/style.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('static/sco/css/sco.message.css')?>">
</head>
<body>
<div class="container">
    <div class="brand_box">
    </div>
    <div class="user_box">
        <form action="" method="post">
        <table cellpadding="5" cellspacing="0" border="0" width="100%">
            <tbody>
            <tr>
                <td class="form_label">用户名</td>
                <td class="form_input">
                    <input type="text"  name="username" class="x">
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="form_tips" id="username">请使用半角的 a-z 或数字 0-9</td>
            </tr>
            <tr>
                <td class="form_label">密码</td>
                <td class="form_input">
                    <input type="password" name="password" class="x">
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="form_tips"  id="password"></td>
            </tr>
            <tr>
                <td class="form_label">验证码</td>
                <td class="form_input">
                    <input type="text"  name="vcode" class="xs">
                    <span class="form_vcode">
                        <script src="<?=base_url('imgauthcode/show_script')?>"></script>
                    </span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="form_tips" id="vcode"></td>
            </tr>
            <tr>
                <td ></td>
                <td >
                    <button type="button" class="btn btn-default form_submit" >登陆</button>
                    <a  class="btn btn-default btn-second"  href="<?=site_url('user/signup');?>">注册</a>
                </td>
            </tr>
        </tbody>
        </table>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?=base_url('static/js/jquery-1.11.1.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('static/sco/js/sco.message.js')?>"></script>
<script type="text/javascript">
    $('.form_submit').click(function(e) {
        var current_form = $(this).parents().find('form');
        $.post(
            window.location.href+'?t=1',
            current_form.serialize(),
            function(data) {

                error_input =  new Array();
                var elements = current_form.children().find('input');
                input_ele_set(elements, data);

                if(data.error_code ==1){
                    if(error_input.length>0){
                        error_input[0].focus();
                    }
                }else{
                    var success = "success~~";
                    $.scojs_message(success, $.scojs_message.TYPE_OK);
                    setTimeout('redirectNext()',2000);
                }
                $('#img_authcode').click();
        });
    });
    var input_ele_set = function(elements , data){
        elements.each(function() {
            var notice_id   = $(this).attr('name');
            var error_data  = data.data[notice_id];
            if(typeof(error_data)=='undefined'){
                $(this).removeClass('error_input');
                $('#'+notice_id).removeClass('error_tips');
                $('#'+notice_id).html('');
            }else{
                $(this).addClass('error_input');
                $('#'+notice_id).addClass('error_tips');
                $('#'+notice_id).html(data.data[notice_id]);
                error_input.push(this);
            }
        });
    }
    var redirectNext = function(){window.location.href = "http://m.baidu.com";}
</script>
</body>
</html>
