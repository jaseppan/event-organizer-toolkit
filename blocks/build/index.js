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
/* harmony import */ var _partials_CourseInformation__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./partials/CourseInformation */ "./src/modules/student-registration-form/partials/CourseInformation.js");
/* harmony import */ var _partials_InvoiceInformation__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./partials/InvoiceInformation */ "./src/modules/student-registration-form/partials/InvoiceInformation.js");
/* harmony import */ var _partials_ParticipantInformation__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./partials/ParticipantInformation */ "./src/modules/student-registration-form/partials/ParticipantInformation.js");
/* harmony import */ var _partials_Catering__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./partials/Catering */ "./src/modules/student-registration-form/partials/Catering.js");
/* harmony import */ var _partials_InstrumentRelatedInformation__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./partials/InstrumentRelatedInformation */ "./src/modules/student-registration-form/partials/InstrumentRelatedInformation.js");
/* harmony import */ var _partials_AdditionalInformation__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./partials/AdditionalInformation */ "./src/modules/student-registration-form/partials/AdditionalInformation.js");

const {
  registerBlockType
} = wp.blocks;







// Import tab contents







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
  console.log('Edit function called');
  if (!title) {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Please add a title and save the post before editing this block.')));
  }
  const {
    courseId,
    coursePrices
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
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_CourseInformation__WEBPACK_IMPORTED_MODULE_7__["default"], {
      title: title,
      courseId: courseId,
      coursePrices: coursePrices,
      setAttributes: setAttributes
    })
  }, {
    name: 'Invoice Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Invoice Information', 'event-organized-toolkit'),
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_InvoiceInformation__WEBPACK_IMPORTED_MODULE_8__["default"], null)
  }, {
    name: 'Participant Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Participant Information', 'event-organized-toolkit'),
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_ParticipantInformation__WEBPACK_IMPORTED_MODULE_9__["default"], null)
  }, {
    name: 'Catering',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Catering', 'event-organized-toolkit'),
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_Catering__WEBPACK_IMPORTED_MODULE_10__["default"], null)
  }, {
    name: 'Instrument Related Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Instrument Related Information', 'event-organized-toolkit'),
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_InstrumentRelatedInformation__WEBPACK_IMPORTED_MODULE_11__["default"], null)
  }, {
    name: 'Additional Information',
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Additional Information', 'event-organized-toolkit'),
    content: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_partials_AdditionalInformation__WEBPACK_IMPORTED_MODULE_12__["default"], null)
  }];
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TabPanel, {
    className: "student-registration-form-tabs",
    activeClass: "active-tab",
    tabs: tabs
  }, tab => tab.content);
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
    }
  },
  edit: EnhancedEdit,
  save: function (props) {
    return null;
  }
});
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

/***/ "./src/modules/student-registration-form/partials/AdditionalInformation.js":
/*!*********************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/AdditionalInformation.js ***!
  \*********************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);



function AdditionalInformation() {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Additional Information', 'event-manager-toolkit')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "additional_information",
    id: "additional_information",
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Additional Information', 'event-manager-toolkit'),
    rows: "3"
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Expectations Towards the Course', 'event-manager-toolkit')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "expectations_towards_the_course",
    id: "expectations_towards_the_course",
    placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Expectations Towards the Course', 'event-manager-toolkit'),
    rows: "3"
  })))));
}
/* harmony default export */ __webpack_exports__["default"] = (AdditionalInformation);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/Catering.js":
/*!********************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/Catering.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _CateringInfo__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./CateringInfo */ "./src/modules/student-registration-form/partials/CateringInfo.js");
/* harmony import */ var _CateringCheckBoxes__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./CateringCheckBoxes */ "./src/modules/student-registration-form/partials/CateringCheckBoxes.js");





function Categing() {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Reserve Meals', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "checkbox",
    value: ""
  })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "eot-info-box"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Meal Prices:', 'event-organizer-toolkit'), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "eot-info-box-content"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "eot-info-box-content-inner"
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CateringInfo__WEBPACK_IMPORTED_MODULE_2__["default"], null), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_CateringCheckBoxes__WEBPACK_IMPORTED_MODULE_3__["default"], null)))));
}
/* harmony default export */ __webpack_exports__["default"] = (Categing);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/CateringCheckBoxes.js":
/*!******************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/CateringCheckBoxes.js ***!
  \******************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);

const {
  Component
} = wp.element;
const {
  Spinner
} = wp.components;

class CateringCheckboxes extends Component {
  constructor(props) {
    super(props);
    this.state = {
      list: [],
      loading: true,
      selectAll: false,
      selectedMeals: []
    };
  }
  componentDidMount() {
    this.runApiFetch();
  }
  runApiFetch() {
    wp.apiFetch({
      path: 'event-organizer-toolkit/v1/list-meals?order=asc&order_by[]=date&order_by[]=start_time'
    }).then(data => {
      this.setState({
        list: data.data,
        loading: false
      });
    });
  }
  handleSelectAllChange = event => {
    const {
      checked
    } = event.target;
    const {
      list,
      selectedMeals
    } = this.state;
    let updatedSelectedMeals;
    if (checked) {
      updatedSelectedMeals = list.data.map(item => item.id);
    } else {
      updatedSelectedMeals = [];
    }
    this.setState({
      selectAll: checked,
      selectedMeals: updatedSelectedMeals
    });
  };
  handleMealChange = event => {
    const {
      value
    } = event.target;
    this.setState(prevState => {
      const selectedMeals = [...prevState.selectedMeals];
      const index = selectedMeals.indexOf(value);
      if (index > -1) {
        selectedMeals.splice(index, 1);
      } else {
        selectedMeals.push(value);
      }
      return {
        selectedMeals
      };
    });
  };
  render() {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, this.state.loading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
      type: "checkbox",
      name: "select-all",
      className: "select-all",
      checked: this.state.selectAll // Add checked attribute
      ,
      onChange: this.handleSelectAllChange // Add onChange event handler
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Select All'))), this.state.list.data.map(item => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      key: item.id
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
      type: "checkbox",
      name: "meal",
      className: "meal",
      value: item.id,
      checked: this.state.selectedMeals.includes(item.id) // Add checked attribute
      ,
      onChange: this.handleMealChange // Add onChange event handler
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, item.title, " ", new Date(item.date).toLocaleDateString())))));
  }
}
/* harmony default export */ __webpack_exports__["default"] = (CateringCheckboxes);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/CateringInfo.js":
/*!************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/CateringInfo.js ***!
  \************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);

const {
  Component
} = wp.element;
const {
  Spinner
} = wp.components;

class CateringInfo extends Component {
  constructor(props) {
    super(props);
    this.state = {
      list: [],
      loading: true
    };
  }
  componentDidMount() {
    this.runApiFetch();
  }
  runApiFetch() {
    wp.apiFetch({
      path: 'event-organizer-toolkit/v1/list-meal-types?order=asc&order_by=start_time'
    }).then(data => {
      this.setState({
        list: data.data,
        loading: false
      });
    });
  }
  render() {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, this.state.loading ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(Spinner, null) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", null, this.state.list.data.map(item => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
      key: item.id
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(item.type, 'event-organizer-toolkit'), ": ", item.price, " "))));
  }
}
/* harmony default export */ __webpack_exports__["default"] = (CateringInfo);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/CourseInformation.js":
/*!*****************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/CourseInformation.js ***!
  \*****************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);



function CourseInformation({
  title,
  courseId,
  coursePrices,
  setAttributes
}) {
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
/* harmony default export */ __webpack_exports__["default"] = (CourseInformation);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/InstrumentRelatedInformation.js":
/*!****************************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/InstrumentRelatedInformation.js ***!
  \****************************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);



function InstrumentRelatedInformation() {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Instrument', 'event-organizer-toolbox'), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    name: "instrument"
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "checkbox",
    name: "instrument_rental"
  }), sprintf((0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('I need to rent an instrument (%d €/day)', 'event-organizer-toolbox'), '5'))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Short description of playing skill')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "instrument_skill",
    rows: "3"
  })))));
}
/* harmony default export */ __webpack_exports__["default"] = (InstrumentRelatedInformation);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/InvoiceInformation.js":
/*!******************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/InvoiceInformation.js ***!
  \******************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);



function InvoiceInformation() {
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
/* harmony default export */ __webpack_exports__["default"] = (InvoiceInformation);

/***/ }),

/***/ "./src/modules/student-registration-form/partials/ParticipantInformation.js":
/*!**********************************************************************************!*\
  !*** ./src/modules/student-registration-form/partials/ParticipantInformation.js ***!
  \**********************************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);



function ParticipantInformation() {
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Name', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    value: ""
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Date of Birth', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    value: ""
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Reserve Accommodation', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "checkbox",
    value: ""
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Arrival Date', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "date",
    value: ""
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Departure Date', 'event-organizer-toolkit'), ":", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "date",
    value: ""
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Sex:', 'event-organizer-toolkit'), ";", (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("select", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Male', 'event-organizer-toolkit')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("option", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Female', 'event-organizer-toolkit'))))));
}
/* harmony default export */ __webpack_exports__["default"] = (ParticipantInformation);

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