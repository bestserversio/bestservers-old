import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

export default function PageNotFound({
    meta
} : {
    meta: MetaType
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto p-4">
                <h1 className="headline">Page Not Found</h1>
                <p>The page you went to was not found. Please check the URL or report this issue.</p>
            </div>
        </Wrapper>
    );
}