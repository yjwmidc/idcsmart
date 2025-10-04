<?php /*a:3:{s:53:"../public/hcydxoep/template/default/client_detail.php";i:1756623755;s:46:"../public/hcydxoep/template/default/header.php";i:1756623755;s:46:"../public/hcydxoep/template/default/footer.php";i:1756623755;}*/ ?>
<!DOCTYPE html>
<html lang="en" theme-color="default" theme-mode>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <title></title>
  <link rel="icon" href="/favicon.ico">
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/tdesign.min.css" />
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/common/reset.css" />
  <link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/iconfont/iconfont.css">
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vue.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/permission.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/composition-api.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/tdesign.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comConfig/comConfig.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comPagination/comPagination.js"></script>
  <script>
    Vue.config.devtools = false;
    Vue.prototype.lang = window.lang;
    const url = "/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/"
  </script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/lang.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/moment.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/layout.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/iconfont/iconfont.js"></script>
</head>

<body>
  <!-- loading -->
  <div id="loading">
    <div class="box">
      <div></div>
      <div></div>
    </div>
  </div>
  <t-layout id="layout">
    <!-- header+menu -->
    <t-layout class="aside" id="aside" v-cloak :class="{'is-fold':collapsed}">
      <com-config>
        <div class="header">
          <div class="logo">
            <img :src="logUrl" alt="logo" @click="goIndex">
            <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed" v-if="!collapsed"
              class="nav-icon">
              <t-icon name="view-list"></t-icon>
            </t-button>
          </div>
          <div class="h-left">
            <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed" v-if="collapsed"
              class="nav-icon">
              <t-icon name="view-list"></t-icon>
            </t-button>
            <div class="global-search">
              <input type="password" class="com-empty-input">
              <t-input id="global-input" :class="{ 'hover-active': isSearchFocus, 'h-search': true}"
                :placeholder="lang.please_search" @blur="changeSearchFocus(false)" @focus="changeSearchFocus(true)"
                @change="changeSearch" clearable>
                <template #prefix-icon>
                  <t-icon name="search" size="20px"></t-icon>
                </template>
              </t-input>
              <div class="search-content" v-show="isShow" id="search-content">
                <t-loading attach="#con" :loading="loadingSearch" size="small"></t-loading>
                <div class="con" v-if="global" id="con">
                  <t-collapse expand-icon-placement="right" default-expand-all :expand-on-row-click="true">
                    <t-collapse-panel value="0" :header="lang.user + '（' + global.clients.length + '）' " class="item"
                      v-if="global.clients.length>0">
                      <ul>
                        <li v-for="item in global.clients" :key="item.id">
                          <a :href="`${baseUrl}client_detail.htm?client_id=${item.id}`">
                            <p class="s-tit">{{item.username}}<span class="company" v-if="item.company">{{'(' + item.company
                              + ')'}}</span></p>
                            <p class="phone" v-if="item.phone">{{item.phone}}</p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                    <t-collapse-panel value="1" :header="lang.tailorism + '（' + global.hosts.length + '）' " class="item"
                      v-if="global.hosts.length>0">
                      <ul>
                        <li v-for="item in global.hosts" :key="item.id">
                          <a :href="`${baseUrl}host_detail.htm?client_id=${item.client_id}&id=${item.id}`">
                            <p class="s-tit">{{item.product_name}}&nbsp;#/{{item.id}}</p>
                            <p class="host-name">{{item.product_name}}</p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                    <t-collapse-panel value="2" :header="lang.product + '（' + global.products.length + '）' "
                      class="item" v-if="global.products.length>0">
                      <ul>
                        <li v-for="item in global.products" :key="item.id">
                          <a :href="`${baseUrl}product_detail.htm?id=${item.id}`">
                            <p class="s-tit">{{item.name}}</p>
                            <p class="host-name">{{item.product_group_name_first}}/{{item.product_group_name_second}}
                            </p>
                          </a>
                        </li>
                      </ul>
                    </t-collapse-panel>
                  </t-collapse>
                </div>
                <p class="no-data" v-if="noData">{{lang.tip10}}</p>
              </div>
            </div>
          </div>
          <t-alert theme="warning" style="padding: 10px;" v-if="versionData.expire === 1 || versionData.expire === 2">
            <template #message>
              <div class="expire-notice">
                {{lang.expire_text1}}
                {{versionData.expire=== 2 ? lang.expire_text3 : lang.expire_text2}}
                <span>({{ versionData.due_time }})</span>
                {{lang.expire_text4}}，{{lang.expire_text5}}
              </div>
            </template>
          </t-alert>
          <!-- 修改密码弹窗结束 -->
          <!-- header operations -->
          <div class="operations-container">
            <t-popup placement="bottom">
              <t-badge :count="total_count" style="margin: 0 10px;">
                <t-button style="width: 20px; height: 20px;" theme="default" shape="square" variant="text"
                  @click="goMessageList">
                  <t-icon name="notification" size="20px"></t-icon>
                </t-button>
              </t-badge>
              <template #content>
                <div class="notification-container" v-loading="loadingMsg">
                  <t-tabs v-model="msgType">
                    <!-- <t-tab-panel value="system" :label="`${lang.notice_text1}(${systemCount})`">
                    </t-tab-panel> -->
                    <t-tab-panel value="idcsmart" :label="`${lang.notice_text2}(${idcsmartCount})`">
                    </t-tab-panel>
                  </t-tabs>
                  <div class="notification-content">
                    <div class="notification-title">
                      <t-button variant="text" theme="primary" @click="goMessageList">{{lang.notice_text3}}</t-button>
                    </div>
                    <div class="notification-list">
                      <div class="notification-item"
                        v-for="item in (msgType === 'system'? systemMsgList : idcsmartMsgList)">
                        <div class="notification-item-title">
                          <span class="title-text aHover" @click="goMesgDetail(item.id)">{{item.title}}</span>
                          <span v-if="item.read === 0" class="read-btn"
                            @click.stop="readMsg(item)">{{lang.notice_text4}}</span>
                        </div>
                        <div class="notification-item-main">
                          <div v-html="item.content">{{item.content}}</div>
                        </div>
                        <div class="notification-item-footer">
                          <span class="time">{{moment(item.accept_time * 1000).format('YYYY-MM-DD HH:mm')}}</span>
                          <span
                            class="notification-item-type">{{item.type === 'system' ? lang.notice_text1 : lang.notice_text2}}</span>
                        </div>
                      </div>
                    </div>
                    <div class="notification-empty">
                      <p
                        v-if="msgType === 'system' && systemMsgList.length === 0 || msgType === 'idcsmart' && idcsmartMsgList.length === 0">
                        {{lang.notice_text21}}
                      </p>
                    </div>
                  </div>
                </div>
              </template>
            </t-popup>
            <t-tooltip placement="bottom" :content="lang.help_document">
              <t-button theme="default" shape="square" variant="text" @click="goHelp">
                <t-icon name="help-circle" size="20px" />
              </t-button>
            </t-tooltip>
            <t-dropdown @click="changeLang" trigger="click" :min-column-width="100"
              :popup-props="{overlayClassName: 'lang-list'}">
              <t-button variant="text">
                <img :src="curSrc" alt="" class="cur-img">
              </t-button>
              <t-dropdown-menu slot="dropdown" attach="html">
                <t-dropdown-item :value="item.display_lang" v-for="item in langList" :key="item.display_lang">
                  <img :src="item.display_img" alt="" class="img">
                  {{item.display_name}}
                </t-dropdown-item>
              </t-dropdown-menu>
            </t-dropdown>
            <t-dropdown :min-column-width="100" trigger="click" class="user-btn" size="small">
              <t-button class="header-user-btn" theme="default" variant="text">
                <template #icon>
                  <t-icon name="user-circle" size="20px"></t-icon>
                </template>
                <div class="header-user-account">
                  {{userName}}
                  <t-icon name="chevron-down"></t-icon>
                </div>
              </t-button>
              <t-dropdown-menu slot="dropdown" attach="html">
                <t-dropdown-item class="operations-dropdown-container-item" @click="toggleSettingPanel">
                  <template>
                    <t-icon name="setting"></t-icon>
                    {{lang.theme_text3}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="toSafeCenter">
                  <template>
                    <t-icon name="lock-off"></t-icon>
                    {{lang.setting_text106}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="handleLogout">
                  <template>
                    <t-icon name="poweroff"></t-icon>
                    {{lang.logout}}
                  </template>
                </t-dropdown-item>
              </t-dropdown-menu>
            </t-dropdown>
            <!-- <t-tooltip placement="bottom" :content="lang.system_setting">
            <t-button theme="default" shape="square" variant="text" @click="toggleSettingPanel">
              <t-icon name="setting" size="20px"></t-icon>
            </t-button>
          </t-tooltip> -->
          </div>
          <!-- system-setting -->
          <t-drawer :visible.sync="visible" :header="lang.system_setting" :footer="false" id="setting">
            <template slot="closeBtn">
              <t-icon name="close"></t-icon>
            </template>
            <div class="setting-group-title">{{ lang.theme_text1 + lang.theme_mode }}</div>
            <t-radio-group v-model="formData.mode">
              <div v-for="(item, index) in MODE_OPTIONS" :key="index" class="setting-layout-drawer">
                <div>
                  <t-radio-button :key="index" :value="item.type">
                    <img :src="item.src"></img>
                  </t-radio-button>
                  <p :style="{ textAlign: 'center', marginTop: '8px' }">{{ item.text }}</p>
                </div>
              </div>
            </t-radio-group>
            <div class="setting-group-title">{{ lang.theme_text1 + lang.theme_color }}</div>
            <t-radio-group v-model="formData.brandTheme" class="theme-radio-group">
              <div v-for="(item, index) in COLOR_OPTIONS.slice(0, COLOR_OPTIONS.length)" :key="index"
                class="setting-layout-drawer theme" :class="{no:item!==formData.brandTheme}">
                <t-radio-button :key="index" :value="item" class="setting-layout-color-group"
                  :style="{color:getBrandColor(item,colorList)['@brand-color']}">
                  <template>
                    <div :style="{background:getBrandColor(item,colorList)['@brand-color']}" class="color"></div>
                  </template>
                </t-radio-button>
              </div>
            </t-radio-group>
            <div class="setting-group-title">{{ lang.theme_text2 + lang.theme_color }}</div>
            <t-radio-group v-model="formData.clientTheme" @change="changeClientTheme" class="theme-radio-group">
              <div v-for="item in clientThemeList" :key="item.name" class="setting-layout-drawer theme"
                :class="{no:item!==formData.clientTheme}">
                <t-radio-button :value="item.name" class="setting-layout-color-group" :style="{color:item.color}">
                  <template>
                    <div :style="{background:item.color}" class="color"></div>
                  </template>
                </t-radio-button>
              </div>
              <div
                style="width: 38px;height: 38px;display: flex;align-items: center;justify-content: center; cursor: pointer;"
                @click="()=>{this.$message.warning('如需更多颜色主题，请联系官方QQ:2853266782')}">
                <div
                  style="width: 24px; height: 24px;background-color: var(--td-brand-color); border-radius: 50%;display: flex;align-items: center;justify-content: center;">
                  <t-icon name="add-circle" style="font-size: 24px; color: #fff;"></t-icon>
                </div>
              </div>
            </t-radio-group>
          </t-drawer>
        </div>
        <!-- aside menu -->
        <t-menu :theme="formData.mode" :value="curValue" :collapsed="collapsed" :expanded="expanded"
          @expand="expanded = $event">
          <div v-for="(item,index) in navList" :key="index">
            <template v-if="!item.child">
              <a :href="getMenuUrl(item)" onclick="return false">
                <t-menu-item :value="item.id" @click="jumpHandler(item)">
                  <template #icon>
                    <t-icon :name="item.icon.replace('t-icon-','')" />
                  </template>
                  <span style="display: flex; align-items: center;">
                    {{item.name}}
                    <img
                      v-if="(item.url === 'configuration_system.htm' && isCanUpdata) || (item.url === 'plugin.htm' && pluginUpgrade)"
                      style="width: 20px; height: 20px; margin-left: 10px;"
                      src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
                  </span>
                </t-menu-item>
              </a>
            </template>
            <t-submenu :value="item.id" mode="popup" v-else>
              <template #icon>
                <t-icon :name="item.icon.replace('t-icon-','')" />
              </template>
              <span slot="title" style="display: flex; align-items: center;">
                {{item.name}}
                <img
                  v-if="(setting_parent_id === item.id && !expanded.includes(setting_parent_id) && isCanUpdata) || plugin_parent_id === item.id && !expanded.includes(plugin_parent_id) && pluginUpgrade"
                  style="width: 20px; height: 20px; margin-left: 10px;"
                  src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
              </span>
              <div v-for="ele in item.child" :key="ele.id">
                <template v-if="!ele.child">
                  <a :href="getMenuUrl(ele)" onclick="return false">
                    <t-menu-item :value="ele.id" :key="ele.id" @click="jumpHandler(ele)">
                      <span style="display: flex; align-items: center;">
                        <span>{{ele.name}}</span>
                        <img
                          v-if="(ele.url === 'configuration_system.htm' && isCanUpdata) || (ele.url === 'plugin.htm' && pluginUpgrade)"
                          style="width: 20px; height: 20px; margin-left: 10px;"
                          src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upgrade.svg">
                      </span>
                    </t-menu-item>
                  </a>
                </template>
                <t-submenu :value="ele.id" mode="popup" v-else>
                  <span slot="title">
                    {{ele.name}}
                  </span>
                  <template v-for="e in ele.child">
                    <a :href="getMenuUrl(e)" onclick="return false">
                      <t-menu-item :value="e.id" :key="e.id" @click="jumpHandler(e)">
                        <span>
                          {{e.name}}
                        </span>
                      </t-menu-item>
                    </a>
                  </template>
                </t-submenu>
              </div>
            </t-submenu>
          </div>
          <template #operations>
            <div id="global_search" :class="{collapsed: collapsed}">
              <div class="search hide">
                <t-icon name="search"></t-icon>
              </div>
              <div class="search-box">
                <div class="item" id="search-table">
                  <t-select v-model="globalForm.table" placeholder="" :popup-props="{ attach: '#search-table' }">
                    <t-option v-for="item in globalConfig" :value="item.table" :label="item.name" :key="item.table">
                    </t-option>
                  </t-select>
                  <t-select v-model="globalForm.key" placeholder="" @change="changeKey"
                    :popup-props="{ attach: '#search-table' }">
                    <t-option v-for="item in calcFiled" :value="item.key" :label="item.name" :key="item.key"></t-option>
                  </t-select>
                </div>
                <div class="item bot" id="search-key">
                  <div class="left">
                    <template v-if="curSearchType === 'select'">
                      <t-tree-select v-if="globalForm.key === 'product_id'" v-model="globalForm.value"
                        :data="curSearchOptions" :popup-props="popupProps" :tree-props="treeProps"
                        :placeholder="lang.product_id_empty_tip" filterable>
                      </t-tree-select>
                      <t-select v-else v-model="globalForm.value" :placeholder="lang.select"
                        :popup-props="{ attach: '#search-key' }">
                        <t-option v-for="item in curSearchOptions" :value="item.value" :label="item.name"
                          :key="item.value">
                        </t-option>
                      </t-select>
                    </template>
                    <t-date-picker allow-input v-else-if="curSearchType === 'date'" v-model="globalForm.value"
                      :popup-props="{ attach: '#search-key' }">
                    </t-date-picker>
                    <template v-else>
                      <input type="password" class="com-empty-input" />
                      <t-input :placeholder="lang.input" v-model="globalForm.value"
                        @keypress.enter.native="handleGlobal">
                      </t-input>
                    </template>
                  </div>
                  <div class="search" @click="handleGlobal">
                    <t-icon :name="searchLoading ? 'loading' : 'search'"></t-icon>
                  </div>
                </div>
              </div>
            </div>
            <!-- <t-button variant="text" shape="square">
              <t-button variant="text" shape="square" @click.native="changeCollapsed">
                <t-icon name="view-list"></t-icon>
              </t-button>
            </t-button> -->
          </template>
        </t-menu>
        <!-- 修改密码弹窗开始 -->
        <t-dialog :visible.sync="editPassVisible" :header="lang.change_password" :on-close="editPassClose"
          :footer="false" width="600">
          <t-form :data="editPassFormData" ref="userDialog" @submit="onSubmit">

            <t-form-item :label="lang.password" name="password" :rules="[
                    { required: true , message: `${lang.input}${lang.password}`, type: 'error' },
                { pattern: /^[\w@!#$%^&*()+-_]{6,32}$/, message: lang.verify8 + '，' + lang.verify14 + '6~32', type: 'warning' }
              ]">
              <t-input :placeholder="`${lang.input}${lang.password}`" type="password"
                v-model="editPassFormData.password" />
            </t-form-item>
            <t-form-item :label="lang.surePassword" name="repassword" :rules="[
                    { required: true, message: `${lang.input}${lang.surePassword}`, type: 'error' },
            { validator: checkPwd, trigger: 'blur' }
          ]">
              <t-input :placeholder="`${lang.input}${lang.surePassword}`" type="password"
                v-model="editPassFormData.repassword" />
            </t-form-item>
            <div class="f-btn" style="text-align: right;">
              <t-button theme="primary" type="submit">{{lang.hold}}</t-button>
              <t-button theme="default" variant="base" @click="editPassClose">{{lang.cancel}}</t-button>
            </div>
          </t-form>
        </t-dialog>
      </com-config>
    </t-layout>
    <t-layout class="t-layout right-box">
      <div class="empty"></div>
      <t-content class="area">

<!-- =======内容区域======= -->
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/client.css">
<style>
  .t-popup {
    white-space: pre-wrap;
  }
</style>
<div id="content" class="client-detail hasCrumb" v-cloak>
  <com-config class="no-bg">
    <!-- crumb -->
    <div class="com-crumb">
      <span>{{lang.user_manage}}</span>
      <t-icon name="chevron-right"></t-icon>
      <a href="client.htm" v-permission="'auth_user_list_view'">{{lang.user_list}}</a>
      <t-icon name="chevron-right" v-permission="'auth_user_list_view'"></t-icon>
      <span class="cur">{{lang.personal}}</span>
    </div>
    <t-card class="list-card-container">
      <div class="com-h-box">
        <ul class="common-tab" :class="{ stop: data.status===0}">
          <li class="active" v-permission="'auth_user_detail_personal_information_view'">
            <a>{{lang.personal}}</a>
          </li>
          <li v-permission="'auth_user_detail_host_info_view'">
            <a :href="`${baseUrl}/client_host.htm?id=${id}`">{{lang.product_info}}</a>
          </li>
          <li v-permission="'auth_user_detail_order_view'">
            <a :href="`${baseUrl}/client_order.htm?id=${id}`">{{lang.order_manage}}</a>
          </li>
          <li v-permission="'auth_user_detail_transaction_view'">
            <a :href="`${baseUrl}/client_transaction.htm?id=${id}`">{{lang.flow}}</a>
          </li>
          <li v-permission="'auth_user_detail_operation_log'">
            <a :href="`${baseUrl}/client_log.htm?id=${id}`">{{lang.operation}}{{lang.log}}</a>
          </li>
          <li
            v-if="$checkPermission('auth_user_detail_notification_log_sms_notification') || $checkPermission('auth_user_detail_notification_log_email_notification')">
            <a
              :href="`${baseUrl}/${($checkPermission('auth_user_detail_notification_log_sms_notification') ? 'client_notice_sms' : 'client_notice_email')}.htm?id=${id}`">{{lang.notice_log}}</a>
          </li>
          <li v-if="hasNewTicket && $checkPermission('auth_user_detail_ticket_premium_view')">
            <a :href="`${baseUrl}/plugin/ticket_premium/client_ticket.htm?id=${id}`">{{lang.auto_order}}</a>
          </li>
          <li v-if="!hasNewTicket && hasTicket && $checkPermission('auth_user_detail_ticket_view')">
            <a :href="`${baseUrl}/plugin/idcsmart_ticket/client_ticket.htm?id=${id}`">{{lang.auto_order}}</a>
          </li>
          <li v-if="hasRecommend ">
            <a
              :href="`${baseUrl}/plugin/idcsmart_recommend/client_recommend.htm?id=${id}`">{{lang.data_export_tip9}}</a>
          </li>
          <li v-permission="'auth_user_detail_info_record_view'">
            <a :href="`${baseUrl}/client_records.htm?id=${id}`">{{lang.info_records}}</a>
          </li>
        </ul>
        <!-- 顶部右侧选择用户 -->
        <com-choose-user :cur-info="data" :clearable="false" @changeuser="changeUser" class="com-clinet-choose">
        </com-choose-user>
      </div>
    </t-card>

    <div class="info-card">
      <t-card :class="{ stop: data.status===0}">
        <h3>{{lang.user_text1}}</h3>
        <div class="header-btn">
          <div class="left">
            <!-- 充值按钮 -->
            <t-button theme="primary" @click="showRecharge"
              v-permission="'auth_user_detail_personal_information_recharge'">
              {{lang.Recharge}}
            </t-button>

            <t-button theme="default" class="com-gray-btn" @click="hanelFreeze">{{lang.user_text45}}</t-button>

            <!-- 强制变更 -->
            <t-button theme="default" class="com-gray-btn" @click="changeMoney('recharge')"
              v-permission="'auth_user_detail_personal_information_change_credit'">
              {{lang.force_change}}
            </t-button>
            <div class="change_log" @click="changeLog"
              v-permission="'auth_user_detail_personal_information_change_credit_log'">
              <t-button theme="default" class="com-gray-btn">{{lang.change_log}}</t-button>
            </div>
          </div>
          <t-button theme="primary" type="submit" :disabled="data.status===0" @click="loginByUser"
            v-permission="'auth_user_detail_personal_information_user_login'">{{lang.login_as_user}}</t-button>
        </div>
        <div class="info-box">
          <t-row align="middle">
            <t-col :span="6">
              <div class="credit-info">
                <div class="left-text">
                  <span
                    class="lebal-text">{{lang.user_text2}}</span><span>{{thousandth(data.credit)}}{{currency_suffix}}</span>
                  <t-popup placement="right-top" @visible-change="handleVisibleChange"
                    v-model:visible="freezePopVisible" v-if="Number(data.freeze_credit) > 0">
                    <span class="common-look">
                      ({{lang.user_text26}}:{{data.freeze_credit}}{{currency_suffix}})
                    </span>
                    <template #content>
                      <div style="width: 900px;padding: 20px;">
                        <h3>{{lang.user_text44}}</h3>
                        <t-form ref="unfreezeRef" :data="unfreezeForm" :label-width="80" @submit="confirmUnFreeze"
                          label-align="top">
                          <t-form-item :label="lang.user_text42">
                            <t-table row-key="id" :data="freezeList" size="medium" :columns="unfreezeColumns" hover
                              :loading="freezeLoading" :table-layout="tableLayout ? 'auto' : 'fixed'"
                              @select-change="rehandleSelectChange" :selected-row-keys="unfreezeForm.credit_ids">
                              <template #id="slotProps">
                                {{ slotProps.row.id || '--' }}
                              </template>
                              <template #create_time="slotProps">
                                {{ moment(slotProps.row.create_time * 1000).format('YYYY-MM-DD HH:mm:ss') }}
                              </template>
                              <template #amount="slotProps">
                                {{ slotProps.row.amount }}
                              </template>
                              <template #notes="slotProps">
                                {{ slotProps.row.notes || '--' }}
                              </template>
                          </t-form-item>
                          <t-form-item :label="lang.user_text38" name="notes"
                            :rules="[{required: false, message: lang.input + lang.user_text38}]">
                            <t-textarea v-model="unfreezeForm.notes" :placeholder="lang.user_text38"
                              @focus="isEditFree = true" @blur="isEditFree = false"></t-textarea>
                          </t-form-item>
                          <div style="display: flex; justify-content: flex-end; gap: 10px;">
                            <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.user_text35}}
                            </t-button>
                            <t-button theme="default" variant="base" @click="unfreezeClose">{{lang.cancel}}</t-button>
                          </div>
                        </t-form>
                      </div>
                    </template>
                  </t-popup>
                </div>
              </div>
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text3}}</span>{{data.host_num}}{{lang.one}}
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text4}}</span>{{thousandth(data.consume)}}{{currency_suffix}}
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text5}}</span>{{data.host_active_num}}{{lang.one}}
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text6}}</span>{{thousandth(calcRefund)}}{{currency_suffix}}
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text7}}</span>{{moment(data.register_time * 1000).format('YYYY-MM-DD HH:mm:ss')}}
            </t-col>
            <t-col :span="6">
              <span>{{lang.user_text8}}</span>{{thousandth(data.withdraw)}}{{currency_suffix}}
            </t-col>
            <t-col :span="6" v-if="hasCertification">
              <span>{{lang.user_text9}}</span>
              <div v-if="data.certification === false">
                <t-tooltip :content="lang.user_text10" theme="light" :show-arrow="false" placement="top-right">
                  <span style="display: flex; align-items: center;">{{lang.user_text11}}<img
                      src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/icon/no_authentication.png" alt=""></span>
                </t-tooltip>
              </div>
              <div
                v-else-if="data.certification && data.certification_detail && data.certification_detail.company?.status === 1">
                <t-tooltip :content="lang.user_text12" theme="light" :show-arrow="false" placement="top-right">
                  <span
                    style="display: flex; align-items: center;">{{data.username}}({{data.certification_detail.company.company}})<img
                      src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/icon/enterprise_authentication.png"
                      alt=""></span>
                </t-tooltip>
              </div>
              <div
                v-else-if="data.certification && data.certification_detail && data.certification_detail.person?.status === 1">
                <t-tooltip :content="lang.user_text13" theme="light" :show-arrow="false" placement="top-right">
                  <span style="display: flex; align-items: center;">{{data.certification_detail.person.card_name}}<img
                      src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/icon/personal_authentication.png" alt=""></span>
                </t-tooltip>
              </div>
            </t-col>
            <t-col :span="6" v-if="hasCoin && clientCoinData.name !== ''">
              <span>{{clientCoinData.name}}</span>{{thousandth(clientCoinData.leave_amount)}}{{currency_suffix}}
              <t-tooltip theme="light" :show-arrow="false" placement="top-right" v-if="clientCoinData.list.length > 1">
                <template #content>
                  <div style="white-space: normal;">
                    <div v-for="item in clientCoinData.list" :key="item.id">
                      <span>{{item.leave_amount}}{{currency_suffix}}</span>
                      <span>{{lang.user_text49}}：(
                        <template v-if="item.effective_end_time == 0">
                          {{lang.user_text50}}
                        </template>
                        <template v-else>
                          {{moment(item.effective_end_time * 1000).format('YYYY-MM-DD HH:mm:ss')}}
                        </template>
                        )</span>
                    </div>
                  </div>
                </template>
                <span class="common-look" style="margin-left: 10px; cursor: pointer;" v-if="hasCoin">
                  {{lang.user_text51}}
                </span>
              </t-tooltip>
              <span v-else-if="clientCoinData.list.length === 1">
                (
                <template v-if="clientCoinData?.list[0]?.effective_end_time == 0">
                  {{lang.user_text50}}
                </template>
                <template v-else>
                  {{moment(clientCoinData?.list[0]?.effective_end_time * 1000).format('YYYY-MM-DD HH:mm:ss')}}
                </template>
                )
              </span>
            </t-col>
            <t-col :span="6" v-if="hasMpWeixinNotice">
              <span>{{lang.product_set_text101}}</span>
              <t-tooltip :content="mp_weixin_notice == 1  ? lang.product_set_text102 : lang.product_set_text103"
                :show-arrow="false" theme="light">
                <div style="display: flex; align-items: center;">
                  <img style="width: 22px; height: 22px;"
                    :src="mp_weixin_notice == 1 ? '/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/weixin_notice.svg' : '/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/weixin_notice_unbind.svg'"
                    :alt="mp_weixin_notice == 1 ? lang.product_set_text102 : lang.product_set_text103">
                </div>
              </t-tooltip>
            </t-col>
            <t-col :span="6" v-if="oauth.length > 0">
              <span>{{lang.product_set_text100}}</span>
              <div
                style="width: 100%;display: flex; flex-wrap: wrap; align-items: center; row-gap: 5px; column-gap: 5px;">
                <template v-for="item in oauth">
                  <img style="width: 22px; height: 22px;" :src="item" alt="">
                </template>
              </div>
            </t-col>
          </t-row>
        </div>
        <div class="receive-box">
          <div class="item">
            <span class="name">{{lang.whether_receive_sms}}</span>
            <t-switch v-model="formData.receive_sms" :custom-value="[1,0]"
              @change="handleChangeReceive($event, 'receive_sms')">
            </t-switch>
            <t-tooltip :content="lang.receive_sms_tip" :show-arrow="false" theme="light">
              <t-icon name="help-circle" size="18px"></t-icon>
            </t-tooltip>
          </div>
          <div class="item">
            <span class="name">{{lang.whether_receive_mail}}</span>
            <t-switch v-model="formData.receive_email" :custom-value="[1,0]"
              @change="handleChangeReceive($event, 'receive_email')">
            </t-switch>
            <t-tooltip :content="lang.receive_mail_tip" :show-arrow="false" theme="light">
              <t-icon name="help-circle" size="18px"></t-icon>
            </t-tooltip>
          </div>
        </div>
      </t-card>
      <t-card>
        <h3>{{lang.user_text14}}</h3>
        <t-table row-key="id" class="ip-table" :data="data.login_logs" size="medium" :columns="logColumns"
          :hover="hover" :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'">
          <template #login_time="slotProps">
            {{ moment(slotProps.row.login_time * 1000).format('YYYY-MM-DD HH:mm:ss') }}<span
              v-if="slotProps.rowIndex === 0">({{lang.user_text15}})</span>
          </template>
          <template #ip="slotProps">
            {{ slotProps.row.ip }}<span v-if="slotProps.rowIndex === 0">({{lang.user_text15}})</span>
          </template>
        </t-table>
      </t-card>
    </div>

    <t-card class="user-info">
      <h3>{{lang.user_text16}}</h3>
      <t-form :data="formData" label-align="top" layout="inline" :rules="rules" ref="userInfo">
        <t-form-item :label="`${lang.name}${calcDevloper}`" name="username">
          <t-input v-model="formData.username" :placeholder="lang.name"></t-input>
        </t-form-item>
        <t-form-item :label="lang.clinet_level" name="username" v-if="hasPlugin">
          <t-select v-model="formData.level_id" :placeholder="lang.clinet_level" clearable>
            <t-option v-for="item in levelList" :value="item.id" :label="item.name" :key="item.name">
            </t-option>
          </t-select>
        </t-form-item>
        <t-form-item :label="lang.finance_search_text33" name="username" v-if="hasIdcsmart_sale">
          <t-select v-model="idcsmart_sale_id" :placeholder="lang.finance_search_text33" clearable>
            <t-option v-for="item in idcsmart_sale_list" :value="item.id" :label="item.name" :key="item.name">
            </t-option>
          </t-select>
        </t-form-item>

        <t-form-item :label="lang.phone" name="phone" :rules="formData.email ?
          [{ required: false},{pattern: /^\d{0,11}$/, message: lang.verify11 }]:
          [{ required: true,message: lang.input + lang.phone, type: 'error' },
          {pattern: /^\d{0,11}$/, message: lang.verify11 }]">
          <t-select v-model="formData.phone_code" filterable style="width: 100px" :placeholder="lang.phone_code">
            <t-option v-for="item in country" :value="item.phone_code" :label="item.name_zh + '+' + item.phone_code"
              :key="item.name">
            </t-option>
          </t-select>
          <t-input :placeholder="lang.phone" v-model="formData.phone" style="width: calc(100% - 100px);" />
        </t-form-item>
        <t-form-item :label="lang.email" name="email" :rules="formData.phone ?
              [{ required: false },
              {pattern: /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{1,9})$/,
              message: lang.email_tip, type: 'warning' }]:
              [{ required: true,message: lang.input + lang.email, type: 'error'},
              {pattern: /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z_])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{1,9})$/,
              message: lang.email_tip, type: 'warning' }
              ]">
          <t-input v-model="formData.email" :placeholder="lang.email"></t-input>
        </t-form-item>
        <t-form-item :label="lang.setting_text14" name="operate_password">
          <t-input v-model="formData.operate_password" :placeholder="lang.setting_text14"
            :type="formData.operate_password ? 'password' : 'text'" autocomplete="off"></t-input>
        </t-form-item>
        <t-form-item :label="lang.country" name="country">
          <t-select v-model="formData.country_id" filterable style="width: 100%" :placeholder="lang.country">
            <t-option v-for="item in country" :value="item.id" :label="item.name_zh" :key="item.id">
            </t-option>
          </t-select>
        </t-form-item>
        <t-form-item :label="lang.address" name="address">
          <t-input v-model="formData.address" :placeholder="lang.address" :maxlength="255" show-limit-number></t-input>
        </t-form-item>
        <t-form-item :label="lang.company" name="company">
          <t-input v-model="formData.company" :placeholder="lang.company"></t-input>
        </t-form-item>
        <t-form-item :label="lang.language" name="language">
          <t-select v-model="formData.language" :placeholder="lang.select+lang.language">
            <t-option v-for="item in langList" :value="item.display_lang" :label="item.display_name"
              :key="item.display_lang">
            </t-option>
          </t-select>
        </t-form-item>
        <t-form-item :label="lang.password" name="password">
          <t-input v-model="formData.password" :placeholder="lang.password"
            :type="formData.password ? 'password' : 'text'" autocomplete="off"></t-input>
        </t-form-item>
        <template v-for="item in clientCustomList">
          <t-form-item :label="item.name">
            <t-input v-if="item.type === 'text' || item.type === 'password' || item.type === 'link'"
              v-model="item.value" :placeholder="item.description"
              :type="item.type === 'password' ? 'password' : 'text'">
            </t-input>
            <t-select v-model="item.value" :placeholder="item.description" v-if="item.type === 'dropdown'">
              <t-option v-for="items in item.options" :value="items" :label="items" :key="items">
              </t-option>
            </t-select>
            <t-input-group separate v-if="item.type === 'dropdown_text'" style="width: 100%;">
              <t-select style="width: 100px; flex-shrink: 0;" v-model="item.select_select">
                <t-option v-for="items in item.options" :value="items" :label="items" :key="items">
                </t-option>
              </t-select>
              <t-input v-model="item.select_text" :placeholder="item.description"></t-input>
            </t-input-group>
            <t-checkbox v-if="item.type === 'tickbox'" v-model="item.value">{{item.description}}</t-checkbox>
            <t-textarea v-if="item.type === 'textarea'" :placeholder="lang.description"
              v-model="item.value"></t-textarea>
          </t-form-item>
        </template>
        <t-form-item :label="lang.notes" name="notes" class=" textarea notes-item">
          <t-textarea :placeholder="lang.notes" v-model="formData.notes" :maxlength="10000"
            show-limit-number></t-textarea>
        </t-form-item>
      </t-form>
      <!-- 底部操作按钮 -->
      <div class="footer-btn">
        <t-button theme="primary" :loading="submitLoading && !statusVisble" @click="updateUserInfo" type="submit"
          v-permission="'auth_user_detail_personal_information_save_user_info'">
          {{lang.hold}}
        </t-button>
        <t-button theme="danger" variant="base" @click="deleteUser"
          v-permission="'auth_user_detail_personal_information_delete_user'">
          {{lang.delete}}
        </t-button>
        <t-button theme="default" class="com-gray-btn" variant="base" @click="changeStatus"
          v-permission="'auth_user_detail_personal_information_deactivate_enable_user'">
          {{data.status===0 ? lang.enable :lang.deactivate}}
        </t-button>
      </div>
    </t-card>

    <t-card class="user-info" v-show="childList.length > 0">
      <h3>{{lang.user_text17}}</h3>
      <!-- 子账户 -->
      <div class="login-log chlid-box" style="margin-bottom:40px">
        <t-table row-key="id" :data="childList" size="medium" :columns="childColumns" :hover="hover" :loading="loading"
          table-layout="auto">
          <template #last_action_time="{row}">
            {{ row.last_action_time>0 ? moment(row.last_action_time * 1000).format('YYYY-MM-DD HH:mm:ss') : '--'}}
          </template>
          <template #caozuo="{row}">
            <!-- <span class="edit-text" @click="goEdit(row.id)">{{lang.user_text18}}</span> -->
            <t-tooltip :content="lang.user_text18" :show-arrow="false" theme="light">
              <t-icon name="edit-1" class="common-look" @click="goEdit(row.id)"></t-icon>
            </t-tooltip>
          </template>
        </t-table>
        <t-pagination show-jumper v-if="total" :total="total" :page-size="params.limit"
          :page-size-options="logSizeOptions" :on-change="changePage" />
      </div>
    </t-card>

    <!-- 充值弹窗 -->
    <t-dialog :visible.sync="visibleRecharge" :header="lang.Recharge" :footer="false" @close="closeRechorge">
      <t-form :data="rechargeData" :rules="rechargeRules" ref="rechargeRef" :label-width="80" @submit="confirmRecharge"
        v-if="visibleRecharge">
        <!-- 支付方式 -->
        <t-form-item :label="lang.pay_way" name="gateway">
          <t-select v-model="rechargeData.gateway" filterable style="width: 100%"
            :placeholder="lang.select+lang.pay_way">
            <t-option v-for="item in gatewayList" :value="item.name" :label="item.title" :key="item.id">
            </t-option>
          </t-select>
        </t-form-item>
        <!-- 充值金额 -->
        <t-form-item :label="lang.Recharge+lang.money" name="amount">
          <t-input v-model="rechargeData.amount" :placeholder="lang.Recharge+lang.money" :label="currency_prefix">
          </t-input>
        </t-form-item>
        <t-form-item :label="lang.flow">
          <t-input v-model="rechargeData.transaction_number" :placeholder="lang.flow">
          </t-input>
        </t-form-item>
        <t-form-item :label="lang.notes">
          <t-input v-model="rechargeData.notes" :placeholder="lang.notes">
          </t-input>
        </t-form-item>
        <div class="submit-btn">
          <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.sure+lang.Recharge}}</t-button>
          <t-button theme="default" variant="base" @click="closeRechorge">{{lang.cancel}}</t-button>
        </div>
      </t-form>
    </t-dialog>
    <!-- 充值/扣费弹窗 -->
    <t-dialog :header="lang.force_change + lang.money" :visible.sync="visibleMoney" :footer="false" @close="closeMoney">
      <t-form :data="moneyData" :rules="moneyRules" ref="moneyRef" :label-width="80" @submit="confirmMoney"
        v-if="visibleMoney">
        <t-form-item :label="lang.type" name="type">
          <t-select v-model="moneyData.type" :placeholder="lang.select+lang.type">
            <t-option value="recharge" :label="lang.add_money" key="recharge"></t-option>
            <t-option value="deduction" :label="lang.sub_money" key="deduction"></t-option>
          </t-select>
        </t-form-item>
        <t-form-item :label="lang.money" name="amount">
          <t-input v-model="moneyData.amount" :placeholder="lang.money" :label="inputLabel">
          </t-input>
        </t-form-item>
        <t-form-item :label="lang.notes">
          <t-textarea v-model="moneyData.notes" :placeholder="lang.notes" />
        </t-form-item>
        <div class="submit-btn">
          <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.submit}}</t-button>
          <t-button theme="default" variant="base" @click="closeMoney">{{lang.cancel}}</t-button>
        </div>
      </t-form>
    </t-dialog>
    <!-- 变更记录 -->
    <t-dialog :visible="visibleLog" :header="lang.change_log" :footer="false" :on-close="closeLog" width="1100">
      <div slot="body">
        <div style="display: flex; align-items: center; gap: 16px; justify-content: flex-end; margin-bottom: 20px;">
          <t-date-range-picker allow-input clearable v-model="range" enable-time-picker :presets="presets">
          </t-date-range-picker>
          <t-select v-model="moneyPage.type" @change="searchChangeLog" :placeholder="lang.user_text47" clearable
            style="width: 200px;">
            <t-option v-for="item in Object.keys(creditChangeType)" :value="item" :label="creditChangeType[item]"
              :key="item">
            </t-option>
          </t-select>
          <t-input v-model="moneyPage.keywords" @keydown.native.enter="searchChangeLog" :placeholder="lang.user_text48"
            style="width: 200px;">
          </t-input>
          <t-button @click="searchChangeLog">{{lang.query}}</t-button>
        </div>
        <t-table row-key="change_log" :data="logData" size="medium" :columns="columns" :hover="hover"
          :loading="moneyLoading" table-layout="fixed" max-height="450">
          <template #type="{row}">
            {{creditChangeType[row.type]}}
          </template>
          <template #amount="{row}">
            <span>
              <span v-if="row.amount * 1 > 0">+</span>{{row.amount}}
            </span>
          </template>

          <template #credit="{row}">
            {{currency_prefix}}{{row.credit}}
          </template>

          <template #create_time="{row}">
            {{moment(row.create_time * 1000).format('YYYY/MM/DD HH:mm')}}
          </template>
          <template #admin_name="{row}">
            {{row.admin_name ? row.admin_name : formData.username}}
          </template>
          <template #footer-summary>
            <div class="page-total-amount" v-if="logCunt">
              <div class="amount-item">
                {{lang.page_total_amount}}：<span class="amount-num">{{currency_prefix}}{{page_total_amount}}</span>
              </div>
              <div class="amount-item">
                {{lang.total_amount}}：<span class="amount-num">{{currency_prefix}}{{total_amount}}</span>
              </div>
            </div>
          </template>
        </t-table>
        <t-pagination show-jumper v-if="logCunt" :total="logCunt" :page-size="moneyPage.limit"
          :page-size-options="pageSizeOptions" :on-change="changePage" />
      </div>
    </t-dialog>

    <!-- 冻结余额弹窗 -->
    <t-dialog :visible="freezeVisible" :header="lang.user_text36" :footer="false" :on-close="freezeClose" width="650">
      <t-form :data="freezeForm" :rules="freezeRules" ref="freezeRef" :label-width="80" @submit="confirmFreeze"
        reset-type="initial" v-if="freezeVisible">
        <t-form-item :label="lang.user_text26" name="freeze_amount">
          <t-input-number v-model="freezeForm.freeze_amount" style="width: 100%;" :placeholder="lang.user_text26"
            theme="normal" :min="0" :max="data.credit" :decimal-places="2">
            <template #suffix><span>{{currency_suffix}}</span></template>
          </t-input-number>
        </t-form-item>
        <t-form-item :label="lang.user_text37" name="client_notes">
          <t-textarea v-model="freezeForm.client_notes" :placeholder="lang.user_text39"></t-textarea>
        </t-form-item>
        <t-form-item :label="lang.user_text38" name="notes">
          <t-textarea v-model="freezeForm.notes" :placeholder="lang.user_text40"></t-textarea>
        </t-form-item>
        <div class="submit-btn">
          <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.submit}}</t-button>
          <t-button theme="default" variant="base" @click="freezeClose">{{lang.cancel}}</t-button>
        </div>
      </t-form>
    </t-dialog>


    <!-- 删除弹窗 -->
    <t-dialog theme="warning" :header="lang.sureDelete" :visible.sync="delVisible">
      <template slot="footer">
        <t-button theme="primary" @click="sureDelUser" :loading="submitLoading">{{lang.sure}}</t-button>
        <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
      </template>
    </t-dialog>
    <!-- 启用/停用 -->
    <t-dialog theme="warning" :header="statusTip" :visible.sync="statusVisble">
      <template slot="footer">
        <t-button theme="primary" @click="sureChange" :loading="submitLoading">{{lang.sure}}</t-button>
        <t-button theme="default" @click="statusVisble=false">{{lang.cancel}}</t-button>
      </template>
    </t-dialog>
    <safe-confirm ref="safeRef" :password.sync="admin_operate_password" @confirm="hadelSafeConfirm"></safe-confirm>

  </com-config>
</div>
<!-- =======页面独有======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comChooseUser/comChooseUser.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/safeConfirm/safeConfirm.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/client.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/client_detail.js"></script>
<!-- footer -->
<t-footer id="footer" v-cloak>Copyright @ 2019-{{new Date().getFullYear()}}
</t-footer>
</t-content>
</t-layout>
</t-layout>
<!-- =======公共======= -->
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/axios.min.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/request.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/commonTool.js"></script>

</body>

</html>

