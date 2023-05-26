import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Servers/Form';

import { type PlatformType, type CategoryType, type ServerType, type ErrorType } from '@/Components/Types';

import NotiBox from '@/Layouts/Notifications/Box'

export default function New({
    meta,
    id,
    values,
    csrf,
    errors,
    success,
    platforms,
    categories,
    btn_text
} : {
    meta: MetaType,
    id?: number,
    values?: ServerType,
    csrf: string,
    errors?: ErrorType[],
    success?: boolean,
    platforms: PlatformType[],
    categories: CategoryType[],
    btn_text?: string
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
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
                            message={id ? "Successfully edited engine!" : "Successfully created new engine!"}
                            bg_class="bg-green-600/50"
                        />
                    </div>
                )}
                <Form
                    id={id}
                    values={values}
                    csrf={csrf}
                    platforms={platforms}
                    categories={categories}
                    btn_text={btn_text}
                />
            </div>
        </Wrapper>
    );
}