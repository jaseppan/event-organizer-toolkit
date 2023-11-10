const { registerBlockType } = wp.blocks;
import { __ } from '@wordpress/i18n';
import { TabPanel } from '@wordpress/components';
import { registerBlockStyle } from '@wordpress/blocks';
import './block.scss';
import { withSelect } from '@wordpress/data';
import { registerBlockStylePicker } from '@wordpress/blocks';
import { useEffect } from '@wordpress/element';

// Block's edit function
function Edit(props) {
    const { attributes, setAttributes, isSaving, isAutoSaving, isPostSaving, title, metaData } = props;

    if (!title) {
        return (
            <div>
                <p>{ __('Please add a title and save the post before editing this block.') }</p>
            </div>
        );
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
        courseExpectations,
    } = attributes;

    // Get post_id of course default language version
    const postId = wp.data.select('core/editor').getCurrentPostId();
    useEffect(() => {
        if (!courseId) {
            const defaultLanguagePostId = getDefaultLanguagePostId(postId);
            setAttributes({ courseId: defaultLanguagePostId });
        }
    }, []);

    const tabs = [
        {
            name: 'Course Information',
            title: __('Course Information', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <div className="eot-notification notice">
                            <p>{__('Define course prices in this tab.', 'event-organizer-toolkit' )}</p>
                        </div>
                        <div>
                            <label>
                                { __('Course Name', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value={ title } 
                                    disabled
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Course Id', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value={ courseId } 
                                    // onChange={ ( event ) => setAttributes({ courseId: event.target.value }) }
                                    disabled
                                />
                            </label>
                        </div>
                        <CoursePrices coursePrices={coursePrices} setAttributes={setAttributes} />
                    </div>
                );
            },
        },
        {
            name: 'Invoice Information',
            title: __('Invoice Information', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <div className="eot-notification notice">
                            <p>{__('This tab does not require editing', 'event-manager-toolbox')}</p>
                        </div>
                        <div>
                            <label>
                                { __('Name', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Email', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Address', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('City', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Zip', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Country', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                        <div>
                            <label>
                                { __('Phone', 'event-organizer-toolkit') }:
                                <input
                                    type="text"
                                    value="" 
                                />
                            </label>
                        </div>
                    </div>
                )
            },
        },
        {
            name: 'Participant Information',
            title: __('Participant Information', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <label>
                            { __('Name', 'event-organizer-toolkit') }:
                            <input
                                type="text"
                                value="" 
                            />
                        </label>
                        <label>
                            { __('Date of Birth', 'event-organizer-toolkit') }:
                            <input
                                type="text"
                                value="" 
                            />
                        </label>
                        <label>
                            { __('Reserve Accommodation', 'event-organizer-toolkit') }:
                            <input
                                type="checkbox"
                                value=""
                            />
                        </label>
                        <label>
                            { __('Arrival Date', 'event-organizer-toolkit') }:
                            <input
                                type="date"
                                value="" 
                            />
                        </label>
                        <label>
                            { __('Departure Date', 'event-organizer-toolkit') }:
                            <input
                                type="date"
                                value="" 
                            />
                        </label>
                        <label>
                            { __('Sex:', 'event-organizer-toolkit') };
                            <select>
                                <option>{ __('Male', 'event-organizer-toolkit') }</option>
                                <option>{ __('Female', 'event-organizer-toolkit') }</option>
                            </select>
                        </label>
                    </div>
                )
            },
        },
        {
            name: 'Catering',
            title: __('Catering', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <label>
                            { __('Reserve Meals', 'event-organizer-toolkit') }:
                            <input
                                type="checkbox"
                                value=""
                            />
                        </label>
                        <div class="eot-info-box">
                            { __('Meal Prices:', 'event-organizer-toolkit') }
                            {/* Get meal price info from database table prefix.eot_meal_types */}
                            
                            {/* Get data for list form database table prefix.eot_meals */}
                            

                        </div>

                    </div>
                )
            },
        },
        {
            name: 'Instrument Related Information',
            title: __('Instrument Related Information', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <label>Test</label>
                    </div>
                )
            },
        },
        {
            name: 'Additional Information',
            title: __('Additional Information', 'event-organized-toolkit'),
            content: function() {
                return (
                    <div>
                        <label>Test</label>
                    </div>
                )
            },
        },
    ]

    return (  
        
        <TabPanel
            className="student-registration-form-tabs"
            activeClass="active-tab"
            tabs={ tabs }>
            {
                ( tab ) => tab.content()
            }
        </TabPanel>


    );
}

// Wrap your block's edit function with withSelect
const EnhancedEdit = withSelect((select) => {
    const { isSavingPost, isAutosavingPost } = select('core/editor');
    const { getCurrentPost } = select('core/editor');
    const { title } = getCurrentPost();
    const { getEditedPostAttribute } = select('core/editor');
    const metaData = getEditedPostAttribute('meta');

    return {
        isSaving: isSavingPost(),
        isAutoSaving: isAutosavingPost(),
        isPostSaving: isSavingPost() && !isAutosavingPost(),
        title,
        metaData,
    };
})(Edit);

registerBlockType( 'eot/eot-student-registration-form', {

    title: 'EOT Student Registration Form',
    icon: 'smiley',
    category: 'common',

    attributes: {
        // Course information
        courseId: {
            type: 'number',
            sourse: 'meta',
            meta: '_eot_course_id',
        },
        coursePrices: {
            type: 'array',
            default: [], // Provide a default value
            source: 'meta',
            meta: '_eot_course_prices',
            items: {
                type: 'object',
                properties: {
                    label: {
                        type: 'string',
                    },
                    price: {
                        type: 'number',
                    },
                },
            },
        },
        // Invoice information
        invoiceName: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_name',
        },
        invoiceAddress: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_address',
        },
        invoiceCity: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_city',
        },
        invoiceZip: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_zip',
        },
        invoiceCountry: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_country',
        },
        invoicePhone: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_phone',
        },
        invoiceEmail: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_invoice_email',
        },
        // Participant information
        participantName: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_participant_name',
        },
        participantDataOfBirth: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_participant_data_of_birth',
        },
        // Accommodation
        accommodationPrice: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_accommodation_price',
        },
        participantSex: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_participant_sex',
        },
        dateOfArrival: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_date_of_arrival',
        },
        dateOfDeparture: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_date_of_departure',
        },
        // Catering
        catering: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_catering',
        },
        // select meals
        meals: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_meals',
        },
        diets: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_diets',
        },
        // Instrument related information
        instrument: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_instrument',
        },
        instrumentRent: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_instrument_rent',
        },
        instrumentRentPrice: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_instrument_rent_price',
        },
        // Additional information
        additionalInfo: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_additional_info',
        },
        courseExpectations: {
            type: 'string',
            sourse: 'meta',
            meta: '_eot_course_expectations',
        },
    },
   
    
    // edit: function(props) {
    //      return null;
    // },
    edit: EnhancedEdit,
    save: function(props) {
        return null;
    },
});

function CoursePrices({ coursePrices, setAttributes }) {
    const updatePrice = (index, value) => {
        const newPrices = [...coursePrices];
        newPrices[index].price = parseFloat(value) || 0;
        setAttributes({ coursePrices: newPrices });
    };

    const updateLabel = (index, value) => {
        const newPrices = [...coursePrices];
        newPrices[index].label = value;
        setAttributes({ coursePrices: newPrices });
    };

    const addPrice = () => {
        const newPrices = [...coursePrices, { label: '', price: 0 }];
        setAttributes({ coursePrices: newPrices });
    };

    const removePrice = (index) => {
        const newPrices = [...coursePrices];
        newPrices.splice(index, 1);
        setAttributes({ coursePrices: newPrices });
    };

    return (
        <div>
            {coursePrices.map((price, index) => (
                <div key={index}>
                    <label>
                        { __('Price Label', 'text-domain') }:
                        <input
                            type="text"
                            value={ price.label || '' } 
                            onChange={ ( event ) => updateLabel(index, event.target.value) }
                        />
                    </label>
                    <label>
                        { __('Course price', 'text-domain') }:
                        <input
                            type="text" // Use text type for manual decimal handling
                            value={ price.price || '' } 
                            onChange={ ( event ) => updatePrice(index, event.target.value) }
                        />
                    </label>
                    <button type="button" onClick={() => removePrice(index)}>
                        { __('Remove', 'text-domain') }
                    </button>
                </div>
            ))}
            <button type="button" onClick={addPrice}>
                { __('Add Price', 'text-domain') }
            </button>
        </div>
    );
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