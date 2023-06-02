import React from 'react';

import { type ServerType } from '@/Components/Types'

export const Banner: React.FC<{
    server: ServerType
}> = ({
    server
}) => {
    return (
        <>
        </>
    );
}

const General: React.FC<{
    server: ServerType
}> = ({
    server
}) => {
    return (
        <div className="server-view-block-general">

        </div>
    );
}

export default General;