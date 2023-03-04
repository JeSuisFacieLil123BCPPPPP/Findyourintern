"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_mana_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      users: [],
      data: [],
      loading: false,
      busy: false,
      // firstPage: 1,
      nextPage: 0,
      total: 0,
      currentPage: 0,
      lastPage: 0,
      fini: false
    };
  },
  methods: {
    getInitialUsers: function getInitialUsers() {
      var _this = this;

      this.loading = true;
      axios.get("/api/v1/realisations/" + 151 + "/commentsPaginate", {
        params: {
          page: 1
        }
      }).then(function (res) {
        console.log("res");
        console.log(res.data.data);
        _this.data = res.data.data;
        _this.total = res.data.meta.total;
        _this.lastPage = res.data.meta.last_page; //  this.currentPage = res.data.meta.currentPage;

        _this.nextPage = _this.nextPage < _this.lastPage ? 2 : _this.lastPage;
        _this.loading = false; // this.users = response.data.results;
      });
    },
    getNextUser: function getNextUser() {
      var _this2 = this;

      window.onscroll = function () {
        //console.log(document.documentElement.scrollTop);
        //console.log(window.innerHeight);
        // console.log(document.documentElement.offsetHeight);
        console.log(document.documentElement);
        console.log("window.innerHeight");
        console.log(window.innerHeight);
        console.log("srolltop");
        console.log(document.documentElement.scrollTop);
        console.log("window");
        console.log(window); // console.log("celine");
        //  console.log(Number(document.getElementById("celine").style.height));
        // console.log(document.getElementById("celine").style.height);

        /* let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.documentElement.scrollHeight;*/

        /* let bottomOfWindow =
          document.documentElement.scrollTop + window.innerHeight ===
          document.getElementById("celine").style.height;*/

        var bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.scrollHeight;

        if (_this2.data.length >= _this2.total) {
          // this.$message.warning("Infinite List loaded all");
          _this2.loading = false;
          _this2.fini = true;
          return;
        }

        if (bottomOfWindow && _this2.fini == false) {
          _this2.loading = true;
          axios.get("/api/v1/realisations/" + 151 + "/commentsPaginate", {
            params: {
              page: _this2.nextPage
            }
          }).then(function (res) {
            _this2.data = _this2.data.concat(res.data.data); //this.data = res.data.data;

            _this2.currentPage = res.data.meta.currentPage || _this2.currentPage;
            _this2.nextPage = _this2.nextPage < _this2.lastPage ? _this2.nextPage + 1 : _this2.lastPage;
            _this2.loading = false;
          });
        }
      };
    }
  },
  mounted: function mounted() {
    console.log("monted");
    this.getNextUser();
  },
  beforeMount: function beforeMount() {
    console.log("befmonted");
    this.getInitialUsers();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
      _c = _vm._self._c;

  return _c("div", {}, [_c("a-list", {
    attrs: {
      "data-source": _vm.data
    },
    scopedSlots: _vm._u([{
      key: "renderItem",
      fn: function fn(item, index) {
        return _c("a-list-item", {}, [_c("a-list-item-meta", {
          attrs: {
            description: item.user.email
          }
        }, [_c("a", {
          attrs: {
            slot: "title",
            href: item.user.pseudo
          },
          slot: "title"
        }, [_vm._v(_vm._s(item.user.pseudo))]), _vm._v(" "), item.user.avatar != null ? _c("a-avatar", {
          attrs: {
            slot: "avatar",
            src: item.user.avatar.url
          },
          slot: "avatar"
        }) : _c("vs-avatar")], 1), _vm._v(" "), _c("div", [_vm._v(_vm._s(item.body))])], 1);
      }
    }])
  }, [_vm._v(" "), _vm.loading && !_vm.fini ? _c("div", {
    staticClass: "demo-loading-container"
  }, [_c("a-spin")], 1) : _vm._e()])], 1);
};

var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.user {\r\n  display: flex;\r\n  background: #ccc;\r\n  border-radius: 1em;\r\n  margin: 1em auto;\n}\n.user-avatar {\r\n  padding: 1em;\n}\n.user-avatar img {\r\n  display: block;\r\n  width: 100%;\r\n  min-width: 64px;\r\n  height: auto;\r\n  border-radius: 50%;\n}\n.user-details {\r\n  padding: 1em;\n}\n.user-name {\r\n  margin: 0;\r\n  padding: 0;\r\n  font-size: 2rem;\r\n  font-weight: 900;\n}\n.demo-loading {\r\n  position: absolute;\r\n  bottom: 40px;\r\n  width: 100%;\r\n  text-align: center;\n}\n.demo-infinite-container {\r\n  border: 1px solid #e8e8e8;\r\n  border-radius: 4px;\r\n  overflow: auto;\r\n  padding: 8px 24px;\r\n  height: 300px;\n}\n.demo-loading-container {\r\n  position: absolute;\r\n  bottom: 40px;\r\n  width: 100%;\r\n  text-align: center;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_style_index_0_id_b1d4c4dc_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_style_index_0_id_b1d4c4dc_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_style_index_0_id_b1d4c4dc_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/mana.vue":
/*!******************************************!*\
  !*** ./resources/js/components/mana.vue ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mana.vue?vue&type=template&id=b1d4c4dc& */ "./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc&");
/* harmony import */ var _mana_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mana.vue?vue&type=script&lang=js& */ "./resources/js/components/mana.vue?vue&type=script&lang=js&");
/* harmony import */ var _mana_vue_vue_type_style_index_0_id_b1d4c4dc_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& */ "./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _mana_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__.render,
  _mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/mana.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/mana.vue?vue&type=script&lang=js&":
/*!*******************************************************************!*\
  !*** ./resources/js/components/mana.vue?vue&type=script&lang=js& ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./mana.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc&":
/*!*************************************************************************!*\
  !*** ./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc& ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_template_id_b1d4c4dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./mana.vue?vue&type=template&id=b1d4c4dc& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=template&id=b1d4c4dc&");


/***/ }),

/***/ "./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_mana_vue_vue_type_style_index_0_id_b1d4c4dc_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader/dist/cjs.js!../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/mana.vue?vue&type=style&index=0&id=b1d4c4dc&lang=css&");


/***/ })

}]);