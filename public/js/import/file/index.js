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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/import/file/index.js":
/*!*******************************************!*\
  !*** ./resources/js/import/file/index.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var ImportFile =
/*#__PURE__*/
function () {
  function ImportFile() {
    _classCallCheck(this, ImportFile);

    this.initObject();
    this.initValidator();
    this.initEvent();
  }

  _createClass(ImportFile, [{
    key: "initObject",
    value: function initObject() {
      this.$form = $('#import-form');
      this.$selectFileInput = $('.js-select-file');
      this.$fileInput = $('.js-file');
      this.$showFileInput = $('.js-show-file');
      this.$saveBtn = $('#save-btn');
      this.$progress = $('.progress');
      this.$progressBar = this.$progress.find('.progress-bar');
      this.$formContainer = $('.js-form-container');
      this.$jsFooter = $('.js-footer');
    }
  }, {
    key: "initValidator",
    value: function initValidator() {
      this.$form.validate({
        ignore: [],
        rules: {
          file: "required"
        },
        messages: {
          file: {
            required: '请选择一个excel文件'
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

      this.$selectFileInput.on('click', function () {
        _this.$fileInput.click();
      });
      this.$fileInput.on('change', function () {
        _this.$showFileInput.val(_this.$fileInput.val());

        _this.$form.valid();
      });
      this.$saveBtn.on('click', function () {
        if (_this.$form.valid()) {
          var importPrepareUrl = _this.$saveBtn.data('importPrepareUrl');

          _this.$formContainer.hide();

          _this.$jsFooter.hide();

          _this.$progress.show();

          $.post(importPrepareUrl, _this.$form.serialize(), function (response) {
            if (!response.code) {
              _this.$progressBar.css('width', response.data.progress + '%');

              _this.$progressBar.attr('aria-valuenow', response.data.progress);

              _this["import"]();
            } else {
              _this.showError(response.data.progress);
            }
          });
        }
      });
    }
  }, {
    key: "import",
    value: function _import() {
      var _this2 = this;

      var formData = new FormData(this.$form[0]);
      var importUrl = this.$saveBtn.data('importUrl');
      $.ajax({
        url: importUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function success(response) {
          if (!response.code) {
            _this2.$progressBar.css('width', response.data.progress + '%');

            _this2.$progressBar.attr('aria-valuenow', response.data.progress);

            _this2.$progressBar.addClass('bg-success');

            var dismissBtn = "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">\u786E\u5B9A</button>";

            _this2.$jsFooter.html(dismissBtn).show();
          } else {
            _this2.showError(response.data.progress);
          }
        },
        error: function error(response) {
          console.log(response);
        }
      });
    }
  }, {
    key: "showError",
    value: function showError(progress) {
      this.$progressBar.css('width', progress + '%');
      this.$progressBar.attr('aria-valuenow', progress);
      this.$progressBar.addClass('bg-danger');
      var dismissBtn = "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">\u786E\u5B9A</button>";
      this.$jsFooter.html(dismissBtn).show();
    }
  }]);

  return ImportFile;
}();

new ImportFile();

/***/ }),

/***/ 4:
/*!*************************************************!*\
  !*** multi ./resources/js/import/file/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /private/var/www/laravel-repository/shipping-manage-sys/resources/js/import/file/index.js */"./resources/js/import/file/index.js");


/***/ })

/******/ });