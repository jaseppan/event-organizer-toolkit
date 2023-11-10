import React from 'react';
import { __ } from '@wordpress/i18n';

function ParticipantInformation() {
    return (
        <div>
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
                    { __('Date of Birth', 'event-organizer-toolkit') }:
                    <input
                        type="text"
                        value="" 
                    />
                </label>
            </div>
            <div>
                <label>
                    { __('Reserve Accommodation', 'event-organizer-toolkit') }:
                    <input
                        type="checkbox"
                        value=""
                    />
                </label>
            </div>
            <div>
                <label>
                    { __('Arrival Date', 'event-organizer-toolkit') }:
                    <input
                        type="date"
                        value="" 
                    />
                </label>
            </div>
            <div>
                <label>
                    { __('Departure Date', 'event-organizer-toolkit') }:
                    <input
                        type="date"
                        value="" 
                    />
                </label>
            </div>
            <div>
                <label>
                    { __('Sex:', 'event-organizer-toolkit') };
                    <select>
                        <option>{ __('Male', 'event-organizer-toolkit') }</option>
                        <option>{ __('Female', 'event-organizer-toolkit') }</option>
                    </select>
                </label>
            </div>
        </div>
    );
}

export default ParticipantInformation;