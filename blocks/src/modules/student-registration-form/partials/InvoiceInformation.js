import React from 'react';
import { __ } from '@wordpress/i18n';

function InvoiceInformation() {
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
    );
}

export default InvoiceInformation;