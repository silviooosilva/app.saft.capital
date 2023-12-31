import { Ref, App } from 'vue-demi';

interface LazyOptions {
    error?: string;
    loading?: string;
    observerOptions?: IntersectionObserverInit;
    log?: boolean;
    lifecycle?: Lifecycle;
    delay?: number;
}
declare enum LifecycleEnum {
    LOADING = "loading",
    LOADED = "loaded",
    ERROR = "error"
}
declare type Lifecycle = {
    [x in LifecycleEnum]?: (el?: HTMLElement) => void;
};

declare function useLazyload(src: Ref<string>, options?: LazyOptions): Ref<HTMLElement | null>;

declare const _default: {
    /**
     * install plugin
     *
     * @param {App} Vue
     * @param {LazyOptions} options
     */
    install(Vue: App, options: LazyOptions): void;
};

export { _default as default, useLazyload };
