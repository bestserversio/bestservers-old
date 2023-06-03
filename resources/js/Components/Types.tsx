export type CategoryType = {
    id: number

    platformId: number
    parent?: number

    has_banner: boolean
    has_icon: boolean

    name: string
    name_short: string
    map_prefix?: string
    url: string | null
    description?: string
}

export type PlatformType = {
    id: number

    engine: number

    name: string
    name_short: string
    description?: string
    url: string

    has_banner: boolean
    has_icon: boolean

    html5_supported: boolean
    html5_external: boolean
    html5_url?: string
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

    platform: number
    category?: number

    name: string
    description: string | null
    url: string
    rules: string | null
    has_banner: boolean

    players: number
    max_players: number
    map?: string
    last_scanned?: Date
    last_stat?: Date

    ipv4?: string
    ipv6?: string
    port?: number
    host_name?: string

    location_lat?: number
    location_lon?: number

    social_website?: string
    social_twitter?: string
    social_youtube?: string
    social_facebook?: string
    social_tiktok?: string
    social_instagram?: string
    social_github?: string
    social_steam?: string
}

export type ServerStat = {
    players: number
    max_players: number
    date: Date
}

export type ErrorType = {
    title?: string
    message: string
}