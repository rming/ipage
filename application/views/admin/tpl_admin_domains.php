
<div class="menu">
    <div class="menu_header">
        <a></a>
    </div>

    <nav >
        <ul class="menu_navbar" id="menu_navbar"  >
            <li>
                <a href="<?=site_url('admin/home');?>">控制台</a>
            </li>
            <li class="sfhover">
                <a href="<?=site_url('admin/domains');?>">域名</a>
            </li>
            <li>
                <a href="<?=site_url('admin/home');?>">电子档</a>
            </li>
            <!--
            <li><a href="javascript:void(0)">menu</a>
                <ul >
                    <li><a>test</a></li>
                    <li><a>test</a></li>
                    <li><a>test</a></li>
                    <li><a>test</a></li>
                    <li><a>test</a></li>
                </ul>
            </li>
            -->

            <li class="pull-right"><a href="<?=site_url('user/logout');?>">退出</a>
            </li>
            <li class="pull-right"><a ><?=$this->login_user->username;?></a>
                <ul >
                    <li><a >个人设置</a></li>
                    <li><a >消息提醒</a></li>
                </ul>
            </li>


        </ul>
    </nav>
</div>
<script type=text/javascript>
    function menuFix() {
        var sfEls = document.getElementById("menu_navbar").getElementsByTagName("li");
        for (var i=0; i<sfEls.length; i++) {
            sfEls[i].onmouseover=function() {
                this.className+=(this.className.length>0? " ": "") + "sfhover";
            }
            sfEls[i].onMouseDown=function() {
                this.className+=(this.className.length>0? " ": "") + "sfhover";
            }
            sfEls[i].onMouseUp=function() {
                this.className+=(this.className.length>0? " ": "") + "sfhover";
            }
            sfEls[i].onmouseout=function() {
                this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"),"");
            }
        }
    }
    window.onload=menuFix;
</script>


<div class="container">
    <div class="admin_header clearfix">
        <h2 class="pull-left">域名列表</h2>
        <a class="btn btn-default pull-right btn-xs new_domain" >
            <i class="icon-plus3">添加</i>
        </a>
    </div>
    <div class="admin_main clearfix">
        <div class="box content_box">
            <form action="" method="post" name="new_domain">
                <table class="table table-bordered  table-striped">
                    <thead>
                        <tr>
                            <th>类型</th>
                            <th>域名</th>
                            <th>解析</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody class="domain_list">
                        <?foreach ($domains as $domain):?>
                        <tr id="domain-<?=$domain->id;?>">
                            <td>域名</td>
                            <td><?=$domain->prefix;?>.sdut.me</td>
                            <td><?=$domain->target;?></td>
                            <td>
                                <a class="btn btn-default btn-xs button_resolve" data-prefix="<?=$domain->prefix;?>" data-domain-id="<?=$domain->id;?>" data-domain-target="<?=$domain->target;?>">
                                    <i class="icon-cog">解析</i>
                                </a>
                                <a class="btn btn-default btn-xs button_remove"  data-domain-id="<?=$domain->id;?>">
                                    <i class="icon-trash">刪除</i>
                                </a>
                            </td>
                        </tr>
                        <?endforeach;?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('a.new_domain').click(function(event) {
        var new_domain_html = '<tr>'+
                        '<td>域名</td>'+
                        '<td><div class="input-group">'+
                        '<input type="text" name="prefix" class="input-xs prepend">'+
                        '<input type="text" name="base[]" class="input-xs append" value=".sdut.me" readonly></div></td>'+
                        '<td><div class="input-group"><input type="text" name="cname"  class="input-xl"></div></td>'+
                        '<td><a class="btn btn-default btn-xs form_submit"><i class="icon-disk">保存</i></a>'+
                        '<a class="btn btn-default btn-xs cancel_submit"><i class="icon-arrow">取消</i></a>'+'</td></tr>';
        $('tbody.domain_list').append(new_domain_html);
        $(this).attr('disabled', 'true');
        $('input.append').focus(function(event) {
            $(this).prev().focus();
        });
        $('input.prepend').focus(function(event) {
            $(this).next().addClass('focus');
        });
        $('input.prepend').blur(function(event) {
            $(this).next().removeClass('focus');
        });
        $('a.form_submit').click(function(event) {
            $.post(
                "<?=site_url('admin/domains/create');?>",
                $('form[name="new_domain"]').serialize(),
                function(data) {
                    if(data.error_code ==1){
                        alert(data.error_message);
                    }else{
                        window.location.reload();
                    }
            });
        });
        $('a.cancel_submit').click(function(event) {
            window.location.reload();
        });
    });

    $('a.button_remove').click(function(event) {
        $.get(
            "<?=base_url('admin/domains/remove')?>/"+$(this).data('domain-id'),
            function(data) {
                if(data.error_code ==1){
                    alert(data.error_message);
                }else{
                    window.location.reload();
                }
        });
    });

    $('a.button_resolve').click(function(event) {
        var domain_id = $(this).data('domain-id');
        var edit_domain_html ='<td>域名</td>'+
                        '<td>'+$(this).data('prefix')+'.sdut.me'+
                        '<input name="prefix" value="'+$(this).data('prefix')+'" hidden></td>'+
                        '<td><div class="input-group"><input type="text" name="cname"  class="input-xl" value="'+$(this).data('domain-target')+'"></div></td>'+
                        '<td><a class="btn btn-default btn-xs form_submit"><i class="icon-disk">保存</i></a>'+
                        '<a class="btn btn-default btn-xs cancel_submit"><i class="icon-arrow">取消</i></a>'+'</td></tr>';
        $('#domain-'+domain_id).html(edit_domain_html);
        $('a.form_submit').click(function(event) {
            $.post(
                "<?=base_url('admin/domains/edit');?>/"+domain_id,
                $('form[name="new_domain"]').serialize(),
                function(data) {
                    if(data.error_code ==1){
                        alert(data.error_message);
                    }else{
                        window.location.reload();
                    }
            });
        });
        $('a.cancel_submit').click(function(event) {
            window.location.reload();
        });
    });

</script>
<script type="text/javascript">
    $('input').keydown(function(event) {
        var keyCode = event.which;
            if (keyCode == 13){
                $('.form_submit').click();
            }
    });
</script>
