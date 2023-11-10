import React from 'react';
import { __ } from '@wordpress/i18n';

function AdditionalInformation() {
    return (
        <div>
            <div>
                <label>
                    <div>
                        { __('Additional Information', 'event-manager-toolkit') }    
                    </div>
                    <div>
                        <textarea
                            name="additional_information"
                            id="additional_information"
                            placeholder={ __('Additional Information', 'event-manager-toolkit') }
                            rows="3"
                        />
                    </div>
                    <div>
                        { __('Expectations Towards the Course', 'event-manager-toolkit') }    
                    </div>
                    <div>
                        <textarea
                            name="expectations_towards_the_course"
                            id="expectations_towards_the_course"
                            placeholder={ __('Expectations Towards the Course', 'event-manager-toolkit') }
                            rows="3"
                        />
                    </div>
                </label>
            </div>
        </div>
    );
}

export default AdditionalInformation;