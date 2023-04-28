import React, { ReactNode, useState } from 'react'

import Header from '@/Layouts/Header/Main';
import MetaInfo from './Meta';
import FormFilters, { type FilterCallbackTypes, type FilterTypes } from '@/Layouts/Forms/Filters';

const Wrapper: React.FC<{ 
    children: ReactNode
    meta: any 
}> = ({ 
    children,
    meta 
}) => {
    const [filterPlatforms, setFilterPlatforms] = useState<number[] | number | null>(null);
    const [filterCategories, setFilterCategories] = useState<number[] | number | null>(null);
    const [filterSearch, setFilterSearch] = useState<string | null>(null);

    const filters: FilterTypes = {
        platforms: filterPlatforms,
        categories: filterCategories,
        search: filterSearch
    }

    const filterCallbacks: FilterCallbackTypes = {
        setPlatforms: setFilterPlatforms,
        setCategories: setFilterCategories,
        setSearch: setFilterSearch
    }

    return (
        <main>
            <MetaInfo
                title={meta.title}
                description={meta.description}
                image={meta.image}
                key_words={meta.key_words}
                robots={meta.robots}
                web_type={meta.web_type}
            />
            <Header />
            <FormFilters 
                filters={filters}
                filterCallbacks={filterCallbacks}
            />
            {children}
        </main>
    );
}

export default Wrapper;