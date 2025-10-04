(function (window, undefined) {
  var old_onload = window.onload;
  window.onload = function () {
    const template = document.getElementsByClassName("configuration-theme")[0];

    Vue.prototype.lang = window.lang;
    new Vue({
      components: {
        comTinymce,
        comConfig,
      },
      mixins: [fixedFooter],
      data () {
        return {
          formData: {
            cart_instruction: 0,
            clientarea_theme_mobile_switch: "0",
            web_switch: "0",
            cart_change_product: "0",
          },
          value: "clientarea_theme",
          clientarea_type: "global_theme",
          clinetarea_switch: "pc",
          isCanUpdata: sessionStorage.isCanUpdata === "true",
          clientarea_theme: [],
          web_theme_list: [],
          cart_theme_list: [],
          cart_theme_mobile_list: [],
          clientarea_theme_mobile_list: [],
          rules: {
            clientarea_theme: [
              {
                required: true,
                message: lang.input + lang.site_name,
                type: "error",
              },
              {
                validator: (val) => val.length <= 255,
                message: lang.verify3 + 255,
                type: "warning",
              },
            ],
          },
          popupProps: {
            overlayInnerStyle: (trigger) => ({
              width: `${trigger.offsetWidth}px`,
            }),
          },
          submitLoading: false,
          hasController: true,
          host_model: "",
        };
      },
      created () {
        const queryName = this.getQuery("name");
        if (queryName) {
          this.value = queryName;
        }
        const navList = JSON.parse(localStorage.getItem("backMenus"));
        let tempArr = navList.reduce((all, cur) => {
          cur.child && all.push(...cur.child);
          return all;
        }, []);
        this.getActivePlugin();
        document.title =
          lang.theme_setting + "-" + localStorage.getItem("back_website_name");
      },
      mounted () {
        this.getTheme();
      },
      methods: {
        changeClient (val) {
          if (val === "cart_theme" && this.formData.cart_instruction === 1) {
            this.$nextTick(() => {
              this.$refs.comTinymce &&
                this.$refs.comTinymce.setContent(
                  this.formData.cart_instruction_content
                );
            });
          }
        },
        getHostModelList (name, type) {
          return (
            this.formData?.module_list?.find((item) => item.name === name)?.[
            type
            ] || []
          );
        },
        changeCartInstruction (val) {
          if (val === 1) {
            this.$nextTick(() => {
              this.$refs.comTinymce &&
                this.$refs.comTinymce.setContent(
                  this.formData.cart_instruction_content
                );
            });
          }
        },
        changeTab (value) {
          if (value === "cart_theme") {
            this.$nextTick(() => {
              this.$refs.comTinymce &&
                this.$refs.comTinymce.setContent(
                  this.formData.cart_instruction_content
                );
            });
          }
        },
        getQuery (name) {
          const reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
          const r = window.location.search.substr(1).match(reg);
          if (r != null) return decodeURI(r[2]);
          return null;
        },
        async getActivePlugin () {
          const res = await getActiveAddon();
          this.hasController = (res.data.data.list || [])
            .map((item) => item.name)
            .includes("TemplateController");
        },
        jumpController (item) {
          event.stopPropagation();
          location.href = `${location.origin}/${location.pathname.split("/")[1]
            }/${item.url}?theme=${item.name}`;
        },

        selectTheme (type, name, host_model) {
          if (host_model) {
           // this.formData[type][host_model] = this.formData[type][host_model] == "" ? name : "";
           this.formData[type][host_model] = name;
          } else {
            this.formData[type] = name;
          }
        },

        async onSubmit ({ validateResult, firstError }) {
          if (validateResult === true) {
            try {
              this.submitLoading = true;

              const params = { ...this.formData };
              if (this.$refs.comTinymce) {
                params.cart_instruction_content =
                  this.$refs.comTinymce.getContent() || "";
              }
              const res = await updateThemeConfig(params);
              this.$message.success(res.data.msg);
              this.getTheme();
              this.submitLoading = false;
            } catch (error) {
              this.submitLoading = false;
              this.$message.error(error.data.msg);
            }
          } else {
            console.log("Errors: ", validateResult);
          }
        },
        async getTheme () {
          try {
            const res = await getThemeConfig();
            const temp = res.data.data;
            this.formData = Object.assign({}, temp);
            this.formData.cart_theme_mobile =
              temp.clientarea_theme_mobile_switch == 0
                ? temp.cart_theme_mobile_list[0]?.name || ""
                : temp.cart_theme_mobile;

            this.formData.clientarea_theme_mobile =
              temp.clientarea_theme_mobile_switch == 0
                ? temp.clientarea_theme_mobile_list[0]?.name || ""
                : temp.clientarea_theme_mobile;
            this.$refs.comTinymce.setContent(temp.cart_instruction_content);
          } catch (error) { }
        },
      },
    }).$mount(template);
    typeof old_onload == "function" && old_onload();
  };
})(window);
