import React from 'react';
import { __ } from '@wordpress/i18n';

function InstrumentRelatedInformation() {
    return (
    <div>
        <div>
            <label>
                { __('Instrument', 'event-organizer-toolbox') }
                <input 
                    type="text" 
                    name="instrument" 
                />
            </label>
        </div>
        <div>
            <label>
                <input
                    type="checkbox"
                    name="instrument_rental"
                />
                { sprintf(__('I need to rent an instrument (%d €/day)', 'event-organizer-toolbox' ), '5' ) }
            </label>
        </div>
        <div>
            <label>
                <div>
                    { __('Short description of playing skill') }    
                </div>
                <div>
                    <textarea
                        name="instrument_skill"
                        rows="3"
                    />
                </div>
            </label>
        </div>
    </div>
    );
}

export default InstrumentRelatedInformation;