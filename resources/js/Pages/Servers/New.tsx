import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import Form from '@/Layouts/Forms/Servers/Form';

import { type PlatformType, type CategoryType } from '@/Components/Types';

export default function New({
    meta,
    platforms,
    categories
} : {
    meta: MetaType,
    platforms: PlatformType[],
    categories: CategoryType[]
}) {
    return (
        <Wrapper meta={meta}>
            <div className="container mx-auto">
                <Form 
                    platforms={platforms}
                    categories={categories}
                />
            </div>
        </Wrapper>
    );
}