import React from 'react';

const FormServerNew: React.FC = () => {
    return (
        <form className="form-gen" action="/servers/create" method="POST">
            <h3 className="headline">General</h3>
            <div className="form-div">
                <label htmlFor="banner">Banner</label>
                <input type="file" name="banner" />
                <p><input type="checkbox" name="b-remove" /> Remove</p>
            </div>

            <div className="form-div">
                <label htmlFor="name">Name*</label>
                <input type="text" name="name" />
            </div>

            <div className="form-div">
                <label htmlFor="description">Description</label>
                <textarea name="description" rows={15}></textarea>
            </div>

            <div className="form-div">
                <label htmlFor="url">URL</label>
                <input type="text" name="url" />
                <p className="form-description">URL to server. E.g. <span className="font-bold">bestservers.io/<span className="italic">URL</span></span></p>
            </div>

            <div className="form-div">
                <label htmlFor="rules">Rules</label>
                <textarea name="rules" rows={15}></textarea>
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
                <input type="text" name="ipv4" />
            </div>

            <div className="form-div">
                <label htmlFor="ipv6">IPv6 Address</label>
                <input type="text" name="ipv6" />
            </div>

            <div className="form-div">
                <label htmlFor="port">Port</label>
                <input type="text" name="port" />
            </div>

            <div className="form-div">
                <label htmlFor="hostname">Host Name</label>
                <input type="text" name="hostname" />
            </div>

            <p><span className="font-extrabold">*</span> There must be at least one field filled out between IPv4 address, IPv6 address, and host name fields for <span className="italic">game servers</span>.</p>

            <h3 className="headline">Social Media</h3>
            <div className="form-div">
                <label htmlFor="social-twitter">Twitter</label>
                <input type="text" name="social-twitter" />
            </div>

            <div className="form-div">
                <label htmlFor="social-youtube">YouTube</label>
                <input type="text" name="social-youtube" />
            </div>

            <div className="form-div">
                <label htmlFor="social-facebook">FaceBook</label>
                <input type="text" name="social-facebook" />
            </div>

            <div className="form-div">
                <label htmlFor="social-tiktok">TikTok</label>
                <input type="text" name="social-tiktok" />
            </div>

            <div className="form-div">
                <label htmlFor="social-github">GitHub</label>
                <input type="text" name="social-github" />
            </div>

            <div className="form-div">
                <label htmlFor="social-steam">Steam Group</label>
                <input type="text" name="social-steam" />
            </div>

            <p><span className="font-extrabold">*</span> You may input your tag, group name, or full URLs for social media.</p>
        </form>
    );
}

export default FormServerNew;