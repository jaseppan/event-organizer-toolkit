import React from 'react';
import { __ } from '@wordpress/i18n';
import CateringInfo from './CateringInfo';
import CateringCheckboxes from './CateringCheckBoxes';


function Categing() {
    
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
                <div class="eot-info-box-content">
                    <div class="eot-info-box-content-inner">
                        <CateringInfo />
                        <CateringCheckboxes />
                    </div>
                </div>
            </div>

        </div>
    );
}

export default Categing;