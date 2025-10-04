<?php /*a:1:{s:63:"../public/plugins/addon/idcsmart_news/template/admin/index.html";i:1756623755;}*/ ?>
<link rel="stylesheet" href="/plugins/addon/idcsmart_news/template/admin/css/new.css" />
<!-- =======内容区域======= -->
<div id="content" class="help news" v-cloak>
  <com-config>
    <t-card class="list-card-container">
      <div class="help_card">
        <div class="common-header top">
          <div class="tabs flex">
            <t-button @click="changetabs(1)" v-permission="'auth_site_management_news_create_news'">
              {{lang.order_new}}
            </t-button>
            <t-button @click="changetabs(3)" theme="default" class="com-gray-btn"
              v-permission="'auth_site_management_news_type'">
              {{lang.classific_manage}}
            </t-button>
          </div>
          <div class="flex">
            <t-input v-model="params.keywords" @keypress.enter.native="onEnter" class="search-input"
              :placeholder="lang.search_placeholder" clearable @clear="onEnter">
            </t-input>
            <t-button @click="getlist(1)">{{lang.query}}</t-button>
          </div>
        </div>
        <div class="help_table">
          <t-table hover row-key="id" :loading="loading" :data="list" :columns="columns">
            <template #title="slotProps">
              <span class="aHover" @click="edit(slotProps.row.id)">{{slotProps.row.title}}</span>
            </template>
            <template #pushorback="slotProps">
              <t-switch v-model="slotProps.row.hidden?false:true" @change="onswitch(slotProps.row,$event)"
                :disabled="!$checkPermission('auth_site_management_news_show_hide')" />
            </template>
            <template #create_time="slotProps">
              <span v-if="slotProps.row.create_time" style="width: 200px">
                {{ getLocalTime(slotProps.row.create_time) }}
              </span>
            </template>
            <template #op="slotProps">

              <t-tooltip :content="lang.edit_news" :show-arrow="false" theme="light">
                <t-icon name="edit-1" color="var(--td-brand-color)" style="margin-right: 10px"
                  @click="edit(slotProps.row.id)" class="common-look"
                  v-permission="'auth_site_management_news_update_news'">
                </t-icon>
              </t-tooltip>




              <t-tooltip :content="lang.op_delete" :show-arrow="false" theme="light">
                <t-icon name="delete" color="var(--td-brand-color)" class="common-look" style="margin-right: 10px"
                  @click="deletes(slotProps.row.id)" v-permission="'auth_site_management_news_delete_news'">
                </t-icon>
              </t-tooltip>

              <t-tooltip :content="slotProps.row.is_top == 1 ? lang.cancel_top_news : lang.top_news" :show-arrow="false"
                theme="light">
                <t-icon name="backtop" color="var(--td-brand-color)" :class="{'rotate-icon': slotProps.row.is_top == 1}"
                  @click="handleTop(slotProps.row)" class="common-look"
                  v-permission="'auth_site_management_news_update_news'">
                </t-icon>
              </t-tooltip>

            </template>
          </t-table>
          <com-pagination v-if="pagination.total" :total="pagination.total" :page="pagination.current"
            :limit="pagination.pageSize" @page-change="changepages">
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
    <t-dialog :header="lang.news_classific_manage" placement="center" :visible.sync="visible" :on-close="close"
      width="70%" :footer="false">
      <t-table :key="key" bordered row-key="index" :max-height="140" :data="typelist" :columns="columns2"
        max-height="80%">
        <template #name="slotProps">
          <t-input :placeholder="lang.input" v-model="slotProps.row.name" :disabled="!slotProps.row.isedit"
            style="width: 250px" />
        </template>
        <template #time="slotProps">
          <span v-if="slotProps.row.update_time"
            style="width: 200px">{{ getLocalTime(slotProps.row.update_time) }}</span>
        </template>
        <template #op="slotProps">
          <div v-if="slotProps.row.id">
            <t-icon class="common-look" v-if="slotProps.row.isedit" name="save" color="var(--td-brand-color)"
              style="margin-right: 10px" @click="edithelptypeform(slotProps.row.name,slotProps.row.id)"></t-icon>
            <t-icon class="common-look" v-if="slotProps.row.isedit" name="close-rectangle" color="var(--td-brand-color)"
              @click="canceledit()">
            </t-icon>
            <t-icon class="common-look" v-if="!slotProps.row.isedit" name="edit-1" color="var(--td-brand-color)"
              style="margin-right: 10px" @click="edithandleClickOp(slotProps.row.id)"></t-icon>
            <t-icon class="common-look" v-if="!slotProps.row.isedit" name="delete" color="var(--td-brand-color)"
              @click="deleteClickOp(slotProps.row.id)"></t-icon>
          </div>
          <div v-else>
            <!--   <t-icon name="save" color="var(--td-brand-color)" style="margin-right: 10px;" @click="savehandleClickadd(slotProps.row.name)"></t-icon> -->
            <t-icon class="common-look" name="close-rectangle" color="var(--td-brand-color)"
              @click="deleteClickadd(slotProps.row.name)"></t-icon>
          </div>
        </template>
      </t-table>
      <div class="addtype" @click="addtype">{{lang.order_new}}</div>
      <div class="com-f-btn" style="text-align: center">
        <t-button theme="primary" type="submit" :loading="submitLoading"
          @click="savehandleClickadd">{{lang.batch_add}}</t-button>
        <t-button theme="default" variant="base" @click="visible = false">{{lang.close}}</t-button>
      </div>
    </t-dialog>
  </com-config>
</div>

<script src="/plugins/addon/idcsmart_news/template/admin/js/lang.js"></script>
<script src="/plugins/addon/idcsmart_news/template/admin/api/new.js"></script>
<script src="/plugins/addon/idcsmart_news/template/admin/js/new.js"></script>
