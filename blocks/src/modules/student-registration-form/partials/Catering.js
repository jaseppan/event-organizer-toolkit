import React from 'react';
import { __ } from '@wordpress/i18n';
import CateringInfo from './CateringInfo';
import CateringCheckboxes from './CateringCheckBoxes';


function Categing() {

    const [reserveMeals, setReserveMeals] = React.useState(false);
    
    return (
        <div>
            <label>
                { __('Reserve Meals', 'event-organizer-toolkit') }:
                <input
                    type="checkbox"
                    value=""
                    onChange={(e) => setReserveMeals(e.target.checked)}
                />
            </label>
            <div class="eot-info-box">
                { __('Meal Prices:', 'event-organizer-toolkit') }
                <div class="eot-info-box-content">
                    <div class="eot-info-box-content-inner">
                        <CateringInfo />
                        {reserveMeals && <CateringCheckboxes />}
                    </div>
                </div>
            </div>

        </div>
    );
}

export default Categing;