const { registerBlockType } = wp.blocks;
import { __ } from '@wordpress/i18n';

// Register eot/event block
registerBlockType('eot/event', {
    title: __('Event', 'text-domain'),
    icon: 'format-aside',
    category: 'common',
    supports: {
        align: ['full'],
    },
    edit: function(props) {
        return (
            <div>
                <h2>{ __('Event', 'text-domain') }</h2>
                <div className="eot-event-container">
                    <div className="eot-event-container-inner"></div>
                </div>
            </div>
        );
    },
    save: function(props) {
        return null;
    },
});