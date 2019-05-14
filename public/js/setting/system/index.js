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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/setting/system/index.js":
/*!**********************************************!*\
  !*** ./resources/js/setting/system/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var SystemSetting =
/*#__PURE__*/
function () {
  function SystemSetting() {
    _classCallCheck(this, SystemSetting);

    this.initObject();
    this.initValidator();
    this.initEvent();
  }

  _createClass(SystemSetting, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#system-setting-form');
      this.$btn = $('#submit-btn');
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      this.$form.validate({
        rules: {
          exchange_rate: {
            required: true,
            min: 0
          },
          commission: {
            required: true,
            min: 0
          },
          e_mail_discount: {
            required: true,
            min: 0
          },
          china_post_discount: {
            required: true,
            min: 0
          },
          ali_standard_discount: {
            required: true,
            min: 0
          }
        },
        messages: {
          exchange_rate: {
            required: '请输入汇率',
            min: '汇率的值不能小于0'
          },
          commission: {
            required: '请输入佣金',
            min: '佣金的值不能小于0'
          },
          e_mail_discount: {
            required: '请输入E邮宝物流折扣',
            min: 'E邮宝物流折扣的值不能小于0'
          },
          china_post_discount: {
            required: '请输入挂号小包物流折扣',
            min: '挂号小包物流折扣的值不能小于0'
          },
          ali_standard_discount: {
            required: '请输入无忧标准物流折扣',
            min: '无忧标准物流折扣的值不能小于0'
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
      this.$btn.click(function () {
        return function () {
          if (this.$form.valid()) {
            this.$form.submit();
          }
        };
      });
    }
  }]);

  return SystemSetting;
}();

new SystemSetting();

/***/ }),

/***/ 2:
/*!****************************************************!*\
  !*** multi ./resources/js/setting/system/index.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/setting/system/index.js */"./resources/js/setting/system/index.js");


/***/ })

/******/ });