<?php /*a:3:{s:54:"../public/clientarea/template/pc/default/agreement.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/footer.php";i:1756623755;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme="<?php echo htmlentities($clientarea_theme_color); ?>" id="addons_js" addons_js='<?php echo json_encode($addons); ?>'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title></title>
    <link rel="icon" href="/favicon.ico">
    <!-- 公共 -->
    <script>
        const url = "/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/"
        const system_version = "<?php echo htmlentities($system_version); ?>"
    </script>

    <!-- 模板样式 -->
    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/reset.css">

    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/theme/index.js"></script>

    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/common.css">
    <link rel="stylesheet" href="/upload/common/iconfont/iconfont.css">


    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/vue.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/element.js"></script>


    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/util.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/lang/index.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/common.js"></script>

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/agreement.css">
</head>

<body>
    <div id="mainLoading">
        <div class="ddr ddr1"></div>
        <div class="ddr ddr2"></div>
        <div class="ddr ddr3"></div>
        <div class="ddr ddr4"></div>
        <div class="ddr ddr5"></div>
    </div>
    <div id="content" class="template">
        <div class="contnet-right-out">
            <div class="content-right" v-show="detailData.id" v-loading="contentLoading">
                <!-- 标题 -->
                <div class="right-title">
                    {{detailData.title}}
                </div>
                <!-- 更新时间 -->
                <div class="right-keywords-time">
                    <div class="right-time">
                        {{lang.agreement_text1}}：{{detailData.create_time | formateTime}}
                    </div>
                    <div class="right-keywords">
                        {{lang.agreement_text2}}：{{detailData.keywords || '--'}}
                    </div>
                </div>

                <!-- 主体内容 -->
                <div class="right-content" v-html="calStr(detailData.content)">
                </div>
                <!-- 附件 -->
                <div class="right-attachment">
                    {{lang.agreement_text3}}：
                    <div class="right-attachment-item" v-for="(f,i) in detailData.attachment" :key="i"
                        @click="downloadfile(f.url)">
                        <span :title="f.name">
                            <i class="el-icon-tickets"></i><span>{{f.name}}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/agreement.js"></script>
    <!-- =======公共======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/directive.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/coinActive/coinActive.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/asideMenu/asideMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/topMenu/topMenu.js"></script>
</body>

</html>

