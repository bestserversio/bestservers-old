import React from 'react';

import { type EngineType } from '@/Components/Types';
import internal from 'stream';

const Form: React.FC<{
    id?: number,
    values?: EngineType,
    csrf: string,
    btn_text?: string
}> = ({
    id,
    values,
    csrf,
    btn_text="Create!"
}) => {
    return (
        <form className="form-gen" action={id ? "/engines/" + id : "/engines"} method="POST">
            <input type="hidden" name="_token" value={csrf} />
            {id && (
                <input type="hidden" name="_method" value="PUT" />
            )}

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
                <textarea name="description" rows={15} defaultValue={values?.description ?? ""}></textarea>
            </div>

            <h3 className="headline">Flags</h3>
            <div className="form-div">
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="is_a2s" defaultChecked={values?.is_a2s} /> <label htmlFor="is_a2s">Is A2S</label>
                </div>

                <div className="flex items-center gap-2">
                    <input type="checkbox" name="is_discord" defaultChecked={values?.is_discord} /> <label htmlFor="is_discord">Is Discord</label>
                </div>
            </div>

            <div className="form-btn-div">
                <button type="submit" className="btn btn-primary">{btn_text}</button>
            </div>
        </form>
    );
}

export default Form;