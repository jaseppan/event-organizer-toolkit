/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
const {
  registerBlockType
} = wp.blocks;
const {
  ServerSideRender
} = wp.blockEditor; // Corrected this import
const {
  createElement
} = wp.element; // Added for JSX

registerBlockType('eot/my-block', {
  title: 'My EOT Block',
  icon: 'smiley',
  category: 'common',
  attributes: {
    formID: {
      type: 'number'
    }
    // ... other attributes
  },

  edit: function () {
    return createElement("div", null, "Hello, EOT!");
  },
  save: function () {
    return createElement("div", null, "Hello, EOT!");
  }
});
/******/ })()
;
//# sourceMappingURL=index.js.map