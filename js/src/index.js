import './editor.scss';
import domReady from '@wordpress/dom-ready';
import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { unregisterBlockType } from '@wordpress/blocks';
// react hook
import { useState, useEffect } from '@wordpress/element';

const classNameToToggle = 'cob-this-is-my-class';

const modifyEdit = ( BlockEdit ) => {
	return ( props ) => {
		// init variables
		const { attributes, name } = props;
		const isCoreButtonBlock = name === 'core/button';
		if ( ! isCoreButtonBlock ) return <BlockEdit { ...props } />; // escape for any block except core/button
		const { className } = attributes;

		// init state
		const [ toggledOn, setToggledOn ] = useState(
			attributes.className?.includes( classNameToToggle )
		);

		// Watch
		useEffect( () => {
			updateClassName();
		}, [ toggledOn ] );
		function updateClassName() {
			// This function updates the attribute depending on the toggle control
			let newClassName = className;
			if ( toggledOn && ! className.includes( classNameToToggle ) ) {
				newClassName = className + ' ' + classNameToToggle;
			} else {
				if ( ! toggledOn && className.includes( classNameToToggle ) ) {
					// not toggled - remove class
					newClassName = className
						.replace( classNameToToggle, '' )
						.trim();
				}
			}
			// update the className.
			props.setAttributes( {
				className: newClassName,
			} );
		}

		// for total sync we can watch if the user updates manually the  Advanced > Class input.
		useEffect( () => {
			setToggledOn( attributes.className?.includes( classNameToToggle ) );
		}, [ attributes.className ] );

		return (
			<>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody title="Custom Panel">
						<ToggleControl
							label="Should text be shown?"
							help={ toggledOn ? 'Yes' : 'No' }
							checked={ toggledOn }
							onChange={ ( val ) => setToggledOn( val ) }
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
};
addFilter(
	'editor.BlockEdit',
	'cob/add-panel-to-button-component',
	modifyEdit
);

domReady( () => {
	alert( 'domready' );
} );
