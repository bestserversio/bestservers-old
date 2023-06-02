import React from 'react';

import { ServerType } from '@/Components/Types';

const Buttons: React.FC<{
    server: ServerType
    grid?: boolean
}> = ({
    server,
    grid
}) => {
    return (
        <div className={grid ? "server-grid-buttons" : "server-table-buttons"}>
            <p>Placeholder.</p>
        </div>
    );
}

export default Buttons;