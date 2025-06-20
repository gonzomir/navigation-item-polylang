import { registerBlockType } from '@wordpress/blocks';

import './style.scss';

import Edit from './edit';
import metadata from './block.json';

/**
 * Register the block.
 */
registerBlockType( metadata.name, {
	edit: Edit,
} );
