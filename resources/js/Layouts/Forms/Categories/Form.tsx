import React from 'react';

import { type PlatformType, type CategoryType } from '@/Components/Types';

const Form: React.FC<{
     platforms: PlatformType[],
     categories: CategoryType[] 
}> = ({ 
    platforms,
    categories
}) => {
    return (
        <form className="form-gen" action="/categories/create" method="POST">
            <div className="form-div">
                <label htmlFor="banner">Banner</label>
                <input type="file" name="banner" />
                <p><input type="checkbox" name="b-remove" /> Remove Current</p>
            </div>

            <div className="form-div">
                <label htmlFor="icon">Icon</label>
                <input type="file" name="icon" />
                <p><input type="checkbox" name="i-remove" /> Remove Current</p>
            </div>

            <div className="form-div">
                <label htmlFor="platform">Platform</label>
                <select name="platform">
                    {platforms.map((platform: PlatformType) => {
                      return (
                        <option value={platform.id.toString()}>{platform.name}</option>
                      );  
                    })}
                </select>
            </div>

            <div className="form-div">
                <label htmlFor="parent">Parent</label>
                <select name="parent">
                    <option value="0">None</option>
                    {categories.map((category: CategoryType) => {
                        return (
                            <option value={category.id.toString()}>{category.name}</option>
                        );
                    })}
                </select>
            </div>

            <div className="form-div">
                <label htmlFor="name">Name*</label>
                <input type="text" name="name" />
            </div>

            <div className="form-div">
                <label htmlFor="name_short">Short Name</label>
                <input type="text" name="name_short" />
            </div>

            <div className="form-div">
                <label htmlFor="map_prefix">Map Prefix</label>
                <input type="text" name="map_prefix" />
            </div>

            <div className="form-div">
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/platforms/<span className="italic">{"{platform}"}</span>/<span className="italic">URL</span></span></p>
            </div>
        </form>
    );
}

export default Form;