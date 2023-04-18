import React from 'react';

import { type MetaType } from '../Components/Meta';
import Wrapper from '../Components/Wrapper';

export default function Index({  
    meta 
} : {
    meta: MetaType
}) {    
    return (
        <>
            <Wrapper
                meta={meta}
            >
                <p>Hello!</p>
            </Wrapper>
        </>
    );
}
