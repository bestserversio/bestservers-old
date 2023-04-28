import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Platforms/Form';

import { type EngineType } from '@/Components/Types';

export default function New({
    meta,
    engines
} : {
    meta: MetaType
    engines: EngineType[]
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
                <Form engines={engines}/>
            </div>
        </Wrapper>
    );
}