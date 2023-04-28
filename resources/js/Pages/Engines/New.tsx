import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Engines/Form';

export default function New({
    meta
} : {
    meta: MetaType
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
                <Form />
            </div>
        </Wrapper>
    );
}