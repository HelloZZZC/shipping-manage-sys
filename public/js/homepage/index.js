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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/homepage/index.js":
/*!****************************************!*\
  !*** ./resources/js/homepage/index.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Homepage =
/*#__PURE__*/
function () {
  function Homepage() {
    _classCallCheck(this, Homepage);

    this.initObject();
    this.initTimer();
  }

  _createClass(Homepage, [{
    key: "initObject",
    value: function initObject() {
      this.$beijingTimer = $('.js-beijing-time');
      this.$moscowTimer = $('.js-moscow-time');
      this.$newyorkTimer = $('.js-newyork-time');
    }
  }, {
    key: "initTimer",
    value: function initTimer() {
      var _this = this;

      setInterval(function () {
        _this.setHomepageDate();
      }, 1000);
    }
  }, {
    key: "setHomepageDate",
    value: function setHomepageDate() {
      this.$beijingTimer.html(this.getLocaleTime(8));
      this.$moscowTimer.html(this.getLocaleTime(3));
      this.$newyorkTimer.html(this.getLocaleTime(-5));
    }
  }, {
    key: "getLocaleTime",
    value: function getLocaleTime(index) {
      var $date = new Date();
      var len = $date.getTime();
      var offset = $date.getTimezoneOffset() * 60000;
      var UTCTime = len + offset;
      return this.transformTime('MM-dd hh:mm:ss', UTCTime + 3600000 * index);
    }
  }, {
    key: "transformTime",
    value: function transformTime(format, date) {
      var $date = new Date(date);
      var $format = {
        "M+": $date.getMonth() + 1,
        "d+": $date.getDate(),
        "h+": $date.getHours(),
        "m+": $date.getMinutes(),
        "s+": $date.getSeconds(),
        "q+": Math.floor(($date.getMonth() + 3) / 3),
        "S": $date.getMilliseconds()
      };
      if (/(y+)/.test(format)) format = format.replace(RegExp.$1, ($date.getFullYear() + "").substr(4 - RegExp.$1.length));

      for (var index in $format) {
        if (new RegExp("(" + index + ")").test(format)) format = format.replace(RegExp.$1, RegExp.$1.length === 1 ? $format[index] : ("00" + $format[index]).substr(("" + $format[index]).length));
      }

      return format;
    }
  }]);

  return Homepage;
}();

new Homepage();

/***/ }),

/***/ 6:
/*!**********************************************!*\
  !*** multi ./resources/js/homepage/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/homepage/index.js */"./resources/js/homepage/index.js");


/***/ })

/******/ });