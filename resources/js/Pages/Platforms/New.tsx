import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Platforms/Form';

import { type PlatformType, type EngineType } from '@/Components/Types';

export default function New({
    meta,
    id,
    values,
    csrf,
    engines,
    btn_text
} : {
    meta: MetaType,
    id?: number,
    values?: PlatformType,
    csrf: string,
    engines: EngineType[],
    btn_text?: string
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
                <Form
                    id={id}
                    values={values}
                    csrf={csrf} 
                    engines={engines}
                    btn_text={btn_text}
                />
            </div>
        </Wrapper>
    );
}