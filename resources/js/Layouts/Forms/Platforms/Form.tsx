import React from 'react';

import { type EngineType, type PlatformType } from '@/Components/Types';

const Form: React.FC<{
    id?: number,
    values?: PlatformType,
    csrf: string,
    engines: EngineType[],
    btn_text?: string
}> = ({
    id,
    values,
    csrf,
    engines,
    btn_text="Create!"
}) => {
    return (
        <form className="form-gen" action="/platforms/create" method="POST">
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
                <label htmlFor="engine">Engine</label>
                <select name="engine">
                    <option value="0">None</option>
                    {engines.map((engine: EngineType) => {
                        return (
                            <option selected={values?.id == engine.id} value={engine.id.toString()}>{engine.name}</option>
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
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15}defaultValue={values?.description ?? ""}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" defaultValue={values?.url ?? ""} />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/platforms/<span className="italic">URL</span></span></p>
            </div>

            <h3 className="headline">HTML 5</h3>
            <div className="form-div">
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="html5_supported" defaultChecked={values?.html5_supported} /><label htmlFor="html5_supported">HTML5 Supported</label>
                </div>
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="html5_external" defaultChecked={values?.html5_external} /><label htmlFor="html5_external">HTML5 External</label>
                </div>
            </div>
            <div className="form-div">
                <label htmlFor="html5_url">HTML5 URL</label>
                <input type="text" name="html5_url" defaultValue={values?.html5_url ?? ""} />
                <p className="form-description">This is the external HTML5 URL if applicable. You may use <span className="italic font-bold">{"{ip}"}</span> and <span className="italic font-bold">{"{port}"}</span> respectively.</p>
            </div>

            <div className="form-btn-div">
                <button type="submit" className="btn btn-primary">{btn_text}</button>
            </div>
        </form>
    );
}

export default Form;