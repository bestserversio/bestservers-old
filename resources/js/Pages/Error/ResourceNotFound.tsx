import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

export default function ResourceNotFound({
    meta
} : {
    meta: MetaType
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto p-4">
                <h1 className="headline">Resource Not Found</h1>
                <p>The resource you're trying to view, edit, or delete is not found. Either this resource does not exist, or the URL you input is incorrect.</p>
            </div>
        </Wrapper>
    );
}