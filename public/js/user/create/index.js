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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/user/create/index.js":
/*!*******************************************!*\
  !*** ./resources/js/user/create/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var CreateUser =
/*#__PURE__*/
function () {
  function CreateUser() {
    _classCallCheck(this, CreateUser);

    this.initObject();
    this.initRules();
    this.initValidator();
    this.initEvent();
  }

  _createClass(CreateUser, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#create-user-form');
      this.$btn = $('#save-btn');
    }
  }, {
    key: "initRules",
    value: function initRules() {
      jQuery.validator.addMethod('mobile', function (value, element) {
        var reg = /^1\d{10}$/;
        return this.optional(element) || reg.test(value);
      }, '请输入正确的手机号格式');
      jQuery.validator.addMethod('nickname', function (value, element) {
        var reg = /^[a-zA-Z0-9_]+$/i;
        return this.optional(element) || reg.test(value);
      }, '账号必须是英文字母、数字及下划线组成');
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      this.$form.validate({
        rules: {
          nickname: {
            required: true,
            nickname: true
          },
          email: {
            required: true,
            email: true
          },
          mobile: {
            required: true,
            mobile: true
          },
          password: {
            required: true,
            minlength: 6
          },
          confirm_password: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          nickname: {
            required: '请输入账号'
          },
          email: {
            required: '请输入邮箱',
            email: '请输入正确格式的邮箱'
          },
          mobile: {
            required: '请输入手机号'
          },
          password: {
            required: '请输入密码',
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
          _this.$form.submit();
        }
      });
    }
  }]);

  return CreateUser;
}();

new CreateUser();

/***/ }),

/***/ 8:
/*!*************************************************!*\
  !*** multi ./resources/js/user/create/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/user/create/index.js */"./resources/js/user/create/index.js");


/***/ })

/******/ });