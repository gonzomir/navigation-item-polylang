import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import './editor.scss';

/**
 * Block edit function.
 *
 * @return {Element} Element to render.
 */
export default function Edit() {
	return (
		<p { ...useBlockProps() }>
			{ __(
				'Navigation Item Polylang – hello from the editor!',
				'navigation-item-polylang'
			) }
		</p>
	);
}
