import React from 'react';

import { type PlatformType, type CategoryType } from '@/Components/Types';

const Form: React.FC<{
    id?: number,
    values?: CategoryType,
    csrf: string,
    platforms: PlatformType[],
    categories: CategoryType[],
    btn_text?: string 
}> = ({
    id,
    values,
    csrf,
    platforms,
    categories,
    btn_text="Create!"
}) => {
    // Make sure we have platforms & categories to prevent error.
    if (platforms == null)
        platforms = [];

    if (categories == null)
        categories = [];
    
    return (
        <form className="form-gen" action={id ? "/categories/" + id : "/categories"} method="POST">
            <input type="hidden" name="_token" value={csrf} />
            {id && (
                <input type="hidden" name="_method" value="PUT" />
            )}

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
                <select name="platform" defaultValue={values?.platformId ?? 0}>
                    {platforms.map((platform: PlatformType) => {
                      return (
                        <option value={platform.id.toString()}>{platform.name}</option>
                      );  
                    })}
                </select>
            </div>

            <div className="form-div">
                <label htmlFor="parent">Parent</label>
                <select name="parent" defaultValue={values?.parent ?? 0}>
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
                <input type="text" name="name" defaultValue={values?.name ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="name_short">Short Name*</label>
                <input type="text" name="name_short" defaultValue={values?.name_short ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="map_prefix">Map Prefix</label>
                <input type="text" name="map_prefix" defaultValue={values?.map_prefix} />
            </div>

            <div className="form-div">
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15}defaultValue={values?.description ?? ""}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" defaultValue={values?.url ?? ""} />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/categories/<span className="italic">{"{category}"}</span>/<span className="italic">URL</span></span></p>
            </div>

            <div className="form-btn-div">
                <button type="submit" className="btn btn-primary">{btn_text}</button>
            </div>
        </form>
    );
}

export default Form;