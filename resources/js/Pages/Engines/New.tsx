import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Engines/Form';
import { type EngineType, type ErrorType } from '@/Components/Types';

import NotiBox from '@/Layouts/Notifications/Box'

export default function New({
    meta,
    values,
    csrf,
    errors = undefined
} : {
    meta: MetaType,
    values?: EngineType,
    csrf: string,
    errors?: ErrorType
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
                {errors && (
                        <NotiBox
                            title={errors.title}
                            message={errors.message}
                        />
                )}
                <Form 
                    values={values}
                    csrf={csrf}
                />
            </div>
        </Wrapper>
    );
}