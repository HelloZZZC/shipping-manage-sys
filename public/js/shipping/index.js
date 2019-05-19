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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/shipping/index.js":
/*!****************************************!*\
  !*** ./resources/js/shipping/index.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Shipping =
/*#__PURE__*/
function () {
  function Shipping() {
    _classCallCheck(this, Shipping);

    this.initObject();
    this.initValidator();
    this.initEvent();
    this.fixTableColumn();
  }

  _createClass(Shipping, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#price-calculate-form');
      this.$radio = $('[ name = "calc_mode"]');
      this.$priceInput = $('[ name = "price"]');
      this.$fixedGrossMarginInput = $('[ name = "fixed_gross_margin"]');
      this.$btn = $('#search-btn');
      this.$table = $('.table');
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      this.$form.validate({
        rules: {
          price_basis_type: "required",
          discount_rate: "required",
          weight: "required",
          profit: "required",
          fixed_gross_margin: "required"
        },
        messages: {
          price_basis_type: {
            required: '请选择重量范围'
          },
          discount_rate: {
            required: '请输入平台折扣率'
          },
          weight: {
            required: '请输入重量'
          },
          profit: {
            required: '请输入产品成本'
          },
          fixed_gross_margin: {
            required: '请输入固定毛利率'
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
      this.$radio.click(function () {
        var mode = $('[ name = "calc_mode"]:checked').val();

        if (mode === 'fixed_gross_margin') {
          _this.$priceInput.val('').attr("disabled", true);

          _this.$fixedGrossMarginInput.attr("disabled", false);

          _this.$fixedGrossMarginInput.rules('add', {
            required: true,
            messages: {
              required: '请输入固定毛利率'
            }
          });

          _this.$priceInput.rules('remove', 'required');
        } else {
          _this.$priceInput.attr("disabled", false);

          _this.$fixedGrossMarginInput.val('').attr("disabled", true);

          _this.$priceInput.rules('add', {
            required: true,
            messages: {
              required: '请输入售价'
            }
          });

          _this.$fixedGrossMarginInput.rules('remove', 'required');
        }

        _this.$form.valid();
      });
    }
  }, {
    key: "fixTableColumn",
    value: function fixTableColumn() {
      var _this2 = this;

      var $fixedColumn = this.$table.clone().insertBefore(this.$table).addClass('fixed-column');
      $fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();
      $fixedColumn.find('tr').each(function (i) {
        $(_this2).height(_this2.$table.find('tr:eq(' + i + ')').height());
      });
    }
  }]);

  return Shipping;
}();

new Shipping();

/***/ }),

/***/ 5:
/*!**********************************************!*\
  !*** multi ./resources/js/shipping/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/shipping/index.js */"./resources/js/shipping/index.js");


/***/ })

/******/ });