<?php /*a:3:{s:59:"../public/clientarea/template/pc/default/security_group.php";i:1749055993;s:51:"../public/clientarea/template/pc/default/header.php";i:1749055993;s:51:"../public/clientarea/template/pc/default/footer.php";i:1749055993;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode id="addons_js" addons_js='<?php echo json_encode($addons); ?>'>

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
    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/element.css">
    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/viewer.min.css">
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/vue.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/element.js"></script>
    <!-- 模板样式 -->
    <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/css/common/common.css">
    <link rel="stylesheet" href="/upload/common/iconfont/iconfont.css">
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/util.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/viewer.min.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/lang/index.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/common.js"></script>
    <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/proofDialog/proofDialog.js"></script>

<!-- 页面独有样式 -->
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/security_group.css">
</head>

<body>
  <!-- mounted之前显示 -->
  <div id="mainLoading">
    <div class="ddr ddr1"></div>
    <div class="ddr ddr2"></div>
    <div class="ddr ddr3"></div>
    <div class="ddr ddr4"></div>
    <div class="ddr ddr5"></div>
  </div>
  <div class="template">
    <el-container>
      <aside-menu @getruleslist="getRule"></aside-menu>
      <el-container>
        <top-menu></top-menu>
        <el-main>
          <!-- 自己的东西 -->
          <div class="main-card security-group">
            <div class="main-card-title">{{lang.security_title}}</div>
            <el-tabs v-model="activeName" @tab-click="handleClick">
              <el-tab-pane label="API" name="1" v-if="isShowAPI"></el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartSshKey')): ?>
              <el-tab-pane :label="lang.security_tab1" name="2"></el-tab-pane>
              <?php endif; ?>
              <?php endforeach; ?>
              <el-tab-pane :label="lang.security_tab2" name="3" v-if="isShowAPILog"></el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartCloud')): ?>
              <el-tab-pane :label="lang.security_group" name="4">
                <div class="content-table">
                  <div class="content_searchbar">
                    <div class="left-btn" @click="createSecurity">
                      {{lang.create_security_group}}
                    </div>
                    <div class="searchbar com-search">

                    </div>
                  </div>
                  <div class="tabledata">
                    <el-table v-loading="loading" :data="dataList" style="width: 100%;margin-bottom: .2rem;">
                      <el-table-column prop="name" :label="lang.security_label1" width="200" align="left">
                        <template slot-scope="{row}">
                          <a :href="`group_rules.htm?id=${row.id}`" class="link">{{row.name}}</a>
                        </template>
                      </el-table-column>
                      <el-table-column prop="host_num" :label="lang.cloud_menu_1" align="left" width="150">
                      </el-table-column>
                      <el-table-column prop="rule_num" :label="lang.rules" align="left">
                      </el-table-column>
                      <el-table-column prop="create_time" :label="lang.account_label10" align="left" width="200">
                        <template slot-scope="scope">
                          <span>{{scope.row.create_time | formateTime}}</span>
                        </template>
                      </el-table-column>
                      <el-table-column prop="type" :label="lang.security_label3" width="100" fixed="right" align="left">
                        <template slot-scope="scope">
                          <el-popover placement="top-start" trigger="hover">
                            <div class="operation">
                              <div class="operation-item" @click="editItem(scope.row)">{{lang.edit}}</div>
                              <div class="operation-item" @click="deleteItem(scope.row)">{{lang.security_btn4}}</div>
                            </div>
                            <span class="more-operation" slot="reference">
                              <div class="dot"></div>
                              <div class="dot"></div>
                              <div class="dot"></div>
                            </span>
                          </el-popover>
                        </template>
                      </el-table-column>
                    </el-table>
                    <pagination :page-data="params" @sizechange="sizeChange" @currentchange="currentChange">
                    </pagination>
                  </div>
                </div>
              </el-tab-pane>
              <?php endif; ?>
              <?php endforeach; ?>
            </el-tabs>
            <!-- 创建/编辑安全组弹窗 -->
            <div class="create-api-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowCj" :show-close=false @close="cjClose">
                <div class="dialog-title">
                  {{optType === 'add' ? lang.create_security_group : lang.edit_security_group}}
                </div>
                <div class="dialog-main">
                  <div class="label">{{lang.security_label1}}</div>
                  <el-input v-model="createForm.name"></el-input>
                  <div class="label">{{lang.account_label9}}</div>
                  <el-input type="textarea" rows="5" v-model="createForm.description"></el-input>
                  <el-alert class="alert-text" :title="errText" v-show="errText" type="error" show-icon
                    :closable="false">
                  </el-alert>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="cjSub" v-loading="submitLoading">{{lang.security_btn5}}</div>
                  <div class="btn-no" @click="cjClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>
            <!-- 删除安全组弹窗 -->
            <div class="delete-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowDel" :show-close=false @close="delClose">
                <div class="del-dialog-title">
                  <i class="el-icon-warning-outline del-icon"></i>{{lang.del_group}}?
                </div>
                <div class="del-dialog-main">
                  {{lang.del_group}}:{{delName}}
                </div>
                <div class="del-dialog-footer">
                  <div class="btn-ok" @click="delSub" v-loading="submitLoading">{{lang.security_btn9}}</div>
                  <div class="btn-no" @click="delClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>

          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/security_group.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/pagination/pagination.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/security_group.js"></script>
  <!-- =======公共======= -->

<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/asideMenu/asideMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/topMenu/topMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/directive.js"></script>

</body>

</html>

