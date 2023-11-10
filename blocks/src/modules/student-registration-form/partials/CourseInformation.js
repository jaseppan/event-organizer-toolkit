import React from 'react';
import { __ } from '@wordpress/i18n';

function CourseInformation({ title, courseId, coursePrices, setAttributes} ) {

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
}


export default CourseInformation;