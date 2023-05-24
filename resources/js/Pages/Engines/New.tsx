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
    errors,
    success
} : {
    meta: MetaType,
    values?: EngineType,
    csrf: string,
    errors?: ErrorType[]
    success: boolean
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto p-4">
                {errors && (
                    <>
                        {errors.map((error: ErrorType) => {
                            return (
                                <div className="my-4">
                                    <NotiBox
                                        title={error.title}
                                        message={error.message}
                                    />
                                </div>
                            );
                        })}
                    </>
                )}
                {success && (
                    <div className="container mx-auto p-4">
                        <NotiBox
                            title="Success!"
                            message="Successfully created new engine!"
                            bg_class="bg-green-600/50"
                        />
                    </div>
                )}
                <Form 
                    values={values}
                    csrf={csrf}
                />
            </div>
        </Wrapper>
    );
}