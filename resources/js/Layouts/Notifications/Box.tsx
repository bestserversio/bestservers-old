import React from 'react';

const Box: React.FC<{
    title?: string
    message: string
    bg_class?: string
    text_class?: string
}> = ({
    title,
    message,
    bg_class="bg-red-600/50",
    text_class="text-white"
}) => {
    return (
        <div className={"p-6 rounded " + bg_class}>
            {title && (
                <h2 className="noti-title">{title}</h2>
            )}
            <p className={text_class}>{message}</p>
        </div>
    );
}

export default Box;