/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/event/block.js":
/*!************************************!*\
  !*** ./src/modules/event/block.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);

const {
  registerBlockType
} = wp.blocks;


// Register eot/event block
registerBlockType('eot/event', {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Event', 'text-domain'),
  icon: 'format-aside',
  category: 'common',
  supports: {
    align: ['full']
  },
  edit: function (props) {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Event', 'text-domain')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "eot-event-container"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "eot-event-container-inner"
    })));
  },
  save: function (props) {
    return null;
  }
});

/***/ }),

/***/ "./src/modules/student-registration-form/block.js":
/*!********************************************************!*\
  !*** ./src/modules/student-registration-form/block.js ***!
  \********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _block_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./block.scss */ "./src/modules/student-registration-form/block.scss");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_6__);

const {
  registerBlockType
} = wp.blocks;








// Block's edit function
function Edit(props) {
  const {
    attributes,
    setAttributes,
    isSaving,
    isAutoSaving,
    isPostSaving,
    title,
    metaData
  } = props;
  if (!title) {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Please add a title and save the post before editing this block.')));
  }
  const {
    courseId,
    courseName,
    coursePrices,
    invoiceName,
    invoiceAddress,
    invoiceCity,
    invoiceZip,
    invoiceCountry,
    invoicePhone,
    invoiceEmail,
    participantName,
    participantDataOfBirth,
    accommodationPrice,
    participantSex,
    dateOfArrival,
    dateOfDeparture,
    catering,
    meals,
    diets,
    instrument,
    instrumentRent,
    instrumentRentPrice,
    skillDescription,
    additionalInfo,
    courseExpectations
  } = attributes;

  // Get post_id of course default language version
  const postId = wp.data.select('core/editor').getCurrentPostId();
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_6__.useEffect)(() => {
    if (!courseId) {
      const defaultLanguagePostId = getDefaultLanguagePostId(postId);
      setAttributes({
        courseId: defaultLanguagePostId
      });
    }
  }, []);
  const tabs = [{
    name: 'Course Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Course Information', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "eot-notification notice"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Define course prices in this tab.', 'event-organizer-toolkit'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Course Name', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: title,
        disabled: true
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Course Id', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: courseId
        // onChange={ ( event ) => setAttributes({ courseId: event.target.value }) }
        ,
        disabled: true
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(CoursePrices, {
        coursePrices: coursePrices,
        setAttributes: setAttributes
      }));
    }
  }, {
    name: 'Invoice Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Invoice Information', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "eot-notification notice"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('This tab does not require editing', 'event-manager-toolbox'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Name', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Email', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Address', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('City', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Zip', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Country', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Phone', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      }))));
    }
  }, {
    name: 'Participant Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Participant Information', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Name', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
        type: "text",
        value: ""
      })));
    }
  }, {
    name: 'Accommodation',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Accommodation', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Test"));
    }
  }, {
    name: 'Catering',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Catering', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Test"));
    }
  }, {
    name: 'Instrument Related Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Instrument Related Information', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Test"));
    }
  }, {
    name: 'Additional Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Additional Information', 'event-organized-toolkit'),
    content: function () {
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Test"));
    }
  }];
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TabPanel, {
    className: "student-registration-form-tabs",
    activeClass: "active-tab",
    tabs: tabs
  }, tab => tab.content());
}

// Wrap your block's edit function with withSelect
const EnhancedEdit = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_5__.withSelect)(select => {
  const {
    isSavingPost,
    isAutosavingPost
  } = select('core/editor');
  const {
    getCurrentPost
  } = select('core/editor');
  const {
    title
  } = getCurrentPost();
  const {
    getEditedPostAttribute
  } = select('core/editor');
  const metaData = getEditedPostAttribute('meta');
  return {
    isSaving: isSavingPost(),
    isAutoSaving: isAutosavingPost(),
    isPostSaving: isSavingPost() && !isAutosavingPost(),
    title,
    metaData
  };
})(Edit);
registerBlockType('eot/eot-student-registration-form', {
  title: 'EOT Student Registration Form',
  icon: 'smiley',
  category: 'common',
  attributes: {
    // Course information
    courseId: {
      type: 'number',
      sourse: 'meta',
      meta: '_eot_course_id'
    },
    coursePrices: {
      type: 'array',
      default: [],
      // Provide a default value
      source: 'meta',
      meta: '_eot_course_prices',
      items: {
        type: 'object',
        properties: {
          label: {
            type: 'string'
          },
          price: {
            type: 'number'
          }
        }
      }
    },
    // Invoice information
    invoiceName: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_name'
    },
    invoiceAddress: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_address'
    },
    invoiceCity: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_city'
    },
    invoiceZip: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_zip'
    },
    invoiceCountry: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_country'
    },
    invoicePhone: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_phone'
    },
    invoiceEmail: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_invoice_email'
    },
    // Participant information
    participantName: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_participant_name'
    },
    participantDataOfBirth: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_participant_data_of_birth'
    },
    // Accommodation
    accommodationPrice: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_accommodation_price'
    },
    participantSex: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_participant_sex'
    },
    dateOfArrival: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_date_of_arrival'
    },
    dateOfDeparture: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_date_of_departure'
    },
    // Catering
    catering: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_catering'
    },
    // select meals
    meals: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_meals'
    },
    diets: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_diets'
    },
    // Instrument related information
    instrument: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_instrument'
    },
    instrumentRent: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_instrument_rent'
    },
    instrumentRentPrice: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_instrument_rent_price'
    },
    // Additional information
    additionalInfo: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_additional_info'
    },
    courseExpectations: {
      type: 'string',
      sourse: 'meta',
      meta: '_eot_course_expectations'
    }
  },
  // edit: function(props) {
  //      return null;
  // },
  edit: EnhancedEdit,
  save: function (props) {
    return null;
  }
});
function CoursePrices({
  coursePrices,
  setAttributes
}) {
  const updatePrice = (index, value) => {
    const newPrices = [...coursePrices];
    newPrices[index].price = parseFloat(value) || 0;
    setAttributes({
      coursePrices: newPrices
    });
  };
  const updateLabel = (index, value) => {
    const newPrices = [...coursePrices];
    newPrices[index].label = value;
    setAttributes({
      coursePrices: newPrices
    });
  };
  const addPrice = () => {
    const newPrices = [...coursePrices, {
      label: '',
      price: 0
    }];
    setAttributes({
      coursePrices: newPrices
    });
  };
  const removePrice = index => {
    const newPrices = [...coursePrices];
    newPrices.splice(index, 1);
    setAttributes({
      coursePrices: newPrices
    });
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, coursePrices.map((price, index) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: index
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Price Label', 'text-domain'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    value: price.label || '',
    onChange: event => updateLabel(index, event.target.value)
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Course price', 'text-domain'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text" // Use text type for manual decimal handling
    ,
    value: price.price || '',
    onChange: event => updatePrice(index, event.target.value)
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    onClick: () => removePrice(index)
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Remove', 'text-domain')))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "button",
    onClick: addPrice
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Add Price', 'text-domain')));
}
function getDefaultLanguagePostId(postId) {
  let defaultLanguagePostId;
  if (typeof window.wpml_get_object_id === 'function') {
    // WPML is active
    defaultLanguagePostId = window.wpml_get_object_id(postId, 'post', true, window.wpml_get_default_language());
  } else if (typeof window.pll_get_post === 'function') {
    // Polylang is active
    defaultLanguagePostId = window.pll_get_post(postId, window.pll_default_language('slug'));
  } else {
    // Neither WPML nor Polylang is active
    defaultLanguagePostId = postId;
  }
  return defaultLanguagePostId;
}

/***/ }),

/***/ "./src/modules/student-registration-form/block.scss":
/*!**********************************************************!*\
  !*** ./src/modules/student-registration-form/block.scss ***!
  \**********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ (function(module) {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
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
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_student_registration_form_block__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/student-registration-form/block */ "./src/modules/student-registration-form/block.js");
/* harmony import */ var _modules_event_block__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/event/block */ "./src/modules/event/block.js");
// Import block modules


}();
/******/ })()
;
//# sourceMappingURL=index.js.map