import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

/**
 * Block edit function.
 *
 * @param {Object} props Component properties.
 * @return {Element} Element to render.
 */
export default function Edit( props ) {
	const { attributes, name } = props;

	const blockProps = useBlockProps();

	return (
		<li { ...blockProps }>
			<ServerSideRender block={ name } attributes={ attributes } />
		</li>
	);
}
