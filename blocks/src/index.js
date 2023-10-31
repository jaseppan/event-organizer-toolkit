const { registerBlockType } = wp.blocks;
const { ServerSideRender } = wp.blockEditor; // Corrected this import
const { createElement } = wp.element; // Added for JSX

registerBlockType( 'eot/my-block', {
    title: 'My EOT Block',
    icon: 'smiley',
    category: 'common',

    attributes: {
        formID: {
            type: 'number',
        },
        // ... other attributes
    },
    
    edit: function() {
        return <div>Hello, EOT!</div>;
    },
    save: function() {
        return <div>Hello, EOT!</div>;
    },
});