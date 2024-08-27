/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
 import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
 import { useState, useEffect } from 'react';
 import { PanelBody, SelectControl } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
    const [selectedContentType, setselectedContentType] = useState(attributes.contentType || 'content-type-contributors');

    useEffect(() => {
        setAttributes({ ...attributes, contentType: selectedContentType });
    }, [selectedContentType, setAttributes]);

    let contentDescription;

    if (selectedContentType === "content-type-contributors") {
        contentDescription = 'Contributors';
    } else if (selectedContentType === "content-type-events") {
        contentDescription = 'Events';
    } else if (selectedContentType === "content-type-posts") {
        contentDescription = 'Posts';
    } else if (selectedContentType === "content-type-stories") {
        contentDescription = 'Stories';
	} else if (selectedContentType === "content-type-gallery") {
        contentDescription = 'Gallery';
	} else if (selectedContentType === "content-type-story-carousel")  {
        contentDescription = 'Story Carousel';
    }

    return (
        <>					
            <InspectorControls>
                <PanelBody title={__('Related Content', 'related-content')}>
                    <SelectControl
                        label="Select Content Type"
                        value={selectedContentType}
                        options={[
                            { label: 'Contributors', value: 'content-type-contributors' },
                            { label: 'Events', value: 'content-type-events' },
                            { label: 'Posts', value: 'content-type-posts' },
							{ label: 'Stories', value: 'content-type-stories' },
                            { label: 'Photographer Gallery', value: 'content-type-gallery'},
                            { label: 'Story Carousel', value: 'content-type-story-carousel'}
                        ]}
                        onChange={(newcontentType) => setselectedContentType(newcontentType)}
                    />
                </PanelBody>				
            </InspectorControls>

            <p {...useBlockProps()}>
                <div className={selectedContentType}>
                    <h2>Related {contentDescription}</h2>
                    <div class="related-content-examples">
                        <ul>
                            <li>
                                <div class="related-example-image"></div>
                                <div class="related-example-title"> </div>                                
                            </li>
                            <li>
                                <div class="related-example-image"></div>
                                <div class="related-example-title"> </div>                                
                            </li>
                            <li>
                                <div class="related-example-image"></div>
                                <div class="related-example-title"> </div>                                
                            </li>
                        </ul>
                    </div>
                </div>
            </p>
        </>
    );
}

