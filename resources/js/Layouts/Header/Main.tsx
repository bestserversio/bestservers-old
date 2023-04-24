import React from 'react';

import Banner from './Banner';
import Navbar from './Navbar';

const Main: React.FC = () => {
    return (
        <div id="header">
            <Banner />
            <Navbar />
        </div>
    );
}

export default Main;