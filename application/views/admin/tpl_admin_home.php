<div class="menu">
    <div class="menu_header">
        <a></a>
    </div>

    <nav >
        <ul class="menu_navbar" id="menu_navbar"  >
            <li class="sfhover" >
                <a href="<?=site_url('admin/home');?>">控制台</a>
            </li>
            <li>
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
        <h2 class="pull-left">控制台</h2>
        <a class="btn btn-default pull-right btn-xs" href="<?=site_url();?>" target="_blank">
            <i class="icon-link"> 网站</i>
        </a>
    </div>
    <div class="admin_main clearfix">
        <div class="box content_box">

        </div>
    </div>
</div>
<script type="text/javascript">
    $('input').keydown(function(event) {
        var keyCode = event.which;
            if (keyCode == 13){
                $('.form_submit').click();
            }
    });
</script>
