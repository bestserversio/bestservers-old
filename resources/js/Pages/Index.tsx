import React from 'react';

import HeadInfo from '../Components/head';

export default function Index({ 
    test, 
    meta 
}) {    
    return (
        <>
            <HeadInfo
                title={meta.title}
                description={meta.description}
                image={meta.image}
                key_words={meta.key_words}
                robots={meta.robots}
                web_type={meta.web_type}
            />
            <p>Hello! Test # is {test}</p>
        </>
    );
}
