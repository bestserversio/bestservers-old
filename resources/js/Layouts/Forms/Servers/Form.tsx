import React from 'react';

import { type PlatformType, type CategoryType, type ServerType } from '@/Components/Types';

const Form: React.FC<{
    id?: number,
    values?: ServerType,
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
    return (
        <form className="form-gen" action={id ? "/servers/" + id : "/servers"} method="POST">
            <input type="hidden" name="_token" value={csrf} />
            {id && (
                <input type="hidden" name="_method" value="PUT" />
            )}

            <h3 className="headline">Platform & Category</h3>
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
                <label htmlFor="category">Category</label>
                <select name="category">
                    {categories.map((category: CategoryType) => {
                        return (
                            <option value={category.id.toString()}>{category.name}</option>
                        );
                    })}
                </select>
            </div>

            <h3 className="headline">General</h3>
            <div className="form-div">
                <label htmlFor="banner">Banner</label>
                <input type="file" name="banner" />
                <p><input type="checkbox" name="b-remove" /> Remove Current</p>
            </div>

            <div className="form-div">
                <label htmlFor="avatar">Avatar</label>
                <input type="file" name="avatar" />
                <p><input type="checkbox" name="a-remove" /> Remove Current</p>
            </div>

            <div className="form-div">
                <label htmlFor="name">Name*</label>
                <input type="text" name="name" defaultValue={values?.name ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15} defaultValue={values?.description ?? ""}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" defaultValue={values?.url ?? ""} />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/<span className="italic">URL</span></span></p>
            </div>

            <div className="form-div">
                <label htmlFor="rules">Rules</label>
                <textarea name="rules" rows={15} defaultValue={values?.rules ?? ""}></textarea>
                <p className="form-description">Rules for the server if applicable. If this field is filled out, it will pop up for new players before joining a server.</p>
            </div>

            <div className="form-div">
                <label htmlFor="location">Location</label>
                <input type="text" name="location" />
                <p className="form-description">This is where your game server is located physically. All servers are sorted by location by default.</p>
            </div>

            <h3 className="headline">Network</h3>
            <div className="form-div">
                <label htmlFor="ipv4">IPv4 Address</label>
                <input type="text" name="ipv4" defaultValue={values?.ipv4 ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="ipv6">IPv6 Address</label>
                <input type="text" name="ipv6" defaultValue={values?.ipv6 ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="port">Port</label>
                <input type="text" name="port" defaultValue={values?.port ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="hostname">Host Name</label>
                <input type="text" name="hostname" defaultValue={values?.host_name ?? ""} />
            </div>

            <p><span className="font-extrabold">*</span> There must be at least one field filled out between IPv4 address, IPv6 address, and host name fields for <span className="italic">game servers</span>.</p>

            <h3 className="headline">Social Media</h3>
            <div className="form-div">
                <label htmlFor="social-twitter">Twitter</label>
                <input type="text" name="social-twitter" defaultValue={values?.social_twitter ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="social-youtube">YouTube</label>
                <input type="text" name="social-youtube"  defaultValue={values?.social_youtube ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="social-facebook">FaceBook</label>
                <input type="text" name="social-facebook" defaultValue={values?.social_facebook ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="social-tiktok">TikTok</label>
                <input type="text" name="social-tiktok" defaultValue={values?.social_tiktok ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="social-github">GitHub</label>
                <input type="text" name="social-github" defaultValue={values?.social_github ?? ""} />
            </div>

            <div className="form-div">
                <label htmlFor="social-steam">Steam Group</label>
                <input type="text" name="social-steam" defaultValue={values?.social_steam ?? ""} />
            </div>

            <p><span className="font-extrabold">*</span> You may input your tag, group name, or full URLs for social media.</p>

            <div className="form-btn-div">
                <button type="submit" className="btn btn-primary">{btn_text}</button>
            </div>
        </form>
    );
}

export default Form;