const { registerBlockType } = wp.blocks;
import { __ } from '@wordpress/i18n';
import { TabPanel } from '@wordpress/components';
import { registerBlockStyle } from '@wordpress/blocks';
import './block.scss';
import { withSelect } from '@wordpress/data';
import { registerBlockStylePicker } from '@wordpress/blocks';
import { useEffect } from '@wordpress/element';
// Import tab contents
import CourseInformation from './partials/CourseInformation';
import InvoiceInformation from './partials/InvoiceInformation';
import ParticipantInformation from './partials/ParticipantInformation';
import Catering from './partials/Catering';
import InstrumentRelatedInformation from './partials/InstrumentRelatedInformation';
import AdditionalInformation from './partials/AdditionalInformation';


// Block's edit function
function Edit(props) {

    
    const { attributes, setAttributes, isSaving, isAutoSaving, isPostSaving, title, metaData } = props;

    console.log('Edit function called'); 

    if (!title) {
        return (
            <div>
                <p>{ __('Please add a title and save the post before editing this block.') }</p>
            </div>
        );
    }

    const { 
        courseId, 
        coursePrices,
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
            content: <CourseInformation title={title} courseId={courseId} coursePrices={coursePrices} setAttributes={setAttributes} />,
        },
        {
            name: 'Invoice Information',
            title: __('Invoice Information', 'event-organized-toolkit'),
            content: <InvoiceInformation />,
        },
        {
            name: 'Participant Information',
            title: __('Participant Information', 'event-organized-toolkit'),
            content: <ParticipantInformation />,
        },
        {
            name: 'Catering',
            title: __('Catering', 'event-organized-toolkit'),
            content: <Catering/>,
        },
        {
            name: 'Instrument Related Information',
            title: __('Instrument Related Information', 'event-organized-toolkit'),
            content: <InstrumentRelatedInformation/>
        },
        {
            name: 'Additional Information',
            title: __('Additional Information', 'event-organized-toolkit'),
            content: <AdditionalInformation/>
        },
    ]

    return (  
        
        <TabPanel
            className="student-registration-form-tabs"
            activeClass="active-tab"
            tabs={ tabs }>
            {
                ( tab ) => tab.content
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
    },
   
    edit: EnhancedEdit,
    save: function(props) {
        return null;
    },
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