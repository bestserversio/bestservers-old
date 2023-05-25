import React from 'react';

export type CategoryType = {
    id: number
    platformId: number
    parent: number | null

    name: string
    url: string | null
    description: string | null
}

export type PlatformType = {
    id: number

    engine: number

    name: string
    name_short: string
    description?: string
    url: string
    has_banner: boolean

    html5_supported: boolean
    html5_external: boolean
    html5_url: string | null
}

export type EngineType = {
    id: number

    name: string
    name_short: string
    description?: string

    is_discord: boolean
    is_a2s: boolean
}

export type ServerType = {
    id: number
    created_at: Date
    updated_at: Date

    name: string
    description: string | null
    url: string
    rules: string | null
    has_banner: boolean

    players: number
    max_players: number
    map: string | null
    last_scanned: Date | null
    last_stat: Date | null

    ipv4: string | null
    ipv6: string | null
    port: number | null
    host_name: string | null

    location_lat: number | null
    location_lon: number | null

    social_twitter: string | null
    social_youtube: string | null
    social_facebook: string | null
    social_tiktok: string | null
    social_instagram: string | null
    social_github: string | null
}

export type ErrorType = {
    title?: string
    message: string
}