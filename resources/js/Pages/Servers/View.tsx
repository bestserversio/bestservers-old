import React from 'react';

import { type MetaType } from '@/Components/Meta';
import Wrapper from '@/Components/Wrapper';

import { type ServerType } from '@/Components/Types';

import ServerView from '@/Layouts/Servers/View/View';

export default function View({
    meta,
    server
} : {
    meta: MetaType,
    server: ServerType
}) {
    return (

        <Wrapper meta={meta}>
            <ServerView server={server} />
        </Wrapper>
    );
}