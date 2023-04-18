import React from 'react'

export type FilterTypes = {
    platforms: number[] | number | null
    categories: number[] | number | null
    search: string | null
}

export type FilterCallbackTypes = {
    setPlatforms: React.Dispatch<React.SetStateAction<number | number[]>>
    setCategories: React.Dispatch<React.SetStateAction<number | number[]>>
    setSearch: React.Dispatch<React.SetStateAction<string>>
}

const FormFilters: React.FC<{ 
    filters: FilterTypes,
    filterCallbacks: FilterCallbackTypes
}> = ({
    filters,
    filterCallbacks
}
) => {
    return (
        <form id="filters">
            <select className="filter" id="filter-platforms" onChange={(e: any) => {
                e.preventDefault();

                filterCallbacks.setPlatforms(Number(e.target.value));
            }}>
                <option value="0">All</option>
            </select>
            <select className="filter" id="filter-categories" onChange={(e: any) => {
                e.preventDefault();
                
                filterCallbacks.setCategories(Number(e.target.value));
            }}>
                <option value="0">All</option>
            </select>
            <input type="text" className="filter" id="filter-search" onChange={(e: any) => {
                e.preventDefault();

                filterCallbacks.setSearch(e.target.value)
            }} />
        </form>
    );
}

export default FormFilters;