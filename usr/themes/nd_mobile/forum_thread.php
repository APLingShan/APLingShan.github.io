<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
{include common/head}
<style>
    .upload_bg{
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        opacity: 0;
        top: 0;
    }
    .m-navbar{
        background-color: rgba(255, 255, 255, 0);
        -webkit-transition: background-color .2s ease-in;
        transition: background-color .2s ease-in;
    }
    .m-bg {
        background-color:#fff!important;
    }
    .forum_thread_header .m-bg .navbar-item,
    .forum_thread_header .m-bg .navbar-item .back-ico:before, 
    .forum_thread_header .m-bg .navbar-item .next-ico:before{
        color: #5C5C5C;
    }
    .navbar-title
    {
        color: #5C5C5C !important;
    }
    *{
        -webkit-overflow-scrolling: touch;
    }
</style>
<div class="g-view">
    <header class="forum_thread">
        <div style="background-image:url({if $forum[$fid]['bg_img']}{#WWW}{$forum[$fid]['bg_img']}{else}http://bpic.588ku.com/back_pic/04/43/61/69585352e75974a.jpg{/if});" class="forum_thread_header">
            <div class="m-navbar navbar-fixed" id="navbar">
                <a href="javascript:history.back(-1);" class="navbar-item">
                    <i class="icon-fanhui"></i>
                </a>
                <div class="navbar-center">
                    <span class="navbar-title form-title"></span>
                </div>
                {if NOW_GID == C("ADMIN_GROUP") || is_forumg($forum,NOW_UID,$fid)}
                <a href="JavaScript:;" class="navbar-item" data-ydui-actionsheet="{target:'#xiugaibeijing',closeElement:'#cancel'}">
                    <i class="icon-yduigengduo"></i>
                </a>
                {else}
                <a href="JavaScript:;" class="navbar-item" data-ydui-actionsheet="{target:'#yd-search',closeElement:'#cancel'}">
                    <i class="icon-sousuo"></i>
                </a>
                {/if}
            </div>
            <div class="forumg">
                <div>
                    <div class="title">
                        <img class="forun_icon" src="{#WWW}upload/forum{$fid}.png?s={#NOW_TIME}" alt="" onerror="this.src='{#WWW}upload/de.png'">
                        <h3>{$title}</h3>
                    </div>
                </div>
                <div>
                    <div class="forun_info">
                        <div>
                            <h3 class="forum_color">{$forum[$fid]['threads']}</h3>
                            <p>??????</p>
                        </div>
                        <div>
                            <h3 class="forum_color">{$forum[$fid]['posts']}</h3>
                            <p>??????</p>
                        </div>
                        <div>
                            <h3 class="forum_color">{php echo S('plugins_myforum')->count(['fid'=>$fid])}</h3>
                            <p>??????</p>
                        </div>
                    </div>
                    <div>
                         <a href="javascript:;" {if !IS_LOGIN}onclick="is_login();"{else}data-ydui-actionsheet="{target:'#ajax_post_page',closeElement:'#cancel-editor'}" onclick="ajax_post('{#HYBBS_URL('post')}','post')"{/if} class="btn btn-icon">
                             <div><i class="icon--jia"></i></div>
                         </a>
                         <a href="javascript:;" class="btn btn-icon" data-ydui-actionsheet="{target:'#form_fenx',closeElement:'#cancel'}">
                             <div><i class="icon-fenxiang"></i></div>
                         </a>
                         <a href="javascript:;" class="btn btn-icon" data-ydui-actionsheet="{target:'#gengduo',closeElement:'#cancel'}">
                             <div><i class="icon-yduigengduo"></i></div>
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {if NOW_GID == C("ADMIN_GROUP")||is_forumg($forum,NOW_UID,$fid)}
    <!-- ???????????? -->
    <div class="m-actionsheet" id="xiugaibeijing" style="height: 100%;">
        <div class="g-view" style="height: 100%;overflow-y: scroll;">
            <header class="forum_thread">
                <div style="background-image:url({if $forum[$fid]['bg_img']}{#WWW}{$forum[$fid]['bg_img']}{else}http://bpic.588ku.com/back_pic/04/43/61/69585352e75974a.jpg{/if});" class="forum_thread_header">
                    <div class="m-navbar navbar-fixed">
                        <a href="javascript:;" class="navbar-item" id="cancel">
                            <i class="icon-cha"></i>
                        </a>
                        <div class="navbar-center">
                            <span class="navbar-title"></span>
                        </div>
                    </div>
                    <div class="forumg">
                        <div>
                            <div class="title">
                                <img class="forun_icon" src="{#WWW}upload/forum{$fid}.png?s={#NOW_TIME}" alt="" onerror="this.src='{#WWW}upload/de.png'">
                                <h3>{$title}</h3>
                            </div>
                        </div>
                        <div>
                            <div class="forun_info">
                                <div>
                                    <h3 class="forum_color">{$forum[$fid]['threads']}</h3>
                                    <p>??????</p>
                                </div>
                                <div>
                                    <h3 class="forum_color">{$forum[$fid]['posts']}</h3>
                                    <p>??????</p>
                                </div>
                                <div>
                                    <h3 class="forum_color">{php echo S('plugins_myforum')->count(['fid'=>$fid])}</h3>
                                    <p>??????</p>
                                </div>
                            </div>
                            <div>
                                <a href="javascript:;" class="btn btn-icon">
                                    <div><i class="icon--jia"></i></div>
                                </a>
                                <a href="javascript:;" class="btn btn-icon">
                                    <div><i class="icon-zhifeiji"></i></div>
                                </a>
                                <a href="javascript:;" class="btn btn-icon">
                                    <div><i class="icon-yduigengduo"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="m-celltitle" style="margin-top: 15px;">?????????????????????414X190?????????</div>
            <div style="position: relative;margin: 0 10px;">
                <button class="btn-block btn-primary" style="margin-top: 0">?????????????????????</button>
                <input class="upload_bg" type="file" name="phone" id="bgimg" multiple="multiple" name="photo" accept="image/*" onchange="upload_bg(this,'{$fid}')">
           </div>
            <div style="position: relative;margin: 0 10px;">
                <button class="btn-block btn-hollow" style="">?????????????????????</button>
                <input class="upload_bg" type="file" name="phone" id="forum_icon" multiple="multiple" name="photo" accept="image/*" onchange="forum_icon(this,'{$fid}')">
           </div>
           <div class="m-cell" style="margin-top: 15px;">
                <div class="cell-item">
                    <div class="cell-right"><input type="text" name="forum_color" value="{$forum[$fid]['color']}" class="cell-input" placeholder="????????????,??????????????????:#990099" autocomplete="off" /></div>
                </div>
                <div class="cell-item">
                    <div class="cell-right"><input type="text" name="forumg" value="{$forum[$fid]['forumg']}" class="cell-input" placeholder="??????id,?????????,????????????:1,2" autocomplete="off" /></div>
                </div>
                <div class="cell-item">
                    <div class="cell-right">
                        <textarea class="cell-textarea" name="forum_mess" placeholder="??????????????????,??????html" style="font-size: 15px">{$forum[$fid]['html']}</textarea>
                    </div>
                </div>
                <div class="cell-item">
                    <div class="cell-right">
                        <textarea class="cell-textarea" name="forum_bangui" placeholder="????????????,??????html" style="font-size: 15px">{$forum[$fid]['bangui']}</textarea>
                    </div>
                </div>
                <div class="cell-item">
                    <div class="cell-right">
                        <button class="btn btn-primary" style="margin-top: 0" onclick="xiuforum(this,{$fid})">????????????</button>
                    </div>
                </div>
                
            </div>
            <div class="m-celltitle" style="margin-top: 15px;">???????????????<p>???????????????????????????????????????????????????????????????????????????????????????id???????????????????????????</p></div>
        </div>
    </div>
    {/if}
    <!-- ????????? -->
    <div class="forum_thread_zifenlei forum_list" id="zifenlei">
        <header class="m-navbar navbar-fixed" style="background:#fff">
            <a href="javascript:;" class="navbar-item" id="cancel">
                <i class="icon-fanhui"></i>
            </a>
            <div class="navbar-center">
                <span class="navbar-title">?????????</span>
            </div>

        </header>
        <div class="g-view">
            <div class="list">
                <div class="m-grids-4">
                    <?php
                        $fdata = S('forum')->select('*',['fid'=>$fid]);
                    ?>
                    {foreach $fdata as $v}
                    <a href="{#HYBBS_URL('forum',$v['id'])}" data-pjax class="grids-item">
                        <div class="grids-txt">
                            <div class="list_img">
                                <img src="{#WWW}upload/forum{$v.id}.png" onerror="this.src='{#WWW}upload/de.png'">
                            </div>
                            <div class="list_title">{$v.name}</div>
                        </div>
                    </a>
                    {/foreach}
                    {if empty($fdata)}
                    <div class="no_thread">
                        <i class="icon-nuandou"></i>
                        <p>???????????????...</p>
                    </div>
                    {/if}
                </div>
            </div>
        </div>
    </div>
    <!-- ?????? -->
    <div class="m-actionsheet gengduo" id="gengduo" style="height: 100%;">
        <style>
            .next-ico::before{color: #656565;}
        </style>
        <header class="m-navbar navbar-fixed" style="background:#fff">
            <a href="javascript:;" class="navbar-item" id="cancel">
                <i class="icon-cha"></i>
            </a>
            <div class="navbar-center">
                <span class="" style="font-size: 20px;color: #656565 !important;"></span>
            </div>
        </header>
        <div class="g-view" style="height:100%;overflow-y: scroll;text-align: left">
            <div class="bankuai">
                <div><img src="{#WWW}upload/forum{$fid}.png" alt="{$title}" onerror="this.src='{#WWW}upload/de.png'"></div>
                <div style="width:100%;">
                    <h3>{$title}</h3>
                    <p>{if !$forum[$fid]['html']}??????????????????{else}{$forum[$fid]['html']}{/if}</p>
                </div>
                <div class="guanzu">
                    {if S('plugins_myforum')->count(['fid'=>$fid,'uid'=>NOW_UID])}
                    <a href="javascript:;" onclick="follow_forum({$fid},'q',this)">??????</a>
                    {else}
                    <a href="javascript:;" onclick="follow_forum({$fid},'g',this)">??????</a>
                    {/if}
                </div>
            </div>
            <div class="nd_content">
                <div style="position: relative;">
                    <h4>??????</h4>
                </div>
                <div class="forum_list m-grids-4">
                    <?php 
                        $banzhu = explode(",",$forum[$fid]['forumg']);
                        $User = M("User");
                        $banzhu = $User->select('*',['uid'=>$banzhu]);
                    ?>
                    {foreach $banzhu as $ban}
                    <a href="{#HYBBS_URL('my',$ban['user'])}" data-pjax="" class="grids-item">
                        <div class="grids-txt">
                            {php $guser = $User->uid_to_user($ban['uid']);$gavatar = $this->avatar($guser);}
                            <img src="{#WWW}{$gavatar.b}" alt="???????????????">
                            <p>{$ban.user}</p>
                        </div>
                    </a>
                    {/foreach}
                    {if !$banzhu} <p style="padding:0 10px;color: #5a5a5a;font-size: 14px">????????????</p> {/if}
                </div>
            </div>
            <div class="nd_content">
                <div style="position: relative;">
                    <h4>??????</h4>
                </div>
                <article class="bangui">
                {if $forum[$fid]['bangui']}{$forum[$fid]['bangui']}{else}????????????{/if}
                </article>
            </div>
        </div>
    </div>
    <!-- ???????????? -->
    <div class="fenxiang">
        <div class="m-actionsheet" id="form_fenx" style="background:#f5f5f5">
            <div style="background:  #fff;line-height:  40px;text-align:  left;padding: 0 15px;">?????????:</div>
            <div class="grids-txt datasetconfig form_fenx" data-sites="yixin">
            </div>
        </div>
    </div>
    <script>
        // ??????
        $(function(){
            soshm('.form_fenx', {
                // ??????????????????????????????location.href
                url: "{#HYBBS_URL('forum',$fid)}",
                // ??????????????????????????????document.title
                title: '{$title}',
                // ??????????????????????????????<meta name="description" content="">content??????
                digest: "{$forum[$fid]['posts']}",
                // ????????????????????????????????????????????????img?????????src
                pic: '{#WWW}upload/forum{$fid}.png',
                sites: ['weixin','weixintimeline','qq','qzone','yixin','weibo','tqq','renren','douban','tieba']
            })
        })
    </script>
    <style>
        .soshm-item {
            float: left;
            margin: 10px 0px;
            cursor: pointer;
            width: 20%;
        }
    </style>
    <!-- ????????? -->
    <div class="m-actionsheet" id="yd-search" style="height: 100%;">
        <style>
            .next-ico::before{color: #656565;}
        </style>
        <header class="m-navbar navbar-fixed" style="background:#fff">
            <a href="javascript:;" class="navbar-item" id="cancel" style="color: #656565;">
                <i class="icon-fanhui"></i>
            </a>
            <div class="navbar-center">
                <span class="" style="font-size: 20px;color: #656565 !important;">??????</span>
            </div>
        </header>
        <div class="g-view" style="height:100%">
            <div class="sh">
                <form id="form" action="{#HYBBS_URL('search')}">
                    <input id="sou" type="text" name="key" placeholder="???????????????">
                    <button class="shbtn" type="submit" style="display: none">??????</button>
                </form>
            </div>
            <div class="resou" style="margin-top:10px;text-align: left;">
                <div>????????????</div>
                {php $inc = get_plugin_inc('nd_website_plus');$sou = array_filter(explode(",",$inc['sou_key']))}
                {foreach $sou as $k => $v}
                    <a href="{#HYBBS_URL('search')}?key={$v}" data-pjax style="{if $k==0}color: #ff5900;border: 1px solid #ff5900;{elseif $k == 1}color: #03a9f4;border: 1px solid #03a9f4;{elseif $k==2}color: #4cd864;border: 1px solid #4cd864;{/if}">{$v}</a>
                {/foreach}
            </div>
        </div>
    </div>
    <!-- ?????? -->
    <div class="forum_thread_nav" style="box-shadow:0 3px 17px -7px rgba(96, 125, 139, 0.31);">
        <a class="{if !isset($_GET['HY_URL'][2])}active{/if}" href="{php HYBBS_URL('forum',$fid);}" data-pjax>??????</a>
        <a class="{if isset($_GET['HY_URL'][2])}{if $_GET['HY_URL'][2] == 'new'}active{/if}{/if}" href="{php HYBBS_URL('forum',$fid,'new');}" data-pjax>??????</a>
        <a class="{if isset($_GET['HY_URL'][2])}{if $_GET['HY_URL'][2] == 'btime'}active{/if}{/if}" href="{php HYBBS_URL('forum',$fid,'btime');}" data-pjax>??????</a>
        <a class="" href="{php HYBBS_URL('plugins','digest',$fid);}" data-pjax>??????</a>
        <div class="right">
            <a href="javascript:;" data-ydui-actionsheet="{target:'#zifenlei',closeElement:'#cancel'}">
                <i class="icon-leimupinleifenleileibie"></i>
            </a>
        </div>
    </div>

    <div id="content">
        {if $top_list || $top_f_data}
        <div class="m-cell" style="background:#fdfdfd;box-shadow:0 3px 17px -7px rgba(96, 125, 139, 0.31);margin-top: 1px;">
            {foreach $top_list as $v}
                <div class="cell-item">
                    <div class="zhiding">
                        <span class="">??????</span>
                        <a href="{#HYBBS_URL('thread',$v['tid'])}" data-pjax> {$v.title}</a>
                    </div>
                </div>
            {/foreach}
            {foreach $top_f_data as $v}
                <div class="cell-item">
                    <div class="zhiding">
                        <span class="">??????</span>
                        <a href="{#HYBBS_URL('thread',$v['tid'])}" data-pjax> {$v.title}</a>
                    </div>
                </div>
            {/foreach}
        </div>
        {/if}
        <!-- ?????? -->
        <div id="forun_list">
            <!--ajax start-->
            <?php
                function is_style($fid){
                    $inc = array_filter(explode("\r\n",view_form('nd_mobile','style')));
                    foreach($inc as $key => $val){
                        $incs = explode(',',$val);
                        if($fid == $incs['0']){
                            return $incs['1']; //????????????id
                            break;
                        }
                    }
                }
            ?>
            {if is_style($fid,1) == 1}
            <!-- ???????????? -->
                {foreach $data as $k => $v}
                    {include forum_list_jindian}
                {/foreach}
            {elseif is_style($fid) == 2}
            <!-- ???????????? -->
                {foreach $data as $k => $v}
                    {include forum_list_quanzi}
                {/foreach}
            {elseif is_style($fid) == 3}
            <!-- ??????????????? -->
                {include forum_list_pubuliu}
            {else}
                {foreach $data as $k => $v}
                    {include forum_list_jindian}
                {/foreach}
            {/if}
            <!--ajax end-->
            {if empty($data)}
            <div class="no_thread">
                <i class="icon-meiyougengduo"></i>
                <p>??????????????????...</p>
            </div>
            {/if}

        </div>
        {if $page_count>1}
            <a href="javascript:;" id="load-forun" class="scroll load-index" url="{$pageid}" style="display: block" onclick="ajax_list(this)">
                <span id="list-loading1">
                    ??????????????????
                </span>
                <span id="list-loading2" style="display:none">
                    <div class="loader loader-1">
                        <div class="loader-outter"></div>
                        <div class="loader-inner"></div>
                    </div>
                    ?????????...
                </span>
            </a>
            {if is_style($fid) == 3}
                <script src="{#WWW}View/nd_mobile/src/GridLoadingEffects/js/modernizr.custom.js"></script>
                <script src="{#WWW}View/nd_mobile/src/GridLoadingEffects/js/masonry.pkgd.min.js"></script>
                <script src="{#WWW}View/nd_mobile/src/GridLoadingEffects/js/classie.js"></script>
                <script src="{#WWW}View/nd_mobile/src/GridLoadingEffects/js/imagesloaded.js"></script>
                <script src="{#WWW}View/nd_mobile/src/GridLoadingEffects/js/AnimOnScroll.js"></script>
                

                <script type="text/javascript">
                    $(document).ready(function () {
                        $.getScript("{#WWW}View/nd_mobile/src/GridLoadingEffects/js/imagesloaded.js")
                        $.getScript("{#WWW}View/nd_mobile/src/GridLoadingEffects/js/AnimOnScroll.js").done(function() {
                            /* ????????????????????????????????????????????? */
                            new AnimOnScroll(document.getElementById('grid'), {
                                    minDuration: 0.4,
                                    maxDuration: 0.7,
                                    viewportFactor: 0.2
                                });
                        });
                        $(window).scroll(function () {
                            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                                var page = parseInt($('#load-forun').attr("url")) + 1;
                                var urlx = "{php HYBBS_URL('forum',$fid,[$type=>'" + page + "']);}";
                                var pege_count = '{$page_count}';
                                if (page <= pege_count) {
                                        $.get(urlx, function (s) {
                                            s = s.replace(/\\n|\\r/g, "");
                                            s = s.substring(s.indexOf("<!--ajax-index start-->"), s.indexOf("<!--ajax-index end-->"));
                                            $('#grid').append(s);
                                            new AnimOnScroll(document.getElementById('grid'), {
                                                minDuration: 0.4,
                                                maxDuration: 0.7,
                                                viewportFactor: 0.2
                                            });
                                            $('#load-forun').attr('url', page).css('display', 'none');
                                        });
                                } else {
                                    $('#load-forun span').text('- ?????????????????? -');
                                };
                            }
                        });
                    });
                </script>
            {else}
                <script>
                    function ajax_list(obj){
                        $(obj).addClass('btn-disabled');
                        $('#list-loading1').hide();
                        $('#list-loading2').show();
                        var page = parseInt($('#load-forun').attr("url")) + 1;
                        var url = "{php HYBBS_URL('forum',$fid,[$type=>'"+page+"']);}";
                        var pege_count = "{$page_count}";
                        if (page <= pege_count) {
                                $.get(url, function(s) {
                                    s = s.replace(/\\n|\\r/g, "");
                                    s = s.substring(s.indexOf("<!--ajax start-->"), s.indexOf("<!--ajax end-->"));
                                    $('#forun_list').append(s);
                                    $('#load-forun').attr('url', page);
                                    $(obj).removeClass('btn-disabled');
                                    $('#list-loading2').hide();
                                    $('#list-loading1').show();
                                    $("img.lazyload").lazyload();
                                });

                        } else {
                            $('#load-forun span').text('- ?????????????????? -');
                        };
                    };
                </script>
            {/if}
        {/if}
    </div>
</div>
<script>
    $(function() {
        $(window).scroll(function() {
            if ($(document).scrollTop() >= 140) {
                $('#navbar').addClass('m-bg');
                $('.form-title').text('{$title;}');
                $('.forum_thread_nav').css({
                    position: 'fixed',
                    top: '50px',
                    left: 0,
                    right: 0,
                    'z-index': '10',
                    'border-top':'1px solid #e7e7e7'
                })
                $('#content').css('margin-top','45px')
            }else{
                $('#navbar').removeClass('m-bg');
                $('.form-title').text('');
                $('.forum_thread_nav').attr('style','')
                $('#content').attr('style','')
            }
        });
    });
</script>
{include common/footer} 
{include common/foot}