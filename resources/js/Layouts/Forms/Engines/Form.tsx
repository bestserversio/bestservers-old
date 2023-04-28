import React from 'react';

const Form: React.FC = () => {
    return (
        <form className="form-gen" action="/engines/create" method="POST">
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

            <h3 className="headline">Flags</h3>
            <div className="form-div">
                <div className="flex items-center gap-2">
                    <input type="checkbox" name="is_a2s" /> <label htmlFor="is_a2s">Is A2S</label>
                </div>

                <div className="flex items-center gap-2">
                    <input type="checkbox" name="is_discord" /> <label htmlFor="is_discord">Is Discord</label>
                </div>
            </div>
        </form>
    );
}

export default Form;