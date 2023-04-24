import React from 'react';

import { type MetaType } from '../../Components/Meta';
import Wrapper from '../../Components/Wrapper';

import Form from '../../Layouts/Forms/Servers/New';

export default function Create({
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