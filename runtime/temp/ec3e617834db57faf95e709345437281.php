<?php /*a:2:{s:46:"../public/hcydxoep/template/default/header.php";i:1756623755;s:63:"../public/plugins/addon/idcsmart_help/template/admin/index.html";i:1756623755;}*/ ?>
<link rel="stylesheet" href="/plugins/addon/idcsmart_help/template/admin/css/help.css" />

<!-- =======内容区域======= -->
<div id="content" class="help" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <div class="help_card">
        <div class="help_tabs">
          <div class="common-header top">
            <div class="flex">
              <t-button @click="changetabs(1)" v-permission="'auth_site_management_help_create_help'">
                {{lang.add_doc}}
              </t-button>
              <t-button
                theme="default"
                class="com-gray-btn"
                @click="changetabs(2)"
                v-permission="'auth_site_management_help_index'">
                {{lang.home_manage}}
              </t-button>
              <t-button
                theme="default"
                class="com-gray-btn"
                @click="changetabs(3)"
                v-permission="'auth_site_management_help_type'">
                {{lang.classific_manage}}
              </t-button>
            </div>
            <div class="flex">
              <t-input
                v-model="params.keywords"
                @keypress.enter.native="onEnter"
                class="search-input"
                :placeholder="lang.search_placeholder"
                clearable
                @clear="onEnter">
              </t-input>
              <t-button @click="getlist(1)">{{lang.query}}</t-button>
            </div>
          </div>
        </div>
        <div class="help_table">
          <t-table hover row-key="id" :data="list" :columns="columns" :loading="loading">
            <template #title="slotProps">
              <span class="aHover" @click="edit(slotProps.row.id)">{{slotProps.row.title}}</span>
            </template>
            <template #pushorback="slotProps">
              <t-switch
                v-model="slotProps.row.hidden?false:true"
                @change="onswitch(slotProps.row,$event)"
                :disabled="!$checkPermission('auth_site_management_help_show_hide')" />
            </template>
            <template #create_time="slotProps">
              <span v-if="slotProps.row.create_time" style="width: 200px">
                {{getLocalTime2(slotProps.row.create_time)}}
              </span>
            </template>
            <template #op="slotProps">
              <t-icon
                class="common-look"
                name="edit-1"
                color="var(--td-brand-color)"
                style="margin-right: 10px"
                @click="edit(slotProps.row.id)"
                v-permission="'auth_site_management_help_update_help'">
              </t-icon>
              <!-- <t-popconfirm theme="warning" content="确认要删除吗？" @Confirm="deletes(slotProps.row.id)">
                <t-icon name="delete" color="var(--td-brand-color)"></t-icon>
              </t-popconfirm> -->
              <t-icon
                class="common-look"
                name="delete"
                color="var(--td-brand-color)"
                @click="deletes(slotProps.row.id)"
                v-permission="'auth_site_management_help_delete_help'"></t-icon>
              <!-- <t-icon name="delete" color="var(--td-brand-color)" @click="deletes(slotProps.row.id)"></t-icon> -->
            </template>
          </t-table>
          <com-pagination
            v-if="pagination.total"
            :total="pagination.total"
            :page="pagination.current"
            :limit="pagination.pageSize"
            @page-change="changepages">
          </com-pagination>
        </div>
        <div class="help_pages"></div>
      </div>
    </t-card>
    <!-- 删除提示框 -->
    <t-dialog theme="warning" :header="lang.sureDelete" :close-btn="false" :visible.sync="delVisible" class="delDialog">
      <template slot="footer">
        <t-button theme="primary" @click="sureDelUser" :loading="submitLoading">{{lang.sure}}</t-button>
        <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
      </template>
    </t-dialog>
    <!-- 分类管理 -->
    <t-dialog
      :header="lang.doc_classific_manage"
      placement="center"
      :visible.sync="visible"
      :on-cancel="onCancel"
      :on-esc-keydown="onKeydownEsc"
      :on-close-btn-click="onClickCloseBtn"
      :on-close="close"
      width="70%"
      :footer="false">
      <t-table :key="key" bordered row-key="index" :data="typelist" :columns="columns2" max-height="80%">
        <template #name="slotProps">
          <t-input
            :placeholder="lang.input"
            v-model="slotProps.row.name"
            :disabled="!slotProps.row.isedit"
            style="width: 250px" />
        </template>
        <template #time="slotProps">
          <span v-if="slotProps.row.update_time" style="width: 200px"
            >{{ getLocalTime(slotProps.row.update_time) }}</span
          >
        </template>
        <template #op="slotProps">
          <div v-if="slotProps.row.id">
            <t-icon
              class="common-look"
              v-if="slotProps.row.isedit"
              name="save"
              color="var(--td-brand-color)"
              style="margin-right: 10px"
              @click="edithelptypeform(slotProps.row.name,slotProps.row.id)"></t-icon>
            <t-icon
              class="common-look"
              v-if="slotProps.row.isedit"
              name="close-rectangle"
              color="var(--td-brand-color)"
              @click="canceledit()">
            </t-icon>
            <t-icon
              class="common-look"
              v-if="!slotProps.row.isedit"
              name="edit-1"
              color="var(--td-brand-color)"
              style="margin-right: 10px"
              @click="edithandleClickOp(slotProps.row.id)"></t-icon>
            <t-icon
              class="common-look"
              v-if="!slotProps.row.isedit"
              name="delete"
              color="var(--td-brand-color)"
              @click="deleteClickOp(slotProps.row.id)"></t-icon>
          </div>
          <div v-else>
            <!-- <t-icon name="save" color="var(--td-brand-color)" style="margin-right: 10px;" @click="savehandleClickadd(slotProps.row.name)"></t-icon> -->
            <t-icon
              class="common-look"
              name="close-rectangle"
              color="var(--td-brand-color)"
              @click="deleteClickadd(slotProps.row.name)"></t-icon>
          </div>
        </template>
      </t-table>
      <div class="addtype" @click="addtype">{{lang.order_new}}</div>
      <div class="com-f-btn" style="text-align: center">
        <t-button theme="primary" type="submit" @click="savehandleClickadd" :loading="submitLoading">
          {{lang.batch_add}}
        </t-button>
        <t-button theme="default" variant="base" @click="visible = false">{{lang.close}}</t-button>
      </div>
    </t-dialog>
  </com-config>
</div>

<script src="/plugins/addon/idcsmart_help/template/admin/js/lang.js"></script>
<script src="/plugins/addon/idcsmart_help/template/admin/api/help.js"></script>
<script src="/plugins/addon/idcsmart_help/template/admin/js/help.js"></script>
