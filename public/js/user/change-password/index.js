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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
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

/***/ "./resources/js/user/change-password/index.js":
/*!****************************************************!*\
  !*** ./resources/js/user/change-password/index.js ***!
  \****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _common_notify__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../common/notify */ "./resources/js/common/notify.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var ChangePassword =
/*#__PURE__*/
function () {
  function ChangePassword() {
    _classCallCheck(this, ChangePassword);

    this.initObject();
    this.initValidator();
    this.initEvent();
  }

  _createClass(ChangePassword, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#password-change-form');
      this.$btn = $('#submit-btn');
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      this.$form.validate({
        rules: {
          new_password: {
            required: true,
            minlength: 6
          },
          confirm_password: {
            required: true,
            equalTo: "#new_password"
          }
        },
        messages: {
          new_password: {
            required: '请输入你的旧密码',
            minlength: '密码长度不能小于6位'
          },
          confirm_password: {
            required: '请输入确认密码',
            equalTo: '两次输入的确认密码不一致，请重新输入'
          }
        },
        errorClass: 'invalid-tooltip',
        errorElement: 'span',
        highlight: function highlight(element, errorClass) {
          $(element).removeClass(errorClass);
        }
      });
    }
  }, {
    key: "initEvent",
    value: function initEvent() {
      var _this = this;

      this.$btn.click(function () {
        if (_this.$form.valid()) {
          $.post(_this.$form.attr('action'), _this.$form.serialize(), function (response) {
            if (!response.code) {
              Object(_common_notify__WEBPACK_IMPORTED_MODULE_0__["notify"])('success', '用户新密码保存成功过');
              setTimeout("window.location.reload();", 1000);
            } else {
              Object(_common_notify__WEBPACK_IMPORTED_MODULE_0__["notify"])('danger', '新密码保存失败，请联系网站管理员');
            }
          });
        }
      });
    }
  }]);

  return ChangePassword;
}();

new ChangePassword();

/***/ }),

/***/ 14:
/*!**********************************************************!*\
  !*** multi ./resources/js/user/change-password/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/user/change-password/index.js */"./resources/js/user/change-password/index.js");


/***/ })

/******/ });