// const { createElement } = wp.element; // Added for JSX
// const { ServerSideRender } = wp.blockEditor; // Corrected this import
// import { useBlockProps } from '@wordpress/block-editor';
const { registerBlockType } = wp.blocks;
import { __ } from '@wordpress/i18n';

registerBlockType( 'eot/eot-student-registration-form', {

    title: 'EOT Student Registration Form',
    icon: 'smiley',
    category: 'common',

    attributes: {
        courseName: {
            type: 'string',
        },
        coursePrices: {
            type: 'array',
            default: [],
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
        // ... other attributes
    },

    edit: function(props) {
        const { attributes, setAttributes } = props;
        const { courseName, coursePrices } = attributes;
    
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
                <div>
                    <label>
                        { __('Course name', 'text-domain') }:
                        <input
                            type="text"
                            value={ courseName || '' } 
                            onChange={ ( event ) => setAttributes({ courseName: event.target.value }) }
                        />
                    </label>
                </div>
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
                            <button onClick={() => removePrice(index)}>
                                { __('Remove', 'text-domain') }
                            </button>
                        </div>
                    ))}
                    <button onClick={addPrice}>
                        { __('Add Price', 'text-domain') }
                    </button>
                </div>
            </div>  
        );
    },
    save: function(props) {
        return null;
    },
});