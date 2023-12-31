/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./assets/src/apps/js/frontend/lp-configs.js ***!
  \***************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   classNames: function() { return /* binding */ classNames; },
/* harmony export */   isQuestionCorrect: function() { return /* binding */ isQuestionCorrect; },
/* harmony export */   questionBlocks: function() { return /* binding */ questionBlocks; },
/* harmony export */   questionChecker: function() { return /* binding */ questionChecker; },
/* harmony export */   questionFooterButtons: function() { return /* binding */ questionFooterButtons; },
/* harmony export */   questionTitleParts: function() { return /* binding */ questionTitleParts; },
/* harmony export */   quizStartBlocks: function() { return /* binding */ quizStartBlocks; }
/* harmony export */ });
const {
  Hook
} = LP;
const classNames = {
  Quiz: {
    Result: ['quiz-result'],
    Content: ['quiz-content'],
    Questions: ['quiz-questions'],
    Buttons: ['quiz-buttons'],
    Attempts: ['quiz-attempts']
  }
};
const questionCheckers = {
  single_choice() {},
  multi_choice() {},
  true_or_false() {}
};
const isQuestionCorrect = {
  fill_in_blank() {
    return true;
  }
};

/**
 * Question blocks.
 *
 * Allow to sort the blocks of question
 */
const questionBlocks = function () {
  return LP.Hook.applyFilters('question-blocks', ['title', 'content', 'answer-options', 'explanation', 'hint', 'buttons']);
};
const questionFooterButtons = function () {
  return LP.Hook.applyFilters('question-footer-buttons', ['instant-check']);
};
const questionTitleParts = function () {
  return LP.Hook.applyFilters('question-title-parts', ['index', 'title', 'hint', 'edit-permalink']);
};
const questionChecker = function (type) {
  const c = LP.Hook.applyFilters('question-checkers', questionCheckers);
  return type && c[type] ? c[type] : function () {
    return {};
  };
};
const quizStartBlocks = function () {
  const blocks = Hook.applyFilters('quiz-start-blocks', {
    meta: true,
    description: true,
    custom: 'Hello'
  });
};
(window.LP = window.LP || {}).config = __webpack_exports__;
/******/ })()
;
//# sourceMappingURL=lp-configs.js.map