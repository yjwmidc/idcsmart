<?php /*a:3:{s:53:"../public/clientarea/template/pc/default/security.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:51:"../public/clientarea/template/pc/default/footer.php";i:1756623755;}*/ ?>
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

<!-- 页面独有样式 -->
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/security.css">
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
              <el-tab-pane label="API" name="1" v-if="isShowAPI">
                <div class="content-table">
                  <div class="content_searchbar">
                    <div class="left-btn" @click="showCreateApi" v-if="create_api">
                      {{lang.security_btn1}}
                    </div>
                    <div class="searchbar com-search">

                    </div>
                  </div>
                  <div class="tabledata">
                    <el-table v-loading="loading" :data="dataList" style="width: 100%;">
                      <el-table-column prop="id" label="ID" width="100" align="left">
                      </el-table-column>
                      <el-table-column prop="name" :label="lang.security_label1" min-width="300"
                        :show-overflow-tooltip="true" align="left">
                      </el-table-column>

                      <el-table-column prop="create_time" :label="lang.account_label10" width="250" align="left">
                        <template slot-scope="scope">
                          <span>{{scope.row.create_time | formateTime}}</span>
                        </template>
                      </el-table-column>
                      <el-table-column prop="ip" :label="lang.security_label2" width="150" align="left">
                        <template slot-scope="scope">
                          <!-- 已开启白名单 -->
                          <div class="open-show">
                            <!-- 未开启白名单 -->
                            <div class="un-open" v-if="scope.row.status == 0">{{lang.security_text2}}</div>
                            <div class="open" v-else>{{lang.security_text1}}</div>
                            <span class="setting" @click="showWhiteIp(scope.row)">{{lang.security_btn3}}</span>
                          </div>
                        </template>
                      </el-table-column>
                      <el-table-column prop="ip" :label="lang.security_label6" width="300" :show-overflow-tooltip="true"
                        align="left">
                        <template slot-scope="scope">
                          <span>{{scope.row.status == 1 && scope.row.ip || '--'}}</span>
                        </template>
                      </el-table-column>
                      <el-table-column prop="type" :label="lang.security_label3" width="100" fixed="right" align="left">
                        <template slot-scope="scope">
                          <el-popover placement="top-start" trigger="hover">
                            <div class="operation">
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
                  </div>
                </div>
              </el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartSshKey')): ?>
              <el-tab-pane :label="lang.security_tab1" name="2"></el-tab-pane>
              <?php endif; ?>
              <?php endforeach; ?>
              <el-tab-pane :label="lang.security_tab2" name="3" v-if="isShowAPILog"></el-tab-pane>
              <?php foreach($addons as $addon): if(($addon['name']=='IdcsmartCloud')): ?>
              <el-tab-pane :label="lang.security_group" name="4"></el-tab-pane>
              <?php endif; ?>
              <?php endforeach; ?>
            </el-tabs>

            <!-- 创建API弹窗 -->
            <div class="create-api-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowCj" :show-close=false @close="cjClose">
                <div class="dialog-title">
                  {{lang.security_btn1}}
                </div>
                <div class="dialog-main">
                  <div class="label">{{lang.security_label1}}</div>
                  <el-input v-model="apiName"></el-input>
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

            <!-- 创建API成功弹窗 -->
            <div class="create-api-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowCj2" :show-close=false @close="cj2Close">
                <div class="dialog-title">
                  {{lang.security_created_api}}
                </div>
                <div class="dialog-main">
                  <div class="content-msg">
                    <div class="msg-item">
                      <div class="item-label">{{lang.security_label1}}:</div>
                      <div class="item-vlaue">{{apiData.name}}</div>
                    </div>
                    <div class="msg-item">
                      <div class="item-label">ID:</div>
                      <div class="item-vlaue">{{apiData.id}}</div>
                    </div>
                    <div class="msg-item">
                      <div class="item-label">{{lang.security_api_adrress}}:</div>
                      <div class="item-vlaue">{{apiData.api_url}}</div>
                    </div>
                    <div class="msg-item">
                      <div class="item-label">Token:</div>
                      <div class="item-vlaue">{{apiData.token}}</div>
                      <div class="copy" v-copy="apiData.token">{{lang.security_btn11}}</div>
                    </div>
                    <div class="msg-item">
                      <div class="item-label">{{lang.security_label9}}:</div>
                      <div class="item-vlaue">{{apiData.private_key}}</div>
                      <div class="copy" v-copy="apiData.private_key">{{lang.security_btn11}}</div>
                    </div>
                    <div class="msg-item">
                      <div class="item-label">{{lang.security_label4}}:</div>
                      <div class="item-vlaue">{{apiData.create_time | formateTime}}</div>
                    </div>
                  </div>
                  <el-checkbox v-model="checked">
                    <span>
                      {{lang.security_tips}}
                      <span class="yellow">{{lang.security_tips2}}</span>
                    </span>

                  </el-checkbox>
                  <el-alert class="alert-text" :title="errText" v-show="errText" type="error" show-icon
                    :closable="false">
                  </el-alert>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="cj2Sub">{{lang.security_btn8}}</div>
                </div>
              </el-dialog>
            </div>

            <!-- 删除弹窗 -->
            <div class="delete-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowDel" :show-close=false @close="delClose">
                <div class="del-dialog-title">
                  <i class="el-icon-warning-outline del-icon"></i>{{lang.security_title3}}?
                </div>
                <div class="del-dialog-main">
                  {{lang.security_title3}}:{{delName}}
                </div>
                <div class="del-dialog-footer">
                  <div class="btn-ok" @click="delSub">{{lang.security_btn9}}</div>
                  <div class="btn-no" @click="delClose">{{lang.security_btn6}}</div>
                </div>
              </el-dialog>
            </div>

            <!-- ip白名单设置弹窗 -->
            <div class="white-ip-dialog">
              <el-dialog width="6.8rem" :visible.sync="isShowWhiteIp" :show-close=false @close="whiteIpClose"
                :destroy-on-close=true>
                <div class="dialog-title">
                  {{lang.security_title4}}
                </div>
                <div class="dialog-main">
                  <el-alert class="info-alert" :title="lang.security_tips3" type="info">
                  </el-alert>
                  <div class="ip-status">
                    <div class="ip-status-text">{{lang.security_label5}}</div>
                    <el-switch v-model="whiteIpData.status" active-color="var(--color-primary)" active-value="1"
                      inactive-value="0">
                    </el-switch>
                  </div>
                  <div class="status-remind">
                    {{lang.security_tips4}}
                  </div>
                  <div v-show="whiteIpData.status == '1'">
                    <div class="label">{{lang.security_label6}}</div>
                    <el-input type="textarea" :rows="3"
                      :placeholder="lang.security_tips5 + `&#10;1.1.1.1&#10;1.1.1.1-2.2.2.2`" v-model="whiteIpData.ip">
                    </el-input>
                  </div>

                  <el-alert class="alert-text" :title="errText" v-show="errText" type="error" show-icon
                    :closable="false">
                  </el-alert>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="whiteIpSub">{{lang.security_btn5}}</div>
                  <div class="btn-no" @click="whiteIpClose">{{lang.security_btn6}}</div>
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
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/security.js"></script>
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

