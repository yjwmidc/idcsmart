<?php /*a:3:{s:54:"../public/hcydxoep/template/default/supplier_order.php";i:1749055993;s:46:"../public/hcydxoep/template/default/header.php";i:1749055993;s:46:"../public/hcydxoep/template/default/footer.php";i:1749055993;}*/ ?>
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
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/vue.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/utils/permission.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/composition-api.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/common/tdesign.min.js"></script>
  <script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/components/comConfig/comConfig.js"></script>
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
    <t-layout class="aside" id="aside" v-cloak :class="{isFold:collapsed}">
      <com-config>
        <div class="header">
          <div class="logo" @click="goIndex">
            <img :src="logUrl" alt="logo">
          </div>

          <div class="h-left">
            <!-- <t-button theme="default" shape="square" variant="text" @click.native="changeCollapsed">
            <t-icon name="view-list"></t-icon>
          </t-button> -->
            <div class="global-search">
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
                    {{lang.theme_setting}}
                  </template>
                </t-dropdown-item>
                <t-dropdown-item class="operations-dropdown-container-item" @click="toSafeCenter">
                  <template>
                    <t-icon name="lock-off"></t-icon>
                    {{lang.setting_text24}}
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
            <template Slot="closeBtn">
              <t-icon name="close"></t-icon>
            </template>
            <div class="setting-group-title">{{ lang.theme_mode }}</div>
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
            <div class="setting-group-title">{{ lang.theme_color }}</div>
            <t-radio-group v-model="formData.brandTheme">
              <div v-for="(item, index) in COLOR_OPTIONS.slice(0, COLOR_OPTIONS.length)" :key="index"
                class="setting-layout-drawer theme" :class="{no:item!==formData.brandTheme}">
                <t-radio-button :key="index" :value="item" class="setting-layout-color-group">
                  <template>
                    <div :style="{background:getBrandColor(item,colorList)['@brand-color']}" class="color"></div>
                  </template>
                </t-radio-button>
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
                    <t-icon :name="item.icon" />
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
                <t-icon :name="item.icon" />
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
                    <t-option v-for="item in globalConfig" :value="item.table" :label="item.name"
                      :key="item.table"></t-option>
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
                      :popup-props="{ attach: '#search-key' }"></t-date-picker>
                    <t-input v-else :placeholder="lang.input" v-model="globalForm.value"
                      @keypress.enter.native="handleGlobal"></t-input>
                  </div>
                  <div class="search" @click="handleGlobal">
                    <t-icon :name="searchLoading ? 'loading' : 'search'"></t-icon>
                  </div>
                </div>
              </div>
            </div>
            <t-button variant="text" shape="square">
              <t-button variant="text" shape="square" @click.native="changeCollapsed">
                <t-icon name="view-list"></t-icon>
              </t-button>
            </t-button>
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
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/upstream_order.css">
<link rel="stylesheet" href="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/css/client.css">
<div id="content" class="supplier_order order" v-cloak>
  <com-config>
    <t-card class="list-card-container top-card">
      <ul class="common-tab">
        <li class="active" v-permission="'auth_upstream_downstream_supplier_detail_order_list_view'">
          <a href="javascript:;">{{lang.box_title1}}</a>
        </li>
        <li v-permission="'auth_upstream_downstream_supplier_detail_product_list_view'">
          <a :href="`supplier_goods.htm?id=${supplier_id}`">{{lang.product_list}}</a>
        </li>
        <li v-permission="'auth_upstream_downstream_supplier_detail_host_list_view'">
          <a :href="`supplier_product.htm?id=${supplier_id}`">{{lang.goods_list}}</a>
        </li>
      </ul>
      <div class="money-box">
        <div class="item">
          <div class="l-text">
            <p class="num">{{currency_prefix}}{{money.total | filterMoney}}</p>
            <p class="txt">{{lang.total_sales}}</p>
          </div>
          <img src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upstream/app_01.png" alt="">
        </div>
        <div class="item">
          <div class="l-text">
            <p class="num">{{currency_prefix}}{{money.profit | filterMoney}}</p>
            <p class="txt">{{lang.total_profit}}</p>
          </div>
          <img src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upstream/app_02.png" alt="">
        </div>
        <div class="item">
          <div class="l-text">
            <p class="num">{{money.product_count}}</p>
            <p class="txt">{{lang.total_goods}}</p>
            <p class="btn"></p>
          </div>
          <img src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upstream/app_03.png" alt="">
        </div>
        <div class="item">
          <div class="l-text">
            <p class="num">{{money.host_count }}</p>
            <p class="txt">{{lang.total_product}}</p>
          </div>
          <img src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/img/upstream/app_04.png" alt="">
        </div>
      </div>
    </t-card>
    <t-card class="list-card-container bottom-card b-table">
      <div class="common-header">
        <span></span>
        <div class="client-search">
          <t-input v-model="params.keywords" :placeholder="lang.app_tip4" @keypress.enter.native="search">
            <span slot="suffix-icon">
              <t-icon style="cursor: pointer;" @click="search" name="search" />
          </t-input>
        </div>
      </div>
      <t-enhanced-table ref="table" row-key="id" drag-sort="row-handler" :data="data" :columns="columns" :tree="{ childrenKey: 'list', treeNodeColumnIndex: 0 }" :loading="loading" :key="new Date().getTime()" :hover="hover" :tree-expand-and-fold-icon="treeExpandAndFoldIconRender" @sort-change="sortChange" class="user-order" :hide-sort-tips="true">
        <template slot="sortIcon">
          <t-icon name="caret-down-small"></t-icon>
        </template>
        <template #id="{row}">
          <!-- <span v-if="row.type" @click="itemClick(row)" class="order-id" :class="{'com-no-child': row.order_item_count <= 1}">
            <t-icon :name="row.isExpand ? 'caret-up-small' : 'caret-down-small'" v-if="row.order_item_count > 1">
            </t-icon>
            {{row.id}}
          </span> -->
          <span @click="lookDetail(row)" v-if="row.type" class="aHover">
           {{row.id}}
          </span>
          <span v-else class="child">-</span>
        </template>
        <template #type="{row}">
          {{lang[row.type]}}
        </template>
        <template #client_name="{row}">
          <a :href="`client_detail.htm?client_id=${row.client_id}`" class="aHover">
            <template>
              <span v-if="row.client_name">{{row.client_name}}</span>
              <span v-else-if="row.phone">+{{row.phone_code}}-{{row.phone}}</span>
              <span v-else="row.email">{{row.email}}</span>
            </template>
            <span v-if="row.company">({{row.company}})</span>
          </a>
        </template>
        <template #create_time="{row}">
          {{row.type ? moment(row.create_time * 1000).format('YYYY-MM-DD HH:mm') : ''}}
        </template>
        <template #icon="{row}">
          <template v-if="row.type">
            <t-tooltip :content="lang[row.type]" theme="light" :show-arrow="false" placement="top-right">
              <img :src="`${rootRul}img/icon/${row.type}.png`" alt="" style="position: relative; top: 3px;">
            </t-tooltip>
          </template>
        </template>
        <template #product_names={row}>
          <template v-if="row.product_names">
            <div v-if="row.description">
              <t-tooltip theme="light" :show-arrow="false" placement="top-right">
                <div slot="content" class="tool-content">{{row.description}}</div>
                <!--  <span @click="itemClick(row)" class="hover">{{row.product_names[0]}}</span> -->
                <a class="aHover" :href="`host_detail.htm?client_id=${row.client_id}&id=${row.host_id}`">{{row.product_names[0]}}</a>
                <span v-if="row.product_names.length>1"  class="hover">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
              </t-tooltip>
            </div>
            <div v-else>
              <!-- @click="itemClick(row)" -->
              <span class="hover"  @click="lookDetail(row)">{{row.product_names[0]}}</span>
              <span v-if="row.product_names.length>1" @click="lookDetail(row)"  class="hover">{{lang.wait}}{{row.product_names.length}}{{lang.products}}</span>
            </div>
          </template>
          <span v-else class="child-name">
            <t-tooltip theme="light" :show-arrow="false" placement="top-right">
              <div slot="content" class="tool-content">{{row.description}}</div>
              <!-- <span @click="childItemClick(row)">{{row.product_name ? row.product_name : row.description}}
              <span class="host-name" v-if="row.host_name">({{row.host_name}})</span>
            </span> -->
              <a :href="`host_detail.htm?client_id=${father_client_id}&id=${row.host_id}`" class="aHover">{{row.product_name ? row.product_name : row.description}}
                <span class="host-name" v-if="row.host_name">({{row.host_name}})</span>
              </a>
            </t-tooltip>
          </span>
        </template>
        <template #amount="{row}">
          {{currency_prefix}}&nbsp;{{row.amount}}
          <!-- 升降机为退款时不显示周期 -->
          <span v-if="row.billing_cycle && Number(row.amount) >= 0 && row.type!=='upgrade'">/{{row.billing_cycle}}</span>
        </template>
        <template #profit="{row}">
          {{currency_prefix}}&nbsp;{{row.profit}}
        </template>
        <template #status="{row}">
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Cancelled'" class="canceled order-canceled">{{lang.canceled}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Refunded'" class="canceled order-refunded">{{lang.refunded}}
          </t-tag>
          <t-tag theme="warning" variant="light" v-if="(row.status || row.host_status)==='Unpaid'" class="order-unpaid">{{lang.Unpaid}}
          </t-tag>
          <t-tag theme="primary" variant="light" v-if="row.status==='Paid'" class="order-paid">{{lang.Paid}}
          </t-tag>
          <t-tag theme="primary" variant="light" v-if="row.host_status === 'Pending'">
            {{lang.Pending}}
          </t-tag>
          <t-tag theme="success" variant="light" v-if="(row.status || row.host_status)==='Active'">{{lang.Active}}
          </t-tag>
          <t-tag theme="danger" variant="light" v-if="(row.status || row.host_status)==='Failed'">{{lang.Failed}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Suspended'">
            {{lang.Suspended}}
          </t-tag>
          <t-tag theme="default" variant="light" v-if="(row.status || row.host_status)==='Deleted'" class="delted">{{lang.Deleted}}
          </t-tag>
          <t-tag theme="warning" variant="light" v-if="row.status ==='WaitUpload'">{{lang.order_wait_upload}}</t-tag>
          <t-tag theme="warning" variant="light" v-if="row.status ==='WaitReview'">{{lang.order_wait_review}}</t-tag>
          <t-tag theme="danger" variant="light" v-if="row.status ==='ReviewFail'">{{lang.order_review_fail}}</t-tag>
        </template>
        <template #gateway="{row}">
          <!-- 其他支付方式 -->
          <template v-if="row.credit == 0">
            {{row.gateway}}
          </template>
          <!-- 混合支付 -->
          <template v-if="row.credit * 1 >0 && row.credit * 1 < row.amount * 1 && row.gateway_sign !== 'credit'">
            <t-tooltip :content="currency_prefix+row.credit" theme="light" placement="bottom-right">
              <span class="theme-color">{{lang.credit}}</span>
            </t-tooltip>
            <span>{{row.gateway ? '+ ' + row.gateway: '' }}</span>
          </template>
          <template v-if="row.gateway_sign === 'credit'">
            <span>{{lang.credit}}</span>
          </template>
        </template>
        <template #op="{row}">
          <template v-if="row.type">
            <t-tooltip :content="`${lang.look}${lang.detail}`" :show-arrow="false" theme="light">
              <t-icon name="view-module" class="common-look" @click="lookDetail(row)" v-permission="'auth_upstream_downstream_supplier_detail_order_list_check_order'"></t-icon>
            </t-tooltip>
            <t-tooltip :content="lang.update_price" :show-arrow="false" theme="light">
              <t-icon name="money-circle" class="common-look" @click="updatePrice(row, 'order')"
              v-if="row.status!=='Paid' && row.status!=='Cancelled' && row.status!=='Refunded' && $checkPermission('auth_upstream_downstream_supplier_detail_order_list_update_order')"></t-icon>
            </t-tooltip>
            <!-- <t-tooltip :content="lang.sign_pay" :show-arrow="false" theme="light" v-show="row.status!=='Paid' && row.status!=='Cancelled' && row.status!=='Refunded'">
            <t-icon name="discount" class="common-look" :class="{disable:row.status==='Paid'}" @click="signPay(row)"></t-icon>
          </t-tooltip> -->
            <t-tooltip :content="lang.delete" :show-arrow="false" theme="light">
              <t-icon name="delete" class="common-look" @click="delteOrder(row)" v-permission="'auth_upstream_downstream_supplier_detail_order_list_delete_order'"></t-icon>
            </t-tooltip>
          </template>
          <template v-else>
            <t-tooltip :content="lang.edit" :show-arrow="false" theme="light" v-if="row.edit && $checkPermission('auth_upstream_downstream_supplier_detail_order_list_update_order')">
              <t-icon name="edit" size="18px" @click="updatePrice(row, 'sub')" class="common-look"></t-icon>
            </t-tooltip>
          </template>
        </template>
      </t-enhanced-table>

      <t-pagination show-jumper :total="total" :page-size="params.limit" :current="params.page" :page-size-options="pageSizeOptions" @change="changePage" v-if="total" />
    </t-card>
    <!-- 删除 -->
    <t-dialog :header="lang.deleteOrder" :visible.sync="delVisible" class="delDialog" width="600">
      <template slot="body">
        <p>
          <t-icon name="error-circle" size="18" style="color:var(--td-warning-color);"></t-icon>
          &nbsp;&nbsp;{{lang.sureDelete}}
        </p>
        <div class="check">
          <t-checkbox v-model="delete_host"></t-checkbox>
          <div class="tips">
            <p class="tit">{{lang.deleteOrderTip1}}<span class="com-red">{{lang.deleteOrderTip3}}</span></p>
            <p class="tip">({{lang.deleteOrderTip2}})</p>
          </div>
        </div>
      </template>
      <template slot="footer">
        <div class="common-dialog">
          <t-button @click="onConfirm">{{lang.sure}}</t-button>
          <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
        </div>
      </template>
    </t-dialog>
    <!-- 调整价格 -->
    <t-dialog :header="lang.update_price" :visible.sync="priceModel" :footer="false">
      <t-form :data="formData" ref="update_price" @submit="onSubmit" :rules="rules" reset-type="initial">
        <t-form-item :label="lang.change_money" name="amount">
          <t-input v-model="formData.amount" type="tel" :label="currency_prefix" :placeholder="lang.money"></t-input>
        </t-form-item>
        <t-form-item :label="lang.description" name="description">
          <t-textarea :placeholder="lang.description" v-model="formData.description" />
        </t-form-item>
        <div class="com-f-btn">
          <t-button theme="primary" type="submit">{{lang.sure}}</t-button>
          <t-button theme="default" variant="base" @click="priceModel=false">{{lang.cancel}}</t-button>
        </div>
      </t-form>
    </t-dialog>
  </com-config>
</div>
<!-- =======页面独有======= -->

<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/common.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/upstream.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/api/client.js"></script>
<script src="/<?php echo htmlentities($template_catalog); ?>/template/<?php echo htmlentities($themes); ?>/js/supplier_order.js"></script>
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

