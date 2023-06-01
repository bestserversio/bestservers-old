import React from 'react';

import { type ServerType } from '@/Components/Types';

import GridRow from './Grid/Row'
import TableRow from './Table/Row'

const ServerBrowser: React.FC<{
    servers: ServerType[]
    grid?: boolean 
}> = ({ 
    servers,
    grid
}) => {
    return (
        <>
            {servers && servers.length > 0 ? (
                <>
                    {grid ? (
                        <div className="servers-grid">
                            {servers.map((server: ServerType) => {
                                return (
                                    <GridRow 
                                        server={server}
                                    />
                                );
                            })}
                        </div>
                    ) : (
                        <table className="servers-table">
                            <tbody>
                                {servers.map((server: ServerType) => {
                                    return (
                                        <TableRow
                                            server={server}
                                        />
                                    );
                                })}
                            </tbody>
                        </table>
                    )}
                </>
            ) : (
                <p>Could not find any servers!</p>
            )}
        </>
    );
}

export default ServerBrowser;