<?php /*a:2:{s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:89:"../public/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/ticketDetails.html";i:1756623756;}*/ ?>
<!-- 页面独有样式 -->
<link rel="stylesheet" href="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/css/ticketDetails.css">
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/viewer.min.css">
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
  <div class="template ticket-details">
    <el-container>
      <aside-menu></aside-menu>
      <el-container>
        <top-menu></top-menu>
        <el-main>
          <!-- 自己的东西 -->
          <div class="main-card">
            <div class="top">
              <div class="top-l">
                <svg t="1749023272025" viewBox="0 0 1024 1024" version="1.1" @click="backTicket" class="top-img"
                  xmlns="http://www.w3.org/2000/svg" p-id="20485" width="0.26rem" height="0.26rem">
                  <path
                    d="M672.426667 209.92H455.68v-136.533333l-295.253333 170.666666 295.253333 170.666667v-136.533333h215.04C819.2 278.186667 938.666667 397.653333 938.666667 546.133333s-119.466667 267.946667-267.946667 267.946667H52.906667c-18.773333 0-34.133333 15.36-34.133334 34.133333s15.36 34.133333 34.133334 34.133334h619.52c186.026667 0 336.213333-150.186667 336.213333-336.213334s-151.893333-336.213333-336.213333-336.213333z"
                    p-id="20486" fill="var(--color-primary)"></path>
                </svg>

                {{lang.ticket_title3}}
              </div>
            </div>
            <div class="top-line"></div>

            <div class="card base-card">
              <div class="card-title">{{baseMsg.title}}</div>
              <div class="card-main">
                <el-row>
                  <el-col :span="12">
                    <div class="card-main-item">
                      <!-- <div class="main-item-label">{{lang.ticket_label9}}</div>
                                            <div class="main-item-text">
                                                {{baseMsg.title}}
                                            </div> -->
                    </div>
                  </el-col>
                  <el-col :span="12">
                    <div class="close-btn" @click="showClose"
                      v-if="baseMsg.status != lang.ticket_text5 && ticketData.can_operate !== 0">
                      {{lang.ticket_btn7}}
                    </div>
                  </el-col>
                </el-row>
                <el-row>
                  <el-col :span="6">
                    <div class="card-main-item">
                      <div class="main-item-label">{{lang.ticket_label10}}</div>
                      <div class="main-item-text">
                        {{baseMsg.create_time | formateTime}}
                      </div>
                    </div>
                  </el-col>
                  <el-col :span="6">
                    <div class="card-main-item">
                      <div class="main-item-label">{{lang.ticket_label2}}</div>
                      <div class="main-item-text">
                        {{baseMsg.type}}
                      </div>
                    </div>
                  </el-col>
                  <el-col :span="6">
                    <div class="card-main-item">
                      <div class="main-item-label">{{lang.ticket_label11}}</div>
                      <div class="main-item-text">
                        {{baseMsg.status}}
                      </div>
                    </div>
                  </el-col>
                  <el-col :span="6">
                    <div class="card-main-item">
                      <div class="main-item-label">{{lang.ticket_label7}}</div>
                      <div class="main-item-text host-item-text" v-if="baseMsg.hosts[0]">
                        <div class="host-item" v-for="item in baseMsg.hosts" :key="item.id" @click="toHost(item.id)">
                          {{item.label}}
                        </div>
                      </div>
                      <div v-else>--</div>
                    </div>
                  </el-col>
                </el-row>
              </div>
            </div>
            <div class="card">
              <div class="card-title">{{lang.ticket_title5}}</div>
              <div class="card-main talk-main">
                <div class="main-old-msg infinite-list-wrapper">
                  <div class="reply-item " v-for="item in ticketData.replies" :key="item.create_time"
                    :class="item.type">
                    <div class="reply-item-top">
                      <div class="reply-time">
                        {{item.create_time | formateTime}}
                      </div>
                      <div class="reply-name">
                        {{item.type == 'Client'? item.client_name : item.admin_name}}
                      </div>
                      <!-- <div class="reply-img">
                                                <img :src="item.type == 'Client'? '/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/img/ticket/client.png':'/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/img/ticket/admin.png'">
                                            </div> -->
                    </div>
                    <div class="reply-item-content" v-html="item.content" @click="hanldeImage($event)">
                      <!-- {{item.content}} -->
                    </div>
                    <div class="reply-item-attachment">
                      <div class="reply-item-attachment-item" v-for="(f,i) in item.attachment" :key="i"
                        @click="clickFile(f)">
                        <span :title="f.name">
                          <i class="el-icon-tickets"></i><span>{{f.name}}</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="main-now-msg">
                  <el-input class="msg-input" type="textarea" :autosize="{ minRows: 5, maxRows: 5}" resize=none
                    maxlength="3000" :placeholder="lang.ticket_label12" v-model="replyData.content">
                  </el-input>
                  <!-- <textarea ref="content" id="tiny" name="content"></textarea> -->
                </div>
              </div>
              <div class="card-footer" v-if="ticketData.can_operate !== 0">
                <el-button type="primary" @click="doReplyTicket"
                  v-loading="sendBtnLoading">{{lang.ticket_btn8}}</el-button>
                <el-upload ref="fileupload" class="upload-btn" :headers="{Authorization: jwt}"
                  action="/console/v1/upload" :before-remove="beforeRemove" multiple :file-list="fileList"
                  :on-success="handleSuccess" :on-progress="handleProgress">
                  <el-button icon="el-icon-upload2">{{lang.ticket_label13}}</el-button>
                </el-upload>
              </div>
            </div>
          </div>

          <!-- 确认关闭弹窗 -->
          <div class="del-dialog">
            <el-dialog width="6.8rem" :visible.sync="visible" :show-close=false>
              <div class="dialog-title">
                {{lang.ticket_title6}}
              </div>
              <div class="dialog-main">
                {{lang.ticket_tips11}} {{baseMsg.title}}，{{lang.ticket_tips12}}
              </div>
              <div class="dialog-footer">
                <div class="btn-ok" @click="doCloseTicket" v-loading="delLoading">{{lang.ticket_btn6}}</div>
                <div class="btn-no" @click="visible= false">{{lang.ticket_btn9}}</div>
              </div>
            </el-dialog>
          </div>
          <div style="height: 0;">
            <img id="viewer" style="width: 0; height: 0;" :src="preImg" alt="">
          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/lang/index.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/api/ticket.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/js/tinymce/tinymce.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/common/viewer.min.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/js/xss.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/js/ticketDetails.js"></script>
