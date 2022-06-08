declare namespace App.DataTransferObjects {
export type FrontendState = {
user: App.DataTransferObjects.UserData | null;
};
export type UserData = {
name: string;
email: string;
};
}
