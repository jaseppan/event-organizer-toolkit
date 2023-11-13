import React from 'react';
import { __ } from '@wordpress/i18n';
import CateringInfo from './CateringInfo';


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
                    </div>
                </div>
            </div>

        </div>
    );
}

export default Categing;