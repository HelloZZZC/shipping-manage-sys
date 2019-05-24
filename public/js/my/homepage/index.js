/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/common/notify.js":
/*!***************************************!*\
  !*** ./resources/js/common/notify.js ***!
  \***************************************/
/*! exports provided: notify */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "notify", function() { return notify; });
function notify(type, msg) {
  $.notify({
    message: msg
  }, {
    element: 'body',
    type: type,
    allow_dismiss: false,
    placement: {
      from: "top",
      align: "center"
    },
    offset: 10,
    spacing: 10,
    z_index: 1051,
    delay: 1000,
    timer: 1000,
    animate: {
      enter: 'animated fadeInDown',
      exit: 'animated fadeOutUp'
    }
  });
}

/***/ }),

/***/ "./resources/js/common/validator-rule.js":
/*!***********************************************!*\
  !*** ./resources/js/common/validator-rule.js ***!
  \***********************************************/
/*! exports provided: init */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "init", function() { return init; });
function init() {
  jQuery.validator.addMethod('mobile', function (value, element) {
    var reg = /^1\d{10}$/;
    return this.optional(element) || reg.test(value);
  }, '请输入正确的手机号格式');
  jQuery.validator.addMethod('nickname', function (value, element) {
    var reg = /^[a-zA-Z0-9]+$/i;
    return this.optional(element) || reg.test(value);
  }, '账号必须是英文字母、数字组成');
}

/***/ }),

/***/ "./resources/js/my/homepage/index.js":
/*!*******************************************!*\
  !*** ./resources/js/my/homepage/index.js ***!
  \*******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _common_validator_rule__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../common/validator-rule */ "./resources/js/common/validator-rule.js");
/* harmony import */ var _common_notify__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../common/notify */ "./resources/js/common/notify.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }




var MyHomepage =
/*#__PURE__*/
function () {
  function MyHomepage() {
    _classCallCheck(this, MyHomepage);

    this.initObject();
    this.initDatePicker();
    this.initValidator();
    this.initUploader();
    this.initEvent();
  }

  _createClass(MyHomepage, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#my-profile-form');
      this.$saveBtn = $('#save-btn');
      this.$birthdayInput = $('#birthday');
      this.$emailInput = $('#email');
      this.$mobileInput = $('#mobile');
      this.$uploadBtn = $('.js-avatar-uploader');
      this.$fileInput = $('.js-avatar');
      this.$uploadContainer = $('.js-upload-container');
      this.$modal = $('#static-modal');
    }
  }, {
    key: "initUploader",
    value: function initUploader() {
      var _this = this;

      var url = this.$uploadContainer.data('url');
      this.$uploadContainer.dmUploader({
        url: url,
        multiple: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        allowedTypes: "image/*",
        extFilter: ["jpg", "jpeg", "png", "gif"],
        maxFileSize: 2097152,
        // 2M
        onUploadError: function onUploadError(id, xhr, status, message) {
          Object(_common_notify__WEBPACK_IMPORTED_MODULE_1__["notify"])('danger', '上传图片失败');
        },
        onUploadSuccess: function onUploadSuccess(id, data) {
          var jsonResponse = JSON.stringify(data);
          var response = JSON.parse(jsonResponse);

          if (!response.code) {
            var gotoUrl = response.data.goto_url;
            var avatarUrl = response.data.avatar_url;
            $.get(gotoUrl, {
              avatar_url: avatarUrl
            }, function (response) {
              _this.$modal.html(response);

              _this.$modal.modal('show');
            });
          } else {
            Object(_common_notify__WEBPACK_IMPORTED_MODULE_1__["notify"])('danger', '服务处理上传图片失败');
          }
        }
      });
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      Object(_common_validator_rule__WEBPACK_IMPORTED_MODULE_0__["init"])();
      this.$form.validate({
        rules: {
          mobile: {
            required: true,
            remote: {
              url: this.$mobileInput.data('url'),
              type: 'get',
              data: {
                exclude: this.$mobileInput.val()
              }
            },
            mobile: true
          },
          email: {
            required: true,
            remote: {
              url: this.$emailInput.data('url'),
              type: 'get',
              data: {
                exclude: this.$emailInput.val()
              }
            },
            email: true
          },
          age: {
            digits: true,
            min: 0,
            max: 100
          },
          address: {
            maxlength: 300
          },
          about: {
            maxlength: 500
          }
        },
        messages: {
          verified_mobile: {
            required: '请输入手机号',
            mobile: '请输入正确格式的手机号',
            remote: '该手机号已被占用，请换一个手机号输入'
          },
          email: {
            required: '请输入邮箱',
            email: '请输入正确格式的邮箱',
            remote: '该邮箱已被占用，请换一个邮箱输入'
          },
          age: {
            digits: '年龄必须为整数',
            min: '年龄最小值为0',
            max: '年龄最大值为100'
          },
          address: {
            maxlength: '地址的最大长度为300字符（一个汉子一个字符）'
          },
          about: {
            maxlength: 'About ME的最大长度为500字符（一个汉子一个字符）'
          }
        },
        errorClass: 'invalid-tooltip unset-top',
        errorElement: 'span',
        highlight: function highlight(element, errorClass) {
          $(element).removeClass(errorClass);
        }
      });
    }
  }, {
    key: "initEvent",
    value: function initEvent() {
      var _this2 = this;

      this.$saveBtn.click(function () {
        if (_this2.$form.valid()) {
          $.post(_this2.$form.attr('action'), _this2.$form.serialize(), function (response) {
            if (!response.code) {
              Object(_common_notify__WEBPACK_IMPORTED_MODULE_1__["notify"])('success', '主页数据保存成功');
              setTimeout("window.location.reload();", 1000);
            } else {
              Object(_common_notify__WEBPACK_IMPORTED_MODULE_1__["notify"])('danger', '主页数据保存失败，请联系网站管理员');
            }
          });
        }
      });
      this.$uploadBtn.click(function () {
        _this2.$fileInput.click();
      });
    }
  }, {
    key: "initDatePicker",
    value: function initDatePicker() {
      this.$birthdayInput.datepicker({
        format: 'mm-dd',
        autoclose: true,
        maxViewMode: 'months',
        startView: 'months'
      });
    }
  }]);

  return MyHomepage;
}();

new MyHomepage();

/***/ }),

/***/ 11:
/*!*************************************************!*\
  !*** multi ./resources/js/my/homepage/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/my/homepage/index.js */"./resources/js/my/homepage/index.js");


/***/ })

/******/ });