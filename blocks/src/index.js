const { registerBlockType } = wp.blocks;

registerBlockType( 'eot/my-block', {
    title: 'My EOT Block',
    icon: 'smiley',
    category: 'common',
    edit: function() {
        return <div>Hello, EOT!</div>;
    },
    save: function() {
        return <div>Hello, EOT!</div>;
    },
});