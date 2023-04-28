import React from 'react';

import { type EngineType } from '@/Components/Types';

const Form: React.FC<{ 
    engines: EngineType[]
}> = ({
    engines
}) => {
    return (
        <form className="form-gen" action="/platforms/create" method="POST">
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
                <label htmlFor="engine">Engine</label>
                <select name="engine">
                    <option value="0">None</option>
                    {engines.map((engine: EngineType) => {
                        return (
                            <option value={engine.id.toString()}>{engine.name}</option>
                        );
                    })}
                </select>
            </div>

            <div className="form-div">
                <label htmlFor="name">Name*</label>
                <input type="text" name="name" />
            </div>

            <div className="form-div">
                <label htmlFor="name_short">Short Name*</label>
                <input type="text" name="name_short" />
            </div>

            <div className="form-div">
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/platforms/<span className="italic">URL</span></span></p>
            </div>

            <h3 className="headline">HTML 5</h3>
            <div className="form-div">
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="html5_supported" /><label htmlFor="html5_supported">HTML5 Supported</label>
                </div>
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="html5_external" /><label htmlFor="html5_external">HTML5 External</label>
                </div>
            </div>
            <div className="form-div">
                <label htmlFor="html5_url">HTML5 URL</label>
                <input type="text" name="html5_url" />
                <p className="form-description">This is the external HTML5 URL if applicable. You may use <span className="italic font-bold">{"{ip}"}</span> and <span className="italic font-bold">{"{port}"}</span> respectively.</p>
            </div>
        </form>
    );
}

export default Form;