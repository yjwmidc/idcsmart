<?php /*a:3:{s:57:"../public/clientarea/template/pc/default/security_ssh.php";i:1749055993;s:51:"../public/clientarea/template/pc/default/header.php";i:1749055993;s:51:"../public/clientarea/template/pc/default/footer.php";i:1749055993;}*/ ?>
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
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/security_ssh.css">
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
          <div class="main-card">
            <div class="main-card-title">{{lang.security_title}}</div>
            <el-tabs v-model="activeName" @tab-click="handleClick">
              <el-tab-pane label="API" name="1" v-if="isShowAPI"></el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartSshKey')): ?>
              <el-tab-pane :label="lang.security_tab1" name="2">
                <div class="content-table">
                  <div class="top-text">
                    {{lang.security_tips6}}
                    <!--<span class="top-link" @click="toLearn">{{lang.security_tips7}}</span>-->
                  </div>
                  <div class="content_searchbar">
                    <div class="left-btn" @click="showCreateSsh">
                      {{lang.security_btn2}}
                    </div>
                    <div class="searchbar com-search">

                    </div>
                  </div>
                  <div class="tabledata">
                    <el-table v-loading="loading" :data="dataList" style="width: 100%;margin-bottom: .2rem;">
                      <el-table-column prop="name" :label="lang.security_label1" width="300"
                        :show-overflow-tooltip="true" align="left">
                      </el-table-column>
                      <el-table-column prop="finger_print" :label="lang.security_label10" min-width="200"
                        :show-overflow-tooltip="true" align="left">
                      </el-table-column>
                      <el-table-column prop="type" :label="lang.finance_label6" width="100" align="left" fixed="right">
                        <template slot-scope="scope">
                          <el-popover placement="top-start" trigger="hover">
                            <div class="operation">
                              <div class="operation-item" @click="editItem(scope.row)">{{lang.security_tips8}}</div>
                              <div class="operation-item" @click="deleteItem(scope.row)">{{lang.security_tips9}}</div>
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
              <el-tab-pane :label="lang.security_tab2" name="3" v-if="isShowAPILog"></el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartCloud')): ?>
              <el-tab-pane :label="lang.security_group" name="4"></el-tab-pane>
              <?php endif; ?>
              <?php endforeach; ?>
            </el-tabs>

            <!-- 删除弹窗 -->
            <div class="delete-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowDel" :show-close=false @close="delClose">
                <div class="del-dialog-title">
                  <i class="el-icon-warning-outline del-icon"></i>{{lang.security_title5}}
                </div>
                <div class="del-dialog-main">
                  {{lang.security_title5}}:{{delName}}
                </div>
                <div class="del-dialog-footer">
                  <div class="btn-ok" @click="delSub">{{lang.security_btn9}}</div>
                  <div class="btn-no" @click="delClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>
            <!-- 创建SSH弹窗 -->
            <div class="cj-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowCj" :show-close=false @close="cjClose">
                <div class="dialog-title">
                  {{lang.security_btn10}}
                </div>
                <div class="dialog-main">
                  <div class="label">{{lang.security_label1}}</div>
                  <el-input v-model="cjData.name"></el-input>
                  <div class="label">{{lang.security_label7}}</div>
                  <el-input type="textarea" v-model="cjData.public_key" :rows="3"></el-input>

                  <el-alert class="alert-text" :title="errText" v-show="errText" type="error" show-icon
                    :closable="false">
                  </el-alert>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="cjSub">{{lang.security_btn5}}</div>
                  <div class="btn-no" @click="cjClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>

            <!-- 编辑SSh弹窗 -->
            <div class="edit-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowEdit" :show-close=false @close="editClose">
                <div class="dialog-title">
                  {{lang.security_title6}}
                </div>
                <div class="dialog-main">
                  <div class="label">{{lang.security_label1}}</div>
                  <el-input v-model="editData.name"></el-input>
                  <div class="label">{{lang.security_label7}}</div>
                  <el-input type="textarea" v-model="editData.public_key" :rows="3"></el-input>

                  <el-alert class="alert-text" :title="errText" v-show="errText" type="error" show-icon
                    :closable="false">
                  </el-alert>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="editSub">{{lang.security_btn5}}</div>
                  <div class="btn-no" @click="editClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>
          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/security.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/pagination/pagination.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/security_ssh.js"></script>
  <!-- =======公共======= -->

<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/asideMenu/asideMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/components/topMenu/topMenu.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($public_themes); ?>/utils/directive.js"></script>

</body>

</html>

