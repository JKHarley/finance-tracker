import '@inertiajs/inertia';

declare module "@inertiajs/inertia" {
    interface PageProps extends App.DataTransferObjects.FrontendState {}
}
