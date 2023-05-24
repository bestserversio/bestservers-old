import React from 'react';

import { type EngineType } from '@/Components/Types';

const Form: React.FC<{
    values?: EngineType,
    csrf: string,
    btn_text?: string
}> = ({
    values,
    csrf,
    btn_text="Create!"
}) => {
    return (
        <form className="form-gen" action="/engines" method="POST">
            <input type="hidden" name="_token" value={csrf} />

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
                    <input type="checkbox" name="is_a2s" value={values?.is_a2s ? "1" : "0"} /> <label htmlFor="is_a2s">Is A2S</label>
                </div>

                <div className="flex items-center gap-2">
                    <input type="checkbox" name="is_discord" value={values?.is_discord ? "1" : "0"} /> <label htmlFor="is_discord">Is Discord</label>
                </div>
            </div>

            <div className="form-btn-div">
                <button type="submit" className="btn btn-primary">{btn_text}</button>
            </div>
        </form>
    );
}

export default Form;