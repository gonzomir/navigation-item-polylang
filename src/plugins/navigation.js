import { addFilter } from '@wordpress/hooks';

addFilter(
	'blocks.registerBlockType',
	'gonzomir/polylang-language-switcher',
	( settings, name ) => {
		if ( name === 'core/navigation' ) {
			const { allowedBlocks = [] } = settings;
			return { ...settings, allowedBlocks: [ ...allowedBlocks, 'gonzomir/polylang-language-switcher' ] };
		}
		return settings;
	}
);
