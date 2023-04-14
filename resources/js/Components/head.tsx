import { Head } from '@inertiajs/react';
import React from 'react';

const HeadInfo: React.FC<{
    title?: string
    description?: string
    robots?: string
    image?: string
    web_type?: string
    key_words?: string
}> = ({
    title,
    description,
    robots,
    image,
    web_type,
    key_words
}) => {
    let base_url;
    let full_url;

    if (typeof window !== "undefined") {
        base_url = window.location.protocol + "//" + window.location.host;
        full_url = base_url + window.location.pathname;
    }

    return (
        <Head>
            <link rel="canonical" href={full_url} key="canonical" />

            {title && (
                <>
                    <title>{title}</title>
                    <meta property="twitter:title" content={title} key="meta_twitterTitle" />
                    <meta property="og:title" content={title} key="meta_ogTitle" />
                </>
            )}

            {image && (
                <>
                    <link rel="apple-touch-icon" href={image} key="meta_appIcon" />
                    <meta property="og:image" content={image} key="meta_ogImg" />
                    <meta property="twitter:image" content={image} key="meta_twitterImg" />
                </>
            )}

            {robots && (
                <meta name="robots" content={robots} key="meta_robots" />
            )}

            {description && (
                    <>
                        <meta name="description" content={description} key="meta_desc" />
                        <meta property="twitter:description" content={description} key="meta_twitterDesc" />
                        <meta property="og:description" content={description} key="meta_ogDesc" />
                    </>
            )}

            {web_type && (
                <meta property="og:type" content={web_type} key="meta_ogWebType" />
            )}

            <meta httpEquiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
            <meta name="opt-targeting" content="{&quot;type&quot;:&quot;Browse&quot;}" />
            <meta httpEquiv="Content-Type" content="text/html; charset=UTF-8" />

            <link rel="icon" type="image/x-icon" href="/favicon.ico" />

            {key_words && (
                <meta name="keywords" content={key_words} key="meta_keywords" />
            )}      

            <meta property="twitter:card" content="summary_large_image" />
            <meta property="twitter:site" content="@bestserversio" />
            <meta property="twitter:creator" content="@bestserversio" />

            <meta property="og:locale" content="en_US" />
            <meta property="og:site_name" content="Best Servers" />
            <meta property="og:url" content={full_url} key="meta_ogUrl" />

            <meta name="msapplication-starturl" content={base_url} key="meta_msappUrl" />
            <meta name="application-name" content="Best Servers" />
            <meta name="apple-mobile-web-app-title" content="Best Servers" />
            <meta name="theme-color" content="#00DF0A" />
            <meta name="mobile-web-app-capable" content="yes" />
            <meta name="apple-touch-fullscreen" content="yes" />
            <meta name="apple-mobile-web-app-capable" content="yes" />
        </Head>
    );
}

export default HeadInfo;