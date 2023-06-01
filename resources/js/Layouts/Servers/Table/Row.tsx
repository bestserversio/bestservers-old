import React from 'react';

import {type ServerType} from '@/Components/Types';

const Row: React.FC<{
    server: ServerType
}> = ({ 
    server
}) => {
    return (
        <tr className="server-table-row">
            <td className="server-grid-main">
                <h3>{server.name}</h3>
            </td>
        </tr>
    );
}
export default Row;