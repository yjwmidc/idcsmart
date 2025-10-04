<?php /*a:3:{s:53:"../public/hcydxoep/template/default/order_details.php";i:1755667656;s:46:"../public/hcydxoep/template/default/header.php";i:1755667656;s:46:"../public/hcydxoep/template/default/footer.php";i:1755667656;}*/ ?>
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

<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/client.css">
<!-- =======内容区域======= -->
<div id="content" class="order-details hasCrumb" v-cloak>
  <com-config>
    <div class="com-crumb">
      <span>{{lang.business_manage}}</span>
      <t-icon name="chevron-right"></t-icon>
      <span style="cursor: pointer;" @click="goOrder">{{lang.order_manage}}</span>
      <t-icon name="chevron-right"></t-icon>
      <span class="cur">{{lang.create_order_detail}}</span>
      <span class="back-text" @click="goBack">
        <t-icon name="chevron-left-double"></t-icon>{{lang.back}}
      </span>
    </div>
    <t-card class="list-card-container">
      <ul class="common-tab">
        <li class="active"
          v-if="$checkPermission('auth_business_order_detail_order_detail_view') || $checkPermission('auth_user_detail_order_check_order')">
          <a>{{lang.create_order_detail}}</a>
        </li>
        <li v-permission="'auth_business_order_detail_refund_record_view'">
          <a :href="`order_refund.htm?id=${id}`">{{lang.refund_record}}</a>
        </li>
        <li v-permission="'auth_business_order_detail_transaction'">
          <a :href="`order_flow.htm?id=${id}`">{{lang.flow}}</a>
        </li>
        <li v-if="hasCostPlugin" v-permission="'auth_addon_cost_pay_show_tab'">
          <a :href="`plugin/cost_pay/order_cost.htm?id=${id}`">{{lang.piece_cost}}</a>
        </li>
        <li v-permission="'auth_business_order_detail_notes_view'">
          <a :href="`order_notes.htm?id=${id}`">{{lang.notes}}</a>
        </li>
      </ul>
      <!-- 基础信息 -->
      <div class="top-info">
        <div class="left-box">
          <div class="item">
            <span class="txt">{{lang.order_number}}：</span>
            <span>{{id}}</span>
          </div>
          <div class="item">
            <span class="txt">{{lang.order_type}}：</span>
            <span>{{lang[orderDetail.type]}}</span>
          </div>
          <div class="item">
            <span class="txt">{{lang.user}}：</span>
            <a :href="`client_detail.htm?client_id=${orderDetail.client_id}`"
              class="info aHover">{{orderDetail.client_name}}</a>
          </div>
          <div class="item">
            <span class="txt">{{lang.order + lang.time}}：</span>
            <span class="info">
              {{moment(orderDetail.create_time * 1000).format('YYYY-MM-DD HH:mm')}}
            </span>
          </div>
          <div class="item">
            <span class="txt">{{lang.order}}{{lang.money}}：</span>
            <span class="info">{{currency_prefix}}&nbsp;{{orderDetail.amount}}</span>
          </div>
          <div class="item">
            <span class="txt">{{lang.order_detail_text1}}：</span>
            <span class="info">{{currency_prefix}}&nbsp;{{orderDetail.credit}}</span>
            <span class="btn" @click="changeCredit('add')" v-if="(orderDetail.amount * 1 !== orderDetail.credit * 1) && orderDetail.apply_credit_amount * 1 > 0
              && $checkPermission('auth_business_order_detail_order_detail_apply_credit') && orderDetail.is_recycle === 0
              && !isTransfer
              ">{{lang.app}}{{lang.credit}}</span>
            <span class="btn" @click="changeCredit('sub')"
              v-if="orderDetail.status == 'Unpaid' && orderDetail.credit * 1 !== 0 && $checkPermission('auth_business_order_detail_order_detail_remove_credit') && orderDetail.is_recycle === 0">{{lang.deduct}}{{lang.credit}}</span>
          </div>
          <div class="item">
            <span class="txt">{{lang.refunded}}：</span>
            <span class="info">{{currency_prefix}}&nbsp;{{orderDetail.refund_amount}}
              <span v-if="orderDetail.refund_gateway*1 > 0">({{orderDetail.gateway_sign === 'credit_limit' ?
                lang.order_detail_text30 :
                lang.order_detail_text10}}：{{currency_prefix}}&nbsp;{{orderDetail.refund_gateway}})</span>
            </span>
            <span class="btn" @click="changeLog"
              v-permission="'auth_business_order_detail_order_detail_change_log'">{{lang.change_log}}</span>
          </div>
          <div class="item" v-if="orderDetail.type === 'artificial'">
            <span class="txt">{{lang.operator}}：</span>
            <span class="info">{{orderDetail.admin_name || '--'}}</span>
          </div>
          <div class="item" v-for="item in self_defined_field" :key="item.id">
            <span class="txt">{{item.field_name}}:</span>
            <span class="info">{{item.value || '--'}}</span>
          </div>
        </div>
        <div class="r-box">
          <div class="con">
            <div class="top">
              <div class="status">
                <t-tag theme="default" variant="light" class="order-canceled"
                  v-if="orderDetail.status === 'Cancelled'">{{lang.canceled}}</t-tag>
                <t-tag theme="default" variant="light" class="order-paid"
                  v-if="orderDetail.status === 'Paid'">{{lang.Paid}}</t-tag>
                <t-tag theme="default" variant="light" class="order-refunded"
                  v-if="orderDetail.status === 'Refunded'">{{lang.refunded}}</t-tag>
                <t-tag theme="default" variant="light" class="order-unpaid"
                  v-if="orderDetail.status === 'Unpaid'">{{lang.Unpaid}}</t-tag>
              </div>
              <!-- 是否开票 -->
              <div class="is-invoiced" v-if="hasInvoicePlugin">
                <a :href="`${baseUrl}/plugin/idcsmart_invoice/index.htm?id=${id}`" target="_blank"
                  v-if="invoiceObj.invoice.id">
                  <t-tag theme="primary">
                    {{lang.order_invoiced}}
                  </t-tag>
                </a>
                <template v-esle>
                  <t-tag v-if="invoiceObj.support_invoice">{{lang.order_not_invoiced}}</t-tag>
                  <a :href="`${baseUrl}/plugin/idcsmart_invoice/index.htm?id=${id}&client_id=${orderDetail.client_id}&status=${orderDetail.status}`"
                    class="aHover common-look" target="_blank" style="margin-left: 5px;"
                    v-if="invoiceObj.support_invoice">
                    {{lang.order_go_invoice}}
                  </a>
                </template>
              </div>
            </div>
            <template v-if="orderDetail.status === 'Unpaid'">
              <t-select v-model="gateway" :placeholder="lang.pay_way" class="order-pay" @change="changePay">
                <t-option v-for="item in payList" :value="item.name" :label="item.title" :key="item.name">
                </t-option>
              </t-select>
              <P class="signPay" @click="signPay"
                v-if="$checkPermission('auth_business_order_detail_order_detail_paid') && orderDetail.is_recycle === 0">
                {{lang.sign_pay}}
              </P>
            </template>
            <p class="time">
              <template v-if="orderDetail.status === 'Paid'">
                {{moment(orderDetail.pay_time * 1000).format('YYYY-MM-DD HH:mm')}}
              </template>
              <template v-else>
                {{moment(orderDetail.create_time * 1000).format('YYYY-MM-DD HH:mm')}}
              </template>
            </p>
            <!-- 支付方式 -->
            <p class="gateway">
              <template v-if="orderDetail.status === 'Unpaid'">
                --
              </template>
              <template v-else>
                <template v-if="orderDetail.gateway_sign === 'credit'">
                  <span>{{lang.balance_pay}}</span>
                </template>
                <template v-else>
                  <!-- 其他支付方式 -->
                  <template v-if="orderDetail.credit == 0">
                    {{orderDetail.gateway}}
                  </template>
                  <!-- 混合支付 -->
                  <template v-if="orderDetail.credit * 1 >0">
                    <t-tooltip :content="currency_prefix+orderDetail.credit" theme="light" placement="bottom-right">
                      <span class="theme-color">{{lang.balance_pay}}</span>
                    </t-tooltip>
                    <span>{{orderDetail.gateway ? '+ ' + orderDetail.gateway: '' }}</span>
                  </template>
                </template>

              </template>
            </p>
          </div>
        </div>
      </div>

      <template v-if="orderDetail.status">
        <template v-if="orderDetail.status ==='Paid' || orderDetail.status ==='Refunded'">
          <div class="refund-top">
            <div>
              <t-button
                v-if="orderDetail.type !=='recharge' && $checkPermission('auth_business_order_detail_refund_record_approval')"
                theme="primary" @click="handleRefund">{{lang.order_detail_text16}}
              </t-button>
            </div>
            <t-input @keypress.enter.native="getProductRefundList" clearable @clear="clearKey" style="width: 300px;"
              :placeholder="lang.order_detail_text17" v-model="refundKeywords">
              <template #suffixIcon>
                <t-icon @click="getProductRefundList" name="search" :style="{ cursor: 'pointer' }"></t-icon>
              </template>
            </t-input>
          </div>
          <!-- 退款列表 -->
          <t-table row-key="id" :data="productRefundData" size="medium" :columns="refundColumns" :hover="hover"
            :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'" :hide-sort-tips="true">
            <template slot="sortIcon">
              <t-icon name="caret-down-small"></t-icon>
            </template>
            <template #description="{row}">
              <a :href="`host_detail.htm?client_id=${orderDetail.client_id}&id=${row.host_id}`" class="aHover"
                v-if="row.host_id">{{row.description}}</a>
              <span v-else>{{row.description}}</span>
            </template>
            <template #product_name="{row}">
              <a :href="`host_detail.htm?client_id=${orderDetail.client_id}&id=${row.host_id}`" class="aHover"
                v-if="row.host_id">{{row.product_name || '--'}}</a>
              <span v-else>{{row.product_name || '--'}}</span>
            </template>
            <template #host_name="{row}">
              <template v-if="row.ip_num > 0">
                <t-tooltip :show-arrow="false" theme="light">
                  <template #content>
                    <div>
                      <div v-if="row.dedicate_ip">{{row.dedicate_ip}}</div>
                      <div v-if="row.assign_ip">
                        <div v-for="item in row.assign_ip.split(',')">{{item}}</div>
                      </div>
                    </div>
                  </template>
                  <span>{{row.host_name || '--'}}</span>
                </t-tooltip>
              </template>
              <template v-else>
                <span>{{row.host_name || '--'}}</span>
              </template>
            </template>
            <template #amount="{row}">
              <span>{{currency_prefix}}{{row.amount}}</span>
            </template>
            <template #refund_status="{row}">
              <span>{{refunStatusOptions[row.refund_status] || '--'}}</span>
            </template>
            <template #host_status="{row}">
              <span>{{hostStatusOptions[row.host_status] || '--'}}</span>
            </template>
            <template #refund_total="{row}">
              <div style="white-space:normal;">
                <div v-if="row.refund_total * 1  !== 0">{{currency_prefix}}{{row.refund_total}}</div>
                <div v-else>--</div>
                <template v-if="orderDetail.gateway_sign === 'credit_limit'">
                  <span
                    v-if="row.refund_gateway * 1  !== 0">({{currency_prefix}}{{row.refund_gateway}}{{lang.order_detail_text30}})</span>
                </template>
                <template v-else>
                  <div v-if="row.refund_credit * 1  !== 0 || row.refund_gateway * 1  !== 0" style="white-space:normal;">
                    (
                    <span
                      v-if="row.refund_credit * 1  !== 0">{{currency_prefix}}{{row.refund_credit}}{{lang.order_detail_text11}}</span>
                    <span v-if="row.refund_gateway * 1  !== 0">
                      <span v-if="row.refund_credit * 1  !== 0">+</span>
                      {{currency_prefix}}{{row.refund_gateway}}{{lang.order_detail_text10}}
                    </span>)
                  </div>
                </template>
              </div>
            </template>
            <template #refund_credit="{row}">
              <template v-if="orderDetail.gateway_sign === 'credit_limit'">
                <span v-if="row.refund_total * 1  !== 0">{{lang.order_detail_text30}}</span>
                <span v-else>--</span>
              </template>
              <template v-else>
                <span v-if="row.refund_credit * 1  !== 0 || row.refund_gateway * 1  !== 0">
                  <span v-if="row.refund_credit * 1  !== 0">{{lang.order_detail_text11}}</span>
                  <template v-if="row.refund_gateway * 1  !== 0">
                    <span v-if="row.refund_credit * 1  !== 0">+</span>
                    <span>{{lang.order_detail_text10}}</span>
                  </template>
                </span>
                <span v-else>--</span>
              </template>
            </template>
            <template #op="{row, rowIndex}">
              <!-- <span class="common-look"
                v-if="row.refund_status !== 'addon_refund' && row.refund_status !== 'all_refund' && row.host_id && $checkPermission('auth_business_order_detail_refund_record_approval')"
                @click="handleRefund(row)">{{lang.order_detail_text9}}</span> -->
              <t-tooltip :content="lang.order_detail_text9" :show-arrow="false" theme="light" v-if="row.refund_status !== 'addon_refund' && row.refund_status !== 'all_refund' && row.host_id && $checkPermission('auth_business_order_detail_refund_record_approval')">
                <i class="iconfont icon-daichulituikuan"  @click="handleRefund(row)"></i>
              </t-tooltip>
              <span v-else>--</span>
            </template>
          </t-table>
        </template>
        <template v-else>
          <!-- 底部描述 -->
          <t-table row-key="id" :data="orderDetail.items" size="medium" :columns="columns" :hover="hover"
            :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'" :hide-sort-tips="true">
            <template slot="sortIcon">
              <t-icon name="caret-down-small"></t-icon>
            </template>
            <template #description="{row}">
              <t-input v-model="row.description" v-if="row.edit"></t-input>
              <template v-else>
                <a :href="`host_detail.htm?client_id=${orderDetail.client_id}&id=${row.host_id}`" class="aHover"
                  v-if="row.host_id">{{row.description}}</a>
                <span v-else>{{row.description}}</span>
              </template>
            </template>
            <template #product_name="{row}">
              <a :href="`host_detail.htm?client_id=${orderDetail.client_id}&id=${row.host_id}`" class="aHover"
                v-if="row.host_id">{{row.product_name || '--'}}</a>
              <span v-else>{{row.product_name || '--'}}</span>
            </template>
            <template #host_name="{row}">
              <span>{{row.host_name || '--'}}</span>
            </template>
            <template #amount="{row}">
              <t-input v-model="row.amount" :label="currency_prefix" v-if="row.edit"></t-input>
              <span v-else>{{currency_prefix}}{{row.amount}}</span>
            </template>
            <template #op="{row, rowIndex}">
              <template v-if="orderDetail.status === 'Unpaid' && orderDetail.is_recycle === 0">
                <t-tooltip :content="lang.delete" :show-arrow="false" theme="light"
                  v-if="row.edit && $checkPermission('auth_business_order_detail_order_detail_delete_order_item')">
                  <t-icon name="delete" size="18px" @click="delteFlow(row, rowIndex)" class="common-look"></t-icon>
                </t-tooltip>
                <t-tooltip :content="lang.hold" :show-arrow="false" theme="light"
                  v-if="row.edit && $checkPermission('auth_business_order_detail_order_detail_save_order_item')">
                  <t-icon name="save" size="18px" @click="saveFlow(row)" class="common-look"></t-icon>
                </t-tooltip>
                <t-tooltip :content="lang.add" :show-arrow="false" theme="light"
                  v-if="rowIndex === orderDetail.items.length -1 && $checkPermission('auth_business_order_detail_order_detail_create_order_item')">
                  <t-icon name="add-circle" size="18px" @click="addSubItem(row)" class="common-look"></t-icon>
                </t-tooltip>
              </template>
            </template>
          </t-table>
        </template>
      </template>
      <!-- 订单退款弹窗 -->
      <t-dialog :visible.sync="refundVisible"
        :header="refundFormData.host_id ? lang.order_detail_text28 : lang.order_detail_text16" :on-close="refundClose"
        :footer="false" width="700" :close-on-overlay-click="false" reset-type="initial">
        <t-form :rules="refundRules" :data="refundFormData" ref="refundDialog" @submit="refundSubmit"
          :label-width="150">
          <t-table style="margin-bottom: var(--td-comp-margin-xxl);" v-if="refundInfo.host_order_item?.length > 0"
            row-key="id" :data="refundInfo.host_order_item" size="medium" :columns="hostColumns" :hover="hover"
            :table-layout="tableLayout ? 'auto' : 'fixed'">
            <template #product_name="{row}">
              <span>{{row.product_name || '--'}}</span>
            </template>
            <template #name="{row}">
              <template v-if="row.description">
                <t-tooltip :content="row.description" :show-arrow="false" theme="light">
                  <span>{{row.name || '--'}}</span>
                </t-tooltip>
              </template>
              <template v-else>
                <span>{{row.name || '--'}}</span>
              </template>
            </template>
            <template #amount="{row}">
              <span>{{currency_prefix}}{{row.amount}}</span>
            </template>
            <template #status="{row}">
              <span>{{hostStatusOptions[row.status] || '--'}}</span>
            </template>
          </t-table>
          <t-form-item :label="lang.order_detail_text19">
            <div>{{currency_prefix}} {{refundInfo.leave_total}}
              <template v-if="refundInfo.gateway === 'credit_limit'">
                ({{lang.order_detail_text30}}:{{currency_prefix}} {{refundInfo.leave_total}})
              </template>
              <template
                v-if="(refundInfo.leave_credit *1 !== 0 || refundInfo.leave_gateway *1 !== 0 )&& refundInfo.gateway !== 'credit_limit'">
                (<span v-if="refundInfo.leave_credit *1 !== 0">{{lang.order_detail_text11}}:{{currency_prefix}}
                  {{refundInfo.leave_credit}}
                </span>
                <span v-if="refundInfo.leave_gateway *1 !== 0"> <span v-if="refundInfo.leave_credit *1 !== 0">+</span>
                  {{lang.order_detail_text10}}:{{currency_prefix}}{{refundInfo.leave_gateway}}
                </span>)
              </template>
            </div>
          </t-form-item>
          <t-form-item :label="lang.order_detail_text29" v-if="refundFormData.host_id">
            <div>{{currency_prefix}} {{refundInfo.leave_host_amount}}</div>
          </t-form-item>
          <t-form-item :label="lang.order_detail_text7" name="amount">
            <t-input-number style="width: 100%;" v-model="refundFormData.amount" theme="normal"
              :allow-input-over-limit="false"
              :max="refundFormData.host_id &&  refundInfo.gateway !== 'credit_limit' ? refundInfo.leave_host_amount * 1 : refundInfo.leave_total * 1"
              :min="0" :decimal-places="2">
            </t-input-number>
          </t-form-item>
          <t-form-item :label="lang.order_detail_text20" name="type" v-if="refundInfo.gateway != 'credit_limit'">
            <t-select v-model="refundFormData.type">
              <t-option key="credit_first" v-if="orderDetail.refund_orginal == 1 && refundInfo.leave_gateway * 1 > 0"
                :label="lang.order_detail_text21" value="credit_first"></t-option>
              <t-option key="gateway_first" v-if="orderDetail.refund_orginal == 1 && refundInfo.leave_gateway * 1 > 0"
                :label="lang.order_detail_text22" value="gateway_first"></t-option>
              <t-option key="credit" :label="lang.order_detail_text23" value="credit"></t-option>
              <t-option key="transaction" v-if="refundInfo.leave_gateway * 1 > 0" :label="lang.order_detail_text24"
                value="transaction"></t-option>
            </t-select>
          </t-form-item>
          <template v-if="refundFormData.type === 'transaction'">
            <t-form-item :label="lang.gateway" name="gateway">
              <t-select v-model="refundFormData.gateway" :placeholder="lang.select+lang.gateway">
                <t-option v-for="item in payList" :value="item.name" :label="item.title" :key="item.name">
                </t-option>
              </t-select>
            </t-form-item>
          </template>
          <t-form-item :label="lang.order_detail_text26" v-if="refundFormData.amount && refundFormData.type">
            <div>{{currency_prefix}} {{(refundFormData.amount * 1).toFixed(2)}}
              <template v-if="refundFormData.type !== 'transaction' && refundInfo.gateway != 'credit_limit'">
                (
                <span v-if="calcRefundCredit *1 !== 0">{{lang.order_detail_text11}}:{{currency_prefix}}
                  {{calcRefundCredit.toFixed(2)}}
                </span>
                <span v-if="calcRefundCredit * 1 < refundFormData.amount*1">
                  <span v-if="calcRefundCredit *1 !== 0">+</span>
                  {{lang.order_detail_text10}}:{{currency_prefix}}
                  {{calcGetaway.toFixed(2)}}
                </span>
                )
              </template>
              <template v-if="refundInfo.gateway === 'credit_limit'">
                ({{lang.order_detail_text30}}:{{currency_prefix}}{{refundFormData.amount}})
              </template>
            </div>
          </t-form-item>
          <t-form-item :label="lang.order_detail_text25" name="notes">
            <t-textarea v-model="refundFormData.notes" :placeholder="lang.order_detail_text25"></t-textarea>
          </t-form-item>
          <div class="com-f-btn">
            <t-button theme="primary" type="submit" :loading="refundLoading">{{lang.hold}}</t-button>
            <t-button theme="default" variant="base" @click="refundClose">{{lang.cancel}}</t-button>
          </div>
        </t-form>
      </t-dialog>
      <!-- 应用/扣除余额 -->
      <t-dialog :visible.sync="visible" :header="title" :on-close="close" :footer="false" width="600"
        :close-on-overlay-click="false" class="apply-money">
        <t-form :rules="rules" :data="formData" ref="userDialog" @submit="onSubmit" v-if="visible" :label-width="150">
          <t-form-item :label="`${lang.order_tip1}`" name="amount" v-if="type === 'add'">
            <t-input :placeholder="`${lang.input}${lang.money}`" v-model="formData.amount" @blur="changeAdd" />
          </t-form-item>
          <t-form-item :label="`${lang.order_tip2}`" name="amount" v-if="type === 'sub'">
            <t-input :placeholder="`${lang.input}${lang.money}`" v-model="formData.amount" @blur="changeSub" />
          </t-form-item>
          <t-form-item :label="`${lang.box_title3}`" name="status"
            v-if="type === 'add' && orderDetail.status === 'Refunded'">
            <t-select v-model="formData.status">
              <t-option key="Refunded" :label="lang.refunded" value="Refunded"></t-option>
              <t-option key="Paid" :label="lang.Paid" value="Paid"></t-option>
            </t-select>
          </t-form-item>
          <div class="com-f-btn">
            <t-button theme="primary" type="submit" :loading="submitLoading">{{lang.hold}}</t-button>
            <t-button theme="default" variant="base" @click="close">{{lang.cancel}}</t-button>
          </div>
        </t-form>
      </t-dialog>
      <!-- 标记支付 -->
      <t-dialog :header="lang.sign_pay" :visible.sync="payVisible" width="600" class="sign_pay">
        <template slot="body">
          <t-form :data="signForm">
            <t-form-item :label="lang.order_amount">
              <t-input :label="currency_prefix" v-model="signForm.amount" disabled />
            </t-form-item>
            <!-- <t-form-item :label="lang.balance_paid">
            <t-input :label="currency_prefix" v-model="signForm.credit" disabled />
          </t-form-item> -->
            <t-form-item :label="lang.no_paid">
              <t-input :label="currency_prefix" v-model="(signForm.credit * 1).toFixed(2)" disabled />
            </t-form-item>
            <t-form-item :label="lang.flow">
              <t-input v-model="signForm.transaction_number"></t-input>
            </t-form-item>
            <!-- <t-checkbox v-model="use_credit" class="checkDelete">{{lang.use_credit}}</t-checkbox> -->
          </t-form>
        </template>
        <template slot="footer">
          <div class="common-dialog" style="margin-top: 20px;">
            <t-button @click="sureSign" :loading="payLoading">{{lang.sure}}</t-button>
            <t-button theme="default" @click="payVisible=false">{{lang.cancel}}</t-button>
          </div>
        </template>
      </t-dialog>
      <!-- 删除提示框 -->
      <t-dialog theme="warning" :header="lang.sureDelete" :close-btn="false" :visible.sync="delVisible">
        <template slot="footer">
          <t-button theme="primary" @click="sureDelUser" :loading="submitLoading">{{lang.sure}}</t-button>
          <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
        </template>
      </t-dialog>
      <!-- 变更记录 -->
      <t-dialog :visible="visibleLog" :header="lang.change_log" :footer="false" :on-close="closeLog" width="1000">
        <div slot="body">
          <t-table row-key="change_log" :data="logData" size="medium" :columns="logColumns" :hover="hover"
            :loading="moneyLoading" table-layout="fixed" max-height="350">
            <template #type="{row}">
              {{lang[row.type]}}
            </template>
            <template #amount="{row}">
              <span>
                <span v-if="row.amount * 1 > 0">+</span>{{row.amount}}
              </span>
            </template>
            <template #create_time="{row}">
              {{moment(row.create_time * 1000).format('YYYY/MM/DD HH:mm')}}
            </template>
            <template #admin_name="{row}">
              {{row.admin_name ? row.admin_name : formData.username}}
            </template>
          </t-table>
          <com-pagination v-if="logCunt" :total="logCunt" :page="moneyPage.page" :limit="moneyPage.limit"
            @page-change="changePage">
          </com-pagination>
        </div>
      </t-dialog>
    </t-card>
    <div class="deleted-svg" v-if="orderDetail.is_recycle">
      <img :src="`${rootRul}img/deleted.svg`" alt="" v-show="orderDetail.is_recycle">
    </div>
  </com-config>
</div>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/client.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/order_details.js"></script>
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

