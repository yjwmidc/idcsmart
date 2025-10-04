<?php /*a:2:{s:51:"../public/clientarea/template/pc/default/header.php";i:1756623755;s:85:"../public/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/addTicket.html";i:1756623756;}*/ ?>
<!-- 页面独有样式 -->
<link rel="stylesheet" href="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/css/addTicket.css">
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
  <div class="template add-ticket">
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
                {{lang.ticket_title2}}
              </div>
            </div>
            <div class="top-line"></div>

            <div class="main-form">
              <el-form ref="form" :model="ticketData" label-width="80px" :rules="rules">
                <el-form-item :label="lang.ticket_label2" prop="ticket_type_id">
                  <!-- <el-select class="select-type" v-model="ticketData.admin_role_id" :placeholder="lang.ticket_tips8" @change="departmentChange">
                                        <el-option v-for="item in departmentList" :key="item.admin_role_id" :value="item.admin_role_id" :label="item.name"></el-option>
                                    </el-select> -->
                  <el-select class="select-type" v-model="ticketData.ticket_type_id" :placeholder="lang.ticket_tips2">
                    <el-option v-for="item in ticketType" :key="item.id" :value="item.id"
                      :label="item.name"></el-option>
                  </el-select>
                </el-form-item>
                <div class="title-host">
                  <el-form-item :label="lang.ticket_label6" prop="title">
                    <el-input class="select-title" v-model="ticketData.title" :placeholder="lang.ticket_tips9"
                      maxlength="20">
                    </el-input>
                  </el-form-item>
                  <el-form-item :label="lang.ticket_label7" prop="host_ids">
                    <el-select filterable class="select-host" v-model="ticketData.host_ids" popper-class="host-dialog"
                      :placeholder="lang.ticket_tips10" collapse-tags clearable @change="chooseItem">
                      <el-option v-for="item in hostList" :key="item.id" :value="item.id"
                        :label="item.product_name + '(' + (item.dedicate_ip || item.name) + ')'">
                        <span v-if="!hasApp">
                          {{item.product_name}}
                          <template v-if="item.dedicate_ip || item.name">
                            ({{ item.dedicate_ip ? item.dedicate_ip : item.name ? item.name : "--"}})
                          </template>
                        </span>
                        <span v-else
                          :class="{'dis-item': item.isDue}">{{item.product_name + calcProductName(item)}}</span>
                        <span v-if="calcShowRenew(item) && hasApp" class="renew"
                          @click="handleRenew(item)">{{lang.ticket_label20}}
                        </span>
                      </el-option>
                    </el-select>
                  </el-form-item>
                </div>
                <el-form-item :label="lang.ticket_label8" prop="content">
                  <!-- <div>
                                        <textarea id="tiny" name="content" >{{ticketData.content}}</textarea>
                                    </div> -->
                  <el-input class="msg-input" type="textarea" :autosize="{ minRows: 5, maxRows: 5}" resize=none
                    maxlength="3000" :placeholder="lang.ticket_label12" v-model="ticketData.content">
                  </el-input>

                </el-form-item>
                <el-form-item>
                  <div style="display: flex;justify-content: space-between;">
                    <el-upload ref="fileupload" class="upload-btn" action="/console/v1/upload"
                      :headers="{Authorization: jwt}" :before-remove="beforeRemove" multiple :file-list="fileList"
                      :on-success="handleSuccess">
                      <el-button icon="el-icon-upload2">{{lang.ticket_label13}}</el-button>
                    </el-upload>
                    <div class="sub-btn" @click="onSubmit" v-loading="loading">{{lang.ticket_btn8}}</div>
                  </div>
                  <!-- <el-button type="primary" @click="onSubmit" v-loading="loading">确认</el-button> -->

                </el-form-item>
              </el-form>
            </div>
            <!-- 确认弹窗 -->
            <div class="renew-dialog">
              <el-dialog width="6.2rem" :visible.sync="sureDialog" :show-close=false @close="sureDialog = false">
                <div class="dialog-main">
                  <p>{{lang.ticket_label23}}</p>
                  <p>{{lang.ticket_label24}}</p>
                </div>
                <div class="dialog-footer">
                  <div class="btn-ok" @click="subJump">{{lang.ticket_btn6}}</div>
                  <div class="btn-no" @click="sureDialog = false">{{lang.ticket_btn9}}</div>
                </div>
              </el-dialog>
            </div>

          </div>
        </el-main>
      </el-container>
    </el-container>
  </div>
  <!-- =======页面独有======= -->
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/api/ticket.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/lang/index.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/js/addTicket.js"></script>
  <script src="/plugins/addon/idcsmart_ticket/template/clientarea/pc/default/js/tinymce/tinymce.min.js"></script>
